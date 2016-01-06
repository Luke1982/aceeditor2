function addToolBar(editor, moduleDir, AceModes) {
	// Create the toolbar DIV
	$(editor.container).parent().prepend('<div id="AceToolbar"></div>');
	// Set the toolbar width to the editor width
	$('#AceToolbar').css('width', $('.ace_editor').outerWidth());
	// Create the bottombar DIV
	$(editor.container).parent().append('<div id="AceBottombar"></div>');
	$('#AceBottombar').css('width', $('.ace_editor').outerWidth());
	// Catch a window resize
	$(window).resize(function(){
		$('#AceBottombar, #AceToolbar').css('width', $('.ace_editor').outerWidth());
	});
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
	// add a slider for the text size
	$('#AceToolbar').append('<div class="AceTextSize"><input type="range" min="12" max="20" value="16" step="1" id="AceTextSize"></div>');
	// Set the default text size
	$('.ace_editor').css('font-size', $('#AceTextSize').val()+'px');
	// Make the slider change the text size in the editor
	$('#AceTextSize').change(function(){
		$('.ace_editor').css('font-size', $('#AceTextSize').val()+'px');
	});
}

function aceResize() {
	$('.ace_editor').resizable({
		handles: 'e,s'
	});
}