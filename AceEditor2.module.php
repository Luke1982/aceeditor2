<?php

class AceEditor2 extends CMSModule
{
	const MANAGE_PERM = 'manage_ace';
	
    public function GetName() { return basename(__CLASS__); }
    public function GetVersion() { return 0.1; }
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
		$script_includes = array('ace.js','theme-twilight.js','mode-css.js','mode-smarty.js','ext-language_tools.js','toolbar.js');
		$toolbarcss = $this->GetModuleURLPath().'/lib/Ace/src-min/toolbar.css';
		
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
				  addToolBar(editor);
				  editor.setTheme('ace/theme/twilight');
				  editor.getSession().setMode('ace/mode/css');
				  editor.setOptions({
					  enableBasicAutocompletion: true,
					  enableLiveAutocompletion: true
				  });
			   });
			})
			</script>
			<style type="text/css">
			.ace_editor {
			   width: 100%;
			   min-height: 50em;
			}
			</style>
EOT;
        return $out;
    }
}
?>