<?php

/**
 * Class subscrAuthorMainController
 */
abstract class subscrAuthorMainController extends modExtraManagerController {
	/** @var subscrAuthor $subscrAuthor */
	public $subscrAuthor;


	/**
	 * @return void
	 */
	public function initialize() {
		$corePath = $this->modx->getOption('subscrauthor_core_path', null, $this->modx->getOption('core_path') . 'components/subscrauthor/');
		require_once $corePath . 'model/subscrauthor/subscrauthor.class.php';

		$this->subscrAuthor = new subscrAuthor($this->modx);

		$this->addCss($this->subscrAuthor->config['cssUrl'] . 'mgr/main.css');
		$this->addJavascript($this->subscrAuthor->config['jsUrl'] . 'mgr/subscrauthor.js');
		$this->addHtml('<script type="text/javascript">
		Ext.onReady(function() {
			subscrAuthor.config = ' . $this->modx->toJSON($this->subscrAuthor->config) . ';
			subscrAuthor.config.connector_url = "' . $this->subscrAuthor->config['connectorUrl'] . '";
		});
		</script>');

		parent::initialize();
	}


	/**
	 * @return array
	 */
	public function getLanguageTopics() {
		return array('subscrauthor:default');
	}


	/**
	 * @return bool
	 */
	public function checkPermissions() {
		return true;
	}
}


/**
 * Class IndexManagerController
 */
class IndexManagerController extends subscrAuthorMainController {

	/**
	 * @return string
	 */
	public static function getDefaultController() {
		return 'home';
	}
}