<?php get_header(); ?>

<section>
    <div class="container py-lg-10 py-5 text-center">
        <h1 class="display-3 mb-3"><?php _e('Sorry, we kunnen deze pagina niet meer vinden', 'creators'); ?></h1>
        <p><?php echo sprintf(__('We hebben ons best gedaan, maar het lijkt erop dat deze pagina niet (meer) bestaat of misschien verhuisd is. Je kunt natuurlijk altijd naar de <a href="%s">homepage</a>.', 'creators'), home_url()); ?></p>
        <a href="<?php echo get_home_url();?>" class="btn btn-dark">Naar de homepage</a>
    </div>
</section>

<?php get_footer(); ?>