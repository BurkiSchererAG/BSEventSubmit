<?php

use Contao\CoreBundle\DataContainer\PaletteManipulator;


// Fields

$GLOBALS['TL_DCA']['tl_calendar']['fields']['eventOwner'] = [
    'label'                   => &$GLOBALS['TL_LANG']['tl_calendar']['eventOwner'],
    'exclude'                 => true,
    'search'                  => true,
    'filter'                  => true,
    'sorting'                 => true,
    'flag'                    => 11,
    'inputType'               => 'select',
    'foreignKey'              => 'tl_user.name',
    'eval'                    => ['doNotCopy' => true, 'chosen' => true, 'mandatory' => true, 'includeBlankOption' => true, 'tl_class' => 'w50'],
    'sql'                     => "int(10) unsigned NOT NULL default '0'",
    //'relation'                => array('type' => 'hasOne', 'load' => 'eager')
];

/**
 * Add Palette
 */
$pm = PaletteManipulator::create()
    ->addField('eventOwner', 'jumpTo', PaletteManipulator::POSITION_AFTER)
    ->applyToPalette('default', 'tl_calendar');
