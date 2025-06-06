<?php if( have_rows('about') ): ?>
    <?php while( have_rows('about') ): the_row(); ?>
        <?php if( have_rows('about_values') ): ?>
            <?php while( have_rows('about_values') ): the_row(); ?>
                <div class="service-information">
                    <div class="container">
                        <div class="block-title block-text-align">
                            <?php echo get_sub_field( 'about_values_title' ); ?>
                        </div>
                        <div class="block-subtitle block-text-align">
                            <?php echo get_sub_field( 'about_values_subtitle' ); ?>
                        </div>
                        <div class="service-information__content d-flex --just-space --align-stretch f-wrap">
                            <?php if( have_rows('about_values_content') ): ?>
                                <?php while( have_rows('about_values_content') ): the_row(); ?>
                                    <div class="service-information__content_item --basis-3">
                                        <div class="service-information__content_item--icon block-btn-margin">
                                            <img src="<?php echo esc_url( get_sub_field('about_values_content_photo') ); ?>" alt="<?php echo get_sub_field( 'about_values_content_title' ); ?>" />
                                        </div>
                                        <div class="service-information__content_item--title block-text-align">
                                            <?php echo get_sub_field( 'about_values_content_title' ); ?>
                                        </div>
                                        <div class="service-information__content_item--text block-text-align">
                                            <?php echo get_sub_field( 'about_values_content_text' ); ?>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; ?>

