<?php $review = $args['review'] ?? []; ?>

<div class="block-review">
    <div class="block-review__header d-flex justify-content-between align-items-center">
        <strong><?php echo esc_html( $review['name'] ?? '' ); ?></strong>
        <ul>
            <?php for ( $i = 1; $i <= 5; $i++ ) : ?>
                <li>
                    <i class="fa-sharp fa-solid fa-star<?php echo $i > ( $review['rating'] ?? 5 ) ? ' opacity-50' : ''; ?>"></i>
                </li>
            <?php endfor; ?>
        </ul>
    </div>
    <div class="block-review__content">
        <p><?php echo esc_html( $review['content'] ?? '' ); ?></p>
    </div>
</div>
