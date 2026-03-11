<?php 
    $rows = get_field('adviseurs', 'options');
    if ($rows) {
        shuffle($rows);
        $row = $rows[0];
        ?>
<section class="mb-3">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <hr>
                <div class="author d-flex align-items-end">
                    <div class="author__media">
                        <img loading="lazy" src="<?php echo $row['afbeelding_met_achtergrond']['url']; ?>" alt="">
                    </div>
                    <div class="author__content">
                        <strong><?php echo $row['voornaam']; ?></strong> <small>Staat voor je klaar</small>
                        <ul class="reset-list d-flex gap-1">
                            <li><a href="tel:<?php echo get_field('algemeen_telefoonnummer','options');?>">Bel mij</a></li>
                            <li><a href="<?php echo get_field('whatsapp_link','options'); ?>">App mij</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>