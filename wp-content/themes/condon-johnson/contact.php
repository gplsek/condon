<?php
  /*
   Template Name: Contact Page
  */
  get_header();
?>



<div class="locations">
    <div class="container">
        <div class="text-center">
            <h2>LOCATIONS</h2>
            <hr />
        </div>
        <div class="row">
            <div class="col-md-6">
                <div id="contact-map-canvas"></div>
            </div>
            <div class="col-md-6">
                <div class="description">
                <?php
                  while ( have_posts() ) : the_post();
                   the_content();
                  endwhile;
                ?>

                <!--
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                </p>
                <ul>
                    <li><a href="#">Oakland</a></li>
                    <li><a href="#">Los Angeles</a></li>
                    <li><a href="#">Portland</a></li>
                    <li><a href="#">San Diego</a></li>
                    <li><a href="#">Seattle</a></li>
                </ul>
                -->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="contact-form">
    <div class="container">
        <div class="text-center">
            <h2>Contact</h2>
            <hr />
        </div>
        <form id="contact-form" method="post">
            <div class="row">
                <div class="col-md-6 col-sm-6"><input type="text" name="name" placeholder="NAME" required></div>
                <div class="col-md-6 col-sm-6"><input type="text" name="phone" placeholder="PHONE" required></div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6"><input type="text" name="email" placeholder="E-MAIL" required></div>
                <div class="col-md-6 col-sm-6"><input type="text" name="subject" placeholder="SUBJECT" required></div>
            </div>
            <div class="row">
                <div class="col-md-12"><textarea name="message" id="" cols="30" rows="10" placeholder="MESSAGE" required></textarea></div>
            </div>
            <div class="row text-right">
                <div class="col-md-12"><button type="submit" name="submit" class="button button-orange animate-slow">SUBMIT</button></div>
            </div>
        </form>
    </div>
</div>


<script type="text/javascript">
    jQuery(document).ready(function () {
        console.log(jQuery('#contact-form button[type="submit"]'));
        jQuery('#contact-form').on('submit', function (e) {
           // console.log('try submit ...');
            e.preventDefault();
           // console.log(JSON.stringify($(this).serializeArray()));

            jQuery.post('/wp-admin/admin-ajax.php', {
                action      : 'condonjohnson_ajax',
                ajaxAction  : 'contact',
                name        : jQuery('#contact-form input[name="name"]').val(),
                phone       : jQuery('#contact-form input[name="phone"]').val(),
                email       : jQuery('#contact-form input[name="email"]').val(),
                subject     : jQuery('#contact-form input[name="subject"]').val(),
                message     : jQuery('#contact-form textarea[name="message"]').val()
            }, function (res) {
                console.log(res);
                if (res.ok) {
                  jQuery('#contact-form').find("input[type=text], textarea").val("");
                  alert('Message successfully sent');
                //  location.reload();
                }

            });


            });

        jQuery('#contact-form button[type="submit"]').on('click', function (e) {
        });
    });
</script>


<script src="https://maps.google.com/maps/api/js?sensor=true&key=AIzaSyCT_bOx9CleX3rEf1RnCg3Jl5m4Izj_ENk" type="text/javascript"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/script.js"></script>
<?php get_footer(); ?>


