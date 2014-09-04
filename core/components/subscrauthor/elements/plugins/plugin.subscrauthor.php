<?php

switch ($modx->event->name) {

	case 'OnManagerPageInit':
		$cssFile = MODX_ASSETS_URL.'components/subscrauthor/css/mgr/main.css';
		$modx->regClientCSS($cssFile);
		break;

}