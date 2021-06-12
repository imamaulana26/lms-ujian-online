/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'links'] },
		{ name: 'editing',     groups: [ 'find', 'selection' ] },
		// { name: 'links' },
		{ name: 'insert', groups: [ 'insert', 'Youtube','MathType' ] },
		{ name: 'forms' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'align', 'bidi' ] },
		{ name: 'tools' },
		// { name: 'styles' },
		{ name: 'colors' }
		// { name: 'about' }
	];

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.extraPlugins = 'youtube , ckeditor_wiris,link';
	// config.youtube_width = '320';
	config.removeButtons = 'Underline,Subscript,Superscript,image,source';

	// Set the most common block elements.
	// config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'link:advanced;link:upload';
};
