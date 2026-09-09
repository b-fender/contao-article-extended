<?php

use BFender\ArticleExtendedBundle\Dca\ArticleOptions;

// --------------------------------------------------------------------
// Neue Legende + Felder in die Standard-Palette einhängen
// --------------------------------------------------------------------
$GLOBALS['TL_DCA']['tl_article']['palettes']['default'] = str_replace(
    '{title_legend},title,alias',
    '{title_legend},title,alias;{article_design_legend},pt,pb,mt,mb,mw,bgcolor,ad_noinside',
    $GLOBALS['TL_DCA']['tl_article']['palettes']['default']
);

// --------------------------------------------------------------------
// Padding-Top
// --------------------------------------------------------------------
$GLOBALS['TL_DCA']['tl_article']['fields']['pt'] = [
    'label'            => &$GLOBALS['TL_LANG']['tl_article']['pt'],
    'exclude'          => true,
    'inputType'        => 'select',
    'options_callback' => [ArticleOptions::class, 'getPtOptions'],
    'eval'             => ['tl_class' => 'w50', 'includeBlankOption' => true, 'chosen' => true],
    'sql'              => "varchar(64) NOT NULL default ''",
];

// --------------------------------------------------------------------
// Padding-Bottom
// --------------------------------------------------------------------
$GLOBALS['TL_DCA']['tl_article']['fields']['pb'] = [
    'label'            => &$GLOBALS['TL_LANG']['tl_article']['pb'],
    'exclude'          => true,
    'inputType'        => 'select',
    'options_callback' => [ArticleOptions::class, 'getPbOptions'],
    'eval'             => ['tl_class' => 'w50', 'includeBlankOption' => true, 'chosen' => true],
    'sql'              => "varchar(64) NOT NULL default ''",
];

// --------------------------------------------------------------------
// Margin-Top
// --------------------------------------------------------------------
$GLOBALS['TL_DCA']['tl_article']['fields']['mt'] = [
    'label'            => &$GLOBALS['TL_LANG']['tl_article']['mt'],
    'exclude'          => true,
    'inputType'        => 'select',
    'options_callback' => [ArticleOptions::class, 'getMtOptions'],
    'eval'             => ['tl_class' => 'w50', 'includeBlankOption' => true, 'chosen' => true],
    'sql'              => "varchar(64) NOT NULL default ''",
];

// --------------------------------------------------------------------
// Margin-Bottom
// --------------------------------------------------------------------
$GLOBALS['TL_DCA']['tl_article']['fields']['mb'] = [
    'label'            => &$GLOBALS['TL_LANG']['tl_article']['mb'],
    'exclude'          => true,
    'inputType'        => 'select',
    'options_callback' => [ArticleOptions::class, 'getMbOptions'],
    'eval'             => ['tl_class' => 'w50', 'includeBlankOption' => true, 'chosen' => true],
    'sql'              => "varchar(64) NOT NULL default ''",
];

// --------------------------------------------------------------------
// Max. Breite
// --------------------------------------------------------------------
$GLOBALS['TL_DCA']['tl_article']['fields']['mw'] = [
    'label'            => &$GLOBALS['TL_LANG']['tl_article']['mw'],
    'exclude'          => true,
    'inputType'        => 'select',
    'options_callback' => [ArticleOptions::class, 'getMwOptions'],
    'eval'             => ['tl_class' => 'w50', 'includeBlankOption' => true, 'chosen' => true],
    'sql'              => "varchar(64) NOT NULL default ''",
];

// --------------------------------------------------------------------
// Hintergrundfarbe
// --------------------------------------------------------------------
$GLOBALS['TL_DCA']['tl_article']['fields']['bgcolor'] = [
    'label'            => &$GLOBALS['TL_LANG']['tl_article']['bgcolor'],
    'exclude'          => true,
    'inputType'        => 'select',
    'options_callback' => [ArticleOptions::class, 'getBgcolorOptions'],
    'eval'             => ['tl_class' => 'w50', 'includeBlankOption' => true, 'chosen' => true],
    'sql'              => "varchar(64) NOT NULL default ''",
];

// --------------------------------------------------------------------
// Ohne "inside"-Wrapper ausgeben (ersetzt die frühere Extra-Vorlage
// mod_article_no_inside.html5)
// --------------------------------------------------------------------
$GLOBALS['TL_DCA']['tl_article']['fields']['ad_noinside'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_article']['ad_noinside'],
    'exclude'   => true,
    'inputType' => 'checkbox',
    'eval'      => ['tl_class' => 'w50 m12'],
    'sql'       => "char(1) NOT NULL default ''",
];
