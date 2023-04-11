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
 * Privacy Subsystem implementation for the Chemistry plugin for TinyMCE.
 *
 * @package    tiny_chemistry
 * @copyright  adapted for chemistry 2023 TOP Lehre FH OOE, Campus Hagenberg (elearning@fh-hagenberg.at), original based on Huong Nguyen <huongnv13@gmail.com> for equation (2022)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tiny_chemistry\privacy;

/**
 * Privacy Subsystem implementation for the Chemistry plugin for TinyMCE.
 *
 * @package    tiny_chemistry
 * @copyright  2022 Huong Nguyen <huongnv13@gmail.com> for equation, adapted for chemistry 2023 TOP Lehre FH OOE, Campus Hagenberg (elearning@fh-hagenberg.at)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class provider implements \core_privacy\local\metadata\null_provider {

    public static function get_reason(): string {
        return 'privacy:metadata';
    }
}
