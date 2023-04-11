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

import {getButtonImage} from 'editor_tiny/utils';
import {get_string as getString} from 'core/str';
import {component, buttonName, icon} from 'tiny_chemistry/common';
import {handleAction} from 'tiny_chemistry/ui';
import {getSelectedChemistry} from 'tiny_chemistry/chemistry';
import {isTexFilterActive} from 'tiny_chemistry/options';

/**
 * Tiny Chemistry commands.
 *
 * @module      tiny_chemistry/commands
 * @copyright   adapted for chemistry 2023 TOP Lehre FH OOE, Campus Hagenberg (elearning@fh-hagenberg.at), original based on Huong Nguyen <huongnv13@gmail.com> for equation (2022)
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

export const getSetup = async() => {
    const [
        buttonText,
        buttonImage,
    ] = await Promise.all([
        getString('buttontitle', component),
        getButtonImage('icon', component),
    ]);

    return (editor) => {
        if (isTexFilterActive(editor)) {
            // Register the Chemistry Icon.
            editor.ui.registry.addIcon(icon, buttonImage.html);

            // Register the Menu Button as a toggle.
            // This means that when highlighted over an existing Chemistry element it will show as toggled on.
            editor.ui.registry.addToggleButton(buttonName, {
                icon,
                tooltip: buttonText,
                onAction: () => {
                    handleAction(editor);
                },
                onSetup: (api) => {
                    editor.on('NodeChange', () => {
                        const result = getSelectedChemistry(editor);
                        api.setActive(result);
                    });
                },
            });

            // Add the Chemistry Menu Item.
            // This allows it to be added to a standard menu, or a context menu.
            editor.ui.registry.addMenuItem(buttonName, {
                icon,
                text: buttonText,
                onAction: () => handleAction(editor),
            });
        }
    };
};
