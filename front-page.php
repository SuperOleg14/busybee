<?php /* Template Name: Front Page */?>

<?php
get_header();
?>

<div class="main-wrapper">
    <?php
    get_template_part('includes/modules/first-screen');
    get_template_part('includes/modules/about');
    get_template_part('includes/modules/services');
    get_template_part('includes/modules/our-logo');
    get_template_part('includes/modules/help');
    get_template_part('includes/modules/service-information');
    get_template_part('includes/modules/help-ethics');
    get_template_part('includes/modules/reviews');
    get_template_part('includes/modules/map');
    get_template_part('includes/modules/faq');

    ?>
</div>

<?php get_footer(); ?>
