<?php
 
require_once('./includes/classes/Links_Layout.php');
require_once('./includes/config/config.php');

global $config;

$tpl = new Links_Layout();

$tpl->open_page();
$tpl->open_head($config['website']['title']);
$tpl->close_head();
$tpl->open_body($config['website']['navigation_links'], $config['website']['affiliates']);
?>

<div class="how_to_text">
    <p>
        We at Links understand that concept may be foreign to some of the users who are 
        asked to try Links, because of this we provide this simple Question and Answer page 
        to you made up of some of the most common questions asked by others. We ask that before you
        send off a question to us from the <a href='/contact'>Contact Us</a> page that you first
        take a quick glance through these questions and see if we have already answered your question for you.
        If you still have any questions then feel free to send us an email or contact us through the website interface.
    </p>
</div>

<div class='faq'> 
    <ul>
        <li>
            <h2>What is Links?</h2>
            <p>
                Links is a simple to use anonymous URL shortening service which aims to provide users
                with a way to share long website addresses with others without having to remember lengthy 
                names and symbols. We keep no logs and share nothing with anyone. 100% anonymous.
            </p>
        </li>
        
        <li>
            <h2>Is it true you don't keep any logs?</h2>
            <p>
                Yes! We believe that the web should be a way to express yourself anonymously if you so choose to
                and keep no access logs so that your privacy is protected!
            </p>
        </li>
        
        <li>
            <h2>Why should I use Links compared to other services?</h2>
            <p>
                This is the real question that most people have is it not? What makes us different from other 
                URL shortening services? Well for one thing we protect your privacy by storing no logs and not sharing 
                user information with anyone. Also we are the little guy out of the bunch. Don't you want to support the little guy?
            </p>
        </li>
        
    </ul>
</div>


<?php

$tpl->close_body();
$tpl->close_page();

//End of faq.php