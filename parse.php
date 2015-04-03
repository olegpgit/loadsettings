<?php
/**
 * Load settings from the text file into the array
 * Created by Oleg Pylypchuk.
 * Date: 4/3/15
 * Time: 1:59 PM
 */

// Define the path to the settings file
define('SETTINGS_PATH' , './');

// Get contents of the settings file
$file = file_get_contents(SETTINGS_PATH.'settings.txt');

if($file)
{
    // Load setings into the array
    $settings = getSettings($file);

    // Print settings
    var_dump($settings);
}

function getSettings($file)// Get settings and load them into an array
{
    $settings = array();

    $rows = explode("\n", $file);

    array_shift($rows);

    foreach($rows as $row)
    {
        if($row != '' && $row[0] != '#')
        {
            $pattern = '/[=]/';

            $data = preg_split($pattern , $row);

            $key = trim($data[0]);

            $value = trim($data[1]);

            if(strtolower($value) == 'yes' || strtolower($value) == 'on' || strtolower($value) == 'true' )
            {
                $value = TRUE;
            }
            else if(strtolower($value) == 'no' || strtolower($value) == 'off' || strtolower($value) == 'false' )
            {
                $value = FALSE;
            }
            else if (preg_match("/[0-9]/", $value))
            {
                If(strpos($value, '.'))
                {
                    $value = (float)$value;
                }
                else
                {
                    $value = (int)$value;
                }

            }

            $settings[$key] = $value;

        }
    }

    return $settings;

}// End getSettings()