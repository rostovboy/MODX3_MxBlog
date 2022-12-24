<?php

use MODX\Revolution\modExtraManagerController;

/**
 * The home manager controller for MxBlog.
 *
 */
class MxBlogHomeManagerController extends modExtraManagerController
{
    /** @var MxBlog\MxBlog $MxBlog */
    public $MxBlog;


    /**
     *
     */
    public function initialize()
    {
        $this->MxBlog = $this->modx->services->get('MxBlog');
        parent::initialize();
    }


    /**
     * @return array
     */
    public function getLanguageTopics()
    {
        return ['mxblog:default'];
    }


    /**
     * @return bool
     */
    public function checkPermissions()
    {
        return true;
    }


    /**
     * @return null|string
     */
    public function getPageTitle()
    {
        return $this->modx->lexicon('mxblog');
    }


    /**
     * @return void
     */
    public function loadCustomCssJs()
    {
        $this->addCss($this->MxBlog->config['cssUrl'] . 'mgr/main.css');
        $this->addJavascript($this->MxBlog->config['jsUrl'] . 'mgr/mxblog.js');
        $this->addJavascript($this->MxBlog->config['jsUrl'] . 'mgr/misc/utils.js');
        $this->addJavascript($this->MxBlog->config['jsUrl'] . 'mgr/misc/combo.js');
        $this->addJavascript($this->MxBlog->config['jsUrl'] . 'mgr/widgets/items.grid.js');
        $this->addJavascript($this->MxBlog->config['jsUrl'] . 'mgr/widgets/items.windows.js');
        $this->addJavascript($this->MxBlog->config['jsUrl'] . 'mgr/widgets/home.panel.js');
        $this->addJavascript($this->MxBlog->config['jsUrl'] . 'mgr/sections/home.js');

        $this->addHtml('<script type="text/javascript">
        MxBlog.config = ' . json_encode($this->MxBlog->config) . ';
        MxBlog.config.connector_url = "' . $this->MxBlog->config['connectorUrl'] . '";
        Ext.onReady(function() {MODx.load({ xtype: "mxblog-page-home"});});
        </script>');
    }


    /**
     * @return string
     */
    public function getTemplateFile()
    {
        $this->content .= '<div id="mxblog-panel-home-div"></div>';
        return '';
    }
}
