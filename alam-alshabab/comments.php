<?php if (post_password_required()) return; ?>
<section class="comments" id="comments">
  <?php if (have_comments()) : ?>
    <h2><?php echo (int) get_comments_number(); ?> تعليق</h2>
    <ol><?php wp_list_comments(['style'=>'ol','avatar_size'=>40]); ?></ol>
    <?php the_comments_pagination(['prev_text'=>'السابق','next_text'=>'التالي']); ?>
  <?php endif;
  comment_form(['title_reply'=>'اكتب تعليقك','label_submit'=>'أرسل التعليق','comment_notes_before'=>'']); ?>
</section>
