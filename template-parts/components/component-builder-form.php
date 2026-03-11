<?php if(get_sub_field( 'zonnepanelen_formulier' )):?>
    <?php get_template_part( 'template-parts/components/component', 'zonnepanelen' ); ?>
<?php else :?>
    <div class="content-form">
        <h3 class="display-3"><?php echo get_sub_field( 'titel' );?></h3>
        <?php echo get_sub_field( 'tekst' );?>
        <?php $posts = get_sub_field('formulier'); if( $posts ): 
                foreach( $posts as $p ): // variable must NOT be called $post (IMPORTANT) 
                    $cf7_id= $p->ID;
                    echo do_shortcode( '[contact-form-7 id="'.$cf7_id.'" ]' ); 
        endforeach; endif; ?>
    </div>
<?php endif;?>
<?php if($cf7_id = 474):?>
    <?php $loop = new WP_Query(
    array(
        'post_type'      => 'dienst',
        'posts_per_page' => -1,
    )  ); ?>

    <?php $waarden = array(); // Array om de waarden op te slaan
        while ($loop->have_posts()) : $loop->the_post();
            if (get_field('in_formulier_tonen')) {
                $waarden[] = get_the_title(); // Titel toevoegen aan de waarden-array
            }
        endwhile; wp_reset_query(); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var waarden = <?php echo json_encode($waarden); ?>;
    var selectBox = document.getElementById('select-boxes');

    // Maak de selectievakjes van CF7
    waarden.forEach(function (waarde) {
        var listItem = document.createElement('span');
        listItem.className = 'wpcf7-list-item';

        var label = document.createElement('label');
        listItem.appendChild(label);

        var checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.name = 'diensten[]';
        checkbox.value = waarde;
        label.appendChild(checkbox);

        var labelText = document.createElement('span');
        labelText.className = 'wpcf7-list-item-label';
        labelText.textContent = waarde;
        label.appendChild(labelText);

        selectBox.appendChild(listItem);
    });
});
</script>
<script src="https://code.jquery.com/jquery-3.7.0.slim.min.js" integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous"></script>
<script>
    window.addEventListener('DOMContentLoaded', function () {
        var queryString = window.location.search;
        var urlParams = new URLSearchParams(queryString);
        var variabele = urlParams.get('variabele');

        if (variabele) {
            console.log('Variabele:', variabele);

            var selectBox = document.getElementById('select-boxes');
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');

            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].value === variabele) {
                    checkboxes[i].checked = true;
                    break;
                }
            }
        }
    });
</script>
<?php endif;?>