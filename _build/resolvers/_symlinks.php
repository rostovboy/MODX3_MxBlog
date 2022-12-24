<?php

/** @var xPDOTransport $transport */
/** @var array $options */
/** @var modX $modx */
if ($transport->xpdo) {
    $modx = $transport->xpdo;

    $dev = MODX_BASE_PATH . 'Extras/MxBlog/';
    /** @var xPDOCacheManager $cache */
    $cache = $modx->getCacheManager();
    if (file_exists($dev) && $cache) {
        if (!is_link($dev . 'assets/components/mxblog')) {
            $cache->deleteTree(
                $dev . 'assets/components/mxblog/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_ASSETS_PATH . 'components/mxblog/', $dev . 'assets/components/mxblog');
        }
        if (!is_link($dev . 'core/components/mxblog')) {
            $cache->deleteTree(
                $dev . 'core/components/mxblog/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_CORE_PATH . 'components/mxblog/', $dev . 'core/components/mxblog');
        }
    }
}

return true;
