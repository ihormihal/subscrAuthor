<?php

require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
require_once MODX_CONNECTORS_PATH . 'index.php';

$corePath = $modx->getOption('subscrauthor_core_path', null, $modx->getOption('core_path') . 'components/subscrauthor/');
require_once $corePath . 'model/subscrauthor/subscrauthor.class.php';
$modx->subscrauthor = new subscrAuthor($modx);

$modx->lexicon->load('subscrauthor:default');

/* handle request */
$path = $modx->getOption('processorsPath', $modx->subscrauthor->config, $corePath . 'processors/');
$modx->request->handleRequest(array(
	'processors_path' => $path,
	'location' => '',
));