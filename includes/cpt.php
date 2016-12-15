<?php

	/**
	 * Add custom post type for lessons
	 */
	function gmt_courses_add_custom_post_type_lessons() {

		$labels = array(
			'name'               => _x( 'Lessons', 'post type general name', 'gmt_courses' ),
			'singular_name'      => _x( 'Lesson', 'post type singular name', 'gmt_courses' ),
			'add_new'            => _x( 'Add New', 'keel-pets', 'gmt_courses' ),
			'add_new_item'       => __( 'Add New Lesson', 'gmt_courses' ),
			'edit_item'          => __( 'Edit Lesson', 'gmt_courses' ),
			'new_item'           => __( 'New Lesson', 'gmt_courses' ),
			'all_items'          => __( 'All Lessons', 'gmt_courses' ),
			'view_item'          => __( 'View Lesson', 'gmt_courses' ),
			'search_items'       => __( 'Search Lessons', 'gmt_courses' ),
			'not_found'          => __( 'No lessons found', 'gmt_courses' ),
			'not_found_in_trash' => __( 'No lessons found in the Trash', 'gmt_courses' ),
			'parent_item_colon'  => '',
			'menu_name'          => __( 'Lessons', 'gmt_courses' ),
		);
		$args = array(
			'labels'        => $labels,
			'description'   => 'Holds our lesson data',
			'public'        => true,
			// 'show_ui'       => true,
			// 'has_archive'   => false,
			// 'exclude_from_search' => true,
			// 'publicly_queryable' => false,
			// 'query_var' => false,
			// 'menu_position' => 5,
			'menu_icon'     => 'dashicons-controls-play',
			// 'hierarchical'  => false,
			'supports'      => array(
				'title',
				'editor',
				// 'thumbnail',
				'excerpt',
				'revisions',
				// 'page-attributes',
				'wpcom-markdown',
			),
			'rewrite' => array(
				'slug' => 'lessons',
			),
			// 'map_meta_cap'  => true,
			// 'capabilities' => array(
			// 	'create_posts' => false,
			// 	'edit_published_posts' => false,
			// 	'delete_posts' => false,
			// 	'delete_published_posts' => false,
			// )
		);
		register_post_type( 'gmt_lessons', $args );
	}
	add_action( 'init', 'gmt_courses_add_custom_post_type_lessons' );



	/**
	 * Add custom post type for courses
	 */
	function gmt_courses_add_custom_post_type_courses() {

		$labels = array(
			'name'               => _x( 'Courses', 'post type general name', 'gmt_courses' ),
			'singular_name'      => _x( 'Course', 'post type singular name', 'gmt_courses' ),
			'add_new'            => _x( 'Add New', 'keel-pets', 'gmt_courses' ),
			'add_new_item'       => __( 'Add New Course', 'gmt_courses' ),
			'edit_item'          => __( 'Edit Course', 'gmt_courses' ),
			'new_item'           => __( 'New Course', 'gmt_courses' ),
			'all_items'          => __( 'Courses', 'gmt_courses' ),
			'view_item'          => __( 'View Course', 'gmt_courses' ),
			'search_items'       => __( 'Search Courses', 'gmt_courses' ),
			'not_found'          => __( 'No courses found', 'gmt_courses' ),
			'not_found_in_trash' => __( 'No courses found in the Trash', 'gmt_courses' ),
			'parent_item_colon'  => '',
			'menu_name'          => __( 'Courses', 'gmt_courses' ),
		);
		$args = array(
			'labels'        => $labels,
			'description'   => 'Holds our course data',
			'public'        => false,
			'show_ui'       => true,
			'has_archive'   => false,
			'exclude_from_search' => true,
			'publicly_queryable' => false,
			'query_var' => false,
			// 'menu_position' => 5,
			// 'menu_icon'     => 'dashicons-money',
			'hierarchical'  => false,
			'supports'      => array(
				'title',
				'editor',
				// 'thumbnail',
				// 'excerpt',
				'revisions',
				// 'page-attributes',
				'wpcom-markdown',
			),
			'show_in_menu'  => 'edit.php?post_type=gmt_lessons',
			// 'rewrite' => array(
			// 	'slug' => 'courses',
			// ),
			// 'map_meta_cap'  => true,
			// 'capabilities' => array(
			// 	'create_posts' => false,
			// 	'edit_published_posts' => false,
			// 	'delete_posts' => false,
			// 	'delete_published_posts' => false,
			// )
		);
		register_post_type( 'gmt_courses', $args );
	}
	add_action( 'init', 'gmt_courses_add_custom_post_type_courses' );



	/**
	 * Add custom post type for course modules
	 */
	function gmt_courses_add_custom_post_type_modules() {

		$labels = array(
			'name'               => _x( 'Modules', 'post type general name', 'gmt_courses' ),
			'singular_name'      => _x( 'Module', 'post type singular name', 'gmt_courses' ),
			'add_new'            => _x( 'Add New', 'keel-pets', 'gmt_courses' ),
			'add_new_item'       => __( 'Add New Module', 'gmt_courses' ),
			'edit_item'          => __( 'Edit Module', 'gmt_courses' ),
			'new_item'           => __( 'New Module', 'gmt_courses' ),
			'all_items'          => __( 'Modules', 'gmt_courses' ),
			'view_item'          => __( 'View Module', 'gmt_courses' ),
			'search_items'       => __( 'Search Modules', 'gmt_courses' ),
			'not_found'          => __( 'No modules found', 'gmt_courses' ),
			'not_found_in_trash' => __( 'No modules found in the Trash', 'gmt_courses' ),
			'parent_item_colon'  => '',
			'menu_name'          => __( 'Modules', 'gmt_courses' ),
		);
		$args = array(
			'labels'        => $labels,
			'description'   => 'Holds our course module data',
			'public'        => false,
			'show_ui'       => true,
			'has_archive'   => false,
			'exclude_from_search' => true,
			'publicly_queryable' => false,
			'query_var' => false,
			// 'menu_position' => 5,
			// 'menu_icon'     => 'dashicons-money',
			'hierarchical'  => false,
			'supports'      => array(
				'title',
				'editor',
				// 'thumbnail',
				// 'excerpt',
				'revisions',
				// 'page-attributes',
				'wpcom-markdown',
			),
			'show_in_menu'  => 'edit.php?post_type=gmt_lessons',
			// 'rewrite' => array(
			// 	'slug' => 'courses',
			// ),
			// 'map_meta_cap'  => true,
			// 'capabilities' => array(
			// 	'create_posts' => false,
			// 	'edit_published_posts' => false,
			// 	'delete_posts' => false,
			// 	'delete_published_posts' => false,
			// )
		);
		register_post_type( 'gmt_course_modules', $args );
	}
	add_action( 'init', 'gmt_courses_add_custom_post_type_modules' );