/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	config.uiColor = '#179DBE';
	config.pasteFromWordPromptCleanup = false;
    config.pasteFromWordCleanupFile = false;
    config.pasteFromWordRemoveFontStyles = false;
    config.pasteFromWordNumberedHeadingToList = false;
    config.pasteFromWordRemoveStyles = false;
    // ckfinder
    config.filebrowserBrowseUrl = '_plugins_/filemanager/dialog.php?type=2&editor=ckeditor&fldr=';
    config.filebrowserImageBrowseUrl = '_plugins_/filemanager/dialog.php?type=1&editor=ckeditor&fldr='; 
    config.filebrowserUploadUrl = '_plugins_/filemanager/dialog.php?type=2&editor=ckeditor&fldr=';
	
};
