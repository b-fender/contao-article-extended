<?php

use Contao\DC_Table;

$GLOBALS['TL_DCA']['tl_ad_option'] = [
    'config' => [
        'dataContainer'    => DC_Table::class,
        'enableVersioning' => true,
        'sql'              => [
            'keys' => [
                'id' => 'primary',
            ],
        ],
    ],

    'list' => [
        'sorting' => [
            'mode'        => 1,
            'fields'      => ['type ASC', 'sorting ASC'],
            'flag'        => 1,
            'panelLayout' => 'filter;search,limit',
        ],
        'label' => [
            'fields' => ['label', 'value', 'type'],
            'format' => '%s <span style="color:#999;padding-left:6px">(%s · %s)</span>',
        ],
        'global_operations' => [
            'all' => [
                'href'       => 'act=select',
                'class'      => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset()" accesskey="e"',
            ],
        ],
        'operations' => [
            'edit' => [
                'href' => 'act=edit',
                'icon' => 'edit.svg',
            ],
            'copy' => [
                'href' => 'act=copy',
                'icon' => 'copy.svg',
            ],
            'delete' => [
                'href'       => 'act=delete',
                'icon'       => 'delete.svg',
                'attributes' => 'onclick="if(!confirm(\'' . ($GLOBALS['TL_LANG']['MSC']['deleteConfirm'] ?? 'Delete this element?') . '\'))return false;Backend.getScrollOffset()"',
            ],
            'show' => [
                'href' => 'act=show',
                'icon' => 'show.svg',
            ],
        ],
    ],

    'palettes' => [
        'default' => '{type_legend},type,value,label;{publish_legend},published,sorting',
    ],

    'fields' => [
        'id' => [
            'sql' => "int(10) unsigned NOT NULL auto_increment",
        ],
        'tstamp' => [
            'sql' => "int(10) unsigned NOT NULL default 0",
        ],
        'type' => [
            'label'     => &$GLOBALS['TL_LANG']['tl_ad_option']['type'],
            'exclude'   => true,
            'filter'    => true,
            'inputType' => 'select',
            'options'   => ['pt', 'pb', 'mt', 'mb', 'mw', 'bgcolor'],
            'reference' => &$GLOBALS['TL_LANG']['tl_ad_option']['type_options'],
            'eval'      => ['mandatory' => true, 'tl_class' => 'w50', 'submitOnChange' => false],
            'sql'       => "varchar(32) NOT NULL default ''",
        ],
        'value' => [
            'label'     => &$GLOBALS['TL_LANG']['tl_ad_option']['value'],
            'exclude'   => true,
            'search'    => true,
            'inputType' => 'text',
            'eval'      => ['mandatory' => true, 'maxlength' => 64, 'tl_class' => 'w50'],
            'sql'       => "varchar(64) NOT NULL default ''",
        ],
        'label' => [
            'label'     => &$GLOBALS['TL_LANG']['tl_ad_option']['label'],
            'exclude'   => true,
            'search'    => true,
            'inputType' => 'text',
            'eval'      => ['mandatory' => true, 'maxlength' => 128, 'tl_class' => 'w50'],
            'sql'       => "varchar(128) NOT NULL default ''",
        ],
        'sorting' => [
            'label'     => &$GLOBALS['TL_LANG']['tl_ad_option']['sorting'],
            'exclude'   => true,
            'inputType' => 'text',
            'default'   => 0,
            'eval'      => ['mandatory' => true, 'rgxp' => 'natural', 'tl_class' => 'w50'],
            'sql'       => "int(10) NOT NULL default 0",
        ],
        'published' => [
            'label'     => &$GLOBALS['TL_LANG']['tl_ad_option']['published'],
            'exclude'   => true,
            'filter'    => true,
            'inputType' => 'checkbox',
            'default'   => true,
            'eval'      => ['tl_class' => 'w50 m12'],
            'sql'       => "char(1) NOT NULL default '1'",
        ],
    ],
];
