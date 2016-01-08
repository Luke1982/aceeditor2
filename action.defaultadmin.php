<?php

if( !defined('CMS_VERSION') ) exit;
if( !$this->CheckPermission(AceEditor2::MANAGE_PERM) ) return;

// Handle the submit action to save preferences
if (isset($params['submit'])) {
	// Use the class method 'SavePreference' from the AceEditor2 class to save the values
	// The 'paramname' (from the input name attribute) MUST be the same as the database column name
	foreach ($params as $paramname => $paramvalue) {
		$this->SavePreference($paramname, $paramvalue);
	}
	$this->SetMessage($this->Lang('pref_saved_mess'));
	$this->RedirectToAdminTab();
}

// Get the currently selected preferences from the database and send them to the template
$ace_prefs = $this->GetCurrentAcePrefs();
foreach ($ace_prefs as $ace_pref_name => $ace_pref_value) {
	$smarty->assign($ace_pref_name, $ace_pref_value);
}

$tpl = $smarty->CreateTemplate($this->GetTemplateResource('manage_ace_prefs.tpl'),null,null,$smarty);
$tpl->display();

?>