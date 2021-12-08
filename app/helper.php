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
