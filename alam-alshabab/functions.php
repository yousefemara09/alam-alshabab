<?php
if (!defined('ABSPATH')) exit;

add_action('after_setup_theme', function () {
    load_theme_textdomain('jeel');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', ['search-form','comment-form','comment-list','gallery','caption','style','script']);
    add_theme_support('custom-logo', ['height'=>60,'width'=>200,'flex-width'=>true]);
    add_theme_support('responsive-embeds');
    add_theme_support('align-wide');
    add_image_size('jeel-card', 640, 400, true);
    add_image_size('jeel-hero', 1000, 700, true);
    register_nav_menus(['primary' => 'القائمة الرئيسية', 'footer' => 'قائمة الفوتر']);
});

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('jeel-fonts', 'https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@400;500;700&family=Readex+Pro:wght@500;700;800&display=swap', [], null);
    wp_enqueue_style('jeel-style', get_stylesheet_uri(), ['jeel-fonts'], wp_get_theme()->get('Version'));
    if (is_singular() && comments_open() && get_option('thread_comments')) wp_enqueue_script('comment-reply');
});

add_filter('excerpt_length', fn() => 28);
add_filter('excerpt_more', fn() => '…');

// إنشاء الأقسام الأساسية عند تفعيل الثيم
add_action('after_switch_theme', function () {
    foreach (['الدراسة','الشغل','تطوير الذات','الفريلانس','تكنولوجيا','أخبار الشباب'] as $c) {
        if (!term_exists($c, 'category')) wp_insert_term($c, 'category');
    }
});

function jeel_menu_fallback() {
    echo '<ul>';
    wp_list_categories(['title_li'=>'','number'=>6,'orderby'=>'count','order'=>'DESC','hide_empty'=>false,'exclude'=>get_option('default_category')]);
    echo '</ul>';
}

function jeel_reading_time() {
    $words = str_word_count(strip_tags(get_the_content()), 0, 'ءآأؤإئابةتثجحخدذرزسشصضطظعغفقكلمنهوىي');
    return max(1, (int) ceil($words / 180));
}

// ===== إعلانات جوجل AdSense =====
add_action('customize_register', function ($wp) {
    $wp->add_section('jeel_ads', ['title' => 'إعلانات جوجل (AdSense)', 'priority' => 40,
        'description' => 'الصق معرّف الناشر ومعرّفات الوحدات الإعلانية بعد قبول موقعك في AdSense. أي خانة فاضية = مفيش إعلان في المكان ده.']);
    $f = ['client' => 'معرّف الناشر (ca-pub-XXXXXXXXXXXXXXXX)', 'top' => 'معرّف وحدة: أعلى الصفحة',
          'grid' => 'معرّف وحدة: وسط شبكة المقالات', 'article' => 'معرّف وحدة: داخل المقال (بعد الفقرة الثانية)',
          'end' => 'معرّف وحدة: آخر المقال'];
    foreach ($f as $k => $label) {
        $wp->add_setting('jeel_ad_' . $k, ['default' => '', 'sanitize_callback' => 'sanitize_text_field']);
        $wp->add_control('jeel_ad_' . $k, ['label' => $label, 'section' => 'jeel_ads', 'type' => 'text']);
    }
});

add_action('wp_head', function () {
    $c = get_theme_mod('jeel_ad_client');
    if ($c && !is_customize_preview()) {
        echo '<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=' . esc_attr($c) . '" crossorigin="anonymous"></script>' . "\n";
    }
}, 5);

function jeel_ad($key, $return = false) {
    $c = get_theme_mod('jeel_ad_client');
    $s = get_theme_mod('jeel_ad_' . $key);
    if (!$c || !$s || is_customize_preview()) return '';
    $h = '<div class="ad" aria-label="إعلان"><ins class="adsbygoogle" style="display:block" data-ad-client="' . esc_attr($c) . '" data-ad-slot="' . esc_attr($s) . '" data-ad-format="auto" data-full-width-responsive="true"></ins><script>(adsbygoogle=window.adsbygoogle||[]).push({});</script></div>';
    if ($return) return $h;
    echo $h;
}

add_filter('the_content', function ($content) {
    if (!is_singular('post') || !in_the_loop() || !is_main_query()) return $content;
    $ad = jeel_ad('article', true);
    if (!$ad) return $content;
    $parts = explode('</p>', $content, 3);
    if (count($parts) < 3) return $content;
    return $parts[0] . '</p>' . $parts[1] . '</p>' . $ad . $parts[2];
});
