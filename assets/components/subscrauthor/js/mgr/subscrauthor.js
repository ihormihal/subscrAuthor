var subscrAuthor = function(config) {
	config = config || {};
	subscrAuthor.superclass.constructor.call(this,config);
};
Ext.extend(subscrAuthor,Ext.Component,{
	page:{},window:{},grid:{},tree:{},panel:{},combo:{},config: {},view: {}
});
Ext.reg('subscrauthor',subscrAuthor);

subscrAuthor = new subscrAuthor();