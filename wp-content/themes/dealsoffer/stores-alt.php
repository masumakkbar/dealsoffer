<?php
/*
    Template Name: All Stores Alt
*/
get_header();

// Fetch all stores
$stores = get_terms([
    'taxonomy'   => 'coupon-store',
    'hide_empty' => false,
    'orderby'    => 'name',
    'order'      => 'ASC',
]);

$grouped_stores = [];
foreach ($stores as $store) {
    $first_letter = strtoupper(mb_substr($store->name, 0, 1));

    if (preg_match('/[A-Z]/', $first_letter)) {
        $grouped_stores[$first_letter][] = $store;
    } else {
        $grouped_stores['#'][] = $store; // Non-alphabetic entries
    }
}

$existing_letters = array_keys($grouped_stores);
?>

<div class="container">

    <ul class="alphabet-nav">
        <?php foreach ($existing_letters as $letter) : ?>
            <li>
                <a href="#<?php echo esc_attr($letter); ?>">
                    <?php echo esc_html($letter); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Display Stores -->
    <?php foreach ($grouped_stores as $letter => $stores) : ?>
        <div class="store-group" id="<?php echo esc_attr($letter); ?>">
            <div class="store-letter-up">
                <h4><?php echo esc_html($letter); ?></h4>
                <a href="#"><i class="tp tp-angle-down"></i></a>
            </div>
            <div class="row">
                <?php foreach ($stores as $store) : 
        
                    ?>
                    <div class="store-card col-xl-3 col-lg-3 col-md-6 col-sm-12">
                        <a href="<?php echo esc_url(get_term_link($store)); ?>">
                            <div class="store-logo">
                                <?php
                                $thumb_id = get_term_meta($store->term_id, 'store_image', true);
                                $image_url = wp_get_attachment_url($thumb_id);
                                if ($image_url) :
                                ?>
                                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($store->name); ?>">
                                <?php else : ?>
                                    <span class="store-placeholder"><?php echo esc_html($store->name[0]); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="store-logo-text">
                                <span class="store-name"><?php echo esc_html($store->name); ?></span>
                                <span><?php echo esc_html( '(' . $store->count . ')'); ?></span>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php get_footer(); ?>
