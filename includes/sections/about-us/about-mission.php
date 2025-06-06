<?php if( have_rows('about') ): ?>
    <?php while( have_rows('about') ): the_row(); ?>
        <?php if( have_rows('about_mission') ): ?>
            <?php while( have_rows('about_mission') ): the_row(); ?>
                <div class="about-mission">
                    <div class="container">
                        <div class="about-mission__content">
                            <?php if( have_rows('about_mission_content') ): ?>
                                <?php while( have_rows('about_mission_content') ): the_row(); ?>
                                    <div class="about-mission__content_item d-flex --just-space">
                                        <div class="block-title">
                                            <?php echo get_sub_field( 'about_mission_content_title' ); ?>
                                        </div>
                                        <div class="about-mission__content_item--text">
                                            <?php echo get_sub_field( 'about_mission_content_text' ); ?>
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

