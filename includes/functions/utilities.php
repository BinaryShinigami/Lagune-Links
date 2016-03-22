<?php

/**
 * Contains basic utility functions for the site
 * 
 * @author Shane McIntosh
 */

function generate_delete_key() {
    $max_chars = rand(0,1024);
    $key = '';
    for ($i = 0; $i < $max_chars; $i++) {
        $key .= rand(32, 126);
    }
    
    $key = md5($key);
    
    return $key;
}

function make_url_safe($url) {
    return strip_tags(nl2br(mysql_real_escape_string($url)));
} 

function insert_into_db($config, $db, $url, $delete_key) {
    $query = "INSERT INTO " . $config['database']['prefix'] . 'urls(url, hit_count, last_hit, delete_key) VALUES ("' . $url . '",0, CURDATE(), "' . $delete_key. '");';

    if ($db->query($query)) {
        return $db->get_last_insert_id();
    }
    else {
        return FALSE;
    }
}

function show_generic_error_page($error, $tpl, $config) {

    $tpl->open_page();
    $tpl->open_head($config['website']['title']);

    $tpl->close_head();
    $tpl->open_body($config['website']['navigation_links'], $config['website']['affiliates']);
    echo '<div class="error drop_shadow">
        ' . $error . '
    </div>';
    $tpl->close_body();
    $tpl->close_page();

}

function show_generic_page($content, $tpl, $config) {

    $tpl->open_page();
    $tpl->open_head($config['website']['title']);

    $tpl->close_head();
    $tpl->open_body($config['website']['navigation_links'], $config['website']['affiliates']);
    echo $content;
    $tpl->close_body();
    $tpl->close_page();

}

function show_generic_success_page($message, $tpl, $config) {
    
    $tpl->open_page();
    $tpl->open_head($config['website']['title']);

    $tpl->close_head();
    $tpl->open_body($config['website']['navigation_links'], $config['website']['affiliates']);
    echo '<div class="success drop_shadow">
        ' . $message . '
            </div>';
    $tpl->close_body();
    $tpl->close_page();
    
}

function redirect_user($url, $tpl, $config) {
    $tpl->open_page();
    $tpl->open_head($config['website']['title']);
    echo '<script>
        <!--
        $(window).load(function() {
     window.location.replace("' . $url . '");   
    });
    -->
    </script>';
    $tpl->close_head();
    $tpl->open_body($config['website']['navigation_links'], $config['website']['affiliates']);
    echo 'Please Wait While We Redirect You To <a href="' . $url . '">' . $url . '</a>';
    $tpl->close_body();
    $tpl->close_page();
}