<?php

require_once('./includes/classes/database.php');
require_once('./includes/config/config.php');
require_once('./includes/functions/utilities.php');

global $config;

$url = $_POST['url'];
$db = new DB($config['database']['username'], $config['database']['password'], $config['database']['hostname'], $config['database']['db_name']);

header('Content-Type: application/json');

if (!$db->is_connected()) {
    echo '{ "status" : "Fail" }';
    die();
}

$url = make_url_safe($url);
$delete_key = generate_delete_key();

$d = insert_into_db($config, $db, $url, $delete_key);
if ($d) {
    echo ' {
        "status" : "success",
        "url" : "' . $d . '",
        "key" : "' . $delete_key . '"
            }';
}
else {
    echo '{ '
    . '"status" : "Fail",' 
    . '"error" : "' . mysql_error() . '"'
            . ' }';
}

/* End of create_link.php */
