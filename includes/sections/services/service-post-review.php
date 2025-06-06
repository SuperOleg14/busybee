<?php if( have_rows('single_services') ): ?>
    <?php while( have_rows('single_services') ): the_row(); ?>
        <div class="service-post-review">
            <div class="container">
                <?php if( have_rows('single_services_review') ): ?>
                    <?php while( have_rows('single_services_review') ): the_row(); ?>
                        <?php if (get_sub_field( 'single_services_review_text' )) : ?>
                            <div class="block-title block-text-align">
                                <?php echo get_sub_field( 'single_services_review_title' ); ?>
                            </div>
                            <div class="service-post-review__content">
                                <div class="service-post-review__content--info block-text-align">
                                    <?php echo get_sub_field( 'single_services_review_text' ); ?>
                                    <div class="service-post-review__content--name d-flex --jc-center --align-center">
                                        <?php echo get_sub_field( 'single_services_review_name' ); ?>
                                        <?php if (get_sub_field( 'single_services_review_speciality' )) : ?>
                                            <span>
                                            <?php echo get_sub_field( 'single_services_review_speciality' ); ?>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="service-post-review__content--trustpilot">
                                        <?php echo file_get_contents(get_theme_file_path("./img/elements/trustpilot-stars.svg")); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endwhile; ?>
<?php endif; ?>
