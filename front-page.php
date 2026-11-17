<?php
get_header();
$ps=kr_projects();
$slides=[['line'=>'Engineering, data and ideas','title'=>'Ideas into impact','sub'=>'Kriyarth','url'=>kr_url('work'),'cta'=>'Explore work','art'=>'river','art2'=>'contour','thumb'=>'']];
$a2=['compass','spiral','compass'];
foreach(array_slice($ps,0,3) as $i=>$p) $slides[]=['line'=>$p['area']?:'Selected work','title'=>$p['title'],'sub'=>$p['status'],'url'=>$p['url'],'cta'=>'View project','art'=>$p['art'],'art2'=>$a2[$i],'thumb'=>$p['thumb']];
$tile_art=['gis-spatial'=>'river','water-systems'=>'pipes','environment'=>'contour','digital-systems'=>'grid'];
?>
<section class="kr-hero" data-hero aria-roledescription="carousel" aria-label="Featured work">
 <?php foreach($slides as $i=>$s): $h=$i?'h2':'h1'; ?>
 <div class="kr-slide s-<?php echo esc_attr($s['art']); ?><?php echo $i?'':' is-active'; ?>"<?php echo $s['thumb']?' style="background-image:url('.esc_url($s['thumb']).')"':''; ?>>
  <?php if(!$s['thumb']): ?>
  <div class="kr-slide__art l"><?php echo kr_art($s['art'],'meet'); ?></div>
  <div class="kr-slide__art r"><?php echo kr_art($s['art2'],'meet'); ?></div>
  <?php endif; ?>
  <div class="kr-slide__copy">
   <p class="kr-slide__line"><?php echo esc_html($s['line']); ?></p>
   <<?php echo $h; ?> class="kr-slide__title"><?php echo esc_html($s['title']); ?></<?php echo $h; ?>>
   <p class="kr-slide__sub"><?php echo esc_html($s['sub']); ?></p>
  </div>
  <a class="kr-btn kr-btn--ghost" href="<?php echo esc_url($s['url']); ?>"><?php echo esc_html($s['cta']); ?></a>
 </div>
 <?php endforeach; ?>
 <div class="kr-hero__nav">
  <button class="kr-round" type="button" data-prev aria-label="Previous slide"><?php echo kr_icon('chev-l'); ?></button>
  <button class="kr-round" type="button" data-next aria-label="Next slide"><?php echo kr_icon('chev-r'); ?></button>
 </div>
 <div class="kr-hero__dots"></div>
</section>

<section class="kr-tiles" aria-label="Areas of work">
 <?php foreach(KR_AREAS as $slug=>$name): ?>
 <a class="kr-tile" href="<?php echo esc_url(add_query_arg('area',$slug,kr_url('work'))); ?>"><?php echo kr_art($tile_art[$slug]); ?><span class="kr-pill"><?php echo esc_html($name); ?> <?php echo kr_icon('arrow'); ?></span></a>
 <?php endforeach; ?>
</section>

<section class="kr-loved">
 <svg class="kr-doodle" viewBox="0 0 300 300" fill="none" stroke="currentColor" stroke-width="3" stroke-dasharray="14 12" stroke-linecap="round" aria-hidden="true"><path d="M10 290C80 240 150 270 160 200S120 130 90 170 170 240 230 130"/></svg>
 <div class="kr-loved__intro">
  <h2>Work<br><span class="kr-serif">Worth</span><br>Exploring</h2>
  <p>Personal projects and professional experience, each labelled honestly.</p>
  <a class="kr-btn" href="<?php echo esc_url(kr_url('work')); ?>">See all <?php echo kr_icon('arrow'); ?></a>
 </div>
 <div class="kr-rail-wrap">
  <div class="kr-rail"><?php foreach($ps as $p) get_template_part('template-parts/project-card',null,['p'=>$p]); ?></div>
  <button class="kr-round kr-rail-btn kr-rail-btn--l" type="button" data-rail="-1" aria-label="Scroll back"><?php echo kr_icon('chev-l'); ?></button>
  <button class="kr-round kr-rail-btn kr-rail-btn--r" type="button" data-rail="1" aria-label="Scroll forward"><?php echo kr_icon('chev-r'); ?></button>
 </div>
</section>

<section class="kr-diary" id="diary">
 <h2>The <span>Field Diary</span></h2>
 <div class="kr-board-scroll"><div class="kr-board"><?php get_template_part('template-parts/diary-board'); ?></div></div>
</section>

<section class="kr-notes" id="notes">
 <div class="kr-notes__head"><h2>Real places. Real data.</h2><p>Drop your map. Tag <strong>@kriyarth</strong>. Get featured here.</p></div>
 <div class="kr-mosaic">
 <?php
 $tiles=[['a','img','river','t-teal'],['b','img','pipes','t-moss'],['c','pat','compass','t-sage'],['d','img','contour','t-clay'],['e','img','grid','t-ink'],['f','img','river','t-sand'],['g','img','contour','t-teal'],['h','pat','spiral','t-blush'],['i','img','pipes','t-ink'],['j','img','grid','t-moss'],['k','pat','compass','t-sage'],['l','img','river','t-clay']];
 $n=0;
 foreach($tiles as $t){
  $img='';
  if($t[1]==='img'){ $n++; if($n<=8) $img=get_theme_mod("kr_tile_$n"); }
  echo '<figure class="kr-m kr-m--'.esc_attr($t[0]).' '.esc_attr($t[3]).'">'.($img?'<img src="'.esc_url($img).'" alt="" loading="lazy">':kr_art($t[2])).'</figure>';
 }
 ?>
 </div>
</section>
<?php get_footer();
