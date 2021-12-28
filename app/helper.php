<?php

/**
 * Extracting user id form user string
 *
 * @param names_of_users
 * @return ids_of_users
 *
 *
 */

function extracting_ids($names)
{
    $ids = '';
    preg_match_all('!\d+!', $names, $id);
    for ($i = 0; $i < sizeof($id[0]); $i++) {
        $ids .= (string)$id[0][$i] . ',';
    }
    return $ids;
}

function extracting_client_id($name)
{
    $id = (int) filter_var($name, FILTER_SANITIZE_NUMBER_INT);
    return $id;
}
/**
 * Remove number from array
 *
 * @param array @param number
 * @return array
 *
 *
 */

function remove_number_from_array($array, $number)
{
    $new_array = [];
    foreach ($array as $key => $value) {
        if ($value != $number) {
            array_push($new_array, $value);
        }
    }
    return $new_array;
}
/**
 * converting a array into string
 *
 * @param array
 * @return string
 *
 *
 */
function array_to_string($array)
{
    $string = '';
    for ($i = 0; $i < sizeof($array); $i++) {
        $string .= (string)$array[$i] . ',';
    }
    return $string;
}
function delete_subtask()
{
}
