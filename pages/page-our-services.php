<?php /* Template Name: Page Our Services */?>

<?php
get_header();
?>

<div class="main-wrapper">
    <?php
    get_template_part('includes/modules/our-services');
    get_template_part('includes/modules/map');
    get_template_part('includes/modules/reviews');
    get_template_part('includes/modules/help');
    get_template_part('includes/modules/faq');
    ?>
</div>

<?php get_footer(); ?>
