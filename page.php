<?php get_header(); while(have_posts()): the_post(); ?>
<section class="kr-ahead"><h1 class="kr-h1"><?php the_title(); ?></h1></section>
<section class="kr-sec"><div class="kr-prose"><?php the_content(); ?></div></section>
<?php endwhile; get_footer();
