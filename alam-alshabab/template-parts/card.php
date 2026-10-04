<?php $cat = get_the_category(); ?>
<article <?php post_class('card'); ?>>
  <a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
    <?php if (has_post_thumbnail()) the_post_thumbnail('jeel-card', ['class'=>'card-img','loading'=>'lazy']); else echo '<div class="card-img"></div>'; ?>
  </a>
  <div class="card-body">
    <?php if ($cat) : ?><a class="tag" href="<?php echo esc_url(get_category_link($cat[0])); ?>"><?php echo esc_html($cat[0]->name); ?></a><?php endif; ?>
    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    <p><?php echo esc_html(get_the_excerpt()); ?></p>
    <div class="meta"><?php echo esc_html(get_the_date()); ?> · قراءة <?php echo jeel_reading_time(); ?> د</div>
  </div>
</article>
