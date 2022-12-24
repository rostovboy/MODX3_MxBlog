let MxBlog = function (config) {
    config = config || {};
    MxBlog.superclass.constructor.call(this, config);
};
Ext.extend(MxBlog, Ext.Component, {
    page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, view: {}, utils: {}
});
Ext.reg('mxblog', MxBlog);

MxBlog = new MxBlog();