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
 * classicrenderer config.
 *
 * @package   theme_classicrenderer
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();
$THEME->name = 'classicrenderer';
$THEME->parents = ['classic'];
$THEME->rendererfactory = 'theme_overridden_renderer_factory';

$THEME->extrascsscallback = 'theme_classicrenderer_get_extra_scss';
$THEME->prescsscallback = 'theme_classicrenderer_get_pre_scss';
$THEME->precompiledcsscallback = 'theme_classicrenderer_get_precompiled_css';
$THEME->scss = function($theme) {
    $parent = theme_config::load('classic');
    return theme_classic_get_main_scss_content($parent);
};

// execute this when the theme loads
// don't allow anonymous logon in this theme
if (file_exists($CFG->dirroot . '/auth/anonymous/lib.php')) {
    require_once($CFG->dirroot . '/auth/anonymous/lib.php');
    auth_anonymous_autologout();
}