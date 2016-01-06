function addToolBar(editor) {
	// Create the toolbar DIV
	$(editor.container).parent().prepend('<div id="AceToolbar"></div>');
	$('#AceToolbar').prepend('<select class="AceModeSelect"><option value="css">CSS</option><option value="smarty">Smarty</option></select>');
	$('.AceModeSelect').change(function(){
		var mode = $('.AceModeSelect').val();
		editor.getSession().setMode('ace/mode/'+mode);
	});
}