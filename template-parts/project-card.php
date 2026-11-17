<?php $p=$args['p']; ?>
<a class="kr-card" href="<?php echo esc_url($p['url']); ?>" data-area="<?php echo esc_attr($p['area_slug']); ?>">
 <div class="kr-card__media art-<?php echo esc_attr($p['art']); ?>">
  <?php if($p['thumb']) echo '<img src="'.esc_url($p['thumb']).'" alt="" loading="lazy">'; else echo kr_art($p['art']); ?>
  <span class="kr-badge"><?php echo esc_html($p['status']); ?></span>
  <span class="kr-go"><?php echo kr_icon('arrow-ur'); ?></span>
  <?php if(!empty($p['tools'][0])): ?><span class="kr-chip"><?php echo esc_html($p['tools'][0]); ?></span><?php endif; ?>
 </div>
 <div class="kr-card__row"><h3><?php echo esc_html($p['title']); ?></h3><span><?php echo esc_html($p['year']); ?></span></div>
 <p class="kr-card__sub"><?php echo esc_html($p['area']); ?></p>
</a>
