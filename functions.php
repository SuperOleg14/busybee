<?php

require_once __DIR__ . '/includes/classes/BusyBeeDynamicModel.php';
require_once __DIR__ . '/includes/classes/AbstractBusyBeeOrderCalculator.php';
require_once __DIR__ . '/includes/classes/BusyBeeDefaultOrderCalculator.php';
require_once __DIR__ . '/includes/classes/BusyBeeDomesticOrderCalculator.php';
require_once __DIR__ . '/includes/classes/BusyBeeOrderCalculatingContext.php';

const EMAIL_NOTIFY_EMAIL_SERVICE8 = '7f58a2@inbox.servicem8.com';

//ADDING JS AND CSS FILES
//--------------------------------------------------
function ox_adding_scripts() {
    if (!function_exists('is_login_page')) {
        function is_login_page() {
            return !strncmp($_SERVER['REQUEST_URI'], '/wp-login.php', strlen('/wp-login.php'));
        }
    }

    if( !is_admin() && !is_login_page()){
        /*removed wp-embed.min.js*/
        wp_deregister_script('wp-embed');
        wp_dequeue_style( 'wp-block-library');

        /*jquery*/
        wp_deregister_script('jquery');
        wp_enqueue_script('jquery', get_template_directory_uri() . '/js/min/jquery.min.js', null, '3.2.1', true);

        //общие для всего сайта стили и скрипты

        /*custom js*/
        wp_enqueue_script('main', get_template_directory_uri() . '/js/min/main.min.js', array('jquery'), time(), true );

        if(is_page_template('pages/page-order.php')){
            wp_enqueue_style('flatpickr', get_stylesheet_directory_uri() . '/css/order/flatpickr.min.css');
            wp_enqueue_script('flatpickr', get_stylesheet_directory_uri() . '/js/order/flatpickr.min.js');
            wp_enqueue_script('order', get_template_directory_uri() . '/js/order.js', array('jquery'), time(), true );
        }

        /*custom css*/
        wp_enqueue_style( 'main', get_template_directory_uri() . '/css/style.min.css', array(), time(), 'all');

        //добавляем css и js для кастомных страниц
        $pageTemplate = get_page_template_slug();

        if (strrpos($pageTemplate, 'pages/') === 0){
            $pageTemplateName = str_replace(['pages/', '.php'], '', $pageTemplate);

            $isCssFile = file_exists(get_theme_file_path('css/' . $pageTemplateName . '.min.css'));
            $isJsFile = file_exists(get_theme_file_path('js/min/' . $pageTemplateName . '.min.js'));

            if($isCssFile) {
                $cssFilePath = get_theme_file_uri('css/' . $pageTemplateName . '.min.css');
                wp_enqueue_style( $pageTemplateName , $cssFilePath, array(), time(), 'all');
            }

            if($isJsFile){
                $jsFilePath = get_theme_file_uri('js/min/' . $pageTemplateName . '.min.js');
                wp_enqueue_script($pageTemplateName, $jsFilePath, array('jquery'), time(), true );
            }
        }

        //добавляем стили для блога и постов
//        if(is_home() || is_single() || is_category() || is_search() || is_author()){
//            wp_enqueue_style( 'blog', get_template_directory_uri() . '/css/page-blog.min.css', array(), time(), 'all');
//            wp_enqueue_script('blog', get_template_directory_uri() . '/js/min/page-blog.min.js', array('jquery'), time(), true );
//        }

        if(is_singular('services') || is_tax('services-category')){
            wp_enqueue_style( 'services', get_template_directory_uri() . '/css/page-our-services.min.css', array(), time(), 'all');
            wp_enqueue_script('services', get_template_directory_uri() . '/js/min/page-our-services.min.js', array('jquery'), time(), true );

        }

        if(is_singular('portfolio') || is_tax('portfolio-category')){
            wp_enqueue_style( 'portfolio', get_template_directory_uri() . '/css/page-our-services.min.css', array(), time(), 'all');
            wp_enqueue_script('portfolio', get_template_directory_uri() . '/js/min/page-our-services.min.js', array('jquery'), time(), true );

        }

        //для 404 страницы
        if(is_404()){
            wp_enqueue_style( 'error', get_template_directory_uri() . '/css/page-error.min.css', array(), time(), 'all');
        }

    }
}

add_action( 'wp_enqueue_scripts', 'ox_adding_scripts' );

//ADDING CRITICAL CSS (only for front-page)
//--------------------------------------------------
//render-blocking styles
$css_files = array(
    'main'
);

//add_action('wp_enqueue_scripts', 'ox_adding_critical_css');


function ox_adding_critical_css()
{
    if (!is_front_page()) return;

    global $wp_styles, $css_files;

    if (empty($css_files)) return;

    $registered_styles = $css_files;
    $css_files = array();

    foreach ($registered_styles as $item) {
        $s = $wp_styles->registered[$item]->src . '?ver=' . $wp_styles->registered[$item]->ver;
        $css_files[$item] = $s;
    }

    $critical_css = load_template_part('css/critical.css');
    echo '<style>' . $critical_css . '</style>';

    global $css_files;

    foreach ($css_files as $key => $item) {
        wp_deregister_style($key);
        echo "<noscript><link rel='stylesheet' href='$item'/></noscript>";
    }

    function hook_non_critical_css()
    {
        global $css_files;

        foreach ($css_files as $key => $item) {
            echo '<script>function loadCSS(e,t,n){"use strict";var i=window.document.createElement("link");var o=t||window.document.getElementsByTagName("script")[0];i.rel="stylesheet";i.href=e;i.media="only x";o.parentNode.insertBefore(i,o);setTimeout(function(){i.media=n||"all"})}loadCSS("' . $item .'");</script>';
        }
    }

    add_action('wp_footer', 'hook_non_critical_css');
}

