<script
  src="https://code.jquery.com/jquery-3.7.0.slim.min.js"
  integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE="
  crossorigin="anonymous"></script>
<?php $posts = get_sub_field('formulier');
if( $posts ): 
    foreach( $posts as $p ): // variable must NOT be called $post (IMPORTANT) 
    $cf7_id= $p->ID;
    ?>
  
<section class="zonnepanelen-form">
    <div class="zonnepanelen-form__inner">
        <div class="row gx-5">
            <div class="col-lg-7">
                <h3 class="display-3 text-white"><?php echo get_sub_field( 'titel' );?></h3>
                <?php echo get_sub_field( 'tekst' );?>
                <?php echo do_shortcode( '[contact-form-7 id="'.$cf7_id.'" ]' );   ?>
            </div>
            <div class="col-lg-5">
                <div class="zonnepanelen-form__map">
                    <strong>Ons dekkingsgebied</strong>
                    <img loading="lazy" src="<?php echo get_field( 'dekkingskaart','options' )['url'];?>" alt="">
                    <a class="stretched-link" href="<?php echo get_field( 'dekkingskaart','options' )['url'];?>" data-fancybox >Bekijk in detail ons dekkingsgebied</a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
endforeach;
endif; ?>
<script>
        (function($) {
            $(document).ready(function() {
                $("#js-form").on("submit", function(event) {
                    event.preventDefault();
                    controleerPostcode($(".js-postcode").val());
                });
            });

            function controleerPostcode(postcode) {
                // Definieer de ACF-waarden in een array
                var acf_waarden = [<?php echo get_field( 'zonnepanelen__postcodes', 'options' );?>];

                // Controleer of de ingevoerde postcode overeenkomt met een van de ACF-waarden
                if (acf_waarden.includes(postcode)) {
                    $(".js-postcode-output").addClass("--succes");
                    $(".js-postcode-output").removeClass("--notice");
                    $(".js-postcode-output").html("<?php echo get_field( 'leveren_tekst', 'options' );?>");
                } else {
                    $(".js-postcode-output").removeClass("--succes");
                    $(".js-postcode-output").addClass("--notice");
                    $(".js-postcode-output").html("<?php echo get_field( 'niet_leveren_tekst', 'options' );?>");
                }
            }

            $(document).on("keyup", ".js-postcode", function() {
                var postcode = $(this).val();
                if (postcode.length == 4 && /^\d+$/.test(postcode)) {
                    controleerPostcode(postcode);
                } else {
                    $(".js-postcode-output").html("");
                }
            });

            $(".js-postcode").on("keypress", function(event) {
                var keyCode = event.which;
                if (keyCode < 48 || keyCode > 57 || $(this).val().length >= 4) {
                event.preventDefault();
                }
            });
            
        })(jQuery);

	</script>