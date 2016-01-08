<?php

class AceEditor2 extends CMSModule
{
	const MANAGE_PERM = 'manage_ace';
	
    public function GetName() { return basename(__CLASS__); }
    public function GetVersion() { return 1; }
    public function GetFriendlyName() { return 'Ace Editor 2.0'; }
    public function GetAdminDescription() { return 'Ace Editor Implementation for CMSMS 2.x series'; }
	public function IsPluginModule() { return FALSE; }
	public function HasAdmin() { return TRUE; }
	public function GetAuthor() { return 'Guido Goluke'; }
	public function GetAuthorEmail() { return 'info[a]majorlabel.nl'; }
	public function VisibleToAdminUser() { return $this->CheckPermission(self::MANAGE_PERM); }	

    public function HasCapability($capability, $params = array())
    {
        if( $capability == CmsCoreCapabilities::SYNTAX_MODULE ) return TRUE;
        return FALSE;
    }

    public function SyntaxGenerateHeader()
    {
		$script_includes = array('ace.js','theme-twilight.js','ext-language_tools.js','toolbar.js');
		$toolbarcss = $this->GetModuleURLPath().'/lib/Ace/src-min/toolbar.css';
		
		// Setup the modes you want to support, the array key is the select box label,
		// The value is the filename (mode-{FILENAME}.js)
		$AceModes = json_encode(array(
			'CSS'		=>		'css',
			'Smarty'	=>		'smarty',
			'HTML'		=>		'html',
			'Javascript'=>		'javascript',
			'JSON'		=>		'json',
			'PHP'		=>		'php',
			'SASS'		=>		'sass',
			'LESS'		=>		'less'
		));
		
		// Get the preferences
		$prefs = $this->GetCurrentAcePrefs();
		// Set the width, based on the width type preferences
		if ($prefs['editor_width_type'] == 'pc') {
			$width = $prefs['editor_width_pc'].'%';
		} else {
			$width = $prefs['editor_width_px'].'px';
		}
		
		$out = '';
		
		foreach($script_includes as $script_include) {
			$out .= '<script src="'.$this->GetModuleURLPath().'/lib/Ace/src-min/'.$script_include.'"></script>';
		}
		
        $out .= <<<EOT
			<link rel="stylesheet" type="text/css" href="{$toolbarcss}">
			<script type="text/javascript">
			$(document).ready(function(){
			   $('textarea.AceEditor2').each(function(){
				  var editor = ace.edit($(this).get(0));
				  var currentMode = $(this).attr('data-cms-lang');
				  var cssPrefMode = '{$prefs['editor_css_prefmode']}';
				  addToolBar(editor, '{$this->GetModuleURLPath()}', {$AceModes}, currentMode, cssPrefMode);
				  editor.setTheme('ace/theme/twilight');
				  editor.setOptions({
					  enableBasicAutocompletion: true,
					  enableLiveAutocompletion: true,
					  highlightGutterLine: true,
					  wrap: 120,
				  });
			   });
			});
			$(window).load(function(){
				aceResize();
			});
			</script>
			<style type="text/css">
			.ace_editor {
			   width: {$width};
			   height: {$prefs['editor_height_px']}px;
			   border: 0;
			}
			</style>
EOT;
        return $out;
    }
	
	public function UninstallPreMessage() { 
		return $this->Lang('ask_uninstall');
	}
	
	// Method to save the settings in the database from the admin panel
	public function SavePreference($prefname, $value) {
		$db 			= \cms_utils::get_db();
		$sql 			= 'UPDATE '.CMS_DB_PREFIX.'mod_ace_editor2 SET '.$prefname.' = ? WHERE id = ?';
		$insert_array	= array($value, 1);
		$db->Execute($sql, $insert_array);
	}
	
	public function GetCurrentAcePrefs() {
		$db 			= \cms_utils::get_db();
		$sql			= 'SELECT * from '.CMS_DB_PREFIX.'mod_ace_editor2 WHERE id = ?';
		$row			= $db->GetRow($sql, array(1));
		return $row;
	}
}
?>