function load_template_part($template_name, $part_name = null)
{
    ob_start();
    get_template_part($template_name, $part_name);
    $var = ob_get_contents();
    ob_end_clean();
    return $var;
}


//REWOVE SOME META TAGS AND UNNECESSARY LINKS
//--------------------------------------------------
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_shortlink_wp_head', 10);
remove_action('wp_head', 'feed_links_extra', 3 );
remove_action('wp_head', 'feed_links', 2 );
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');

//remove wpemoji
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

//remove wp-json
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );


//REGISTRATION MENU
//--------------------------------------------------
register_nav_menus( array(
    'header_menu' => 'Header Menu',
    'header_submenu' => 'Header SEO Menu',
    'footer_menu_company' => 'Footer Menu Company',
    'footer_menu_services' => 'Footer Menu Services',
    'footer_menu_help_centre' => 'Footer Menu Help Centre',
));

//custom classes for menu items
function nav_class_filter( $classes, $item, $args, $depth ) {
    //добавлять классы только для меню в хедере
//    if($args->theme_location === 'header_menu' ) {
//        $classes = ['navigation__link']; //такая запись переписывает все классы для элемента меню
//    }

    if($args->theme_location === 'header_submenu' ) {
        $classes = ['submenu__link']; //такая запись переписывает все классы для элемента меню
    }

    //добавлять классы только для меню в футере
    if($args->theme_location === 'footer_menu') {
        $classes[] = ['footer-menu__link'];  //такая запись добавляет класс в общий массив классов, формирующийся вордпрессом
    }

    return $classes;
}

add_filter( 'nav_menu_css_class', 'nav_class_filter', 10, 4 );

/***
 * new pagination template for blog
 * @param $template
 * @param $class
 * @return string
 */
function my_navigation_template( $template, $class ){
    return '
            <nav class="%1$s blog__pagination" role="navigation">
                <div class="blog__nav-links">%3$s</div>
            </nav>    
            ';
}

add_filter('navigation_markup_template', 'my_navigation_template', 10, 2 );

/**
 * Limit excerpt to a number of characters
 * added read more btn
 *
 * @param string $excerpt
 * @return string
 */
function custom_short_excerpt($excerpt){
    global $post;
    return substr($excerpt, 0, 400).'...';
//    return substr($excerpt, 0, 200).'... <a class="article-preview__more" href="'.get_permalink($post->ID).'">Read More>></a>';

}
add_filter('the_excerpt', 'custom_short_excerpt');

/**
 * added thumbnails for blog
 */
add_theme_support( 'post-thumbnails', array('post') );

/**
 * Custom excerpt for recent posts
 */
function the_recent_post_excerpt( $post ){
    $excerpt = $post['post_excerpt'] ? $post['post_excerpt'] : $post['post_content'];
    return substr(wp_strip_all_tags($excerpt), 0, 200).'... <a class="article-preview__more" href="'.get_permalink($post['ID']).'">Read More>></a>';
}

/**
 * get template part with custom data
 * @param $template
 * @param array $data
 */
function get_template_part_params($template, $data= array()){
    extract($data);
    require locate_template($template.'.php');
}


/**
 * Следующие две функции позволяют отделять заголовок от основного контента
 */

/**
 * get title
 * @param $text
 * @return string|string[]|null
 */
function getPageTitle($text){
    $pattern = '/<h1[^>]*>\s*(.*?)\s*<\/h1>/i';
    preg_match($pattern, $text, $matches);
    $h1 = preg_replace('/<h1[^>]*?>([\\s\\S]*?)<\/h1>/',
        '\\1', $matches[0]);
    return $h1;
}

/**
 * get content without page title
 * @param $text
 * @return string|string[]|null
 */
function removeTitleFromContent($text){
    if( is_page() && !is_front_page()) {
        $pattern = '/<h1[^>]*>\s*(.*?)\s*<\/h1>/i';
        $result = preg_replace($pattern, "", $text);
        return $result;
    }
    else{
        return $text;
    }
}

add_theme_support( 'post-thumbnails' );

//add_filter('the_content', 'removeTitleFromContent');

function my_myme_types($mime_types){
    $mime_types['svg'] = 'image/svg+xml'; //Adding svg extension
    return $mime_types;
}

add_filter('upload_mimes', 'my_myme_types', 1, 1);

function bg_color( $color = false, $echo = true ) {

    if ( empty( $color ) ) {
        return false;
    }

    $string = 'style="background-color: '.$color.'"';

    if ( $echo ) {
        echo $string;
    } else {
        return $string;
    }
}

if( function_exists('acf_add_options_page') ) {

    acf_add_options_page();

    acf_add_options_page(array(
        'page_title' 	=> 'Theme Options',
        'menu_title'	=> 'Theme Options',
        'menu_slug' 	=> 'theme-options',
        'parent_slug'   => '',
        'capability'	=> 'edit_posts',
        'redirect'		=> false
    ));
    acf_add_options_page(array(
        'page_title' 	=> 'FAQ',
        'menu_title'	=> 'FAQ',
        'menu_slug' 	=> 'theme-options-about',
        'capability'	=> 'edit_posts',
        'parent_slug'   => 'theme-options',
    ));
    acf_add_options_page(array(
        'page_title' 	=> 'Reviews',
        'menu_title'	=> 'Reviews',
        'menu_slug' 	=> 'theme-options-reviews',
        'capability'	=> 'edit_posts',
        'parent_slug'   => 'theme-options',
    ));

}

