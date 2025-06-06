<?php if( have_rows('single_portfolio') ): ?>
    <?php while( have_rows('single_portfolio') ): the_row(); ?>
        <div class="portfolio-video">
            <div class="container">
                <?php if( have_rows('single_portfolio_video') ): ?>
                    <?php while( have_rows('single_portfolio_video') ): the_row(); ?>
                        <div class="block-title block-text-align">
                            <?php echo get_sub_field( 'single_portfolio_video_title' ); ?>
                        </div>
                        <div class="portfolio-video__content block-text-align">
                            <iframe width="710" height="385" src="<?php echo get_sub_field('single_portfolio_video_url') ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endwhile; ?>
<?php endif; ?>
