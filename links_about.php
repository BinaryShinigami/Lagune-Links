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
        Welcome to Links! Links is a simple to use URL shortening and anonymizing
        website that allows you to links users to websites without leaving them with
        any pesky referrers from your site! It also lets you shorten unsightly long 
        URLs so that you can use them easily on twitter or tell them the URL over the
        phone, or even write them down easily! If you have any problems please refer to 
        the <a href="#">F.A.Q.</a> page for common problems and solutions.
    </p>
    
    <p>
        Links was created as an alternative URL shortening service which keeps no logs.
        By not logging anything Links can ensure that your IP and information is kept secret
        and allows you to use Links anonymously. Due to the fact that we can't control the logs of the
        data center we recommend you at least use SSL to encrypt your traffic with links so that no one 
        can tell what you are sending to Links and where you are being redirected to.
    </p>
    
    <p>
        Links was developed by Shane McIntosh of <a href='http://lagune-software.com'>Lagune Software</a> as a small
        project to shake off the &quot;rust&quot; of not working with PHP in a while. If you have any problems or bugs to report
        please send a description of the bug/problem with as much information as you can provide to <a href='mailto:binary@lagune-software.com'>binary@lagune-software.com</a>.
    </p>
</div>


<?php

$tpl->close_body();
$tpl->close_page();

//End of about.php
