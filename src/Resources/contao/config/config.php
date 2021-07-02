<?php

/**
 * Front end modules
 */
$GLOBALS['FE_MOD']['bs']['bs_EventSubmit'] = 'BurkiSchererAG\ModuleEventSubmit';


/**
 * Notification Center Notification Types
 */
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE'] = array_merge_recursive(
    (array) $GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE'],
    array(
        'bs' => array(
            'bs_eventsubmit' => array(
                'email_text' => [
                    'eventsubmit_mod_*', 'event_*', 'member_*',
                    'GuestCompany', 'GuestTitle', 'GuestFirstname', 'GuestLastname', 'GuestEmail',
                    'contaoCalendarEventDetails', 'contaoCalendarEventList', 'contaoCalendarDetails', 'contaoCalendarList'
                ],
                'file_name' => [
                    'eventsubmit_mod_*', 'event_*', 'member_*'
                ]
            )
        )
    )
);

/* make same variables from email_text above, avialable to email_subject, email_html and file_content */
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['bs']['bs_eventsubmit']['email_subject'] =
    &$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['bs']['bs_eventsubmit']['email_text'];
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['bs']['bs_eventsubmit']['email_html'] =
    &$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['bs']['bs_eventsubmit']['email_text'];
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['bs']['bs_eventsubmit']['file_content'] =
    &$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['bs']['bs_eventsubmit']['email_text'];



/**
 * Some Configuration values
 */
//Allow to create event only within so much months
$GLOBALS['BS_EventSubmit']['BS_EVENT_ALLOWED_MONTHS'] = 24;

//If there are uploads then create a destination subfolder automatically inside the base folder.
//Subfolder name is YYYYMMDD-HHMM-EventID. Set to false if you like to have all files inside the base folder
$GLOBALS['BS_EventSubmit']['BS_CUSTOM_FOLDER'] = true;

//If you prefer to have another naming for the subfolder, then define a clouser function like example give below
$GLOBALS['BS_EventSubmit']['BS_CUSTOM_FOLDER_FUNCTION'] = null;

//Adds detail textarea
$GLOBALS['BS_EventSubmit']['DETAIL_CE_TEXT_FIELD'] = 1;


/**
 * Example folder name callback
 */
 /*
$GLOBALS['BS_EventSubmit']['BS_CUSTOM_FOLDER_FUNCTION'] =  function ($obj, $basePath) {

    //You can add any logic here
    $newFolder = rand(0, 100);

    $objFolder = new \Contao\Folder($basePath . '/' . $newFolder);

    if (($uuid = $objFolder->getModel()->uuid) == null) {
        //We fall here if the folder is excluded from the DBAFS
        $fileModel = \Contao\Dbafs::addResource($objFolder->path);
        $uuid = $fileModel->row()['uuid'];
    }

    return $uuid;
};
 */
