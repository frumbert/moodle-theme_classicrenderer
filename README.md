ClassicRenderer
===============

This Moodle theme inherits from Classic and provides NO settings of its own.

The purpose is to provide a way to override renderers without changing the appearance or features of the parent theme.

It currently has ONE renderer override:

- core_course_renderer

This currently looks to see if the course format is [onetopicplus](https://github.com/frumbert/moodle-format_onetopicplus) and then modifies the activity navigation which you get underneath activity pages, instead drawing a 'Return to course home' button instead of previous/next navigation.