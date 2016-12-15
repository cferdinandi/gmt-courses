/**
 * GMT Courses Sortable
 * @description  Drag-and-drop lesson reordering
 * @version  1.0.0
 * @author   Chris Ferdinandi
 * @license  GPLv3
 */
jQuery(document).ready(function($){

	'use strict';

	$( '.list-lessons' ).sortable({
		items: '.list-lessons-lesson',
		opacity: 0.6,
		cursor: 'move',
		placeholder: {
			element: function(currentItem) {
				return $('<li style=\'background:#f1f1f1\'>&nbsp;</li>')[0];
			},
			update: function(container, p) {
				return;
			}
		}
	});

});