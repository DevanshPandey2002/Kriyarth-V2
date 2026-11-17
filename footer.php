</main>
<?php
$ig=get_theme_mod('kr_instagram');
$polas=[['river','t-teal','contours at dusk','-3deg'],['pipes','t-moss','trench, day 3','2deg'],['contour','t-clay','the river bend','-2deg'],['grid','t-ink','first sketch','3deg'],['compass','t-sage','survey stakes','-3deg'],['spiral','t-blush','site notes','2deg']];
$soc=['instagram'=>'kr_instagram','linkedin'=>'kr_linkedin','youtube'=>'kr_youtube','x'=>'kr_x','whatsapp'=>'kr_whatsapp'];
?>
<div class="kr-end">
 <section class="kr-follow">
  <div>
   <h2>Find us in the field.</h2>
   <p>Let's turn a good idea into useful work, together.</p>
   <a class="kr-btn" href="<?php echo esc_url($ig?:kr_url('contact')); ?>"<?php echo $ig?' target="_blank" rel="noopener"':''; ?>><?php echo $ig?'Follow us':'Start a conversation'; ?></a>
  </div>
  <div class="kr-polas" aria-hidden="true">
   <?php foreach($polas as $p): ?>
   <figure class="kr-pola" style="--rot:<?php echo esc_attr($p[3]); ?>"><div class="kr-pola__img <?php echo esc_attr($p[1]); ?>"><?php echo kr_art($p[0]); ?></div><figcaption><?php echo esc_html($p[2]); ?></figcaption></figure>
   <?php endforeach; ?>
  </div>
 </section>

 <footer class="kr-footer">
  <div class="kr-fgrid">
   <div class="kr-fl">
    <div class="kr-flogo" lang="hi">क्रियार्थ</div>
    <p>Join us to hear about new projects, field notes and experiments.</p>
    <form class="kr-sub" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
     <input type="hidden" name="action" value="kr_form"><input type="hidden" name="type" value="sub">
     <?php wp_nonce_field('kr_form','_n'); ?>
     <input class="hp" type="text" name="website" tabindex="-1" autocomplete="off" aria-hidden="true">
     <label class="screen-reader-text" for="kr-sub-email">Email address</label>
     <input id="kr-sub-email" type="email" name="email" placeholder="Your email address" required>
     <button type="submit">Subscribe</button>
    </form>
    <h3 class="kr-soc-h">Socials</h3>
    <div class="kr-soc">
     <?php foreach($soc as $i=>$k){ $u=get_theme_mod($k); if($u) echo '<a href="'.esc_url($u).'" target="_blank" rel="noopener" aria-label="'.esc_attr(ucfirst($i)).'">'.kr_icon($i).'</a>'; } ?>
     <a href="<?php echo esc_url(kr_url('contact')); ?>" aria-label="Contact"><?php echo kr_icon('mail'); ?></a>
    </div>
   </div>
   <div class="kr-fcols">
    <div><h3>Explore</h3><ul>
     <li><a href="<?php echo esc_url(kr_url('work')); ?>">Selected work</a></li>
     <li><a href="<?php echo esc_url(home_url('/#diary')); ?>">Field diary</a></li>
     <li><a href="<?php echo esc_url(home_url('/#notes')); ?>">Field notes</a></li>
     <li><a href="<?php echo esc_url(kr_url('about')); ?>">About Kriyarth</a></li>
    </ul></div>
    <div><h3>Areas</h3><ul>
     <?php foreach(KR_AREAS as $s=>$n) echo '<li><a href="'.esc_url(add_query_arg('area',$s,kr_url('work'))).'">'.esc_html($n).'</a></li>'; ?>
    </ul></div>
    <div><h3>Connect</h3><ul>
     <li><a href="<?php echo esc_url(kr_url('contact')); ?>">Contact</a></li>
     <li><a href="<?php echo esc_url(kr_url('contact')); ?>">Collaborate</a></li>
    </ul></div>
    <div class="kr-fbase kr-fbase--in">
     <span>&copy; <?php echo esc_html(date('Y')); ?> Kriyarth. All rights reserved.</span>
     <span><a href="<?php echo esc_url(get_privacy_policy_url()?:home_url('/privacy-policy/')); ?>">Privacy Policy</a></span>
    </div>
   </div>
  </div>
  <div class="kr-big" aria-hidden="true"><span class="l"><?php echo kr_art('compass'); ?></span><b><?php echo esc_html(get_theme_mod('kr_tagline','Ideas into impact.')); ?></b><span class="r"><?php echo kr_art('compass'); ?></span></div>
 </footer>
</div>
<?php if(isset($_GET['kr'])): ?>
<div class="kr-toast" role="status"><?php echo $_GET['kr']==='ok'?'Thanks — your message is on its way.':'That did not send. Check the email address and try again.'; ?></div>
<?php endif; ?>
<?php wp_footer(); ?>
</body>
</html>
