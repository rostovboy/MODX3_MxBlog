<?php

namespace MxBlog;

use MODX\Revolution\modX;
use MODX\Revolution\modResource;
use MODX\Revolution\modManagerController;

class MxBlog
{
    /** @var \modX $modx */
    public $modx;
    /** @var array $config */
    public $config = [];

    public function __construct(modX $modx, array $config = [])
    {
        $this->modx = $modx;
        $corePath = MODX_CORE_PATH . 'components/mxblog/';
        $assetsUrl = MODX_ASSETS_URL . 'components/mxblog/';

        $this->config = array_merge([
            'corePath' => $corePath,
            'modelPath' => $corePath . 'model/',
            'processorsPath' => $corePath . 'Processors/',

            'connectorUrl' => $assetsUrl . 'connector.php',
            'assetsUrl' => $assetsUrl,
            'cssUrl' => $assetsUrl . 'css/',
            'jsUrl' => $assetsUrl . 'js/',
        ], $config);

        $this->modx->lexicon->load('mxblog:default');
    }

    public function loadArticlesTab(modManagerController $controller, modResource $resource)
    {
        $cssUrl = $this->config['cssUrl'] . 'mgr/';
        $jsUrl = $this->config['jsUrl'] . 'mgr/';
        $assetsUrl = MODX_ASSETS_URL . 'components/mxblog/';

        $this->modx->log(1, $cssUrl);

        $controller->addLexiconTopic('mxblog:default');
        $controller->addJavascript($jsUrl . 'mxblog.js');
        $controller->addLastJavascript($jsUrl . 'misc/combo.js');
        $controller->addLastJavascript($jsUrl . 'misc/utils.js');

        $controller->addLastJavascript($jsUrl . 'tab/articles.grid.js');
        $controller->addLastJavascript($jsUrl . 'tab/articles.panel.js');
        $controller->addCss($cssUrl . 'main.css');

        $controller->addHtml('
		<script type="text/javascript">
			MxBlog.config = ' . $this->modx->toJSON($this->config) . ';
			MxBlog.config.connector_url = "' . $assetsUrl . 'connector.php' . '";
		</script>');

        $insert = '
                tabs.add({
                    xtype: "mxblog-page",
                    id: "mxblog-page",
                    //cls: "modx-resource-tab x-form-label-left x-hide-offsets",
                    bodyCssClass: "main-wrapper",
                    title: _("mxblog_articles_tab_name"),
                    record: {
                        id: ' . $resource->get('id') . ',
                    }
                });
            ';

        $controller->addHtml('
                <script type="text/javascript">
                    Ext.ComponentMgr.onAvailable("modx-resource-tabs", function() {
                        var tabs = this;
                        tabs.on("beforerender", function() {
                            ' . $insert . '
                        });
                    });
                </script>');
    }
}
