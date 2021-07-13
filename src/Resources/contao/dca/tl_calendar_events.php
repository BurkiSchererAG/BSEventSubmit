<?php

use Contao\System;
use Contao\Controller;
use Contao\StringUtil;
use Contao\Image;
use Contao\FrontendUser;
use Contao\CoreBundle\DataContainer\PaletteManipulator;


System::loadLanguageFile('tl_calendar_events');
System::loadLanguageFile('tl_member');
Controller::loadDataContainer('tl_calendar_events');

/* mark these standard fields as editable */
foreach (['title', 'teaser', 'startDate', 'endDate', 'startTime', 'endTime', 'location', 'url', 'singleSRC', 'enclosure'] as $key) {
    $GLOBALS['TL_DCA']['tl_calendar_events']['fields'][$key]['eval']['feEditable'] = true;
}

/* Change some setting of standard fields, when in Frontend */
if (TL_MODE == 'FE') {
    $GLOBALS['TL_DCA']['tl_calendar_events']['fields']['endDate']['eval']['mandatory']   = false;
    $GLOBALS['TL_DCA']['tl_calendar_events']['fields']['startTime']['eval']['mandatory'] = false;
    $GLOBALS['TL_DCA']['tl_calendar_events']['fields']['endTime']['eval']['mandatory']   = false;
    $GLOBALS['TL_DCA']['tl_calendar_events']['fields']['teaser']['eval']['mandatory']   = true;

    $GLOBALS['TL_DCA']['tl_calendar_events']['fields']['url']['eval']['mandatory']   = false;

    //enclosure
    $GLOBALS['TL_DCA']['tl_calendar_events']['fields']['enclosure']['eval']['storeFile']   = true;
    $GLOBALS['TL_DCA']['tl_calendar_events']['fields']['enclosure']['eval']['mandatory']   = false;

    //teaser image
    $GLOBALS['TL_DCA']['tl_calendar_events']['fields']['singleSRC']['eval']['storeFile']   = true;
    $GLOBALS['TL_DCA']['tl_calendar_events']['fields']['singleSRC']['eval']['mandatory']   = false;
    $GLOBALS['TL_DCA']['tl_calendar_events']['fields']['singleSRC']['label'] = &$GLOBALS['TL_LANG']['tl_calendar_events']['singleSRC'];


    /**
     * These save_callback are only relevant from backend and also it expects DataContainer $dc as 2nd argument.
     * In the frontend we set the correct values from our script, hence unset it
     */
    unset($GLOBALS['TL_DCA']['tl_calendar_events']['fields']['endTime']['save_callback']);
    unset($GLOBALS['TL_DCA']['tl_calendar_events']['fields']['endDate']['save_callback']);
}

/**
 * Custom Fields
 */
$GLOBALS['TL_DCA']['tl_calendar_events']['fields']['email'] = [
    'label'                   => &$GLOBALS['TL_LANG']['tl_calendar_events']['email'],
    'exclude'                 => true,
    'search'                  => true,
    'filter'                  => true,
    'sorting'                 => true,
    'inputType'               => 'text',
    'eval'                    => ['maxlength' => 255, 'rgxp' => 'email', 'decodeEntities' => true, 'feEditable' => true, 'feViewable' => true, 'tl_class' => 'w50'],
    'sql'                     => "varchar(255) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_calendar_events']['fields']['company'] = [
    'label'                   => &$GLOBALS['TL_LANG']['tl_calendar_events']['company'],
    'exclude'                 => true,
    'search'                  => true,
    'filter'                  => true,
    'sorting'                 => true,
    'inputType'               => 'text',
    'eval'                    => ['maxlength' => 255, 'decodeEntities' => true, 'feEditable' => true, 'feViewable' => true, 'tl_class' => 'w50'],
    'sql'                     => "varchar(255) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_calendar_events']['fields']['designation'] = [
    'label'                   => &$GLOBALS['TL_LANG']['tl_calendar_events']['designation'],
    'exclude'                 => true,
    'search'                  => true,
    'sorting'                 => true,
    'flag'                    => 1,
    'inputType'               => 'text',
    'eval'                    => ['maxlength' => 255, 'feEditable' => true, 'feViewable' => true, 'feGroup' => 'career', 'tl_class' => 'w50'],
    'sql'                     => "varchar(255) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_calendar_events']['fields']['firstname'] = [
    'label'                   => &$GLOBALS['TL_LANG']['tl_calendar_events']['firstname'],
    'exclude'                 => true,
    'search'                  => true,
    'sorting'                 => true,
    'flag'                    => 1,
    'inputType'               => 'text',
    'eval'                    => ['maxlength' => 255, 'feEditable' => true, 'feViewable' => true, 'feGroup' => 'personal', 'tl_class' => 'w50'],
    'sql'                     => "varchar(255) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_calendar_events']['fields']['lastname'] = [
    'label'                   => &$GLOBALS['TL_LANG']['tl_calendar_events']['lastname'],
    'exclude'                 => true,
    'search'                  => true,
    'sorting'                 => true,
    'flag'                    => 1,
    'inputType'               => 'text',
    'eval'                    => ['maxlength' => 255, 'feEditable' => true, 'feViewable' => true, 'feGroup' => 'personal', 'tl_class' => 'w50'],
    'sql'                     => "varchar(255) NOT NULL default ''"
];


