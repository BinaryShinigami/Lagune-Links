<?php

/**
 * Contains functions that relate to the HTML output of the website. This is crappy way to do this...
 * TODO Convert to proper use of some type of Templating system to separate layout from code...
 * 
 * @author Shane McIntosh
 */

class Links_Layout {
    
    public function __construct() {
        
    }
    
    public function open_page() {
        echo '<!DOCTYPE html>
                <html>';
    }
    
    public function open_head($page_title) {
        echo '
    <head>
        <title>' . $page_title . '</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="/resources/css/blueprint/screen.css" type="text/css" media="screen, projection">
        <link rel="stylesheet" href="/resources/css/blueprint/print.css" type="text/css" media="print"> 
        <!--[if lt IE 8]>
          <link rel="stylesheet" href="/resources/css/blueprint/ie.css" type="text/css" media="screen, projection">
        <![endif]-->
        <link rel="stylesheet" href="/resources/css/links_main.css" media="screen, projection">
        
        <script src="/resources/scripts/jquery-1.10.2.min" type="text/javascript"></script>
        ';
    }
    
    public function close_head() {
        echo '
                </head>';
    }
    
    public function open_body($nav_links, $affiliate_links, $misc_panels = array()) {
        echo '
                <body>
        <div class="container fill_height">
            
            <div class="span-24 banner">
                <center><a href="/"><img src="/resources/images/banner2.png" /></a></center>
            </div>
            <div class="span-5 fill_height">
                <ul>
                    <li><h3>Navigation</h3></li>';
               foreach($nav_links as $title=>$link) { 

                    echo '<li class="nav_link"><a href="' . $link . '">' . $title. '</a></li>';
                }
                echo '</ul>
                <ul>
                    <li><h3>Affiliates</h3></li>
                    ';
                foreach ($affiliate_links as $affiliate) {
                    echo '<li class="nav_link"><a href="' . $affiliate['url'] . '" alt='. $affiliate['alt-text'] .' >';
                    if ($affiliate['img']) {
                        echo '<img src="'. $affiliate['img'] . '" />';
                    }
                    else {
                        echo $affiliate['alt-text'];
                    }
                    echo '</a></li>';
                }
                echo '</ul>';
                
                foreach($misc_panels as $panel) {
                    echo '<ul>
                        <li><h3>' . $panel['title'] . '</h3></li>' . $panel['content'];
                }
                
            echo '</div>
            
            <div class="span-19 last fill_height">';
    }
    
    public function close_body() {
        echo '
             </div>
            <div class="span-24 footer">
                <center>Copyright &copy 2013 Lagune Software, Shane McIntosh</center>
            </div>
            
        </div>
    </body>';
    }
    
    public function close_page() {
        echo '</html>';
    }
    
    
}

/* End of Links_Layout.php */