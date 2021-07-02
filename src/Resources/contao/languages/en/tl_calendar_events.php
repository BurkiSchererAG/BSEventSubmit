<?php
//Rename core
$GLOBALS['TL_LANG']['tl_calendar']['author'][0] = 'Author/Contao User';


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_calendar_events']['designation'] = ['Salutation', 'Salutation or Job title'];
$GLOBALS['TL_LANG']['tl_calendar_events']['member'] = ['Event creator / Member', 'Select the member who create this event'];

$GLOBALS['TL_LANG']['tl_calendar_events']['email'] = ['Event creator email', 'Email of person who created this event'];
$GLOBALS['TL_LANG']['tl_calendar_events']['firstname'] = ['First name', 'First name of person who created this event'];
$GLOBALS['TL_LANG']['tl_calendar_events']['lastname'] = ['Last name', 'First name of person who created this event'];
$GLOBALS['TL_LANG']['tl_calendar_events']['company'] = ['Company/Organization', 'Company of person who created this event'];
$GLOBALS['TL_LANG']['tl_calendar_events']['singleSRC'] = ['Teaser Image', 'Please select image file'];



foreach (range(1, $GLOBALS['BS_EventSubmit']['DETAIL_CE_TEXT_FIELD']) as $key) {
    $GLOBALS['TL_LANG']['tl_calendar_events']['detailCE' . $key] = ['Add event detail textarea-' . $key, 'Add detail input textarea'];
}
/**
 * Legend
 */
$GLOBALS['TL_LANG']['tl_calendar_events']['creator_legend'] = 'Event Creator Information';