/**
 * Get Post Featured image
 *
 * @var int $id Post id
 * @var string $size = 'full' featured image size
 *
 * @return string Post featured image url
 * @author DimonPDAA
 */
function get_attached_img_url( $id = 0, $size = "medium_large" ) {
    $img = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), $size );

    return $img[0];
}

/*-------------------------------------------------------------
Set post Views for BLOG post
-------------------------------------------------------------*/
function getPostViews($postID)
{
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    } else {
        if ($count > 1000) {
            return round ( $count / 1000 ,1 ).'K';
        }
    }
    return $count;
}

function setPostViews($postID)
{
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

function add_preview_post_meta_box() {
    add_meta_box(
        'preview_post_meta_box',
        'Preview Post',
        'render_preview_post_meta_box',
        'post',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_preview_post_meta_box');

function render_preview_post_meta_box($post) {
    $preview_post_id = get_post_meta($post->ID, 'preview_post_id', true);
    wp_nonce_field('preview_post_meta_box_nonce', 'preview_post_meta_box_nonce');
    ?>
    <p>
        <label for="preview_post_id">Select Preview Post:</label>
        <br />
        <select name="preview_post_id" id="preview_post_id">
            <option value="">Select a Post</option>
            <?php
            $posts = get_posts(array(
                'post_type' => 'post',
                'numberposts' => -1,
                'orderby' => 'title',
                'order' => 'ASC'
            ));
            foreach ($posts as $post) {
                $selected = ($preview_post_id == $post->ID) ? 'selected' : '';
                echo '<option value="' . $post->ID . '" ' . $selected . '>' . $post->post_title . '</option>';
            }
            ?>
        </select>
    </p>
    <?php
}

function save_preview_post_meta($post_id) {
    if (!isset($_POST['preview_post_meta_box_nonce']) || !wp_verify_nonce($_POST['preview_post_meta_box_nonce'], 'preview_post_meta_box_nonce')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (isset($_POST['preview_post_id'])) {
        update_post_meta($post_id, 'preview_post_id', $_POST['preview_post_id']);
    } else {
        delete_post_meta($post_id, 'preview_post_id');
    }
}
add_action('save_post', 'save_preview_post_meta');

add_filter('get_avatar', 'custom_get_avatar', 10, 5);
function custom_get_avatar($avatar, $id_or_email, $size, $default, $alt) {
    if (is_numeric($size)) {
        $size = 'full';
    }

    return $avatar;
}

//Custom post type services
add_action('init', 'register_services');
function register_services()
{
    $labels = array(
        'name' => _x('Services', 'post type general name', 'acemountfront'),
        'singular_name' => _x('Services', 'post type singular name', 'acemountfront'),
        'menu_name' => _x('Services', 'admin menu', 'acemountfront'),
        'name_admin_bar' => _x('Services', 'add new on admin bar', 'acemountfront'),
        'add_new' => _x('Add New', 'Services', 'acemountfront'),
        'add_new_item' => __('Add New Service', 'acemountfront'),
        'new_item' => __('New Service', 'acemountfront'),
        'edit_item' => __('Edit Service', 'acemountfront'),
        'view_item' => __('View Service', 'acemountfront'),
        'all_items' => __('All Services', 'acemountfront'),
        'search_items' => __('Search Services', 'acemountfront'),
        'parent_item_colon' => __('Parent Services:', 'acemountfront'),
        'not_found' => __('No Services found.', 'acemountfront'),
        'not_found_in_trash' => __('No Services found in Trash.', 'acemountfront')
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => 5,
        'show_in_rest' => true,
        'taxanomies' => array('services-category'),
        'supports' => array('title', 'editor', 'author', 'thumbnail')
    );
    register_post_type('services', $args);
}
function tr_create_services_taxonomy()
{
    register_taxonomy(
        'services-category',
        'services',
        array(
            'label' => __('Services Categories'),
            'rewrite' => array('slug' => 'services-category'),
            'show_in_rest' => true,
            'hierarchical' => true,
        )
    );
}
add_action('init', 'tr_create_services_taxonomy');

//Custom post type portfolio
add_action('init', 'register_portfolio');
function register_portfolio()
{
    $labels = array(
        'name' => _x('Portfolio', 'post type general name', 'acemountfront'),
        'singular_name' => _x('Portfolio', 'post type singular name', 'acemountfront'),
        'menu_name' => _x('Portfolio', 'admin menu', 'acemountfront'),
        'name_admin_bar' => _x('Portfolio', 'add new on admin bar', 'acemountfront'),
        'add_new' => _x('Add New', 'Portfolio', 'acemountfront'),
        'add_new_item' => __('Add New Work', 'acemountfront'),
        'new_item' => __('New Work', 'acemountfront'),
        'edit_item' => __('Edit Work', 'acemountfront'),
        'view_item' => __('View Vork', 'acemountfront'),
        'all_items' => __('All Portfolio', 'acemountfront'),
        'search_items' => __('Search Portfolio', 'acemountfront'),
        'parent_item_colon' => __('Parent Portfolio:', 'acemountfront'),
        'not_found' => __('No Portfolio found.', 'acemountfront'),
        'not_found_in_trash' => __('No Portfolio found in Trash.', 'acemountfront')
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => 5,
        'show_in_rest' => true,
        'taxanomies' => array('portfolio-category'),
        'supports' => array('title', 'editor', 'author', 'thumbnail')
    );
    register_post_type('portfolio', $args);
}
function tr_create_portfolio_taxonomy()
{
    register_taxonomy(
        'portfolio-category',
        'portfolio',
        array(
            'label' => __('Portfolio Categories'),
            'rewrite' => array('slug' => 'portfolio-category'),
            'show_in_rest' => true,
            'hierarchical' => true,
        )
    );
}
add_action('init', 'tr_create_portfolio_taxonomy');

if ( !function_exists('busy_bee_register_admin_menu') ) {
    function busy_bee_register_admin_menu(): void
    {
        add_menu_page('Order Form', 'Order Form', 'manage_options', 'busy_bee_order_form_settings', 'busy_bee_order_form_calculator' );
        add_submenu_page(
            'busy_bee_order_form_settings',
            'Form Price Calculations',
            'Form Price Calculations',
            'manage_options',
            'busy_bee_order_form_calculator',
            'busy_bee_order_form_calculator'
        );
        add_submenu_page(
            'busy_bee_order_form_settings',
            'Form Price Extras',
            'Form Price Extras',
            'manage_options',
            'busy_bee_order_form_extras',
            'busy_bee_order_form_extras'
        );
    }
}

add_action('admin_menu', 'busy_bee_register_admin_menu');

if ( !function_exists('busy_bee_order_form_calculator') ) {
    function busy_bee_order_form_calculator(): void {

        $request = filter_input_array(
            INPUT_POST,
            FILTER_SANITIZE_SPECIAL_CHARS
        );
        if (isset($request['order_save_settings'])) {
            foreach ($request as $key => $value) {
                update_option($key, $value);
            }
            show_message('Updated!');
        }

        ?>
        <form method="post">
            <table>
                <tr>
                    <th>Type of cleaning</th>
                    <th>Reserved price £</th>
                    <th>Price per 1 bedroom £</th>
                    <th>Price per 1 bathroom £</th>
                    <th>Extra from bedrooms</th>
                    <th>Extra price £</th>
                </tr>
                <tr>
                    <td>
                        End of tenancy
                    </td>
                    <td>
                        <input
                                type="number"
                                name="end_of_tenancy_reserved_price"
                                value="<?php echo get_option('end_of_tenancy_reserved_price'); ?>"
                                step=".25"
                        >
                    </td>
                    <td>
                        <input
                                type="number"
                                name="end_of_tenancy_price_per_bedroom"
                                value="<?php echo get_option('end_of_tenancy_price_per_bedroom'); ?>"
                                step=".25"
                        >
                    </td>
                    <td>
                        <input
                                type="number"
                                name="end_of_tenancy_price_per_bathroom"
                                value="<?php echo get_option('end_of_tenancy_price_per_bathroom'); ?>"
                                step=".25"
                        >
                    </td>
                    <td>
                        <input
                                type="number"
                                name="end_of_tenancy_extra_from"
                                value="<?php echo get_option('end_of_tenancy_extra_from'); ?>"
                                step=".25"
                        >
                    </td>
                    <td>
                        <input
                                type="number"
                                name="end_of_tenancy_extra_price"
                                value="<?php echo get_option('end_of_tenancy_extra_price'); ?>"
                                step=".25"
                        >
                    </td>
                </tr>

                <tr>
                    <td>
                        Deep cleaning
                    </td>
                    <td>
                        <input
                                type="number"
                                name="deep_cleaning_reserved_price"
                                value="<?php echo get_option('deep_cleaning_reserved_price'); ?>"
                                step=".25"
                        >
                    </td>
                    <td>
                        <input
                                type="number"
                                name="deep_cleaning_price_per_bedroom"
                                value="<?php echo get_option('deep_cleaning_price_per_bedroom'); ?>"
                                step=".25"
                        >
                    </td>
                    <td>
                        <input
                                type="number"
                                name="deep_cleaning_price_per_bathroom"
                                value="<?php echo get_option('deep_cleaning_price_per_bathroom'); ?>"
                                step=".25"
                        >
                    </td>
                    <td>
                        <input
                                type="number"
                                name="deep_cleaning_extra_from"
                                value="<?php echo get_option('deep_cleaning_extra_from'); ?>"
                                step=".25"
                        >
                    </td>
                    <td>
                        <input
                                type="number"
                                name="deep_cleaning_extra_price"
                                value="<?php echo get_option('deep_cleaning_extra_price'); ?>"
                                step=".25"
                        >
                    </td>
                </tr>

                <tr>
                    <td>
                        After construction
                    </td>
                    <td>
                        <input
                                type="number"
                                name="after_construction_reserved_price"
                                value="<?php echo get_option('after_construction_reserved_price'); ?>"
                                step=".25"
                        >
                    </td>
                    <td>
                        <input
                                type="number"
                                name="after_construction_price_per_bedroom"
                                value="<?php echo get_option('after_construction_price_per_bedroom'); ?>"
                                step=".25"
                        >
                    </td>
                    <td>
                        <input
                                type="number"
                                name="after_construction_price_per_bathroom"
                                value="<?php echo get_option('after_construction_price_per_bathroom'); ?>"
                                step=".25"
                        >
                    </td>
                    <td>
                        <input
                                type="number"
                                name="after_construction_extra_from"
                                value="<?php echo get_option('after_construction_extra_from'); ?>"
                                step=".25"
                        >
                    </td>
                    <td>
                        <input
                                type="number"
                                name="after_construction_extra_price"
                                value="<?php echo get_option('after_construction_extra_price'); ?>"
                                step=".25"
                        >
                    </td>
                </tr>

                <tr>
                    <td>
                        Carpet cleaning
                    </td>
                    <td>
                        <input
                                type="number"
                                name="carpet_cleaning_reserved_price"
                                value="<?php echo get_option('carpet_cleaning_reserved_price'); ?>"
                                step=".25"
                        >
                    </td>
                    <td>
                        <input
                                type="number"
                                name="carpet_cleaning_price_per_bedroom"
                                value="<?php echo get_option('carpet_cleaning_price_per_bedroom'); ?>"
                                step=".25"
                        >
                    </td>
                    <td>
                        <input
                                type="number"
                                name="carpet_cleaning_price_per_bathroom"
                                value="<?php echo get_option('carpet_cleaning_price_per_bathroom'); ?>"
                                step=".25"
                        >
                    </td>
                    <td>
                        <input
                                type="number"
                                name="carpet_cleaning_extra_from"
                                value="<?php echo get_option('carpet_cleaning_extra_from'); ?>"
                                step=".25"
                        >
                    </td>
                    <td>
                        <input
                                type="number"
                                name="carpet_cleaning_extra_price"
                                value="<?php echo get_option('carpet_cleaning_extra_price'); ?>"
                                step=".25"
                        >
                    </td>
                </tr>
                <tr>
                    <th>Domestic cleaning</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Minimum Booking Amount</th>
                </tr>
                <tr>
                    <td>
                        One off / Weekly
                    </td>
                    <td>
                        <input
                                type="number"
                                name="domestic_cleaning_once_reserved_price"
                                value="<?php echo get_option('domestic_cleaning_once_reserved_price'); ?>"
                                step=".25"
                        >
                    </td>
                    <td>
                        <input
                                type="number"
                                name="domestic_cleaning_once_price_per_bedroom"
                                value="<?php echo get_option('domestic_cleaning_once_price_per_bedroom'); ?>"
                                step=".25"
                        >
                    </td>
                    <td>
                        <input
                                type="number"
                                name="domestic_cleaning_once_price_per_bathroom"
                                value="<?php echo get_option('domestic_cleaning_once_price_per_bathroom'); ?>"
                                step=".25"
                        >
                    </td>
                    <td>
                        <input
                                type="number"
                                name="domestic_cleaning_once_min_booking_price"
                                value="<?php echo get_option('domestic_cleaning_once_min_booking_price'); ?>"
                                step=".25"
                        >
                    </td>
                </tr>
                <tr>
                    <td>
                        Fortnightly / Monthly
                    </td>
                    <td>
                        <input
                                type="number"
                                name="domestic_cleaning_every_reserved_price"
                                value="<?php echo get_option('domestic_cleaning_every_reserved_price'); ?>"
                                step=".25"
                        >
                    </td>
                    <td>
                        <input
                                type="number"
                                name="domestic_cleaning_every_price_per_bedroom"
                                value="<?php echo get_option('domestic_cleaning_every_price_per_bedroom'); ?>"
                                step=".25"
                        >
                    </td>
                    <td>
                        <input
                                type="number"
                                name="domestic_cleaning_every_price_per_bathroom"
                                value="<?php echo get_option('domestic_cleaning_every_price_per_bathroom'); ?>"
                                step=".25"
                        >
                    </td>
                    <td>
                        <input
                                type="number"
                                name="domestic_cleaning_every_min_booking_price"
                                value="<?php echo get_option('domestic_cleaning_every_min_booking_price'); ?>"
                                step=".25"
                        >
                    </td>
                </tr>

                <tr>
                    <td style='margin: auto;'>
                        <input class="btn" type="submit" name="order_save_settings" value="Save"/>
                    </td>
                </tr>
            </table>
        </form>
        <?php
    }
}

if ( !function_exists( 'busy_bee_order_form_extras' ) ) {
    function busy_bee_order_form_extras(): void {
        $request = filter_input_array(
            INPUT_POST,
            FILTER_SANITIZE_SPECIAL_CHARS
        );
        if (isset($request['order_save_extras'])) {
            foreach ($request as $key => $value) {
                update_option($key, $value);
            }
            show_message('Updated!');
        }
        ?>
        <form method="post">
            <table>
                <tr>
                    <th>Extra name</th>
                    <th>Price £</th>
                </tr>
                <tr>
                    <td>
                        Is furnished
                    </td>
                    <td>
                        <input
                                type="number"
                                name="is_furnished_extra_price"
                                value="<?php echo get_option('is_furnished_extra_price'); ?>"
                                step=".25"
                        >
                    </td>
                </tr>

                <tr>
                    <td>
                        Include cleaning products
                    </td>
                    <td>
                        <input
                                type="number"
                                name="include_our_cleaning_products"
                                value="<?php echo get_option('include_our_cleaning_products'); ?>"
                                step=".25"
                        >
                    </td>
                </tr>
                <tr>
                    <td>
                        Carpet cleaning
                    </td>
                    <td>
                        <input
                                type="number"
                                name="extras_carpet_price"
                                value="<?php echo get_option('extras_carpet_price'); ?>"
                                step=".25"
                        >
                    </td>
                </tr>
                <tr>
                    <td>
                        Sofa cleaning
                    </td>
                    <td>
                        <input
                                type="number"
                                name="extras_sofa_price"
                                value="<?php echo get_option('extras_sofa_price'); ?>"
                                step=".25"
                        >
                    </td>
                </tr>
                <tr>
                    <td>
                        Balcony (outside)
                    </td>
                    <td>
                        <input
                                type="number"
                                name="extras_balcony_price"
                                value="<?php echo get_option('extras_balcony_price'); ?>"
                                step=".25"
                        >
                    </td>
                </tr>
                <tr>
                    <td>
                        Сurtains cleaning
                    </td>
                    <td>
                        <input
                                type="number"
                                name="extras_curtains_price"
                                value="<?php echo get_option('extras_curtains_price'); ?>"
                                step=".25"
                        >
                    </td>
                </tr>
                <tr>
                    <td>
                        Chair cleaning
                    </td>
                    <td>
                        <input
                                type="number"
                                name="extras_chair_price"
                                value="<?php echo get_option('extras_chair_price'); ?>"
                                step=".25"
                        >
                    </td>
                </tr>
                <tr>
                    <td>
                        Armchair cleaning
                    </td>
                    <td>
                        <input
                                type="number"
                                name="extras_armchair_price"
                                value="<?php echo get_option('extras_armchair_price'); ?>"
                                step=".25"
                        >
                    </td>
                </tr>
                <tr>
                    <td>
                        Inside cupboard cleaning
                    </td>
                    <td>
                        <input
                                type="number"
                                name="extras_inside_price"
                                value="<?php echo get_option('extras_inside_price'); ?>"
                                step=".25"
                        >
                    </td>
                </tr>
                <tr>
                    <td>
                        Living / Dining / Lounge
                    </td>
                    <td>
                        <input
                                type="number"
                                name="extras_ldl_price"
                                value="<?php echo get_option('extras_ldl_price'); ?>"
                                step=".25"
                        >
                    </td>
                </tr>
                <tr>
                    <td>
                        Hallway
                    </td>
                    <td>
                        <input
                                type="number"
                                name="extras_hallway_price"
                                value="<?php echo get_option('extras_hallway_price'); ?>"
                                step=".25"
                        >
                    </td>
                </tr>
                <tr>
                    <td>
                        Landing
                    </td>
                    <td>
                        <input
                                type="number"
                                name="extras_landing_price"
                                value="<?php echo get_option('extras_landing_price'); ?>"
                                step=".25"
                        >
                    </td>
                </tr>
                <tr>
                    <td>
                        Steps
                    </td>
                    <td>
                        <input
                                type="number"
                                name="extras_steps_price"
                                value="<?php echo get_option('extras_steps_price'); ?>"
                                step=".25"
                        >
                    </td>
                </tr>
                <tr>
                    <td>
                        Inside fridge cleaning
                    </td>
                    <td>
                        <input
                                type="number"
                                name="extras_inside_fridge_price"
                                value="<?php echo get_option('extras_inside_fridge_price'); ?>"
                                step=".25"
                        >
                    </td>
                </tr>
                <tr>
                    <td>
                        Oven cleaning
                    </td>
                    <td>
                        <input
                                type="number"
                                name="extras_oven_price"
                                value="<?php echo get_option('extras_oven_price'); ?>"
                                step=".25"
                        >
                    </td>
                </tr>
                <tr>
                    <td>
                        Inside windows cleaning
                    </td>
                    <td>
                        <input
                                type="number"
                                name="extras_windows_price"
                                value="<?php echo get_option('extras_windows_price'); ?>"
                                step=".25"
                        >
                    </td>
                </tr>
                <tr>
                    <td>
                        Ironing
                    </td>
                    <td>
                        <input
                                type="number"
                                name="extras_ironing_price"
                                value="<?php echo get_option('extras_ironing_price'); ?>"
                                step=".25"
                        >
                    </td>
                </tr>

                <tr>
                    <td style='margin: auto;'>
                        <input class="btn" type="submit" name="order_save_extras" value="Save"/>
                    </td>
                </tr>
            </table>
        </form>
        <?php
    }
}

if ( !function_exists('busy_bee_get_supported_postcodes') ) {
    function busy_bee_get_supported_postcodes(): array {
        return require_once __DIR__ . '/postcodes.php';
    }
}

if ( !function_exists('busy_bee_get_unsupported_postcodes') ) {
    function busy_bee_get_unsupported_postcodes(): array {
        return require_once __DIR__ . '/unsupported_postcodes.php';
    }
}

if ( !function_exists('busy_bee_validate_postcodes') ) {
    function busy_bee_validate_postcodes(BusyBeeDynamicModel $model): bool {
        $postcodes = array_merge(
            busy_bee_get_supported_postcodes(),
            busy_bee_get_unsupported_postcodes()
        );
        $code = mb_substr($model->getAttribute('postcode'), 0, 4);
        if (!in_array(strtoupper($code), $postcodes)) {
            $model->addErrorMessage('postcode', 'Unsupported postcode.');
        }

        return !$model->hasErrors();
    }
}

if ( !function_exists('busy_bee_get_supported_postcodess_json') ) {
    function busy_bee_get_supported_postcodes_json(): void {
        echo json_encode([
            'supported' => busy_bee_get_supported_postcodes(),
            'unsupported' => busy_bee_get_unsupported_postcodes()
        ]);
        wp_die();
    }
}

add_action('wp_ajax_busy_bee_get_supported_postcodes', 'busy_bee_get_supported_postcodes_json' );
add_action('wp_ajax_nopriv_busy_bee_get_supported_postcodes', 'busy_bee_get_supported_postcodes_json' );

if ( !function_exists('busy_bee_create_model') ) {
    /**
     * Factory function for dynamic model.
     * Could be redefined in child theme if some another specific instance expected.
     *
     * @return BusyBeeDynamicModel
     */
    function busy_bee_create_model(): BusyBeeDynamicModel {
        return new BusyBeeDynamicModel();
    }
}

if ( !function_exists('busy_bee_set_rules_to_order_model') ) {
    /**
     * Function for setting specific validation rules to receiving order model.
     * Could be redefined in child theme.
     *
     * @param BusyBeeDynamicModel $model
     *
     * @return void
     */
    function busy_bee_set_rules_to_order_model(BusyBeeDynamicModel $model): void {
        $model->setRules(
            [
                [
                    [
                        'postcode',
                        'name',
                        'phone',
                        'email',
                        'adress',
                    ],
                    BusyBeeDynamicModel::RULE_REQUIRED
                ],
                [
                    [
                        'type_cleaning',
                        'space_furnished',
                        'cleaning_products',
                        'bedrooms',
                        'bathrooms'
                    ],
                    BusyBeeDynamicModel::RULE_NUMERIC,
                    'skip_on_empty' => false,
                ],
                [
                    ['space_furnished', 'cleaning_products'],
                    BusyBeeDynamicModel::RULE_IN, 'values' => [0, 1], 'strict' => false
                ],
                ['email', BusyBeeDynamicModel::RULE_EMAIL],
                [
                    ['often_work'],
                    BusyBeeDynamicModel::RULE_REQUIRED,
                    'when' => fn() => $model->getAttribute('type_cleaning') == BusyBeeOrderCalculatingContext::DOMESTIC_CLEANING
                        || $model->getAttribute('type_cleaning') == BusyBeeOrderCalculatingContext::COMMERCIAL_CLEANING,
                ],
            ]
        );
    }
}

if ( !function_exists('get_body_for_order_email') ) {
    function get_body_for_order_email(BusyBeeDynamicModel $model): string
    {
        $name = trim($model->getAttribute('name'));
        if (strpos($name, ' ') !== false) {
            $content = sprintf(
                'First Name: %s<br>',
                stristr($name, ' ', true)
            );
            $content .= sprintf(
                'Last Name: %s<br>',
                trim(stristr($name, ' '))
            );
        } else {
            $content = sprintf('First Name: %s<br>', $name);
        }

        $content .= sprintf('Enail: %s<br>', $model->getAttribute('email'));
        $content .= sprintf('Phone: %s<br>', $model->getAttribute('phone'));
        // $content .= sprintf('Job Address: %s', $model->getAttribute(''));
        // $content .= sprintf('Billing Address: %s', '');
        $attrs = [
            'postcode',
            ['type_cleaning', [BusyBeeOrderCalculatingContext::class, 'getTypeCleaning']],
            ['space_furnished', 'busy_bee_int_to_word'],
            ['cleaning_products', 'busy_bee_int_to_word'],
            'often_work',
            'bathrooms',
            'bedrooms',
            'adress',
        ];

        foreach ($attrs as $attr) {
            if (is_array($attr)) {
                $callback = $attr[1];
                $attr = $attr[0];
                $content .= sprintf(
                    '%s: %s<br>',
                    $model->getLabel($attr),
                    call_user_func($callback, $model->getAttribute($attr))
                );
            } else {
                $content .= sprintf(
                    '%s: %s<br>',
                    $model->getLabel($attr),
                    $model->getAttribute($attr)
                );
            }
        }

        $extras = $model->getAttribute('extras');
        if (is_array($extras)) {
            $content .= sprintf('%s:<br>', $model->getLabel('extras'));
            foreach ($extras as $name => $quantity) {
                $content .= sprintf(
                    '%s: quantity: %d<br>',
                    ucwords(str_replace('_', ' ', $name)),
                    $quantity
                );
            }
        }

        if ($model->hasAttribute('price')) {
            $content .= sprintf(
                '%s: %s<br>',
                $model->getLabel('price'),
                $model->getAttribute('price')
            );
        }

        return $content;
    }
}

if (!function_exists('busy_bee_add_price_rules')) {
    function busy_bee_add_price_rules(BusyBeeDynamicModel $model): void {
        $model->addRule([
            ['price'],
            BusyBeeDynamicModel::RULE_DIGIT_MIN,
            'min' => get_option('domestic_cleaning_once_min_booking_price'),
            'when' => fn() => $model->getAttribute('type_cleaning') == BusyBeeOrderCalculatingContext::DOMESTIC_CLEANING
                && (
                    $model->getAttribute('often_work') == 'One off'
                    || $model->getAttribute('often_work') == 'Weekly'
                ),
        ]);
        $model->addRule([
            ['price'],
            BusyBeeDynamicModel::RULE_DIGIT_MIN,
            'min' => get_option('domestic_cleaning_every_min_booking_price'),
            'when' => fn() => $model->getAttribute('type_cleaning') == BusyBeeOrderCalculatingContext::DOMESTIC_CLEANING
                && (
                    $model->getAttribute('often_work') == 'Monthly'
                    || $model->getAttribute('often_work') == 'Fortnightly'
                ),
        ]);
    }
}

if ( !function_exists('receive_order') ) {
    function receive_order(): void {
        $model = busy_bee_create_model();
        busy_bee_set_rules_to_order_model($model);
        busy_bee_add_filtering_extras_rules($model);
        $request = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

        if (
            $model->load($request)
            && $model->validate()
            && busy_bee_validate_postcodes($model)
        ) {
            $price = busy_bee_calculate_price($model);
            busy_bee_add_price_rules($model);
            $model->setAttribute('price', $price);

            if ($model->validate()) {
                $content = get_body_for_order_email($model);

                $headers = [
                    'content-type: text/html',
                ];

                wp_mail(
                    EMAIL_NOTIFY_EMAIL_SERVICE8,
                    'Order Form From Site',
                    $content,
                    $headers
                );

                echo json_encode(['status' => 'OK']);
                wp_die();
            }
        }

        http_response_code(422);
        echo json_encode(
            array_merge(['status' => 'failed'],
                ['errors' => $model->getErrors()]),
            JSON_PRETTY_PRINT
        );

        wp_die();
    }
}

add_action('wp_ajax_receive_order', 'receive_order' ); // executed when logged in
add_action('wp_ajax_nopriv_receive_order', 'receive_order' ); // executed when logged out

if ( !function_exists('busy_bee_set_order_price_model_rules') ) {
    /**
     * Function for setting specific validation rules to calculating order price model.
     * Could be redefined in child theme.
     *
     * @param BusyBeeDynamicModel $model
     *
     * @return void
     */
    function busy_bee_set_order_price_model_rules(BusyBeeDynamicModel $model): void {
        $model->setRules(
            [
                [
                    [
                        'type_cleaning',
                        'space_furnished',
                        'bedrooms',
                        'bathrooms',
                        'cleaning_products'
                    ],
                    BusyBeeDynamicModel::RULE_NUMERIC,
                ],
                [
                    ['often_work'],
                    BusyBeeDynamicModel::RULE_REQUIRED,
                    'when' => fn() => $model->getAttribute('type_cleaning') == BusyBeeOrderCalculatingContext::DOMESTIC_CLEANING
                        || $model->getAttribute('type_cleaning') == BusyBeeOrderCalculatingContext::COMMERCIAL_CLEANING,
                ],
            ]
        );
    }
}

if ( !function_exists('busy_bee_calculate_order') ) {
    function busy_bee_calculate_order(): void {
        $request = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

        $model = busy_bee_create_model();
        busy_bee_set_order_price_model_rules($model);
        busy_bee_add_filtering_extras_rules($model);

        if ($model->load($request) && $model->validate()) {
            $price = busy_bee_calculate_price($model);
            busy_bee_add_price_rules($model);
            $model->setAttribute('price', $price);

            if ($model->validate()) {
                echo json_encode(['status' => 'OK', 'price' => $price]);
            } else {
                echo json_encode(['status' => 'OK', 'price' => $price, 'warnings' => $model->getErrors()]);
            }
        } else {
            http_response_code(422);
            echo json_encode(
                array_merge(['status' => 'failed'], ['errors' => $model->getErrors()])
            );
        }

        wp_die();
    }
}

if ( !function_exists('busy_bee_calculate_price') ) {
    function busy_bee_calculate_price(BusyBeeDynamicModel $model) {
        $context = new BusyBeeOrderCalculatingContext();
        $calc = $context->getStrategy($model->getAttribute('type_cleaning'))
            ->load($model);

        $price = $calc->calculate(
            $model->getAttribute('bedrooms'),
            $model->getAttribute('bathrooms'),
            $model->getAttribute('extras') ?? [],
        );

        return number_format($price, 2);
    }
}

add_action('wp_ajax_calculate_order', 'busy_bee_calculate_order' ); // executed when logged in
add_action('wp_ajax_nopriv_calculate_order', 'busy_bee_calculate_order' ); // executed when logged out

if (!function_exists('busy_bee_add_filtering_extras_rules')) {
    function busy_bee_add_filtering_extras_rules(BusyBeeDynamicModel $model): void {
        $model->addRule([
            ['type_cleaning'],
            BusyBeeDynamicModel::RULE_IN,
            'values' => [
                BusyBeeOrderCalculatingContext::END_OF_TENANCY_CLEANING,
                BusyBeeOrderCalculatingContext::DEEP_CLEANING,
                BusyBeeOrderCalculatingContext::AFTER_CONSTRUCTION_CLEANING,
                BusyBeeOrderCalculatingContext::CARPET_CLEANING,
                BusyBeeOrderCalculatingContext::DOMESTIC_CLEANING,
//                BusyBeeOrderCalculatingContext::COMMERCIAL_CLEANING,
            ],
        ]);
        $model->addRule(
            [
                ['extras'],
                BusyBeeDynamicModel::RULE_FILTER_ARRAY,
                'caseAttr' => 'type_cleaning',
                'keys' => true,
                'cases' => [
                    BusyBeeOrderCalculatingContext::END_OF_TENANCY_CLEANING => [
                        'extras_carpet',
                        'extras_sofa',
                        'extras_balcony',
                        'extras_curtains',
                        'extras_chair',
                        'extras_armchair',
                    ],
                    BusyBeeOrderCalculatingContext::DEEP_CLEANING => [
                        'extras_carpet',
                        'extras_sofa',
                        'extras_balcony',
                        'extras_curtains',
                        'extras_chair',
                        'extras_armchair',
                    ],
                    BusyBeeOrderCalculatingContext::AFTER_CONSTRUCTION_CLEANING => [
                        'extras_carpet',
                        'extras_sofa',
                        'extras_balcony',
                        'extras_curtains',
                        'extras_chair',
                        'extras_armchair',
                    ],
                    BusyBeeOrderCalculatingContext::CARPET_CLEANING => [
                        'extras_ldl',
                        'extras_hallway',
                        'extras_landing',
                        'extras_steps',
                    ],
                    BusyBeeOrderCalculatingContext::DOMESTIC_CLEANING => [
                        'extras_inside_fridge',
                        'extras_balcony',
                        'extras_oven',
                        'extras_windows',
                        'extras_ironing',
                    ],
                    BusyBeeOrderCalculatingContext::COMMERCIAL_CLEANING => [],
                ],
            ]
        );
    }
}

if (!function_exists('busy_bee_int_to_word')) {
    function busy_bee_int_to_word($bool): string {
        return $bool ? 'Yes' : 'No';
    }
}
