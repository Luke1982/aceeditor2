function addToolBar(editor, moduleDir, AceModes, currentMode, cssPrefMode) {
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
	// Autoload the current mode, that is the mode from the textarea 'data-cms-lang' attribute
	// If the 'data-cms-lang' attribute is CSS, use the cssPrefMode
	if (currentMode == 'css') {
		$('head').append('<script src="'+moduleDir+'/lib/Ace/src-min/mode-'+cssPrefMode+'.js></script>');
		editor.getSession().setMode('ace/mode/'+cssPrefMode);
	} else {
		$('head').append('<script src="'+moduleDir+'/lib/Ace/src-min/mode-'+currentMode+'.js></script>');
		editor.getSession().setMode('ace/mode/'+currentMode);
	}
	// Append the mode select to the toolbar
	$('#AceToolbar').prepend('<select class="AceModeSelect"></select>');
	// Fill the mode select with the selected modes
	$.each(AceModes, function(Label, AceMode){
		$('.AceModeSelect').prepend('<option value="'+AceMode+'">'+Label+'</option>');
		if (currentMode != 'css' && AceMode == currentMode) {
			$('.AceModeSelect option[value^='+AceMode+']').attr('selected','selected');
		} else if (AceMode == currentMode) {
			$('.AceModeSelect option[value^='+cssPrefMode+']').attr('selected','selected');
		}
	});
	// Automatically load the selected mode file, append it to the head and set the mode
	// When changing the selection
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
	// jump to line input field
	$('#AceToolbar').append('<input class="AceJumpToLine" size"="70" placeholder="type line number" type="text">');
	$('.AceJumpToLine').keyup(function(){
		editor.resize(true);
		editor.scrollToLine($('.AceJumpToLine').val(), true, true, function () {}); 
		editor.gotoLine($('.AceJumpToLine').val(), 0, true);
	});
}

function aceResize() {
	$('.ace_editor').resizable({
		handles: 'e,s'
	});
}