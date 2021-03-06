subscrAuthor.panel.Home = function(config) {
	config = config || {};
	Ext.apply(config,{
		border: false
		,baseCls: 'modx-formpanel'
		,items: [{
			html: '<h2>'+_('subscrauthor')+'</h2>'
			,border: false
			,cls: 'modx-page-header container'
		},{
			xtype: 'modx-tabs'
			,bodyStyle: 'padding: 10px'
			,defaults: { border: false ,autoHeight: true }
			,border: true
			,activeItem: 0
			,hideMode: 'offsets'
			,items: [{
				title: _('subscrauthor_users')
				,items: [{
					html: _('subscrauthor_intro_msg')
					,border: false
					,bodyCssClass: 'panel-desc'
					,bodyStyle: 'margin-bottom: 10px'
				},{
					xtype: 'subscrauthor-grid-users'
					,preventRender: true
				}]
			}]
		}]
	});
	subscrAuthor.panel.Home.superclass.constructor.call(this,config);
};
Ext.extend(subscrAuthor.panel.Home,MODx.Panel);
Ext.reg('subscrauthor-panel-home',subscrAuthor.panel.Home);
