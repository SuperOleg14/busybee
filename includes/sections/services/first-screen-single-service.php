<?php if( have_rows('single_services') ): ?>
    <?php while( have_rows('single_services') ): the_row(); ?>
        <div class="first-screen-single-service">
            <div class="container">
                <a href="#" class="first-section__content_info--trustpilot">
                    <?php echo file_get_contents(get_theme_file_path("./img/content/trustpilot-logo.svg")); ?>
                </a>
                <h1 class="block-service-title">
                    <?php the_title(); ?>
                </h1>
                <?php get_template_part('includes/modules/breadcrumbs'); ?>
                <?php if( have_rows('single_services_info') ): ?>
                    <?php while( have_rows('single_services_info') ): the_row(); ?>
                        <div class="first-screen-single-service__content d-flex --just-space">
                            <div class="single-service-slider d-flex">
                                <div class="first-screen-single-service__content--slider single-service-slider-for">
                                    <?php if ( have_rows( 'single_services_info_slider' ) ): ?>
                                        <?php while ( have_rows( 'single_services_info_slider' ) ) : the_row(); ?>
                                            <div class="first-screen-single-service__content--slider-item">
                                                <img src="<?php echo esc_url( get_sub_field('single_services_info_slider_photo') ); ?>" />
                                            </div>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="first-screen-single-service__content--slider single-service-slider-nav">
                                    <?php if ( have_rows( 'single_services_info_slider' ) ): ?>
                                        <?php while ( have_rows( 'single_services_info_slider' ) ) : the_row(); ?>
                                            <div class="first-screen-single-service__content--slider-item">
                                                <img src="<?php echo esc_url( get_sub_field('single_services_info_slider_photo') ); ?>" />
                                            </div>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="first-screen-single-service__content--info">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endwhile; ?>
<?php endif; ?>

