<?php

require_once($CFG->dirroot.'/course/renderer.php');

class theme_classicrenderer_core_course_renderer extends core_course_renderer {

    /**
     * Renders the activity navigation.
     *
     * @param \core_course\output\activity_navigation $page
     * @return string html for the page
     */
    public function render_activity_navigation(\core_course\output\activity_navigation $page) {
        $format = $this->page->course->format;
        if ($format === "onetopicplus") {
            $data = new stdClass();
            $data->sectionnum = $this->page->cm->sectionnum;
            $data->courseid = $this->page->course->id;
            $data->text = get_string('returntext', 'theme_classicrenderer');
            $template = 'theme_classicrenderer/activity_navigation';
        } else {
            $template = 'core_course/activity_navigation';
            $data = $page->export_for_template($this->output);
        }
        return $this->output->render_from_template($template, $data);
    }

}