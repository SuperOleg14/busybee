<div class="related-service-posts">
    <div class="container">
        <div class="block-title block-text-align">
            Other services you may like
        </div>
        <div class="related-service-posts__content">
            <?php
            $current_service_id = get_the_ID();

            $args = array(
                'posts_per_page' => -1,
                'post_type' => 'services',
                'post_status' => 'publish',
                'orderby' => 'date',
                'order' => 'DESC',
                'post__not_in' => array($current_service_id),
                'tax_query' => array(
                    array(
                        'taxonomy' => 'services-category',
                        'field' => 'id',
                        'terms' => wp_get_post_terms($current_service_id, 'services-category', array("fields" => "ids")),  // Получаем категории текущего поста
                    ),
                ),
            );

            $related_posts = new WP_Query($args);

            if ($related_posts->have_posts()) : while ($related_posts->have_posts()) : $related_posts->the_post();
                ?>
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

            <?php endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</div>
