<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php wp_title(); ?></title>
    <link rel="icon" type="image/png" sizes="192x192" href="<?php bloginfo('template_url'); ?>/img/favicon/favicon-192x192.png">
    <link rel="icon" type="image/png" sizes="180x180" href="<?php bloginfo('template_url'); ?>/img/favicon/favicon-180x180.png">
    <script type="text/javascript">
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]function(){(c[a].q=c[a].q[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "jy68tyyl8e");
    </script>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header class="header">
    <div class="container">
        <div class="navbar-header d-flex --just-space --align-center">
            <?php if (!is_page_template('pages/page-order.php')) : ?>
                <div class="header__hamburger js-hamburger">
                    <div class="hamburger-line1"></div>
                    <div class="hamburger-line2"></div>
                    <div class="hamburger-line3"></div>
                </div>
            <?php endif; ?>
            <?php if (is_front_page()) : ?>
                <div class="header__logo">
                    <?php echo file_get_contents(get_theme_file_path("./img/logo/logo.svg")); ?>
                </div>
            <?php else : ?>
                <a href="/" class="header__logo" >
                    <?php echo file_get_contents(get_theme_file_path("./img/logo/logo.svg")); ?>
                </a>
            <?php endif; ?>
            <?php if (!is_page_template('pages/page-order.php')) : ?>
                <ul class="header__navigation d-flex --just-space --align-center">

                    <?php if (has_nav_menu('header_menu')) :
                        $nav_args = array(
                            'theme_location' => 'header_menu',
                            'container' => '',
                            'items_wrap' => '%3$s',
                            'depth' => 2
                        );
                        wp_nav_menu($nav_args);
                    endif; ?>

                </ul>
            <?php endif; ?>
            <?php if (!is_page_template('pages/page-order.php')) : ?>
                <div class="header__phone">
                    <a href="<?php echo preg_replace('@^(https?://)?([^/?]+)([/?].*)?$@', 'https://${2}', get_site_url()); ?>/order/">
                        Book Now
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</header>

<main id="main" class="main">
