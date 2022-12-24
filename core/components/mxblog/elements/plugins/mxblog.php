<?php

/**
 * @var modX $modx
 * @var array $scriptProperties
 * @var string $mode
 * @var object $resource
 */

use MxBlog\MxBlog;

$mxblog = new MxBlog($modx);
if (!($mxblog instanceof MxBlog)) return '';

switch ($modx->event->name) {
    case 'OnDocFormPrerender':

        if ($mode == 'new' or $resource->get('class_key') != 'MxBlog\Model\BlogSection') return;

        $mxblog->loadArticlesTab($modx->controller, $resource);

        break;
}