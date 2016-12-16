<?php

	/**
	 * Create the metaboxes
	 */
	function gmt_courses_create_metaboxes() {

		// Lesson video
		add_meta_box( 'gmt_courses_metabox_lesson_video', __( 'Lesson Video', 'gmt_courses' ), 'gmt_courses_render_metabox_lesson_video', 'gmt_lessons', 'normal', 'default');

		// Pick the lesson type
		add_meta_box( 'gmt_courses_metabox_lesson_type', __( 'Lesson Type', 'gmt_courses' ), 'gmt_courses_render_metabox_lesson_type', 'gmt_lessons', 'side', 'default');

		// Pick the course for the lesson
		add_meta_box( 'gmt_courses_metabox_course', __( 'Course', 'gmt_courses' ), 'gmt_courses_render_metabox_course', 'gmt_lessons', 'side', 'default');

		// Reorder and organize all lessons for a course
		add_meta_box( 'gmt_courses_metabox_lessons', __( 'Lessons', 'gmt_courses' ), 'gmt_courses_render_metabox_lessons', 'gmt_courses', 'normal', 'default');

		// Pick the downloads that have access to this course
		// @todo move to another plugin
		// add_meta_box( 'gmt_courses_metabox_downloads', __( 'Downloads', 'gmt_courses' ), 'gmt_courses_render_metabox_downloads', 'gmt_courses', 'side', 'default');

	}
	add_action( 'add_meta_boxes', 'gmt_courses_create_metaboxes' );



	/**
	 * Render the lesson details metabox
	 */
	function gmt_courses_render_metabox_lesson_video() {

		// Variables
		global $post;

		?>

			<fieldset>

				<div>
					<input type="text" class="large-text" id="gmt_courses_lesson_video" name="gmt_courses_lesson_video[video]" value="<?php echo esc_attr( get_post_meta( $post->ID, 'gmt_courses_lesson_video', true ) ); ?>">
					<label for="gmt_courses_lesson_video"><?php _e( 'URL of the lesson video', 'gmt_courses' ); ?></label>
				</div>
				<br>

				<div>
					<input type="text" class="regular-text" id="gmt_courses_lesson_video_length" name="gmt_courses_lesson_video[length]" value="<?php echo esc_attr( get_post_meta( $post->ID, 'gmt_courses_lesson_video_length', true ) ); ?>">
					<label for="gmt_courses_lesson_video_length"><?php _e( 'Video length', 'gmt_courses' ); ?></label>
				</div>

			</fieldset>

		<?php

		wp_nonce_field( 'gmt_courses_metabox_lesson_video_nonce', 'gmt_courses_metabox_lesson_video_process' );
	}



	/**
	 * Create an extendable list of lesson types
	 * @return [type] [description]
	 */
	function gmt_courses_get_lesson_types() {
		$types = array(
			'lesson' => __( 'Lesson', 'gmt_courses' ),
			'module' => __( 'Module', 'gmt_courses' ),
		);

		return apply_filters( 'gmt_courses_get_lesson_types', $types );
	}



	/**
	 * Render the lesson type metabox
	 */
	function gmt_courses_render_metabox_lesson_type() {

		// Variables
		global $post;
		$lesson_type = get_post_meta( $post->ID, 'gmt_courses_lesson_type', true );
		$types = gmt_courses_get_lesson_types();

		?>

			<fieldset>

				<?php foreach( $types as $key => $type ) : ?>

					<label>
						<input type="radio" name="gmt_courses_lesson_type" value="<?php echo $key; ?>" <?php checked( $lesson_type, $key ); if ( $key === 'lesson' ) { checked( $lesson_type, '' ); } ?>>
						<?php echo $type; ?>
					</label>
					<br>

				<?php endforeach; ?>

			</fieldset>

		<?php

		wp_nonce_field( 'gmt_courses_metabox_lesson_type_nonce', 'gmt_courses_metabox_lesson_type_process' );
	}



	/**
	 * Render the course metabox
	 */
	function gmt_courses_render_metabox_course() {

		// Variables
		global $post;
		$the_course = get_post_meta( $post->ID, 'gmt_courses_course', true );
		$courses = get_posts(array(
			'posts_per_page'   => -1,
			'post_type'        => 'gmt_courses',
			'post_status'      => 'any',
			'orderby'          => 'menu_order',
			'order'            => 'ASC',
		));

		?>

			<fieldset>

				<?php foreach( $courses as $course ) : ?>

					<label>
						<input type="radio" name="gmt_courses_course" value="<?php echo $course->ID; ?>" <?php checked( $the_course, $course->ID ); ?>>
						<?php echo $course->post_title; ?>
					</label>
					<br>

				<?php endforeach; ?>

			</fieldset>

		<?php

		wp_nonce_field( 'gmt_courses_metabox_course_nonce', 'gmt_courses_metabox_course_process' );
	}



	/**
	 * Render the lessons metabox
	 */
	function gmt_courses_render_metabox_lessons() {

		// Variables
		global $post;
		$lessons = gmt_courses_get_lessons( $post->ID, true );

		?>

			<fieldset class="list-modules">

				<p>Drag-and-drop modules and lessons to reorder them.</p>

				<ul class="list-lessons">
					<?php foreach( $lessons as $lesson ) : ?>
						<?php
							// Get the lesson type
							$type = get_post_meta( $lesson->ID, 'gmt_courses_lesson_type', true );
						?>
						<li class="list-lessons-lesson">
							<?php if ( $type === 'module' ) : ?>
								<h3>
							<?php endif; ?>
							<input type="hidden" name="gmt_courses_lesson_order[]" value="<?php echo $lesson->ID; ?>">
							&varr; <?php echo $lesson->post_title; ?>
							<?php if ( $type === 'module' ) : ?>
								</h3>
							<?php endif; ?>
						</li>
					<?php endforeach; ?>
				</ul>

			</fieldset>

		<?php

		wp_nonce_field( 'gmt_courses_metabox_lessons_nonce', 'gmt_courses_metabox_lessons_process' );

	}



	/**
	 * Render the downloads metabox
	 */
	function gmt_courses_render_metabox_downloads() {

		// Variables
		global $post;
		$downloads = get_posts(array(
			'posts_per_page'   => -1,
			'post_type'        => 'download',
			'post_status'      => 'any',
		));
		$access = get_post_meta( $post->ID, 'gmt_courses_downloads', true );

		?>

			<fieldset>

				<p>The downloads that have access to this course.</p>

				<?php foreach( $downloads as $download ) : ?>
					<?php
						$checked = is_array($access) && array_key_exists($download->ID, $access) && $access[$download->ID] === 'on' ? 'checked' : '';
					?>

					<label>
						<input type="checkbox" name="gmt_courses_downloads[<?php echo $download->ID; ?>]" value="<?php echo $download->ID; ?>" <?php echo $checked; ?>>
						<?php echo $download->post_title; ?>
					</label>

				<?php endforeach; ?>

			</fieldset>

		<?php

		wp_nonce_field( 'gmt_courses_metabox_downloads_nonce', 'gmt_courses_metabox_downloads_process' );

	}



	/**
	 * Save the lesson video metabox
	 * @param  Number $post_id The post ID
	 * @param  Array  $post    The post data
	 */
	function gmt_courses_save_metabox_lesson_video( $post_id, $post ) {

		if ( !isset( $_POST['gmt_courses_metabox_lesson_video_process'] ) ) return;

		// Verify data came from edit screen
		if ( !wp_verify_nonce( $_POST['gmt_courses_metabox_lesson_video_process'], 'gmt_courses_metabox_lesson_video_nonce' ) ) {
			return $post->ID;
		}

		// Verify user has permission to edit post
		if ( !current_user_can( 'edit_post', $post->ID )) {
			return $post->ID;
		}

		// Sanitize and save details
		if ( !isset( $_POST['gmt_courses_lesson_video'] ) ) return;
		update_post_meta( $post->ID, 'gmt_courses_lesson_video', $_POST['gmt_courses_lesson_video']['video'] );
		update_post_meta( $post->ID, 'gmt_courses_lesson_video_length', $_POST['gmt_courses_lesson_video']['length'] );

	}
	add_action( 'save_post', 'gmt_courses_save_metabox_lesson_video', 10, 2 );



	/**
	 * Save the lesson type metabox
	 * @param  Number $post_id The post ID
	 * @param  Array  $post    The post data
	 */
	function gmt_courses_save_metabox_lesson_type( $post_id, $post ) {

		if ( !isset( $_POST['gmt_courses_metabox_lesson_type_process'] ) ) return;

		// Verify data came from edit screen
		if ( !wp_verify_nonce( $_POST['gmt_courses_metabox_lesson_type_process'], 'gmt_courses_metabox_lesson_type_nonce' ) ) {
			return $post->ID;
		}

		// Verify user has permission to edit post
		if ( !current_user_can( 'edit_post', $post->ID )) {
			return $post->ID;
		}

		// Sanitize and save details
		if ( !isset( $_POST['gmt_courses_lesson_type'] ) ) return;
		update_post_meta( $post->ID, 'gmt_courses_lesson_type', wp_filter_nohtml_kses( $_POST['gmt_courses_lesson_type'] ) );

	}
	add_action( 'save_post', 'gmt_courses_save_metabox_lesson_type', 10, 2 );



	/**
	 * Save the course metabox
	 * @param  Number $post_id The post ID
	 * @param  Array  $post    The post data
	 */
	function gmt_courses_save_metabox_course( $post_id, $post ) {

		if ( !isset( $_POST['gmt_courses_metabox_course_process'] ) ) return;

		// Verify data came from edit screen
		if ( !wp_verify_nonce( $_POST['gmt_courses_metabox_course_process'], 'gmt_courses_metabox_course_nonce' ) ) {
			return $post->ID;
		}

		// Verify user has permission to edit post
		if ( !current_user_can( 'edit_post', $post->ID )) {
			return $post->ID;
		}

		// Sanitize and save details
		if ( !isset( $_POST['gmt_courses_course'] ) ) return;
		update_post_meta( $post->ID, 'gmt_courses_course', $_POST['gmt_courses_course'] );

	}
	add_action( 'save_post', 'gmt_courses_save_metabox_course', 10, 2 );



	/**
	 * Save the lessons metabox
	 * @param  Number $post_id The post ID
	 * @param  Array  $post    The post data
	 */
	function gmt_courses_save_metabox_lessons( $post_id, $post ) {

		if ( wp_is_post_revision( $post_id ) ) return;

		if ( !isset( $_POST['gmt_courses_metabox_lessons_process'] ) ) return;

		// Verify data came from edit screen
		if ( !wp_verify_nonce( $_POST['gmt_courses_metabox_lessons_process'], 'gmt_courses_metabox_lessons_nonce' ) ) {
			return $post->ID;
		}

		// Verify user has permission to edit post
		if ( !current_user_can( 'edit_post', $post->ID )) {
			return $post->ID;
		}

		// Verify data is provided
		if ( !isset( $_POST['gmt_courses_lesson_order'] ) ) return;

		// unhook this function so it doesn't loop infinitely
		remove_action( 'save_post', 'gmt_courses_save_metabox_lessons' );

		// Update post order
		foreach( $_POST['gmt_courses_lesson_order'] as $key => $lesson ) {
			wp_update_post(array(
				'ID' => $lesson,
				'menu_order' => $key,
			));
		}

		// re-hook this function
		add_action( 'save_post', 'gmt_courses_save_metabox_lessons' );

	}
	add_action( 'save_post', 'gmt_courses_save_metabox_lessons', 10, 2 );



	/**
	 * Save the course downloads metabox
	 * @param  Number $post_id The post ID
	 * @param  Array  $post    The post data
	 */
	function gmt_courses_save_metabox_downloads( $post_id, $post ) {

		if ( wp_is_post_revision( $post_id ) ) return;

		if ( !isset( $_POST['gmt_courses_metabox_downloads_process'] ) ) return;

		// Verify data came from edit screen
		if ( !wp_verify_nonce( $_POST['gmt_courses_metabox_downloads_process'], 'gmt_courses_metabox_downloads_nonce' ) ) {
			return $post->ID;
		}

		// Verify user has permission to edit post
		if ( !current_user_can( 'edit_post', $post->ID )) {
			return $post->ID;
		}

		// Get downloads list
		$downloads = get_posts(array(
			'posts_per_page'   => -1,
			'post_type'        => 'download',
			'post_status'      => 'any',
		));

		// Sanitize and save details
		$santized = array();
		foreach( $downloads as $download ) {
			$sanitized[$download->ID] = isset( $_POST['gmt_courses_downloads'][$download->ID] ) ? 'on' : 'off';
		}
		update_post_meta( $post->ID, 'gmt_courses_downloads', $sanitized );

	}
	add_action( 'save_post', 'gmt_courses_save_metabox_downloads', 10, 2 );



	function gmt_courses_wp_admin_scripts() {
		global $post_type;
		if ( $post_type != 'gmt_courses' ) return;
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'gmt-courses-sortable', plugins_url( '../includes/gmt-courses-sortable.js' , __FILE__ ), array( 'jquery', 'jquery-ui-sortable' ) );
	}
	add_action( 'admin_enqueue_scripts', 'gmt_courses_wp_admin_scripts' );