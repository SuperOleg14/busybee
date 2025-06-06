<?php get_header(); ?>

    <div class="service-taxonomy post">
        <?php
        get_template_part('includes/sections/services/first-screen-single-service');
        get_template_part('includes/sections/services/how-it-works');
        get_template_part('includes/sections/services/service-post-review');
        get_template_part('includes/sections/services/portfolio-posts-for-service');
        get_template_part('includes/modules/map');
        get_template_part('includes/sections/services/related-service-posts');
        get_template_part('includes/modules/faq');
        ?>
    </div>

<?php get_footer(); ?>
