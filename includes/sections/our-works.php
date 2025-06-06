<?php if ( have_rows( 'our_works' ) ): ?>
    <?php while ( have_rows( 'our_works' ) ) : the_row(); ?>
        <div class="our-works">
            <div class="container">
                <h1 class="block-service-title">
                    <?php echo get_sub_field( 'our_works_title' ); ?>
                </h1>
                <?php get_template_part('includes/modules/breadcrumbs'); ?>
                <div class="reviews__content">
                    <ul class="reviews__content_nav d-flex --align-stretch">
                        <li class="tab btn-block tab--active">
                            Commercial Cleaning
                        </li>
                        <li class="tab btn-block">
                            Domestic Cleaning
                        </li>
                    </ul>
                    <div class="reviews__content_block">
                        <div class="content content--active">
                            <?php
                            get_template_part(
                                slug: 'loop-portfolio',
                                args: ['var_name' => [
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'portfolio-category',
                                            'field'    => 'id',
                                            'terms'    => 9,
                                            'operator' => 'IN',
                                        )
                                    )
                                ]]);
                            ?>
                        </div>
                        <div class="content">
                            <?php
                            get_template_part(
                                slug: 'loop-portfolio',
                                args: ['var_name' => [
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'portfolio-category',
                                            'field'    => 'id',
                                            'terms'    => 10,
                                            'operator' => 'IN',
                                        )
                                    )
                                ]]);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
<?php endif; ?>
