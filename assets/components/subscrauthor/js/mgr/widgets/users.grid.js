subscrAuthor.grid.Items = function(config) {
	config = config || {};
    this.sm = new Ext.grid.CheckboxSelectionModel();
	Ext.applyIf(config,{
		id: 'subscrauthor-grid-users'
		,url: subscrAuthor.config.connector_url
		,baseParams: {
			action: 'mgr/user/getlist'
		}
		,fields: ['id','user_id','user_email','author_id']
		,autoHeight: true
		,paging: true
		,remoteSort: true
        ,sm: this.sm
		,columns: [
			{header: _('id'),dataIndex: 'id',width: 50}
			,{header: _('user_id'),dataIndex: 'user_id',width: 50}
			,{header: _('user_email'),dataIndex: 'user_email',width: 200}
			,{header: _('author_id'),dataIndex: 'author_id',width: 50}
		]
		,tbar: [{
			text: _('subscrauthor_user_create')
			,handler: this.createItem
			,scope: this
		}]
		,listeners: {
			rowDblClick: function(grid, rowIndex, e) {
				var row = grid.store.getAt(rowIndex);
				this.updateItem(grid, e, row);
			}
		}
	});
	subscrAuthor.grid.Items.superclass.constructor.call(this,config);
};
Ext.extend(subscrAuthor.grid.Items,MODx.grid.Grid,{
	windows: {}

	,getMenu: function() {
        var cs = this.getSelectedAsList();
        var m = [];
        if (cs.split(',').length > 1) {
            m.push({
    			text: _('subscrauthor_users_remove')
    			,handler: this.removeSelected
    		});
        } else {
    		m.push({
    			text: _('subscrauthor_user_update')
    			,handler: this.updateItem
    		});
    		m.push('-');
    		m.push({
    			text: _('subscrauthor_user_remove')
    			,handler: this.removeItem
    		});
        }
		this.addContextMenuItem(m);
	}
	
	,createItem: function(btn,e) {
		if (!this.windows.createItem) {
			this.windows.createItem = MODx.load({
				xtype: 'subscrauthor-window-user-create'
				,listeners: {
					'success': {fn:function() { this.refresh(); },scope:this}
				}
			});
		}
		this.windows.createItem.fp.getForm().reset();
		this.windows.createItem.show(e.target);
	}

	,updateItem: function(btn,e,row) {
		if (typeof(row) != 'undefined') {this.menu.record = row.data;}
		var id = this.menu.record.id;

		MODx.Ajax.request({
			url: subscrAuthor.config.connector_url
			,params: {
				action: 'mgr/user/get'
				,id: id
			}
			,listeners: {
				success: {fn:function(r) {
					if (!this.windows.updateItem) {
						this.windows.updateItem = MODx.load({
							xtype: 'subscrauthor-window-user-update'
							,record: r
							,listeners: {
								'success': {fn:function() { this.refresh(); },scope:this}
							}
						});
					}
					this.windows.updateItem.fp.getForm().reset();
					this.windows.updateItem.fp.getForm().setValues(r.object);
					this.windows.updateItem.show(e.target);
				},scope:this}
			}
		});
	}

	,removeItem: function(btn,e) {
		if (!this.menu.record) return false;
		
		MODx.msg.confirm({
			title: _('subscrauthor_user_remove')
			,text: _('subscrauthor_user_remove_confirm')
			,url: this.config.url
			,params: {
				action: 'mgr/user/remove'
				,id: this.menu.record.id
			}
			,listeners: {
				'success': {fn:function(r) { this.refresh(); },scope:this}
			}
		});
	}

    ,getSelectedAsList: function() {
        var sels = this.getSelectionModel().getSelections();
        if (sels.length <= 0) return false;

        var cs = '';
        for (var i=0;i<sels.length;i++) {
            cs += ','+sels[i].data.id;
        }
        cs = cs.substr(1);
        return cs;
    }

    ,removeSelected: function(act,btn,e) {
        var cs = this.getSelectedAsList();
        if (cs === false) return false;

        MODx.msg.confirm({
			title: _('subscrauthor_users_remove')
			,text: _('subscrauthor_users_remove_confirm')
			,url: this.config.url
			,params: {
                action: 'mgr/users/remove'
                ,items: cs
            }
            ,listeners: {
                'success': {fn:function(r) {
                    this.getSelectionModel().clearSelections(true);
                    this.refresh();
                       var t = Ext.getCmp('modx-resource-tree');
                       if (t) { t.refresh(); }
                },scope:this}
            }
        });
        return true;
    }
});
Ext.reg('subscrauthor-grid-users',subscrAuthor.grid.Items);




subscrAuthor.window.CreateItem = function(config) {
	config = config || {};
	this.ident = config.ident || 'mecitem'+Ext.id();
	Ext.applyIf(config,{
		title: _('subscrauthor_user_create')
		,id: this.ident
		,height: 100
		,width: 475
		,url: subscrAuthor.config.connector_url
		,action: 'mgr/user/create'
		,fields: [
			{xtype: 'textfield',fieldLabel: _('user_id'),name: 'user_id',id: 'subscrauthor-'+this.ident+'-user_id',anchor: '99%'}
			,{xtype: 'textfield',fieldLabel: _('user_email'),name: 'user_email',id: 'subscrauthor-'+this.ident+'-user_email',anchor: '99%'}
			,{xtype: 'textfield',fieldLabel: _('author_id'),name: 'author_id',id: 'subscrauthor-'+this.ident+'-author_id',anchor: '99%'}
		]
		,keys: [{key: Ext.EventObject.ENTER,shift: true,fn: function() {this.submit() },scope: this}]
	});
	subscrAuthor.window.CreateItem.superclass.constructor.call(this,config);
};
Ext.extend(subscrAuthor.window.CreateItem,MODx.Window);
Ext.reg('subscrauthor-window-user-create',subscrAuthor.window.CreateItem);


subscrAuthor.window.UpdateItem = function(config) {
	config = config || {};
	this.ident = config.ident || 'meuitem'+Ext.id();
	Ext.applyIf(config,{
		title: _('subscrauthor_user_update')
		,id: this.ident
		,height: 100
		,width: 475
		,url: subscrAuthor.config.connector_url
		,action: 'mgr/user/update'
		,fields: [
			{xtype: 'hidden',name: 'id',id: 'subscrauthor-'+this.ident+'-id'}
			,{xtype: 'textfield',fieldLabel: _('user_id'),name: 'user_id',id: 'subscrauthor-'+this.ident+'-user_id',anchor: '99%'}
			,{xtype: 'textfield',fieldLabel: _('user_email'),name: 'user_email',id: 'subscrauthor-'+this.ident+'-user_email',anchor: '99%'}
			,{xtype: 'textfield',fieldLabel: _('author_id'),name: 'author_id',id: 'subscrauthor-'+this.ident+'-author_id',anchor: '99%'}
		]
		,keys: [{key: Ext.EventObject.ENTER,shift: true,fn: function() {this.submit() },scope: this}]
	});
	subscrAuthor.window.UpdateItem.superclass.constructor.call(this,config);
};
Ext.extend(subscrAuthor.window.UpdateItem,MODx.Window);
Ext.reg('subscrauthor-window-user-update',subscrAuthor.window.UpdateItem);