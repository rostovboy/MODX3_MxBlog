MxBlog.page.Home = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        components: [{
            xtype: 'mxblog-panel-home',
            renderTo: 'mxblog-panel-home-div'
        }]
    });
    MxBlog.page.Home.superclass.constructor.call(this, config);
};
Ext.extend(MxBlog.page.Home, MODx.Component);
Ext.reg('mxblog-page-home', MxBlog.page.Home);