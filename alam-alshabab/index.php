<?php get_header();
$show_hero = is_home() && !is_paged() && have_posts();
if ($show_hero) :
  the_post();
  $img = get_the_post_thumbnail_url(null, 'jeel-hero'); ?>
  <section class="hero">
    <div class="hero-body">
      <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      <p><?php echo esc_html(get_the_excerpt()); ?></p>
      <a class="btn" href="<?php the_permalink(); ?>">اقرأ المقال</a>
    </div>
    <div class="hero-img" <?php if ($img) echo 'style="background-image:url(' . esc_url($img) . ')"'; ?>></div>
  </section>
  <nav class="cats" aria-label="الأقسام">
    <?php foreach (get_categories(['hide_empty'=>false,'exclude'=>get_option('default_category')]) as $c) : ?>
      <a href="<?php echo esc_url(get_category_link($c)); ?>"><?php echo esc_html($c->name); ?></a>
    <?php endforeach; ?>
  </nav>
  <h2 class="sec-title">أحدث المقالات</h2>
<?php endif;
if (have_posts()) : ?>
  <div class="grid">
    <?php $i = 0; while (have_posts()) : the_post(); get_template_part('template-parts/card'); if (++$i === 6) jeel_ad('grid'); endwhile; ?>
  </div>
  <?php the_posts_pagination(['prev_text'=>'السابق','next_text'=>'التالي']);
elseif (!$show_hero) : ?>
  <p class="empty">مفيش مقالات هنا لسه.</p>
<?php endif;
get_footer();
