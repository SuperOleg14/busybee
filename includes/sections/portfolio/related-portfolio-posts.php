<div class="related-service-posts related-portfolio-posts">
    <div class="container">
        <?php
        $current_portfolio_id = get_the_ID();
        $current_category = get_the_terms($current_portfolio_id, 'portfolio-category');

        if ($current_category) {
            $category_name = $current_category[0]->name;
            $category_url = get_term_link($current_category[0]);
        } else {
            $category_name = "Commercial Cleaning";
            $category_url = '/';
        }
        ?>
        <div class="block-title block-text-align width-content">
            Check out our recent works in
            <span><?php echo esc_html($category_name); ?></span>
        </div>
        <div class="related-portfolio-posts__content d-flex --just-space --align-stretch">
            <?php
            $current_portfolio_id = get_the_ID();

            $args = array(
                'posts_per_page' => 2,
                'post_type' => 'portfolio',
                'post_status' => 'publish',
                'orderby' => 'date',
                'order' => 'DESC',
                'post__not_in' => array($current_portfolio_id),
                'tax_query' => array(
                    array(
                        'taxonomy' => 'portfolio-category',
                        'field' => 'id',
                        'terms' => wp_get_post_terms($current_portfolio_id, 'portfolio-category', array("fields" => "ids")),
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
            <?php endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
        <a href="<?php echo preg_replace('@^(https?://)?([^/?]+)([/?].*)?$@', 'https://${2}', get_site_url()); ?>/our-works" class="block-btn block-btn-margin">All <span><?php echo esc_html($category_name); ?></span></a>
    </div>
</div>
