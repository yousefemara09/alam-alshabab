<?php get_header(); while (have_posts()) : the_post(); $cat = get_the_category(); ?>
<article <?php post_class('article'); ?>>
  <?php if ($cat) : ?><a class="tag" href="<?php echo esc_url(get_category_link($cat[0])); ?>"><?php echo esc_html($cat[0]->name); ?></a><?php endif; ?>
  <h1><?php the_title(); ?></h1>
  <div class="meta">بقلم <?php the_author(); ?> · <?php echo esc_html(get_the_date()); ?> · قراءة <?php echo jeel_reading_time(); ?> د</div>
  <?php if (has_post_thumbnail()) the_post_thumbnail('jeel-hero', ['class'=>'feat']); ?>
  <div class="entry"><?php the_content(); wp_link_pages(); ?></div>
  <?php jeel_ad('end'); ?>
  <div class="post-tags"><?php the_tags('', '', ''); ?></div>
  <?php if (comments_open() || get_comments_number()) comments_template(); ?>
</article>
<?php endwhile; get_footer();
