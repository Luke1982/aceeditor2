function addToolBar(editor, moduleDir, AceModes) {
	// Create the toolbar DIV
	$(editor.container).parent().prepend('<div id="AceToolbar"></div>');
	// Set the toolbar width to the editor width
	$('#AceToolbar').css('width', $('.ace_editor').outerWidth());
	// Create the bottombar DIV
	$(editor.container).parent().append('<div id="AceBottombar"></div>');
	$('#AceBottombar').css('width', $('.ace_editor').outerWidth());
	// Append the mode select to the toolbar
	$('#AceToolbar').prepend('<select class="AceModeSelect"></select>');
	// Fill the mode select with the selected modes
	$.each(AceModes, function(Label, AceMode){
		$('.AceModeSelect').prepend('<option value="'+AceMode+'">'+Label+'</option>');
	});
	// Automatically load the selected mode file, append it to the head and set the mode
	$('.AceModeSelect').change(function(){
		var mode = $('.AceModeSelect').val();
		$('head').append('<script src="'+moduleDir+'/lib/Ace/src-min/mode-'+mode+'.js></script>');
		editor.getSession().setMode('ace/mode/'+mode);
	});
}