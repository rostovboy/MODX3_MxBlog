<?php
namespace MxBlog\Model\mysql;

use xPDO\xPDO;

class BlogSection extends \MxBlog\Model\BlogSection
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
        'composites' => 
        array (
            'Articles' => 
            array (
                'class' => 'MxBlog\\Model\\Article',
                'local' => 'id',
                'foreign' => 'parent',
                'cardinality' => 'many',
                'owner' => 'local',
            ),
        ),
    );

}
