MxBlog.panel.Home = function (config) {
    config = config || {};
    Ext.apply(config, {
        baseCls: 'modx-formpanel',
        layout: 'anchor',
        cls: 'container',
        /*
         stateful: true,
         stateId: 'mxblog-panel-home',
         stateEvents: ['tabchange'],
         getState:function() {return {activeTab:this.items.indexOf(this.getActiveTab())};},
         */
        hideMode: 'offsets',
        items: [{
            html: '<h2>' + _('mxblog') + '</h2>',
            cls: '',
            style: {margin: '15px 0'}
        }, {
            xtype: 'modx-tabs',
            defaults: {border: false, autoHeight: true},
            border: true,
            hideMode: 'offsets',
            items: [{
                title: _('mxblog_items'),
                layout: 'anchor',
                items: [{
                    html: _('mxblog_intro_msg'),
                    cls: 'panel-desc',
                }, {
                    xtype: 'mxblog-grid-items',
                    cls: 'main-wrapper',
                }]
            }]
        }]
    });
    MxBlog.panel.Home.superclass.constructor.call(this, config);
};
Ext.extend(MxBlog.panel.Home, MODx.Panel);
Ext.reg('mxblog-panel-home', MxBlog.panel.Home);
