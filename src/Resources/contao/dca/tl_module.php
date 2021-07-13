<?php

use Contao\System;
use Contao\Controller;


// Fields

$GLOBALS['TL_DCA']['tl_module']['fields']['bsEventSubmitEditable'] = [
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['bsEventSubmitEditable'],
    'exclude'                 => true,
    'inputType'               => 'checkboxWizard',
    'options_callback'        => static function () {
        $return = [];

        System::loadLanguageFile('tl_calendar_events');
        Controller::loadDataContainer('tl_calendar_events');

        foreach ($GLOBALS['TL_DCA']['tl_calendar_events']['fields'] as $k => $v) {
            if ($v['eval']['feEditable']) {
                if (strlen($GLOBALS['TL_DCA']['tl_calendar_events']['fields'][$k]['label'][0]) > 0) {
                    $return[$k] = $GLOBALS['TL_DCA']['tl_calendar_events']['fields'][$k]['label'][0];
                } else {
                    $return[$k] = $k;
                }
            }
        }

        return $return;
    },
    'eval'                    => ['multiple' => true, 'submitOnChange' => true],
    'sql'                     => "blob NULL"
];

$GLOBALS['TL_DCA']['tl_module']['fields']['bsEventSubmitCalendar'] = [
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['bsEventSubmitCalendar'],
    'exclude'                 => true,
    'inputType'               => 'select',
    'foreignKey'              => 'tl_calendar.title',
    'eval'                    => ['chosen' => true],
    'sql'                     => "int(10) unsigned NOT NULL default '0'"
];

$GLOBALS['TL_DCA']['tl_module']['fields']['bsUploadDir'] = [
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['bsUploadDir'],
    'exclude'                 => true,
    'inputType'               => 'fileTree',
    'eval'                    => ['fieldType' => 'radio', 'mandatory' => true, 'tl_class' => 'clr'],
    'sql'                     => "binary(16) NULL"
];


/**
 * Add fields to the pallette
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['bs_EventSubmit'] = '{title_legend},name,headline,type;
                                                                {config_legend},bsEventSubmitCalendar,bsEventSubmitEditable,disableCaptcha; 
                                                                {notification_legend},nc_notification;                                                               
                                                                {redirect_legend},jumpTo;{template_legend:hide},tableless;
                                                                {protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';

/**
 * Notification choices
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['nc_notification']['eval']['ncNotificationChoices']['bs_eventsubmit'] = ['bs_eventsubmit'];
