<?php /* Template Name: Page About Us */?>

<?php
get_header();
?>

<div class="main-wrapper page-wrapper page-about">
    <?php
    get_template_part('includes/sections/about-us/first-screen-about');
    get_template_part('includes/modules/about');
    get_template_part('includes/sections/about-us/about-mission');
    get_template_part('includes/sections/about-us/about-values');
    get_template_part('includes/sections/about-us/about-developed');
    get_template_part('includes/modules/help');
    get_template_part('includes/sections/about-us/about-works');
    get_template_part('includes/modules/faq');
    ?>
</div>

<?php get_footer(); ?>
