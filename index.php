<?php
 
require_once('./includes/classes/Links_Layout.php');
require_once('./includes/config/config.php');

global $config;

$tpl = new Links_Layout();

$tpl->open_page();
$tpl->open_head($config['website']['title']);

$site_url = $config['website']['url'];

$html = "Your new Link is: <a href=\"" . $site_url ."/' + url + '\">' + '" . $site_url . "/' + url + '</a><br />To delete this link use <a href=\"" . $site_url . "/d/' + url + ':' + key + '\">' + '" . $site_url . "/d/' +url + ':' + key + '</a>";

?>
<script>
<!--
    $(document).ready(function() {
       $(success).hide(); 
       
       $(url_form).append('<input type="button" value="Tinify" class="drop_shadow" onClick="process_request()" />');
       $(url).change('process_request()');
       
       
    });

    function process_request() {
        
        if ( $(url).val().length <= 0 ) {
            
            $(success).text('Sorry but you did not provide a valid URL!');
            $(success).removeClass('success');
            $(success).addClass('error');
            $(success).css('visibility', 'visible');
            $(success).show(350);
            
            return;
        
        }
        
        $.post("/tinify_url", 
            {
                url: $(url).val()
            },
            function(data, status) {
                if (data['status'] != 'Fail') {
                    
                    var url = data['url'];
                    var key = data['key']
                    
                    $(success).removeClass('error');
                    $(success).addClass('success');
                    $(success).html('<?php echo $html; ?> ');
                    $(success).show(350);
                    $(success).css('visibility', 'visible');
                }
                else {
                    $(success).text('Oh-No! We failed to create you a Link in the database!');
                    $(success).removeClass('success');
                    $(success).addClass('error');
                    $(success).css('visibility', 'visible');
                    $(success).show(350);
                }
            }
        )
        .fail(
            function() {
            $(success).text('Oh-No! We failed to create you a Link!');
            $(success).removeClass('success');
            $(success).addClass('error');
            $(success).css('visibility', 'visible');
            $(success).show(350);
            }
        );
    }
 -->
</script>
<?php
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
                </div>
                <div class="ajax_results success drop_shadow" id="success" >
                     
                </div>
                <div class="center" id="input_form">
                    <form action="/non_ajax_url_form" method="post" id="url_form" onsubmit="process_request();return false;">
                        <label class="text">
                            Enter URL: <input type="text" class="text drop_shadow" name="url" id="url" />
                        </label>
                        <noscript>
                            <input type="submit" value="No Script Submit" />
                        </noscript>
                    </form>
                </div>

<?php

$tpl->close_body();
$tpl->close_page();

//End of Index.php
