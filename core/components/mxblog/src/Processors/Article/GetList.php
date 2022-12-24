<?php

namespace MxBlog\Processors\Article;

use MxBlog\Model\Article;
use MODX\Revolution\Processors\Model\GetListProcessor;
use xPDO\Om\xPDOQuery;
use xPDO\Om\xPDOObject;

class GetList extends GetListProcessor
{
    public $objectType = 'Article';
    public $classKey = Article::class;
    public $defaultSortField = 'id';
    public $defaultSortDirection = 'DESC';
    //public $permission = 'list';


    /**
     * We do a special check of permissions
     * because our objects is not an instances of modAccessibleObject
     *
     * @return boolean|string
     */
    public function beforeQuery()
    {
        if (!$this->checkPermissions()) {
            return $this->modx->lexicon('access_denied');
        }

        return true;
    }


    /**
     * @param xPDOQuery $c
     *
     * @return xPDOQuery
     */
    public function prepareQueryBeforeCount(xPDOQuery $c)
    {
        // чтобы отображать только соответствующие ресурсу настройки
        if ($this->getProperty('blog_section_id')) {
            $c->where(array('parent' => $this->getProperty('blog_section_id')));
        }

        if ($this->getProperty('combo')) {
            $c->select('id,pagetitle');
        }

        $query = trim($this->getProperty('query'));
        if ($query) {
            $c->where([
                'pagetitle:LIKE' => "%{$query}%",
                'OR:alias:LIKE' => "%{$query}%",
            ]);
        }

        $this->modx->log(1, print_r($c, 1));

        return $c;
    }


    /**
     * @param xPDOObject $object
     *
     * @return array
     */
    public function prepareRow(xPDOObject $object)
    {
        if ($this->getProperty('combo')) {
            $array = array(
                'id' => $object->get('id'),
                'pagetitle' => '(' . $object->get('id') . ') ' . $object->get('pagetitle'),
            );
        } else {
            $array = $object->toArray();
        }

        $array['preview_url'] = $this->modx->makeUrl($array['id'], $array['context_key']);

        $array['actions'] = [];

        // View
        $array['actions'][] = [
            'cls' => '',
            'icon' => 'icon icon-eye',
            'title' => $this->modx->lexicon('mxblog_article_view'),
            'action' => 'viewArticle',
            'button' => true,
            'menu' => true,
        ];

        // Edit
        $array['actions'][] = [
            'cls' => '',
            'icon' => 'icon icon-edit',
            'title' => $this->modx->lexicon('mxblog_article_update'),
            //'multiple' => $this->modx->lexicon('mxblog_articles_update'),
            'action' => 'editArticle',
            'button' => true,
            'menu' => true,
        ];


        /*if (!$array['published']) {
            $array['actions'][] = [
                'cls' => '',
                'icon' => 'icon icon-power-off action-green',
                'title' => $this->modx->lexicon('mxblog_article_published'),
                'multiple' => $this->modx->lexicon('mxblog_articles_published'),
                'action' => 'publishArticle',
                'button' => true,
                'menu' => true,
            ];
        } else {
            $array['actions'][] = [
                'cls' => '',
                'icon' => 'icon icon-power-off action-gray',
                'title' => $this->modx->lexicon('mxblog_article_unpublished'),
                'multiple' => $this->modx->lexicon('mxblog_articles_unpublished'),
                'action' => 'unpublishArticle',
                'button' => true,
                'menu' => true,
            ];
        }
        // Remove
        $array['actions'][] = [
            'cls' => '',
            'icon' => 'icon icon-trash-o action-red',
            'title' => $this->modx->lexicon('mxblog_article_remove'),
            'multiple' => $this->modx->lexicon('mxblog_articles_remove'),
            'action' => 'removeItem',
            'button' => true,
            'menu' => true,
        ];*/

        return $array;
    }
}
