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
        if( $capability == CmscoreCapabilities::SYNTAX_MODULE ) return TRUE;
        return FALSE;
    }

    public function SyntaxGenerateHeader()
    {
        $aceditor = $this->GetModuleURLPath().'/lib/Ace/src-min/ace.js';
        $out = <<<EOT
			<script type="text/javascript" src="{$aceditor}"></script>
			<script type="text/javascript">
			$(document).ready(function(){
			   $('textarea.AceEditor2').each(function(){
				  var editor = ace.edit($(this).get(0));
				  editor.setTheme('ace/theme/twilight');
			   });
			})
			</script>
			<style type="text/css">
			.ace_editor {
			   width: 90%;
			   min-height: 50em;
			}
			</style>
EOT;
        return $out;
    }
}
?>