<?php get_header(); ?>

<ol id="posts">

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <li class="postWrapper" id="post-<?php the_ID(); ?>">

      <h2 class="postTitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
      <small><?php the_date(); ?> by <?php the_author(); ?></small>

      <div class="post"><?php the_content(__('(more...)')); ?></div>
      <p class="postMeta">Category: <?php the_category(', ') . " " . the_tags(__('Tags: '), ', ', ' | ') . comments_popup_link(__('Comments (0)'), __('Comments (1)'), __('Comments (%)')) . edit_post_link(__('Edit'), ' | '); ?></p>

    </li>

    <?php endwhile; ?>

  </ol>

<?php endif; ?>

<?php  get_footer(); ?>