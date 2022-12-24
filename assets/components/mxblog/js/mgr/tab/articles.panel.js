MxBlog.panel.Article = function (config) {
    config = config || {};

    Ext.apply(config, {
        border: false,
        baseCls: 'x-panel',
        items: [{
            html: '<p>' + _('mxblog_articles_tab_desc') + '</p>',
            xtype: 'modx-description'
        }, {
            //title: _('mxblog_articles'),
            items: [{
                id: 'mxblog-grid-articles',
                xtype: 'mxblog-grid-articles',
                cls: 'main-wrapper',
                record: config.record,
                //store: 0,
            }]
        }]
    });

    MxBlog.panel.Article.superclass.constructor.call(this, config);
};
Ext.extend(MxBlog.panel.Article, MODx.Panel);
Ext.reg('mxblog-page', MxBlog.panel.Article);