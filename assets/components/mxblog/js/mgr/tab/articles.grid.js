MxBlog.grid.Articles = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'mxblog-grid-articles';
    }
    Ext.applyIf(config, {
        url: MxBlog.config.connector_url,
        fields: this.getFields(config),
        columns: this.getColumns(config),
        tbar: this.getTopBar(config),
        sm: new Ext.grid.CheckboxSelectionModel(),
        baseParams: {
            action: 'MxBlog\\Processors\\Article\\GetList',
            blog_section_id: config.record.id,
        },
        listeners: {
            rowDblClick: function (grid, rowIndex, e) {
                var row = grid.store.getAt(rowIndex);
                this.updateArticle(grid, e, row);
            }
        },
        viewConfig: {
            forceFit: true,
            enableRowBody: true,
            autoFill: true,
            showPreview: true,
            scrollOffset: 0,
            getRowClass: function (rec) {
                return !rec.data.active
                    ? 'mxblog-grid-row-disabled'
                    : '';
            }
        },
        paging: true,
        remoteSort: true,
        autoHeight: true,
    });
    MxBlog.grid.Articles.superclass.constructor.call(this, config);

    // Clear selection on grid refresh
    this.store.on('load', function () {
        if (this._getSelectedIds().length) {
            this.getSelectionModel().clearSelections();
        }
    }, this);
};
Ext.extend(MxBlog.grid.Articles, MODx.grid.Grid, {
    windows: {},

    getMenu: function (grid, rowIndex) {
        var ids = this._getSelectedIds();

        var row = grid.getStore().getAt(rowIndex);
        var menu = MxBlog.utils.getMenu(row.data['actions'], this, ids);

        this.addContextMenuItem(menu);
    },

    getFields: function () {
        return ['id', 'pagetitle', 'createdon', 'published', 'preview_url', 'actions'];
    },

    getColumns: function () {
        return [{
            header: _('mxblog_article_id'),
            dataIndex: 'id',
            sortable: true,
            width: 30
        }, {
            header: _('mxblog_article_pagetitle'),
            dataIndex: 'pagetitle',
            sortable: true,
            width: 200,
        }, {
            header: _('mxblog_article_createdon'),
            dataIndex: 'createdon',
            sortable: false,
            width: 100,
            renderer: MxBlog.utils.formatDate,
        }, {
            header: _('mxblog_article_published'),
            dataIndex: 'published',
            renderer: MxBlog.utils.renderBoolean,
            sortable: true,
            width: 100,
        }, {
            header: _('mxblog_grid_actions'),
            dataIndex: 'actions',
            renderer: MxBlog.utils.renderActions,
            sortable: false,
            width: 100,
            id: 'actions'
        }];
    },

    getTopBar: function () {
        return [{
            text: '<i class="icon icon-plus"></i>&nbsp;' + _('mxblog_article_create'),
            handler: this.createArticle,
            scope: this
        }, '->', {
            xtype: 'mxblog-field-search',
            width: 250,
            listeners: {
                search: {
                    fn: function (field) {
                        this._doSearch(field);
                    }, scope: this
                },
                clear: {
                    fn: function (field) {
                        field.setValue('');
                        this._clearSearch();
                    }, scope: this
                },
            }
        }];
    },

    onClick: function (e) {
        var elem = e.getTarget();
        if (elem.nodeName == 'BUTTON') {
            var row = this.getSelectionModel().getSelected();
            if (typeof(row) != 'undefined') {
                var action = elem.getAttribute('action');
                if (action == 'showMenu') {
                    var ri = this.getStore().find('id', row.id);
                    return this._showMenu(this, ri, e);
                }
                else if (typeof this[action] === 'function') {
                    this.menu.record = row.data;
                    return this[action](this, e);
                }
            }
        }
        return this.processEvent('click', e);
    },

    _getSelectedIds: function () {
        var ids = [];
        var selected = this.getSelectionModel().getSelections();

        for (var i in selected) {
            if (!selected.hasOwnProperty(i)) {
                continue;
            }
            ids.push(selected[i]['id']);
        }

        return ids;
    },

    _doSearch: function (tf) {
        this.getStore().baseParams.query = tf.getValue();
        this.getBottomToolbar().changePage(1);
    },

    _clearSearch: function () {
        this.getStore().baseParams.query = '';
        this.getBottomToolbar().changePage(1);
    },


    createArticle: function () {
        MODx.loadPage('resource/create', 'class_key=MxBlog\\Model\\Article&parent=' + MODx.request.id + '&context_key=' + MODx.ctx);
    },

    viewArticle: function () {
        window.open(this.menu.record['preview_url']);
        return false;
    },

    editArticle: function () {
        MODx.loadPage('resource/update', 'id=' + this.menu.record.id);
    },

    /*deleteArticle: function () {
        this.productAction('delete');
    },

    undeleteArticle: function () {
        this.productAction('undelete');
    },

    publishArticle: function () {
        this.productAction('publish');
    },

    unpublishArticle: function () {
        this.productAction('unpublish');
    },*/

});
Ext.reg('mxblog-grid-articles', MxBlog.grid.Articles);