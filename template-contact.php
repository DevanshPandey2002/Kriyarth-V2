<?php /* Template Name: Contact */ get_header(); $em=get_theme_mod('kr_email'); ?>
<section class="kr-ahead kr-contact">
 <div>
  <h1 class="kr-h1">Have a question worth exploring?</h1>
  <p class="kr-lede">Open to thoughtful collaborations across engineering, mapping, research, and visual communication.</p>
  <?php if($em) echo '<p class="kr-lede"><a href="mailto:'.esc_attr($em).'">'.esc_html($em).'</a></p>'; ?>
 </div>
 <form class="kr-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
  <input type="hidden" name="action" value="kr_form"><input type="hidden" name="type" value="msg">
  <?php wp_nonce_field('kr_form','_n'); ?>
  <input class="hp" type="text" name="website" tabindex="-1" autocomplete="off" aria-hidden="true">
  <label class="screen-reader-text" for="c-name">Your name</label><input id="c-name" name="name" placeholder="Your name" required>
  <label class="screen-reader-text" for="c-email">Email address</label><input id="c-email" type="email" name="email" placeholder="Email address" required>
  <label class="screen-reader-text" for="c-msg">Message</label><textarea id="c-msg" name="message" rows="6" placeholder="What would you like to explore?" required></textarea>
  <button class="kr-btn kr-btn--dark" type="submit">Send message</button>
 </form>
</section>
<?php get_footer();
