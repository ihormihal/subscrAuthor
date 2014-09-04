subscrAuthor.page.Home = function(config) {
	config = config || {};
	Ext.applyIf(config,{
		components: [{
			xtype: 'subscrauthor-panel-home'
			,renderTo: 'subscrauthor-panel-home-div'
		}]
	}); 
	subscrAuthor.page.Home.superclass.constructor.call(this,config);
};
Ext.extend(subscrAuthor.page.Home,MODx.Component);
Ext.reg('subscrauthor-page-home',subscrAuthor.page.Home);