<?php

require_once($CFG->dirroot.'/course/renderer.php');

class theme_classicrenderer_core_course_renderer extends core_course_renderer {

    /**
     * Renders the activity navigation.
     * (in an activity it's the bottom of the page)
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

    public function course_info_box(stdClass $course) {
        $content = '';
        $content .= $this->output->box_start('generalbox info');
        $chelper = new coursecat_helper();
        $chelper->set_show_courses(self::COURSECAT_SHOW_COURSES_EXPANDED);
        $content .= $this->coursecat_coursebox($chelper, $course);
        $content .= $this->output->box_end();
        return $content;
    }

    // lets wrap this in a way we can identify
    protected function coursecat_coursebox(coursecat_helper $chelper, $course, $additionalclasses = '') {
        if (!isset($this->strings->summary)) {
            $this->strings->summary = get_string('summary');
        }
        if ($chelper->get_show_courses() <= self::COURSECAT_SHOW_COURSES_COUNT) {
            return '';
        }
        if ($course instanceof stdClass) {
            $course = new core_course_list_element($course);
        }
        $classes = trim('coursecat-coursebox coursebox clearfix '. $additionalclasses);
        if ($chelper->get_show_courses() < self::COURSECAT_SHOW_COURSES_EXPANDED) {
            $classes .= ' collapsed';
        }

        $content = $this->output->box_start($classes, null, [
            'data-courseid' => $course->id,
            'data-type' => self::COURSECAT_TYPE_COURSE,
        ]);

        $content .= html_writer::start_tag('div', array('class' => 'info'));
        $content .= $this->course_name($chelper, $course);
        $content .= $this->course_enrolment_icons($course);
        $content .= html_writer::end_tag('div');

        $content .= html_writer::start_tag('div', array('class' => 'content'));
        $content .= $this->coursecat_coursebox_content($chelper, $course);
        $content .= html_writer::end_tag('div');

        $content .= $this->output->box_end();

        return $content;
    }


    // render a course info box, typically used on the ENROL screen
    // lets add some css target names so we can more easily control what is visible
    // some items wrap internally, other don't.
    protected function coursecat_coursebox_content(coursecat_helper $chelper, $course) {
        if ($chelper->get_show_courses() < self::COURSECAT_SHOW_COURSES_EXPANDED) {
            return '';
        }
        if ($course instanceof stdClass) {
            $course = new core_course_list_element($course);
        }
        $content =  \html_writer::tag('div', $this->course_summary($chelper, $course), ['class'=>'course-summary']);
        $content .= \html_writer::tag('div', $this->course_overview_files($course), ['class'=>'course-overview-files']);
        $content .= \html_writer::tag('div', $this->course_contacts($course), ['class'=>'course-contacts']);
        $content .= \html_writer::tag('div', $this->course_category_name($chelper, $course), ['class'=>'course-category-name']);
        $content .= $this->course_custom_fields($course); // already uses class="customfields-container" 
        return \html_writer::tag('div', $content, ['class' => 'coursecat-coursebox-content']);
    }

}