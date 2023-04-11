// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Tiny Chemistry UI.
 *
 * @module      tiny_chemistry/ui
 * @copyright   adapted for chemistry 2023 TOP Lehre FH OOE, Campus Hagenberg (elearning@fh-hagenberg.at), original based on Huong Nguyen <huongnv13@gmail.com> for equation (2022)
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

import ChemistryModal from 'tiny_chemistry/modal';
import ModalFactory from 'core/modal_factory';
import ModalEvents from 'core/modal_events';
import {getLibraries, getTexDocsUrl} from 'tiny_chemistry/options';
import {notifyFilterContentUpdated} from 'core/event';
import * as TinyChemistryRepository from 'tiny_chemistry/repository';
import {displayException} from 'core/notification';
import {debounce} from 'core/utils';
import Selectors from 'tiny_chemistry/selectors';
import {getSourceChemistry, getCurrentChemistryData, setChemistry} from 'tiny_chemistry/chemistry';

let currentForm;
let lastCursorPos = 0;

/**
 * Handle action
 * @param {TinyMCE} editor
 */
export const handleAction = (editor) => {
    displayDialogue(editor);
};

/**
 * Display the chemistry editor
 * @param {TinyMCE} editor
 * @returns {Promise<void>}
 */
const displayDialogue = async(editor) => {
    let data = {};
    const currentChemistryData = getCurrentChemistryData(editor);
    if (currentChemistryData) {
        Object.assign(data, currentChemistryData);
    }
    const modalPromises = await ModalFactory.create({
        type: ChemistryModal.TYPE,
        templateContext: getTemplateContext(editor, data),
        large: true,
    });

    modalPromises.show();
    const $root = await modalPromises.getRoot();
    const root = $root[0];
    currentForm = root.querySelector(Selectors.elements.form);

    $root.on(ModalEvents.hidden, () => {
        modalPromises.destroy();
    });

    $root.on(ModalEvents.shown, () => {
        const library = root.querySelector(Selectors.elements.library);
        TinyChemistryRepository.filterChemistry(1, library.innerHTML).then(async data => {
            library.innerHTML = data.content;
            updatePreview();
            notifyFilter(library);
            return data;
        }).catch(displayException);
    });

    root.addEventListener('click', (e) => {
        const libraryItem = e.target.closest(Selectors.elements.libraryItem);
        const submitAction = e.target.closest(Selectors.actions.submit);
        const textArea = e.target.closest('.tiny_chemistry_chemistry');
        if (libraryItem) {
            e.preventDefault();
            selectLibraryItem(libraryItem);
        }
        if (submitAction) {
            e.preventDefault();
            setChemistry(currentForm, editor);
            modalPromises.destroy();
        }
        if (textArea) {
            debounce(updatePreview(), 500);
        }
    });

    root.addEventListener('keyup', (e) => {
        const textArea = e.target.closest(Selectors.elements.chemistryTextArea);
        if (textArea) {
            debounce(updatePreview(), 500);
        }
    });

    root.addEventListener('keydown', (e) => {
        const libraryItem = e.target.closest(Selectors.elements.libraryItem);
        if (libraryItem) {
            if (e.keyCode == 37 || e.keyCode == 39) {
                groupNavigation(e);
            }
        }
    });
};

/**
 * Get template context.
 * @param {TinyMCE} editor
 * @param {Object} data
 * @returns {Object}
 */
const getTemplateContext = (editor, data) => {
    const libraries = getLibraries(editor);
    const texDocsUrl = getTexDocsUrl(editor);

    return Object.assign({}, {
        elementid: editor.id,
        libraries: libraries,
        texdocsurl: texDocsUrl,
        delimiters: Selectors.delimiters,
    }, data);
};

/**
 * Handle select library item.
 * @param {Object} libraryItem
 */
const selectLibraryItem = (libraryItem) => {
    const tex = libraryItem.getAttribute('data-tex');
    const input = currentForm.querySelector(Selectors.elements.chemistryTextArea);
    let oldValue;
    let newValue;
    let focusPoint = 0;

    oldValue = input.value;

    newValue = oldValue.substring(0, lastCursorPos);
    if (newValue.charAt(newValue.length - 1) !== ' ') {
        newValue += ' ';
    }
    newValue += tex;
    focusPoint = newValue.length;

    if (oldValue.charAt(lastCursorPos) !== ' ') {
        newValue += ' ';
    }
    newValue += oldValue.substring(lastCursorPos, oldValue.length);

    input.value = newValue;
    input.focus();

    input.selectionStart = input.selectionEnd = focusPoint;

    updatePreview();
};

/**
 * Update the preview section.
 */
const updatePreview = () => {
    const textarea = currentForm.querySelector(Selectors.elements.chemistryTextArea);
    const preview = currentForm.querySelector(Selectors.elements.preview);
    const prefix = '';
    const cursorLatex = Selectors.cursorLatex;
    const isChar = /[a-zA-Z{]/;
    let currentPos = textarea.selectionStart;
    let chemistry = textarea.value;

    // Move the cursor so it does not break expressions.
    // Start at the very beginning.
    if (!currentPos) {
        currentPos = 0;
    }

    if (getSourceChemistry()) {
        currentPos = chemistry.length;
    }

    // First move back to the beginning of the line.
    while (chemistry.charAt(currentPos) === '\\' && currentPos >= 0) {
        currentPos -= 1;
    }
    if (currentPos !== 0) {
        if (chemistry.charAt(currentPos - 1) != '{') {
            // Now match to the end of the line.
            while (isChar.test(chemistry.charAt(currentPos)) &&
                    currentPos < chemistry.length &&
                    isChar.test(chemistry.charAt(currentPos - 1))) {
                currentPos += 1;
            }
        }
    }
    // Save the cursor position - for insertion from the library.
    lastCursorPos = currentPos;
    chemistry = prefix + chemistry.substring(0, currentPos) + cursorLatex + chemistry.substring(currentPos);

    chemistry = Selectors.delimiters.start + ' ' + chemistry + ' ' + Selectors.delimiters.end;
    TinyChemistryRepository.filterChemistry(1, chemistry).then((data) => {
        preview.innerHTML = data.content;
        notifyFilter(preview);

        return data;
    }).catch(displayException);
};

/**
 * Notify the filters about the modified nodes
 * @param {Element} element
 */
const notifyFilter = (element) => {
    notifyFilterContentUpdated(element);
};

/**
 * Callback handling the keyboard navigation in the groups of the library.
 * @param {Event} e
 */
const groupNavigation = (e) => {
    e.preventDefault();

    const current = e.target.closest(Selectors.elements.libraryItem);
    const parent = current.parentNode; // This must be the <div> containing all the buttons of the group.
    const buttons = Array.prototype.slice.call(parent.querySelectorAll(Selectors.elements.libraryItem));
    const direction = e.keyCode !== 37 ? 1 : -1;
    let index = buttons.indexOf(current);
    let nextButton;

    if (index < 0) {
        index = 0;
    }

    index += direction;
    if (index < 0) {
        index = buttons.length - 1;
    } else if (index >= buttons.length) {
        index = 0;
    }
    nextButton = buttons[index];
    nextButton.focus();
};
