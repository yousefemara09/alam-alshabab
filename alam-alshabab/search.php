<?php get_header(); ?>
<div class="page-head">
  <h1>نتائج البحث عن: <?php echo esc_html(get_search_query()); ?></h1>
  <?php get_search_form(); ?>
</div>
<?php if (have_posts()) : ?>
  <div class="grid" style="margin-top:24px">
    <?php while (have_posts()) : the_post(); get_template_part('template-parts/card'); endwhile; ?>
  </div>
  <?php the_posts_pagination(['prev_text'=>'السابق','next_text'=>'التالي']);
else : ?><p class="empty">مفيش نتايج. جرّب كلمات تانية.</p><?php endif;
get_footer();
