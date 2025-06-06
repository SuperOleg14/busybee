<?php if( have_rows('single_services') ): ?>
    <?php while( have_rows('single_services') ): the_row(); ?>
        <div class="how-it-works">
            <div class="container">
                <?php if( have_rows('single_services_works') ): ?>
                    <?php while( have_rows('single_services_works') ): the_row(); ?>
                        <div class="block-title block-text-align">
                            <?php echo get_sub_field( 'single_services_works_title' ); ?>
                        </div>
                        <div class="how-it-works__content d-flex --just-space f-wrap">
                            <?php if( have_rows('single_services_works_content') ): ?>
                                <?php while( have_rows('single_services_works_content') ): the_row(); ?>
                                    <div class="how-it-works__content_item block-text-align --basis-3">
                                        <div class="how-it-works__content_item--number">
                                            0<?php echo get_row_index(); ?>
                                        </div>
                                        <div class="how-it-works__content_item--title">
                                            <?php echo get_sub_field( 'single_services_works_content_title' ); ?>
                                        </div>
                                        <div class="how-it-works__content_item--text">
                                            <?php echo get_sub_field( 'single_services_works_content_text' ); ?>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endwhile; ?>
<?php endif; ?>
