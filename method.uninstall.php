<?php

if( !defined('CMS_VERSION') ) exit;
$this->RemovePermission(AceEditor2::MANAGE_PERM);
$db = $this->GetDb();
$dict = NewDataDictionary( $db );
$sqlarray = $dict->DropTableSQL( CMS_DB_PREFIX.'mod_ace_editor2');
$dict->ExecuteSQLArray($sqlarray);

?>