<?php
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
 * Tiny chemistry plugin.
 *
 * @package    tiny_chemistry
 * @copyright  adapted for chemistry 2023 TOP Lehre FH OOE, Campus Hagenberg (elearning@fh-hagenberg.at), original based on Huong Nguyen <huongnv13@gmail.com> for equation (2022)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tiny_chemistry;

use context;
use context_system;
use editor_tiny\editor;
use editor_tiny\plugin;
use editor_tiny\plugin_with_buttons;
use editor_tiny\plugin_with_configuration;
use editor_tiny\plugin_with_menuitems;
use filter_manager;

/**
 * Tiny chemistry plugin.
 *
 * @package    tiny_chemistry
 * @copyright  2022 Huong Nguyen <huongnv13@gmail.com> for equation, adapted for chemistry 2023 TOP Lehre FH OOE, Campus Hagenberg (elearning@fh-hagenberg.at)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class plugininfo extends plugin implements plugin_with_buttons, plugin_with_menuitems, plugin_with_configuration {

    public static function get_available_buttons(): array {
        return [
            'tiny_chemistry/chemistry',
        ];
    }

    public static function get_available_menuitems(): array {
        return [
            'tiny_chemistry/chemistry',
        ];
    }

    public static function get_plugin_configuration_for_context(context $context, array $options, array $fpoptions,
        ?editor $editor = null): array {
        $texexample = '$$\pi$$';
        // Format a string with the active filter set.
        // If it is modified - we assume that some sort of text filter is working in this context.
        $result = format_text($texexample, true, $options);
        $texfilteractive = ($texexample !== $result);

        if (isset($options['context'])) {
            $context = $options['context'];
        } else {
            $context = context_system::instance();
        }

        $libraries = [
            [
                'key' => 'group1',
                'groupname' => get_string('librarygroup1', 'tiny_chemistry'),
                'elements' => explode("\n", trim(get_config('tiny_chemistry', 'librarygroup1'))),
                'active' => true,
            ],
            [
                'key' => 'group2',
                'groupname' => get_string('librarygroup2', 'tiny_chemistry'),
                'elements' => explode("\n", trim(get_config('tiny_chemistry', 'librarygroup2'))),
            ],
            [
                'key' => 'group3',
                'groupname' => get_string('librarygroup3', 'tiny_chemistry'),
                'elements' => explode("\n", trim(get_config('tiny_chemistry', 'librarygroup3'))),
            ],
            [
                'key' => 'group4',
                'groupname' => get_string('librarygroup4', 'tiny_chemistry'),
                'elements' => explode("\n", trim(get_config('tiny_chemistry', 'librarygroup4'))),
            ],
            [
                'key' => 'group5',
                'groupname' => get_string('librarygroup5', 'tiny_chemistry'),
                'elements' => explode("\n", trim(get_config('tiny_chemistry', 'librarygroup5'))),
            ],           
        ];

        return [
            'texfilter' => $texfilteractive,
            'contextid' => $context->id,
            'libraries' => $libraries,
            'texdocsurl' => get_docs_url('Using_TeX_Notation'),
        ];
    }
}
