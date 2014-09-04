<?php
/**
 * The home manager controller for subscrAuthor.
 *
 */
class subscrAuthorHomeManagerController extends subscrAuthorMainController {
	/* @var subscrAuthor $subscrAuthor */
	public $subscrAuthor;


	/**
	 * @param array $scriptProperties
	 */
	public function process(array $scriptProperties = array()) {
	}


	/**
	 * @return null|string
	 */
	public function getPageTitle() {
		return $this->modx->lexicon('subscrauthor');
	}


	/**
	 * @return void
	 */
	public function loadCustomCssJs() {
		$this->addJavascript($this->subscrAuthor->config['jsUrl'] . 'mgr/widgets/items.grid.js');
		$this->addJavascript($this->subscrAuthor->config['jsUrl'] . 'mgr/widgets/home.panel.js');
		$this->addJavascript($this->subscrAuthor->config['jsUrl'] . 'mgr/sections/home.js');
		$this->addHtml('<script type="text/javascript">
		Ext.onReady(function() {
			MODx.load({ xtype: "subscrauthor-page-home"});
		});
		</script>');
	}


	/**
	 * @return string
	 */
	public function getTemplateFile() {
		return $this->subscrAuthor->config['templatesPath'] . 'home.tpl';
	}
}