<?php /*
 * Template name: Page Thank You
 */ ?>

<?php get_header(); ?>

<div class="thank-page d-flex --just-space --align-center --dir-col block-text-align">
    <div class="thank-page__content d-flex --just-space --align-center --dir-col">
        <a href="/" class="header__logo" >
            <?php echo file_get_contents(get_theme_file_path("./img/logo/logo.svg")); ?>
        </a>
        <div class="thank-page__photo">
            <img src="<?php bloginfo('template_url'); ?>/img/content/thank.png">
        </div>
        <div class="thank-page__info">
            <div class="thank-page__info_title">
                Thank you!
            </div>
            <div class="thank-page__info_text">
                Your have successfully booked your cleaning
            </div>
        </div>
        <div class="thank-page__btn d-flex --align-center --jc-center">
            <div class="thank-page__btn_item d-flex --align-center --jc-center --dir-col">
                <a href="<?php echo preg_replace('@^(https?://)?([^/?]+)([/?].*)?$@', 'https://${2}', get_site_url()); ?>/" class="thank-page__btn_item--link"></a>
                <div class="thank-page__btn_item--photo">
                    <img src="<?php bloginfo('template_url'); ?>/img/content/thank/thank-photo-1.svg">
                </div>
                <div class="thank-page__btn_item--title">
                    Home
                </div>
            </div>
            <div class="thank-page__btn_item d-flex --align-center --jc-center --dir-col">
                <a href="<?php echo preg_replace('@^(https?://)?([^/?]+)([/?].*)?$@', 'https://${2}', get_site_url()); ?>/our-services/" class="thank-page__btn_item--link"></a>
                <div class="thank-page__btn_item--photo">
                    <img src="<?php bloginfo('template_url'); ?>/img/content/thank/thank-photo-2.svg">
                </div>
                <div class="thank-page__btn_item--title">
                    Services
                </div>
            </div>
            <div class="thank-page__btn_item d-flex --align-center --jc-center --dir-col">
                <a href="<?php echo preg_replace('@^(https?://)?([^/?]+)([/?].*)?$@', 'https://${2}', get_site_url()); ?>/our-works/" class="thank-page__btn_item--link"></a>
                <div class="thank-page__btn_item--photo">
                    <img src="<?php bloginfo('template_url'); ?>/img/content/thank/thank-photo-3.svg">
                </div>
                <div class="thank-page__btn_item--title">
                    Our works
                </div>
            </div>
            <div class="thank-page__btn_item d-flex --align-center --jc-center --dir-col">
                <a href="<?php echo preg_replace('@^(https?://)?([^/?]+)([/?].*)?$@', 'https://${2}', get_site_url()); ?>/contacts/" class="thank-page__btn_item--link"></a>
                <div class="thank-page__btn_item--photo">
                    <img src="<?php bloginfo('template_url'); ?>/img/content/thank/thank-photo-4.svg">
                </div>
                <div class="thank-page__btn_item--title">
                    Contact us
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
