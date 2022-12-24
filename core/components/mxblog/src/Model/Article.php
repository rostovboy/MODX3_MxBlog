<?php

namespace MxBlog\Model;

use xPDO\xPDO;
use MODX\Revolution\modResource;

/**
 * Class Article
 *
 *
 * @package MxBlog\Model
 */
class Article extends modResource
{
    public $showInContextMenu = true;
    public $allowChildrenResources = false;

    /**
     * Article constructor
     *
     * @param xPDO $xpdo
     */
    function __construct(xPDO &$xpdo)
    {
        parent:: __construct($xpdo);
        $this->set('class_key', 'Article');
        $this->set('show_in_tree', 0);
    }

    /**
     * @param xPDO $modx
     *
     * @return string
     */
    public static function getControllerPath(xPDO &$modx)
    {
        return $modx->getOption('mxblog.core_path', null, $modx->getOption('core_path') . 'components/mxblog/') . 'controllers/article/';
    }


    /**
     * @return array
     */
    public function getContextMenuText()
    {
        $this->xpdo->lexicon->load('mxblog:default');

        return array(
            'text_create' => $this->xpdo->lexicon('mxblog_article'),
            'text_create_here' => $this->xpdo->lexicon('mxblog_article_create_here'),
        );
    }


    /**
     * @return null|string
     */
    public function getResourceTypeName()
    {
        $this->xpdo->lexicon->load('mxblog:default');

        return $this->xpdo->lexicon('mxblog_article_type');
    }
}