$GLOBALS['TL_DCA']['tl_calendar_events']['fields']['member'] = [
    'label'                   => &$GLOBALS['TL_LANG']['tl_calendar_events']['member'],
    'exclude'                 => true,
    'search'                  => true,
    'filter'                  => true,
    'sorting'                 => true,
    'flag'                    => 11,
    'inputType'               => 'select',
    'foreignKey'              => 'tl_member.lastname',
    'eval'                    => ['doNotCopy' => true, 'chosen' => true, 'includeBlankOption' => true, 'tl_class' => 'clr w50 wizard'],
    'wizard' => [
        static function (\Contao\DataContainer $dc) {
            return ($dc->value < 1) ? '' :
                ' <a href="contao/main.php?do=member&amp;act=edit&amp;id=' . $dc->value .
                '&amp;popup=1&amp;nb=1&amp;rt=' . REQUEST_TOKEN . '" title="' .
                sprintf(StringUtil::specialchars($GLOBALS['TL_LANG']['tl_calendar_events']['memberinfo']), $dc->value) .
                '" onclick="Backend.openModalIframe({\'title\':\''  .
                StringUtil::specialchars(str_replace("'", "\\'", sprintf($GLOBALS['TL_LANG']['tl_calendar_events']['memberinfo'], $dc->value))) .
                '\',\'url\':this.href});return false">' .
                Image::getHtml('alias.gif') .
                '</a>';
        }
    ],
    'sql'                     => "int(10) unsigned NOT NULL default '0'",
    'relation'                => ['type' => 'hasOne', 'load' => 'eager']
];


//This doesn't have real DB field. Its used add details input textarea

foreach (range(1, $GLOBALS['BS_EventSubmit']['DETAIL_CE_TEXT_FIELD']) as $key) {
    $GLOBALS['TL_DCA']['tl_calendar_events']['fields']['detailCE_' . $key] = [
        'label'                   => &$GLOBALS['TL_LANG']['tl_calendar_events']['detailCE' . $key],
        'exclude'                 => true,
        'inputType'               => 'textarea',
        'eval'                    => ['rte' => 'tinyMCE', 'decodeEntities' => true, 'feEditable' => true],
    ];
}

/**
 * Show or hide personal fields depending upon if user is logged in or guest.
 **/
if (TL_MODE == 'FE') {
    $objFrontendUser = FrontendUser::getInstance();

    $arrGuestFields = ['email', 'firstname', 'lastname', 'designation', 'company'];

    if ($objFrontendUser->email === null) {
        foreach ($arrGuestFields as $key) {
            $GLOBALS['TL_DCA']['tl_calendar_events']['fields'][$key]['eval']['mandatory'] = true;
        }
    } else {
        foreach ($arrGuestFields as $key) {
            $GLOBALS['TL_DCA']['tl_calendar_events']['fields'][$key]['eval']['feEditable'] = false;
        }
    }
}

/**
 * Add Palette
 */
$pm = PaletteManipulator::create()
    ->addLegend('creator_legend', 'title_legend', PaletteManipulator::POSITION_AFTER)
    ->addField('member, email, firstname, lastname, designation, company', 'creator_legend', PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('default', 'tl_calendar_events')
    ->applyToPalette('internal', 'tl_calendar_events')
    ->applyToPalette('article', 'tl_calendar_events')
    ->applyToPalette('external', 'tl_calendar_events');
