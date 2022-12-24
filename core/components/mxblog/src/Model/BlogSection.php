<?php

namespace MxBlog\Model;

use xPDO\xPDO;
use MODX\Revolution\modResource;


class BlogSection extends modResource
{
    /** @var modX $xpdo */
    public $xpdo;
    public $allowListingInClassKeyDropdown = true;
    public $showInContextMenu = true;
    public $allowChildrenResources = true;

    /**
     * Override modResource::__construct to ensure a few specific fields are forced to be set.
     * @param xPDO $xpdo
     */
    function __construct(xPDO &$xpdo)
    {
        parent:: __construct($xpdo);
        $this->set('class_key', 'BlogSection');
        $this->set('hide_children_in_tree', true);
    }

    /**
     * @param xPDO $modx
     *
     * @return string
     */
    public static function getControllerPath(xPDO &$modx)
    {
        return $modx->getOption('mxblog.core_path', null, $modx->getOption('core_path') . 'components/mxblog/') . 'controllers/section/';
    }

    /**
     * @return array
     */
    public function getContextMenuText()
    {
        $this->xpdo->lexicon->load('mxblog:default');

        return array(
            'text_create' => $this->xpdo->lexicon('mxblog_blog_section'),
            'text_create_here' => $this->xpdo->lexicon('mxblog_blog_section_create_here'),
        );
    }


    /**
     * @return null|string
     */
    public function getResourceTypeName()
    {
        $this->xpdo->lexicon->load('mxblog:default');

        return $this->xpdo->lexicon('mxblog_section_type');
    }
}
