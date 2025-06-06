<div class="faq">
    <div class="container">
        <div class="faq__title">
            Frequently Asked Questions
        </div>
        <div class="reviews__content">
            <ul class="reviews__content_nav d-flex --jc-center --align-stretch">
                <li class="tab btn-block tab--active">
                    Domestic Cleaning
                </li>
                <li class="tab btn-block">
                    Commercial Cleaning
                </li>
            </ul>
            <div class="reviews__content_block">
                <?php if( have_rows('faq', 'options') ): ?>
                    <?php while( have_rows('faq', 'options') ): the_row(); ?>
                        <div class="content content--active">
                            <div class="faq-content">
                                <div class="accordion">
                                    <?php if( have_rows('faq_domestic_accordion') ): ?>
                                        <?php while( have_rows('faq_domestic_accordion') ): the_row(); ?>
                                            <div class="card">
                                                <div class="card-btn">
                                                    <h3>
                                                        <?php echo get_sub_field('faq_domestic_accordion_title') ?>
                                                    </h3>
                                                </div>
                                                <div class="card-body">
                                                    <?php echo get_sub_field('faq_domestic_accordion_text') ?>
                                                </div>
                                            </div>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="content">
                            <div class="faq-content">
                                <div class="accordion">
                                    <?php if( have_rows('faq_commercial_accordion') ): ?>
                                        <?php while( have_rows('faq_commercial_accordion') ): the_row(); ?>
                                            <div class="card">
                                                <div class="card-btn">
                                                    <h3>
                                                        <?php echo get_sub_field('faq_commercial_accordion_title') ?>
                                                    </h3>
                                                </div>
                                                <div class="card-body">
                                                    <?php echo get_sub_field('faq_commercial_accordion_text') ?>
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
</div>
