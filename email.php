<?php
 
require_once('./includes/classes/Links_Layout.php');
require_once('./includes/config/config.php');

global $config;

$tpl = new Links_Layout();

$tpl->open_page();
$tpl->open_head($config['website']['title']);
$tpl->close_head();
$tpl->open_body($config['website']['navigation_links'], $config['website']['affiliates']);

$addr = $_POST['sender_addr'];
$subject = $_POST['subject'];
$body = $_POST['body'];

if ( (strlen($addr) < 1) || (strlen($subject) < 1) || (strlen($body) < 1) ) {
    echo '<div class="error drop_shadow">
        Sorry but all fields of the form are required!</div>';
    ?>
<div class='center' id='input_form'>
    
    <form action='/send_email' method='POST'>
        <label for='sender_addr' class='span-8'>
            Your Email:
        </label>
        <input type='text' class='text span-11 last' name='sender_addr' id='sender_addr' /><br />

        <label for='subject' class='span-8'>
            Subject:
        </label>
        <input type='text' class='text span-11 last' name='subject' id='subject' /><br />
        <label for='body' class='span-19 last'>
            Please Enter Your Question:
        </label>
        <textarea class='text span-11 last' height='150' id='body' name='body'></textarea><br />
        <input type='submit' value='Send E-Mail' />
    </form>

</div>
<?php
}
else {
    $addr = strip_tags($addr);
    $addr = nl2br($addr);
    $headers = 'From: ' . $addr . '\r\n';
    
    if (mail('shane@packetheaven.net', $subject, $body, $headers)) {
        echo 'Mail Sent Successfully!';
    }
    else {
        echo 'Error Sending Mail! Please send manually :\'(';
    }
}

$tpl->close_body();
$tpl->close_page();

//End of email.php
