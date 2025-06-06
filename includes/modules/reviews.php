
<div class="reviews">
    <div class="container">
        <div class="block-title block-text-align">
            What our clients are saying
        </div>
        <a href="#" class="first-section__content_info--trustpilot block-text-align">
            <?php echo file_get_contents(get_theme_file_path("./img/content/trustpilot-logo.svg")); ?>
        </a>
        <div class="reviews__content">
            <ul class="reviews__content_nav d-flex --jc-center --align-stretch">
                <li class="tab btn-block tab--active">
                    Domestic Cleaning
                </li>
                <li class="tab btn-block">
                    Commercial Cleaning
                </li>
            </ul>
            <?php if( have_rows('reviews', 'options') ): ?>
                <?php while( have_rows('reviews', 'options') ): the_row(); ?>
                    <div class="reviews__content_block">
                        <div class="content content--active">
                            <div class="reviews-slider">
                                <?php if( have_rows('reviews_domestic') ): ?>
                                    <?php while( have_rows('reviews_domestic') ): the_row(); ?>
                                        <div class="reviews-slider__item">
                                            <div class="reviews-slider__item--photo block-btn-margin">
                                                <img src="<?php echo esc_url( get_sub_field('reviews_domestic_photo') ); ?>" />
                                            </div>
                                            <div class="reviews-slider__item--title block-btn-margin">
                                                <?php echo get_sub_field('reviews_domestic_title') ?>
                                            </div>
                                            <div class="reviews-slider__item--text block-btn-margin">
                                                <?php echo get_sub_field('reviews_domestic_text') ?>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="content">
                            <div class="reviews-slider">
                                <?php if( have_rows('reviews_commercial') ): ?>
                                    <?php while( have_rows('reviews_commercial') ): the_row(); ?>
                                        <div class="reviews-slider__item">
                                            <div class="reviews-slider__item--photo block-btn-margin">
                                                <img src="<?php echo esc_url( get_sub_field('reviews_commercial_photo') ); ?>" />
                                            </div>
                                            <div class="reviews-slider__item--title block-btn-margin">
                                                <?php echo get_sub_field('reviews_commercial_title') ?>
                                            </div>
                                            <div class="reviews-slider__item--text block-btn-margin">
                                                <?php echo get_sub_field('reviews_commercial_text') ?>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
