<?php

switch($oldversion) {
	case "1":
		// delete toolbar files in the Ace library folder.
		// They've been moved to lib/js and lib/css
		unlink('/lib/Ace/src-min/toolbar.css');
		unlink('/lib/Ace/src-min/toolbar.js');
	break;
}