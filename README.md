# GMT Courses
A no-frills courses plugin.

[Download Courses](https://github.com/cferdinandi/gmt-courses/archive/master.zip)



## Getting Started

Getting started with Courses is as simple as installing a plugin:

1. Upload the `gmt-courses` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the Plugins menu in WordPress.
3. Create a course under `Courses` in the WordPRess dashboard.
4. Create lessons under `Courses` as well, and associate them with a course.
5. Lessons and modules can be rearranged via drag-and-drop under their associated course.

And that's it, you're done. Nice work!

It's recommended that you also install the [GitHub Updater plugin](https://github.com/afragen/github-updater) to get automattic updates.



## How do you display courses in your WordPress theme?

As a custom post type, you can use WordPress's built-in post type templates. The custom post type name is `gmt_lessons` for lessons, and `gmt_courses` for courses.

**This is not a plug-and-play solution.** It's a framework for building on top of.



## Utility methods

```php
/**
 * Get all of the lessons associated with a course
 * @param  number  $module_id The course ID
 * @param  boolean $any       If true, get all lessons (including unpublished)
 * @return array              An array of post objects
 */
gmt_courses_get_lessons( $course_id, $any = false );


/**
 * Get the next and previous lessons that are not modules
 * @param  number $post_id The current lesson ID
 * @return array           The next and previous lessons
 */
gmt_courses_get_next_and_previous_lessons( $post_id );
```



## How to Contribute

Please read the [Contribution Guidelines](CONTRIBUTING.md).



## License

The code is available under the [GPLv3](LICENSE.md).