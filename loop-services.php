<div class="services__block d-flex --align-stretch f-wrap">
    <?php

    $servicesPost = array_merge(
        [
            'posts_per_page' => -1,
            'post_type' => 'services',
            'orderby' => 'date',
            'post_status' => 'publish',
            'order' => 'DESC',
        ],
        $args['var_name'] ?? []
    );

    $loopServices = new WP_Query( $servicesPost );
    ?>

    <?php if ($loopServices -> have_posts()) :
        while ($loopServices -> have_posts()) : $loopServices -> the_post(); ?>
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
    endif; ?>
</div>
