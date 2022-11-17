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
 * classicrenderer theme PROXY callbacks
 * We want to call the parent theme versions
 *
 * @package    theme_classicrenderer
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot.'/theme/classic/lib.php');

function theme_classicrenderer_get_main_scss_content($theme) {
    $parent = theme_config::load('classic');
    return theme_classic_get_main_scss_content($parent);
}

function theme_classicrenderer_get_pre_scss($theme) {
    $parent = theme_config::load('classic');
    return theme_classic_get_pre_scss($parent);
}

function theme_classicrenderer_get_extra_scss($theme) {
    $parent = theme_config::load('classic');
    return theme_classic_get_extra_scss($parent);
}

function theme_classicrenderer_get_precompiled_css() {
    $parent = theme_config::load('classic');
    return theme_classic_get_precompiled_css($parent);
}

function theme_classicrenderer_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = array()) {
    return theme_classic_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, $options);
}
