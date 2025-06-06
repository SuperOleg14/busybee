<?php if( have_rows('about') ): ?>
    <?php while( have_rows('about') ): the_row(); ?>
        <div class="related-service-posts related-portfolio-posts">
            <div class="container">
                <?php if( have_rows('about_portfolio') ): ?>
                    <?php while( have_rows('about_portfolio') ): the_row(); ?>
                        <div class="block-title block-text-align width-content">
                            <?php echo get_sub_field( 'about_portfolio_title' ); ?>
                        </div>
                        <div class="related-portfolio-posts__content d-flex --just-space --align-stretch">
                            <?php if( $portfolio_posts_for_service = get_sub_field('about_portfolio_works') ): ?>

                                <?php foreach( $portfolio_posts_for_service as $post ): setup_postdata($post); ?>
                                    <div id="post-<?php the_ID(); ?>" class="services__block_item d-flex --dir-col --just-space --align-stretch">
                                        <a href="<?php the_permalink() ?>" class="services__block_item--link"></a>
                                        <div>
                                            <div class="services__block_item--photo d-flex --align-stretch --just-space">
                                                <?php if (has_post_thumbnail()) {
                                                    the_post_thumbnail('medium_large', array("class" => "services__item_thumbnail"));
                                                }  else {?>
                                                    <img src="<?= get_bloginfo('template_url') . '/img/content/services-photo-1.png' ; ?>" alt="" class="services__item_thumbnail">
                                                <?php } ?>
                                            </div>
                                            <h3 class="services__block_item--title">
                                                <?php the_title(); ?>
                                            </h3>
                                        </div>
                                        <?php if( have_rows('single_portfolio') ): ?>
                                            <?php while( have_rows('single_portfolio') ): the_row(); ?>
                                                <?php if (get_sub_field('single_portfolio_location')) : ?>
                                                    <div class="services__block_item--cost">
                                                        <?php echo get_sub_field('single_portfolio_location') ?>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endwhile; ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>

                                <?php wp_reset_postdata(); ?>
                            <?php endif; ?>
                        </div>
                        <?php $relatedPortfolioPoststLink = get_sub_field('about_portfolio_link'); ?>
                        <?php if ( $relatedPortfolioPoststLink ): ?>
                            <a class="block-btn block-btn-margin" href="<?php echo esc_url( $relatedPortfolioPoststLink['url']) ?>" target="_blank">
                                <?php echo esc_html( $relatedPortfolioPoststLink['title']) ?>
                            </a>
                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endwhile; ?>
<?php endif; ?>
