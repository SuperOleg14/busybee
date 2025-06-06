<?php /*
 * Template name: Services Category
 */ ?>

<?php get_header(); ?>

<div class="service-taxonomy">
    <div class="container">
        <a href="#" class="first-section__content_info--trustpilot">
            <?php echo file_get_contents(get_theme_file_path("./img/content/trustpilot-logo.svg")); ?>
        </a>
        <h1 class="block-service-title">
            <?php single_cat_title(); ?>
        </h1>
        <?php get_template_part('includes/modules/breadcrumbs'); ?>
        <?php
        get_template_part(
            slug: 'loop-services',
            args: ['var_name' => [
                'tax_query' => array(
                    array(
                        'taxonomy' => 'services-category',
                        'field'    => 'id',
                        'terms'    => array(get_queried_object()->term_id),
                        'operator' => 'IN',
                    )
                )
            ]]);
        ?>
    </div>
    <?php
    get_template_part('includes/modules/map');
    get_template_part('includes/modules/reviews');
    get_template_part('includes/modules/help');
    ?>
</div>

<?php get_footer(); ?>
