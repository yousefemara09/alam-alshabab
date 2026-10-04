<form role="search" class="search-form" method="get" action="<?php echo esc_url(home_url('/')); ?>">
  <input type="search" name="s" value="<?php echo esc_attr(get_search_query()); ?>" placeholder="ابحث في المقالات" aria-label="بحث">
  <button type="submit">بحث</button>
</form>
