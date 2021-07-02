Basic Event Submission
===================

With this bundle you can create an event from frontend. You make a module type `Event Submission` and select *editable* fields.

By default some fields from `tl_calendar_events` are already made editiable, but you can add more fields as shown below.


## Adding more fields

You can add more fields from `tl_calendar_events` to editable list by adding `['eval']['feEditable'] = true`

```php
/* mark these standard fields as editable */
foreach (array('title', 'teaser', 'startDate', 'endDate', 'startTime', 'endTime', 'location', 'enclosure') as $key) {
    $GLOBALS['TL_DCA']['tl_calendar_events']['fields'][$key]['eval']['feEditable'] = true;
}
```


## Notification Tokens

By submiting an event you can send a notification of type `Event Submit`.

All events fields from the particular event (`tl_calendar_events`) are avaliable as notification simple token
```php
##event_*##
```
Also if there is a file upload, then link to the file is available as.
```php
##event_{uploadFieldName}_path##
```
For example: 
```php
##event_teaser_image_path##
##event_enclosure_path##
```

All events fields from the Module `Event Submission` are also available inside notification.

```php
##eventsubmit_mod_*##

##eventsubmit_mod_name##
##eventsubmit_mod_type##
##eventsubmit_mod_headline##
```

If there is a logged in frontend user, then all member fields are also available inside notification.

```php
##member_*##
```
If user is a guest user (not logged in member) then following informations are also available inside notification.
```php
##GuestCompany##, 
##GuestTitle##, 
##GuestFirstname##, 
##GuestLastname##, 
##GuestEmail##
````

## Configuration
```php
//inside your module config.php

//Allow to create event only within so much months
`$GLOBALS['BS_EventSubmit']['BS_EVENT_ALLOWED_MONTHS'] = 24`;

//If there are uploads then create a destination subfolder automatically inside the base folder.
//Subfolder name is YYYYMMDD-HHMMSS-EventID. Set to false if you like to have all files inside the base folder
$GLOBALS['BS_EventSubmit']['BS_CUSTOM_FOLDER'] = true;

//If you prefer to have another naming for the subfolder, then define a clouser function like example give below
$GLOBALS['BS_EventSubmit']['BS_CUSTOM_FOLDER_FUNCTION'] = null;
```

## Upload destination

You define a base destination location for the uploads from module. For each event submission with upload file, a subfolder is created automatically within the base folder.

The naming of this subfolder is `Date-Time-EventID` with format `YYYYMMDD-HHMM-ID`. You can change to your need by defining a clouser function inside config array as below.

```php

/**
 * Example folder name callback
 */
$GLOBALS['BS_EventSubmit']['BS_CUSTOM_FOLDER_FUNCTION'] =  function ($obj, $basePath) {

    //You can add any logic here for folder name.
    $newFolder = rand(0, 100);

    $objFolder = new \Contao\Folder($basePath . '/' . $newFolder);

    if (($uuid = $objFolder->getModel()->uuid) == null) {
        //We fall here if the folder is excluded from the DBAFS
        $fileModel = \Contao\Dbafs::addResource($objFolder->path);
        $uuid = $fileModel->row()['uuid'];
    }

    return $uuid;
};
```

## More custom fields

You can add more custom fields from your bundle by adding more DCA flields to `$GLOBALS['TL_DCA']['tl_calendar_events']['fields']`. These custom fields must have `eval` with `'feEditable' => true`.

