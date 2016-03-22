<?php

require_once('./includes/classes/database.php');
require_once('./includes/config/config.php');
require_once('./includes/functions/utilities.php');
require_once('./includes/classes/Links_Layout.php');

global $config;

$url = $_POST['url'];
$db = new DB($config['database']['username'], $config['database']['password'], $config['database']['hostname'], $config['database']['db_name']);

if (strlen($url) <= 0) {
    die(show_generic_error_page('All form elements required!', new Links_Layout(), $config));
}

if (!$db->is_connected()) {
    show_generic_error_page($db->get_error_message(), new Links_Layout(), $config);
    die();
}

$url = make_url_safe($url);
$delete_key = generate_delete_key();

$d = insert_into_db($config, $db, $url, $delete_key);
if ($d) {
    
    $message = 'Your new Link is: <a href="http://links.ls/' . $d . '">' . 'http://links.ls/' . $d . '</a><br />
        To delete this link use <a href="http://links.ls/d/' . $d . ':' . $delete_key . '">' . 'http://links.ls/d/' . $d . ':' . $delete_key . '</a>';
    
    show_generic_success_page($message, new Links_Layout(), $config);
    die();
}
else {
    show_generic_error_page($db->get_error_message(), new Links_Layout(), $config);
    die();
}

/* End of create_link_non_ajax.php */
