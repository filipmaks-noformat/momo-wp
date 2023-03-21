<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <div class="postWrapper" id="post-<?php the_ID(); ?>">

      <h1 class="postTitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>
      <?php echo get_avatar( $comment, 32 ); ?>  
      <small><?php the_date(); ?> by <?php the_author(); ?></small>

      <div class="post"><?php the_content(__('(more...)')); ?></div>
      <p class="postMeta">Category: <?php the_category(', ') . " " . the_tags(__('Tags: '), ', ', ' | ') . edit_post_link(__('Edit'), ''); ?></p>

    </div>

<?php endwhile; endif; ?>

<?php get_footer(); ?>