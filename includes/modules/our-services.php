<?php if ( have_rows( 'our_services' ) ): ?>
<?php while ( have_rows( 'our_services' ) ) : the_row(); ?>
        <div class="our-services">
            <div class="container">
                <a href="#" class="first-section__content_info--trustpilot">
                    <?php echo file_get_contents(get_theme_file_path("./img/content/trustpilot-logo.svg")); ?>
                </a>
                <h1 class="block-service-title">
                    <?php echo get_sub_field( 'our_services_title' ); ?>
                </h1>
                <?php get_template_part('includes/modules/breadcrumbs'); ?>
                <div class="our-services__content">
                    <?php if ( have_rows( 'our_services_content' ) ): ?>
                        <?php while ( have_rows( 'our_services_content' ) ) : the_row(); ?>
                            <div class="our-services__content_item d-flex --just-space --align-center">
                                <div class="our-services__content_slider">
                                    <?php if ( have_rows( 'our_services_content_slider' ) ): ?>
                                        <?php while ( have_rows( 'our_services_content_slider' ) ) : the_row(); ?>
                                            <div class="our-services__content_slider--item">
                                                <img src="<?php echo esc_url( get_sub_field('our_services_content_slider_photo') ); ?>" />
                                            </div>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="our-services__content_info">
                                    <?php echo get_sub_field( 'our_services_content_info' ); ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
<?php endif; ?>
