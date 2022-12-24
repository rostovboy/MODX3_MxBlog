<?php

use MxBlog\Model\Article;

class ArticleCreateManagerController extends ResourceCreateManagerController
{
    /**
     * Returns language topics
     * @return array
     */
    public function getLanguageTopics()
    {
        return ['resource', 'mxblog:default'];
    }


    /**
     * Check for any permissions or requirements to load page
     * @return bool
     */
    public function checkPermissions()
    {
        return $this->modx->hasPermission('new_document');
    }


    /**
     * Return the default template for this resource
     * @return int|mixed
     */
    public function getDefaultTemplate()
    {
        if (!$template = $this->modx->getOption('mxblog_template_article_default')) {
            $template = parent::getDefaultTemplate();
        }

        return $template;
    }
}