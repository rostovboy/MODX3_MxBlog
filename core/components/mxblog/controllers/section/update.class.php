<?php

use MxBlog\Model\BlogSection;

class BlogSectionUpdateManagerController extends ResourceUpdateManagerController
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
        return $this->modx->hasPermission('edit_document');
    }

}