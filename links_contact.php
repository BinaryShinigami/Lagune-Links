<?php
 
require_once('./includes/classes/Links_Layout.php');
require_once('./includes/config/config.php');

global $config;

$tpl = new Links_Layout();

$tpl->open_page();
$tpl->open_head($config['website']['title']);
?>
<script>
    <!--
    $(document).ready(function() {
        $(output_box).hide();
        
        $(email_form).append("<div class='clear' style='text-align: center'><input type='button' value='Send E-Mail' onclick='validate_form()' /></div>");
    });
    
    function validate_form() {
        var addr_len = $(sender_addr).val().length;
        var subject_len = $(subject).val().length;
        var body_len = $(body).val().length;
        
        if (addr_len == 0 || subject_len == 0 || body_len == 0) {
            $(output_box).text("Sorry but all fields are required!");
            $(output_box).addClass('error');
            $(output_box).css('visibility', 'visible');
            $(output_box).show(350);
        }
        else {
            //Put AJAX REQUEST HERE!!!!
            
            $.post('/send_mail_ajax',
                {
                    sender_addr : $(sender_addr).val(),
                    subject : $(subject).val(),
                    body: $(body).val()
                },
                function(data, status) {
                    if (data['status'] == 'success') {
                        $(output_box).text("Message Sent Successfully");
                        $(output_box).addClass('success');
                        $(output_box).css('visibility', 'visible');
                        $(output_box).show(350);
                    }
                    else {
                        $(output_box).text("Failed to Send Email!");
                        $(output_box).addClass('error');
                        $(output_box).css('visibility', 'visible');
                        $(output_box).show(350);
                    }
                }
                )
                .fail(function() {
                    $(output_box).text('Ajax Request to Email Message Failed!');
                    $(output_box).addClass('error');
                    $(output_box).css('visibility', 'visible');
                    $(output_box).show(350);
                });
            
        }
    }
    -->
</script>
<?php
$tpl->close_head();
$tpl->open_body($config['website']['navigation_links'], $config['website']['affiliates']);
?>

<div class="how_to_text">
    <p>
        You can contact Link by email, but first we suggest that you take a look at our
        <a href='/faq'>Frequently Asked Questions</a> page to see if someone has already asked
        the same question as you! If you're question is not on there we will gladly answer your
        question for you. Simply shoot us an email at <a href='mailto:links@lagune-software.com'>links@lagune-software.com</a>.
    </p>
    
    <p>
        You can also contact us by filling out the form below. Please be as detailed as possible to
        ensure that we can answer your question in a speedy and efficient manner. Someone will reply to your 
        question as soon as possible.
    </p>
</div>
<div class='drop_shadow ajax_results' id='output_box'>
    Results Go Here
</div>
<div class='center' id='input_form'>
    
    <form action='/send_email' method='POST' id="email_form" onsubmit="validate_form(); return false;">
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
        <textarea class='text span-11 last' height='200' id='body' name='body'></textarea><br />
        <noscript>
        <input type='submit' value='Send E-Mail (No Javascript)' />
        </noscript>
    </form>

</div>
    
<?php

$tpl->close_body();
$tpl->close_page();

//End of Index.php
