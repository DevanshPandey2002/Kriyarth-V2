<?php get_header(); $ps=kr_projects(); ?>
<section class="kr-ahead">
 <h1 class="kr-h1">Selected work</h1>
 <p class="kr-lede">Personal projects, field lessons and experiments, each with its status made clear.</p>
 <div class="kr-filters" data-filter>
  <button type="button" class="kr-btn is-on" data-f="all">All</button>
  <?php foreach(KR_AREAS as $s=>$n) echo '<button type="button" class="kr-btn" data-f="'.esc_attr($s).'">'.esc_html($n).'</button>'; ?>
 </div>
</section>
<section class="kr-sec"><div class="kr-grid"><?php foreach($ps as $p) get_template_part('template-parts/project-card',null,['p'=>$p]); ?></div></section>
<?php get_footer();
