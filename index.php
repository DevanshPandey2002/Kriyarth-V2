<?php get_header(); ?>
<section class="kr-ahead"><h1 class="kr-h1"><?php echo is_search()?'Search: '.esc_html(get_search_query()):'Latest'; ?></h1></section>
<section class="kr-sec">
<?php if(have_posts()): while(have_posts()): the_post(); ?>
 <article class="kr-post"><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><div class="kr-prose"><?php the_excerpt(); ?></div></article>
<?php endwhile; the_posts_pagination(); else: ?>
 <p class="kr-lede">Nothing found. Try a different search.</p>
<?php endif; ?>
</section>
<?php get_footer();
