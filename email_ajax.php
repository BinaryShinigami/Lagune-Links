<?php

require_once('./includes/classes/Links_Layout.php');
require_once('./includes/config/config.php');

global $config;

header('Content-Type: application/json');

$addr = $_POST['sender_addr'];
$subject = $_POST['subject'];
$body = $_POST['body'];


$addr = strip_tags($addr);
$addr = nl2br($addr);
$headers = 'From: ' . $addr . '\r\n';

if (mail('shane@packetheaven.net', $subject, $body, $headers)) {
    echo ' { "status" : "success" } ';
}
else {
    echo '{ "status" : "fail" }';
}

//End of email_ajax.php
