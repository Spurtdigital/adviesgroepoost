<section class="panel">
    <div class="container">
        <div class="js-panel-inner panel__inner">

        </div>
        <?php if(get_field( 'whatsapp_header', 'options' )):?>
            <a href="<?php echo get_field( 'whatsapp_header', 'options' );?>" class="panel__whatsapp"><?php echo get_field( 'whatsapp_header_label', 'options' );?></a>
        <?php endif;?>
    </div>
</section>