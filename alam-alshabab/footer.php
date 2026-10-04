</main>
<footer class="site-foot">
  <div class="wrap foot-row">
    <div>© <?php echo date('Y'); ?> <?php bloginfo('name'); ?> — <?php bloginfo('description'); ?></div>
    <?php wp_nav_menu(['theme_location'=>'footer','container'=>false,'fallback_cb'=>false]); ?>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
