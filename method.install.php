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
editor_width_pc X
";
$sqlarray = $dict->CreateTableSQL(CMS_DB_PREFIX.'mod_ace_editor2',$flds,$taboptarray);
$dict->ExecuteSQLArray($sqlarray);

?>