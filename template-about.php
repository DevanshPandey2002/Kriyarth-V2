<?php /* Template Name: About */ get_header(); ?>
<section class="kr-ahead"><h1 class="kr-h1">An independent creative and engineering practice.</h1><p class="kr-lede">Kriyarth connects engineering thinking, spatial data, and visual communication to make complex ideas easier to understand.</p></section>
<section class="kr-sec" id="approach">
 <h2 class="kr-h2">How we approach a problem</h2>
 <ol class="kr-steps">
  <li><span>1</span><h3>Understand the system</h3><p>Start with the context, the people involved, the available evidence, and the question that actually needs answering.</p></li>
  <li><span>2</span><h3>Find the signal</h3><p>Use engineering logic, spatial data, and structured thinking to identify what matters most.</p></li>
  <li><span>3</span><h3>Make it understandable</h3><p>Turn the insight into a map, visual, documented workflow, or digital experience that helps people act.</p></li>
 </ol>
</section>
<section class="kr-sec">
 <h2 class="kr-h2">Tools and technologies</h2>
 <ul class="kr-chips kr-chips--lg"><li>AutoCAD</li><li>QGIS</li><li>Microsoft Excel</li><li>GIS &amp; spatial analysis</li><li>Quantity estimation</li><li>Technical documentation</li><li>Data visualisation</li></ul>
</section>
<?php while(have_posts()){ the_post(); if(get_the_content()) echo '<section class="kr-sec"><div class="kr-prose">'.apply_filters('the_content',get_the_content()).'</div></section>'; } ?>
<?php get_footer();
