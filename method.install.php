<?php

if( !defined('CMS_VERSION') ) exit;
$this->CreatePermission(AceEditor2::MANAGE_PERM,'Manage Ace Editor 2');

$db = $this->GetDb();
$dict = NewDataDictionary($db);
$taboptarray = array('mysql' => 'TYPE=MyISAM');
$flds = "
id I KEY AUTO,
editor_width_type X,
editor_width_px X,
editor_width_pc X,
editor_height_px X,
editor_css_prefmode X
";
$sqlarray = $dict->CreateTableSQL(CMS_DB_PREFIX.'mod_ace_editor2',$flds,$taboptarray);
$dict->ExecuteSQLArray($sqlarray);

// Create the first and only line in the table, used to store the preferences
$db 			= \cms_utils::get_db();
$sql 			= 'INSERT INTO '.CMS_DB_PREFIX.'mod_ace_editor2 (editor_width_type, editor_width_px, editor_width_pc, editor_height_px, editor_css_prefmode) VALUE (?,?,?,?,?)';
$startvalues	= array('pc','800','95','600','css');
$db->Execute($sql, $startvalues);

?>