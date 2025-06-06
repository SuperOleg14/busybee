<div class="first-screen-about">
    <div class="container">
        <a href="#" class="first-section__content_info--trustpilot">
            <?php echo file_get_contents(get_theme_file_path("./img/content/trustpilot-logo.svg")); ?>
        </a>
        <h1 class="block-service-title">
            <?php the_title(); ?>
        </h1>
        <?php get_template_part('includes/modules/breadcrumbs'); ?>
        <div class="first-screen-about__photo">
            <?php if (has_post_thumbnail()) {
                the_post_thumbnail('full');
            }  ?>
        </div>
        <div class="first-screen-about__content">
            <?php the_content(); ?>
        </div>
    </div>
</div>
