<?php if(get_sub_field( 'handmatige_vulling' )){
    $id = get_the_ID();
    $vullingtype = $id;
    $fieldtype = 'get_sub_field';
} else {
    $vullingtype = 'options';
    $fieldtype = 'get_field';
} 
if(get_sub_field( 'stappen_handmatig_vullen' )){
    $id = get_the_ID();
    $vlaktype = $id;
} else{
    $vlaktype = 'options';
}

?>
<?php // $fieldtype( 'cta_titel', $vullingtype );?>
<?php $class = $args['class'];?>

<div class="layout-method <?php echo $class; ?> js-has-dark">
    <div class="container">
        <div class="row gx-xl-10 gx-lg-5 gx-3">
            <div class="col-lg-6">
                <h3 class="mb-lg-4"><?php echo $fieldtype( 'werkwijze_titel', $vullingtype );?></h3>
                <p class="mb-3"><?php echo $fieldtype( 'werkwijze_tekst', $vullingtype );?></p>
                <?php get_template_part( 'template-parts/components/component', 'button', array( 'global' => 'options' ) ); ?>
            </div>
            <div class="col-lg-6 mt-2 mt-md-3 mt-lg-0">
                <div class="layout-method-steps --dark">
                    <?php $stepcount = 0; if ( have_rows('stappen', $vlaktype) ) : ?>
                        <?php while( have_rows('stappen', $vlaktype) ) : the_row(); $stepcount ++;?>
                        <div class="layout-method-step <?php if($stepcount < 2): echo 'show'; else: echo '--dark'; endif; ?>">
                            <span class="layout-method-step__number"><?php echo $stepcount;?></span>
                            <div class="layout-method-step__title"><?php echo get_sub_field( 'titel' );?></div>
                            <div class="layout-method-step__content"><?php echo get_sub_field( 'tekst' );?></div>
                        </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div> 