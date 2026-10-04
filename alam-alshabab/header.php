<!doctype html>
<html lang="ar" dir="rtl">
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip" href="#main">تخطّي إلى المحتوى</a>
<header class="site-head">
  <div class="wrap head-row">
    <a class="brand" href="<?php echo esc_url(home_url('/')); ?>">
      <?php if (has_custom_logo()) { the_custom_logo(); } else { $w=explode(' ',trim(get_bloginfo('name')));$l=array_pop($w);echo esc_html(implode(' ',$w)).($w?' ':'').'<span>'.esc_html($l).'</span>'; } ?>
    </a>
    <button class="menu-btn" aria-expanded="false" aria-controls="nav" onclick="var n=document.getElementById('nav');var o=n.classList.toggle('open');this.setAttribute('aria-expanded',o)">القائمة</button>
    <nav class="nav" id="nav" aria-label="القائمة الرئيسية">
      <?php wp_nav_menu(['theme_location'=>'primary','container'=>false,'fallback_cb'=>'jeel_menu_fallback']); ?>
    </nav>
  </div>
</header>
<main id="main" class="wrap">
<?php jeel_ad('top'); ?>
