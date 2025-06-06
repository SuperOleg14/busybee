<?php if( have_rows('single_portfolio') ): ?>
    <?php while( have_rows('single_portfolio') ): the_row(); ?>
        <div class="related-service-posts">
            <div class="container">
                <div class="block-title block-text-align">
                    Other services you may like
                </div>
                <div class="related-service-posts__content">
                    <?php if( $service_posts_for_portfolio = get_sub_field('related_services_for_portfolio') ): ?>

                        <?php foreach( $service_posts_for_portfolio as $post ): setup_postdata($post); ?>
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
                                <?php if( have_rows('single_services') ): ?>
                                    <?php while( have_rows('single_services') ): the_row(); ?>
                                        <?php if (get_sub_field('single_services_cost')) : ?>
                                            <div class="services__block_item--cost">
                                                Stating from
                                                <span>
                                                £<?php echo get_sub_field('single_services_cost') ?>
                                            </span>
                                            </div>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>

                        <?php wp_reset_postdata(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
<?php endif; ?>
