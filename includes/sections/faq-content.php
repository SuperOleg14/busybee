<div class="global-faq faq">
    <div class="container">
        <a href="#" class="first-section__content_info--trustpilot">
            <?php echo file_get_contents(get_theme_file_path("./img/content/trustpilot-logo.svg")); ?>
        </a>
        <h1 class="block-service-title">
            Frequently Asked Questions
        </h1>
        <?php get_template_part('includes/modules/breadcrumbs'); ?>
        <div class="reviews__content">
            <ul class="reviews__content_nav d-flex --align-stretch">
                <li class="tab btn-block tab--active">
                    Domestic Cleaning
                </li>
                <li class="tab btn-block">
                    Commercial Cleaning

                </li>
            </ul>
            <div class="reviews__content_block">
                <?php if( have_rows('global_faq') ): ?>
                    <?php while( have_rows('global_faq') ): the_row(); ?>
                        <div class="content content--active">
                            <div class="faq-content">
                                <div class="accordion">
                                    <?php if( have_rows('global_faq_domestic_accordion') ): ?>
                                        <?php while( have_rows('global_faq_domestic_accordion') ): the_row(); ?>
                                            <div class="card">
                                                <div class="card-btn">
                                                    <h3>
                                                        <?php echo get_sub_field('global_faq_domestic_accordion_title') ?>
                                                    </h3>
                                                </div>
                                                <div class="card-body">
                                                    <?php echo get_sub_field('global_faq_domestic_accordion_text') ?>
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
                                    <?php if( have_rows('global_faq_commercial_accordion') ): ?>
                                        <?php while( have_rows('global_faq_commercial_accordion') ): the_row(); ?>
                                            <div class="card">
                                                <div class="card-btn">
                                                    <h3>
                                                        <?php echo get_sub_field('global_faq_commercial_accordion_title') ?>
                                                    </h3>
                                                </div>
                                                <div class="card-body">
                                                    <?php echo get_sub_field('global_faq_commercial_accordion_text') ?>
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
