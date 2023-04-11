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
 * Tiny Chemistry plugin helper function to build queryable data selectors.
 *
 * @module      tiny_chemistry/selectors
 * @copyright   adapted for chemistry 2023 TOP Lehre FH OOE, Campus Hagenberg (elearning@fh-hagenberg.at), original based on Huong Nguyen <huongnv13@gmail.com> for equation (2022)
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

export default {
    chemistryPatterns: [
        // We use space or not space because . does not match new lines.
        // $$\ce{ blah }$$.
        /\$\$(\\ce\{[\S\s]+?)\}\$\$/,
        // E.g. "\(\ce{ blah }\)".
        /\\\(\\ce\{([\S\s]+?)\}\\\)/,
        // E.g. "\[\ce{ blah }\]".
        /\\\[\\ce\{([\S\s]+?)\}\\\]/,
        // E.g. "[tex]\ce{ blah }[/tex]".
        /\[tex\]\\ce\{([\S\s]+?)\}\[\/tex\]/
    ],
    delimiters: {
        start: '\\(',
        end: '\\)'
    },
    cursorLatex: '\\Downarrow ',
    actions: {
        submit: '[data-action="save"]'
    },
    elements: {
        form: 'form',
        library: '.tiny_chemistry_library',
        libraryItem: '.tiny_chemistry_library button',
        chemistryTextArea: '.tiny_chemistry_chemistry',
        preview: '.tiny_chemistry_preview',
    }
};
