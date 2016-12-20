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
 * Get all of the courses
 * @param  boolean $any If true, get all courses (including unpublished)
 * @return [type]       [description]
 */
gmt_courses_get_courses( $any = false );


/**
 * Get all of the lessons associated with a course
 * @param  number  $module_id The course ID
 * @param  boolean $any       If true, get all lessons (including unpublished)
 * @return array              An array of post objects
 */
gmt_courses_get_lessons( $course_id, $any = false );


/**
 * Get the next lesson that's not a module
 * @param  array  $lessons An array of lesson objects
 * @param  number $current The current lesson ID
 * @return object          The next lesson object
 */
gmt_courses_get_next_lesson( $lessons, $current );


/**
 * Get the previous lesson that's not a module
 * @param  array  $lessons An array of lesson objects
 * @param  number $current The current lesson ID
 * @return object          The previous lesson object
 */
gmt_courses_get_previous_lesson( $lessons, $current );


/**
 * Get the next and previous lessons that are not modules
 * @param  number $post_id The current lesson ID
 * @return array           The next and previous lessons
 */
gmt_courses_get_next_and_previous_lessons( $post_id );



/**
 * Get the first lesson in a course that isn't a module
 * @todo   Make sure the first lessons isn't a module...
 * @param  number  $module_id The course ID
 * @param  boolean $any       If true, get all lessons (including unpublished)
 * @return object             The course
 */
gmt_courses_get_first_lesson( $course_id, $any = false );


/**
 * Get the first module in a course
 * @todo   Make sure the first lessons isn't a module...
 * @param  number  $module_id The course ID
 * @param  boolean $any       If true, get all lessons (including unpublished)
 * @return object             The course
 */
gmt_courses_get_first_module( $course_id, $any = false );
```



## Examples

### Looping through all lessons to create a course curriculum

```php
// Variable
// Get lessons
$lessons = gmt_courses_get_lessons( get_post_meta( $post_id, 'gmt_courses_course', true ) );
$curriculum = '';

// Loop through each lesson
foreach( $lessons as $key => $lesson ) {

	// Get the lesson type
	$type = get_post_meta( $lesson->ID, 'gmt_courses_lesson_type', true );

	// Modules
	if ( $type === 'module' ) {
		$curriculum .=
			'<tr>' .
				'<th>' . $lesson->post_title . '</th>' .
			'</tr>';
	} else {
	// Lessons

		// Get the video length
		$length = get_post_meta( $lesson->ID, 'gmt_courses_lesson_video_length', true );
		$curriculum .=
			'<tr>' .
				'<td>' .
					'<a href="' . get_permalink( $lesson->ID ) . '">' . $lesson->post_title . '</a>' .
					( empty( $length ) ? '' : '&nbsp;<em>(' . esc_html( $length ) . ')</em>' ) .
				'</td>' .
			'</tr>';
	}
}
```

## Next lesson/previous lesson navigation links

```php
// Get next and previous lessons
$adjacent_lessons = gmt_courses_get_next_and_previous_lessons( $post_id );
$nav = '';

// If there's a next lesson
if ( !empty( $adjacent_lessons['next'] ) ) {
	$nav .= '<li><a href="' . get_permalink( $adjacent_lessons['next']->ID ) . '">' . $adjacent_lessons['next']->post_title . '</a></li>';
}

// If there's a previous lesson
if ( !empty( $adjacent_lessons['previous'] ) ) {
	$nav .= '<li><a href="' . get_permalink( $adjacent_lessons['previous']->ID ) . '">' . $adjacent_lessons['previous']->post_title . '</a></li>';
}

if ( !empty( $nav ) ) {
	echo
		'<nav>' .
			'<ul>' .
				$nav .
			'</ul>' .
		'</nav>';
}
```



## How to Contribute

Please read the [Contribution Guidelines](CONTRIBUTING.md).



## License

The code is available under the [GPLv3](LICENSE.md).