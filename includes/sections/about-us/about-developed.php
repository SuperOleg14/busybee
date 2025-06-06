<?php if( have_rows('about') ): ?>
    <?php while( have_rows('about') ): the_row(); ?>
        <?php if( have_rows('about_developed') ): ?>
            <?php while( have_rows('about_developed') ): the_row(); ?>
                <div class="developed">
                    <div class="container">
                        <div class="developed__content d-flex --just-space">
                            <div class="developed__content_sticky">
                                <div class="block-title">
                                    <?php echo get_sub_field( 'about_developed_title' ); ?>
                                </div>
                                <div class="developed__content_photo">
                                    <img src="<?php echo esc_url( get_sub_field('about_developed_photo') ); ?>" alt="Busy Bee Clean" />
                                </div>
                            </div>
                            <div class="developed__content_step">
                                <?php if( have_rows('about_developed_step') ): ?>
                                    <?php while( have_rows('about_developed_step') ): the_row(); ?>
                                        <div class="developed__content_step--item">
                                            <div class="developed__content_step--date d-flex --align-center --jc-center">
                                                <?php echo get_sub_field( 'about_developed_step_date' ); ?>
                                            </div>
                                            <div class="developed__content_step--info">
                                                <?php echo get_sub_field( 'about_developed_step_info' ); ?>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; ?>

