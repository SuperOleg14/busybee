<?php
get_header();
?>

<main class="wrapper" style="margin-top: 100px">
    <div class="container">
        <?php if (have_posts()) :
            while ( have_posts()) : the_post();
                the_content();
            endwhile;
        endif; ?>
    </div>
</main>

<?php get_footer(); ?>
