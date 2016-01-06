function addToolBar(editor, moduleDir, AceModes) {
	// Create the toolbar DIV
	$(editor.container).parent().prepend('<div id="AceToolbar"></div>');
	// Append the mode select to the toolbar
	$('#AceToolbar').prepend('<select class="AceModeSelect"></select>');
	// Fill the mode select with the selected modes
	$.each(AceModes, function(Label, AceMode){
		$('.AceModeSelect').prepend('<option value="'+AceMode+'">'+Label+'</option>');
	});
	$('.AceModeSelect').change(function(){
		var mode = $('.AceModeSelect').val();
		$('head').append('<script src="'+moduleDir+'/lib/Ace/src-min/mode-'+mode+'.js></script>');
		editor.getSession().setMode('ace/mode/'+mode);
	});
}