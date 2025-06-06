<?php /* Template Name: Page WAR in Ukraine */?>

<?php get_header(); ?>

    <div class="main-wrapper page-war">
        <div class="container">
            <h1 class="block-service-title">
                <?php the_title(); ?>
            </h1>
            <?php get_template_part('includes/modules/breadcrumbs'); ?>
            <div class="war__content">
                <?php the_content(); ?>
            </div>
        </div>
    </div>

<?php get_footer(); ?>
