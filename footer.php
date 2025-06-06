</main><?php // main-container end ?>

<footer class="footer">
    <div class="container">
        <div class="footer__content">
            <div class="footer__top d-flex f-wrap">
                <div class="footer__top_menu--item --basis-3">
                    <div class="footer__top_menu--title">
                        Company
                    </div>
                    <ul>
                        <?php if (has_nav_menu('footer_menu_company')) :
                            $nav_args = array(
                                'theme_location' => 'footer_menu_company',
                                'container' => '',
                                'items_wrap' => '%3$s',
                                'depth' => 2
                            );
                            wp_nav_menu($nav_args);
                        endif; ?>
                    </ul>
                </div>
                <div class="footer__top_menu--item --basis-3">
                    <div class="footer__top_menu--title">
                        Services
                    </div>
                    <ul>
                        <?php if (has_nav_menu('footer_menu_services')) :
                            $nav_args = array(
                                'theme_location' => 'footer_menu_services',
                                'container' => '',
                                'items_wrap' => '%3$s',
                                'depth' => 2
                            );
                            wp_nav_menu($nav_args);
                        endif; ?>
                    </ul>
                </div>
                <div class="footer__top_menu--item --basis-3">
                    <div class="footer__top_menu--title">
                        Help centre
                    </div>
                    <ul>
                        <?php if (has_nav_menu('footer_menu_help_centre')) :
                            $nav_args = array(
                                'theme_location' => 'footer_menu_help_centre',
                                'container' => '',
                                'items_wrap' => '%3$s',
                                'depth' => 2
                            );
                            wp_nav_menu($nav_args);
                        endif; ?>
                    </ul>
                </div>
            </div>
            <div class="footer__bottom d-flex --just-space --align-center">
                <div class="footer__bottom_social d-flex --align-stretch">
                    <a href="https://www.facebook.com/busybeeclean.co.uk/?_ga=2.122568523.1374067139.1699967845-671786692.1696335599" class="footer__bottom_social--item fb" target="_blank" rel="noopener"></a>
                    <a href="https://uk.linkedin.com/company/busy-bee-clean?trk=public_profile_topcard-current-company" class="footer__bottom_social--item ln" target="_blank" rel="noopener"></a>
                </div>
                <div class="footer__bottom_copyright d-flex --just-space --align-center">
                    <div class="footer__bottom_copyright--item">
                        Copyright: Busy Bee Clean LTD
                    </div>
                    <a href="#" class="footer__bottom_copyright--item link-copyright">
                        Privacy Policy
                    </a>
                    <a href="<?php echo preg_replace('@^(https?://)?([^/?]+)([/?].*)?$@', 'https://${2}', get_site_url()); ?>/terms-and-conditions//" class="footer__bottom_copyright--item link-copyright">
                        Terms & Conditions
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
