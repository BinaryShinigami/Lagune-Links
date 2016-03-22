<?php

require_once('./includes/classes/database.php');
require_once('./includes/config/config.php');
require_once('./includes/functions/utilities.php');
require_once('./includes/classes/Links_Layout.php');

global $config;

$key = $_GET['key'];
$db = new DB($config['database']['username'], $config['database']['password'], $config['database']['hostname'], $config['database']['db_name']);

if (strlen($key) <= 0) {
    header('Location: /');
    die();
}

if (!$db->is_connected()) {
    show_generic_error_page($db->get_error_message(), new Links_Layout(), $config);
    die();
}

$key = make_url_safe($key);
$key = explode(':', $key);

$query = 'SELECT * FROM ' . $config['database']['prefix'] . 'urls WHERE id = "' . $key[0] . '"';
$d = $db->query($query);
if (!$d) {
    show_generic_error_page('Unable to execute Query; ' . $db->get_error_message(), new Links_Layout(), $config);
    die();
}
else {
    $a = $db->fetch_next_result();
    if ($a['delete_key'] != $key[1]) {
        show_generic_error_page('Delete Key Does not Match!', new Links_Layout(), $config);
        die();
    }
}

$query = 'DELETE FROM ' . $config['database']['prefix'] . 'urls WHERE id = "' . $key[0] . '" AND delete_key = "' . $key[1] . '";';
$d = $db->query($query);

if ($d) {
    
    $message = 'Link Deleted!';
    
    show_generic_success_page($message, new Links_Layout(), $config);
    die();
}
else {
    show_generic_error_page($db->get_error_message(), new Links_Layout(), $config);
    die();
}

/* End of delete_link.php */
