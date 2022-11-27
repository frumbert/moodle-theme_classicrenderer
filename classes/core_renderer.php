<?php

namespace theme_classicrenderer\output;

use moodle_url;
use html_writer;
use renderer_base;
use single_button;

defined('MOODLE_INTERNAL') || die;

class core_renderer extends \core_renderer {

    public function edit_button(moodle_url $url) {
        $url->param('sesskey', sesskey());
        if ($this->page->user_is_editing()) {
            $url->param('edit', 'off');
            $editstring = get_string('turneditingoff');
        } else {
            $url->param('edit', 'on');
            $editstring = get_string('turneditingon');
        }
        $button = new single_button($url, $editstring, 'post', ['class' => 'btn btn-danger']);
        return $this->render_single_button($button);
    }

    public function box_start($classes = 'generalbox', $id = null, $attributes = array()) {
        $this->opencontainers->push('box', html_writer::end_tag('div'));
        $attributes['id'] = $id;
        $attributes['class'] = 'core-box ' . renderer_base::prepare_classes($classes);
        return html_writer::start_tag('div', $attributes);
    }

}