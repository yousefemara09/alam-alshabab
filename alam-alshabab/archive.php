<?php get_header(); ?>
<div class="page-head">
  <h1><?php the_archive_title(); ?></h1>
  <?php the_archive_description('<p class="meta">','</p>'); ?>
</div>
<?php if (have_posts()) : ?>
  <div class="grid" style="margin-top:24px">
    <?php $i = 0; while (have_posts()) : the_post(); get_template_part('template-parts/card'); if (++$i === 6) jeel_ad('grid'); endwhile; ?>
  </div>
  <?php the_posts_pagination(['prev_text'=>'السابق','next_text'=>'التالي']);
else : ?><p class="empty">مفيش مقالات في القسم ده لسه.</p><?php endif;
get_footer();
