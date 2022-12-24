<?php

/**
 * @var \MODX\Revolution\modX $modx
 * @var array $namespace
 */

// Load the classes
$modx->addPackage('MxBlog\Model', $namespace['path'] . 'src/', null, 'MxBlog\\');

$modx->services->add('MxBlog', function ($c) use ($modx) {
    return new MxBlog\MxBlog($modx);
});
