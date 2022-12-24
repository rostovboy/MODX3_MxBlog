<?php
namespace MxBlog\Model\mysql;

use xPDO\xPDO;

class Article extends \MxBlog\Model\Article
{

    public static $metaMap = array (
        'package' => 'MxBlog\\Model',
        'version' => '3.0',
        'extends' => 'MODX\\Revolution\\modResource',
        'tableMeta' => 
        array (
            'engine' => 'InnoDB',
        ),
        'fields' => 
        array (
        ),
        'fieldMeta' => 
        array (
        ),
        'aggregates' => 
        array (
            'Section' => 
            array (
                'class' => 'MxBlog\\Model\\BlogSection',
                'local' => 'parent',
                'foreign' => 'id',
                'cardinality' => 'one',
                'owner' => 'foreign',
            ),
        ),
    );

}
