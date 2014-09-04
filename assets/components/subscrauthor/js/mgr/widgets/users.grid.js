subscrAuthor.grid.Users = function(config) {
	config = config || {};
    this.sm = new Ext.grid.CheckboxSelectionModel();
	Ext.applyIf(config,{
		id: 'subscrauthor-grid-users'
		,url: subscrAuthor.config.connector_url
		,baseParams: {
			action: 'mgr/user/getlist'
		}
		,fields: ['id','user_id','user_email','author']
		,autoHeight: true
		,paging: true
		,remoteSort: true
        ,sm: this.sm
		,columns: [
			{header: _('id'),dataIndex: 'id',width: 70}
			,{header: _('user_id'),dataIndex: 'user_id',width: 200}
			,{header: _('user_email'),dataIndex: 'user_email',width: 250}
			,{header: _('author'),dataIndex: 'author',width: 70}
		]
		,tbar: [{
			text: _('subscrauthor_user_create')
			,handler: this.createUser
			,scope: this
		}]
		,listeners: {
			rowDblClick: function(grid, rowIndex, e) {
				var row = grid.store.getAt(rowIndex);
				this.updateUser(grid, e, row);
			}
		}
	});
	subscrAuthor.grid.Users.superclass.constructor.call(this,config);
};
Ext.extend(subscrAuthor.grid.Users,MODx.grid.Grid,{
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
    			,handler: this.updateUser
    		});
    		m.push('-');
    		m.push({
    			text: _('subscrauthor_user_remove')
    			,handler: this.removeUser
    		});
        }
		this.addContextMenuUser(m);
	}
	
	,createUser: function(btn,e) {
		if (!this.windows.createUser) {
			this.windows.createUser = MODx.load({
				xtype: 'subscrauthor-window-user-create'
				,listeners: {
					'success': {fn:function() { this.refresh(); },scope:this}
				}
			});
		}
		this.windows.createUser.fp.getForm().reset();
		this.windows.createUser.show(e.target);
	}

	,updateUser: function(btn,e,row) {
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
					if (!this.windows.updateUser) {
						this.windows.updateUser = MODx.load({
							xtype: 'subscrauthor-window-user-update'
							,record: r
							,listeners: {
								'success': {fn:function() { this.refresh(); },scope:this}
							}
						});
					}
					this.windows.updateUser.fp.getForm().reset();
					this.windows.updateUser.fp.getForm().setValues(r.object);
					this.windows.updateUser.show(e.target);
				},scope:this}
			}
		});
	}

	,removeUser: function(btn,e) {
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
                ,users: cs
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
Ext.reg('subscrauthor-grid-users',subscrAuthor.grid.Users);




subscrAuthor.window.CreateUser = function(config) {
	config = config || {};
	this.ident = config.ident || 'mecuser'+Ext.id();
	Ext.applyIf(config,{
		title: _('subscrauthor_user_create')
		,id: this.ident
		,height: 200
		,width: 475
		,url: subscrAuthor.config.connector_url
		,action: 'mgr/user/create'
		,fields: [
			{xtype: 'textfield',fieldLabel: _('user_id'),user_id: 'user_id',id: 'subscrauthor-'+this.ident+'-user_id',anchor: '99%'}
			,{xtype: 'textfield',fieldLabel: _('user_email'),user_id: 'user_email',id: 'subscrauthor-'+this.ident+'-user_email',height: 150,anchor: '99%'}
			,{xtype: 'textfield',fieldLabel: _('author'),user_id: 'author',id: 'subscrauthor-'+this.ident+'-author',height: 150,anchor: '99%'}
		]
		,keys: [{key: Ext.EventObject.ENTER,shift: true,fn: function() {this.submit() },scope: this}]
	});
	subscrAuthor.window.CreateUser.superclass.constructor.call(this,config);
};
Ext.extend(subscrAuthor.window.CreateUser,MODx.Window);
Ext.reg('subscrauthor-window-user-create',subscrAuthor.window.CreateUser);


subscrAuthor.window.UpdateUser = function(config) {
	config = config || {};
	this.ident = config.ident || 'meuuser'+Ext.id();
	Ext.applyIf(config,{
		title: _('subscrauthor_user_update')
		,id: this.ident
		,height: 200
		,width: 475
		,url: subscrAuthor.config.connector_url
		,action: 'mgr/user/update'
		,fields: [
			{xtype: 'hidden',user_id: 'id',id: 'subscrauthor-'+this.ident+'-id'}
			,{xtype: 'textfield',fieldLabel: _('user_id'),user_id: 'user_id',id: 'subscrauthor-'+this.ident+'-user_id',anchor: '99%'}
			,{xtype: 'textfield',fieldLabel: _('user_email'),user_id: 'user_email',id: 'subscrauthor-'+this.ident+'-user_email',height: 150,anchor: '99%'}
			,{xtype: 'textfield',fieldLabel: _('author'),user_id: 'author',id: 'subscrauthor-'+this.ident+'-author',height: 150,anchor: '99%'}
		]
		,keys: [{key: Ext.EventObject.ENTER,shift: true,fn: function() {this.submit() },scope: this}]
	});
	subscrAuthor.window.UpdateUser.superclass.constructor.call(this,config);
};
Ext.extend(subscrAuthor.window.UpdateUser,MODx.Window);
Ext.reg('subscrauthor-window-user-update',subscrAuthor.window.UpdateUser);