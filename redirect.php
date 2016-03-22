<?php

require_once('./includes/classes/database.php');
require_once('./includes/config/config.php');
require_once('./includes/classes/Links_Layout.php');
require_once('./includes/functions/utilities.php');
global $config;

$website_id = $_GET['id'];


if (!is_numeric($website_id)) {
    
    header('Location: /');
}
else {
    $query = "SELECT url FROM " . $config['database']['prefix'] . 'urls WHERE id = ' . $website_id;
    
    $db = new DB($config['database']['username'], $config['database']['password'], $config['database']['hostname'], $config['database']['db_name']);
    
    if (!$db->is_connected()) {
        die(show_generic_error_page($db->get_error_message(), new Links_Layout(), $config));
    }
    else {
        if ($db->query($query)) {
            $url = $db->fetch_next_result();
            if (!$url) {
                die(show_generic_error_page($db->get_error_message(), new Links_Layout(), $config));
            }
            redirect_user($url['url'], new Links_Layout(), $config);
        }
        else {
            die(show_generic_error_page($db->get_error_message(), new Links_Layout(), $config));
        }
    }
    
}

/* end of redirect.php */