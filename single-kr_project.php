<?php get_header(); while(have_posts()): the_post(); $p=kr_project(get_the_ID()); ?>
<div class="kr-progress" aria-hidden="true"></div>
<header class="kr-phero s-<?php echo esc_attr($p['art']); ?>"<?php echo $p['thumb']?' style="background-image:url('.esc_url($p['thumb']).')"':''; ?>>
 <?php if(!$p['thumb']): ?><div class="kr-art-bg"><?php echo kr_art($p['art'],'meet'); ?></div><?php endif; ?>
 <p class="kr-tag"><?php echo esc_html($p['status']); ?></p>
 <h1><?php the_title(); ?></h1>
 <?php if($p['blurb']) echo '<p class="kr-phero__lede">'.esc_html($p['blurb']).'</p>'; ?>
</header>
<div class="kr-pbody">
 <aside class="kr-facts">
  <dl>
   <dt>Status</dt><dd><?php echo esc_html($p['status']); ?></dd>
   <?php if($p['area']) echo '<dt>Area</dt><dd>'.esc_html($p['area']).'</dd>'; ?>
   <?php if($p['year']) echo '<dt>Year</dt><dd>'.esc_html($p['year']).'</dd>'; ?>
   <?php if($p['tools']){ echo '<dt>Tools</dt><dd><ul class="kr-chips">'; foreach($p['tools'] as $t) echo '<li>'.esc_html($t).'</li>'; echo '</ul></dd>'; } ?>
  </dl>
  <a class="kr-btn" href="<?php echo esc_url(kr_url('contact')); ?>">Discuss this</a>
 </aside>
 <article class="kr-prose"><?php the_content(); ?></article>
</div>
<?php $more=kr_projects(6,$p['id']); if($more): ?>
<section class="kr-loved kr-loved--more">
 <div class="kr-loved__intro"><h2>More<br><span class="kr-serif">Work</span></h2><a class="kr-btn" href="<?php echo esc_url(kr_url('work')); ?>">See all <?php echo kr_icon('arrow'); ?></a></div>
 <div class="kr-rail-wrap"><div class="kr-rail"><?php foreach($more as $m) get_template_part('template-parts/project-card',null,['p'=>$m]); ?></div>
  <button class="kr-round kr-rail-btn kr-rail-btn--l" type="button" data-rail="-1" aria-label="Scroll back"><?php echo kr_icon('chev-l'); ?></button>
  <button class="kr-round kr-rail-btn kr-rail-btn--r" type="button" data-rail="1" aria-label="Scroll forward"><?php echo kr_icon('chev-r'); ?></button></div>
</section>
<?php endif; endwhile; get_footer();
