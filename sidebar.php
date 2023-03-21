<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package wordpress
 */

if (!is_active_sidebar('sidebar-1')) {
	return;
}
?>

	<?php
	$popular = new WP_Query(array(
		'post_type' => 'post',
		'posts_per_page' => 3,
		'meta_key' => 'popular_posts',
		'orderby' => 'meta_value_num',
		'order' => 'DESC'
	));
	if ($popular->have_posts()) : ?>
		<div class="widget">
			<h3>Most popular</h3>
			<ul class="aside-post-list">
				<?php while ($popular->have_posts()) : $popular->the_post(); ?>
					<li>
						<?php $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'thumbnail'); ?>
						<a href="<?php the_permalink(); ?>">
							 <?php if ( has_post_thumbnail() ) { ?>
							<figure class="has-image">
								<img src="<?php echo $featured_img_url; ?>" alt="<?php the_title(); ?>">
							</figure>
							 <?php } else { ?>
							<figure>
								<img src="<?php echo get_template_directory_uri() ?>/pictures/img-blog-placehoder-thumb.png" alt="<?php the_title(); ?>">
							</figure>
							 <?php } ?>
						</a>
						<hgroup>
							<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
							<p class="meta"><?php the_time('jS F Y'); ?></p>
						</hgroup>
					</li>
				<?php endwhile; ?>
			</ul>
			<a href="<?php bloginfo('url'); ?>/popular-posts/" class="link-more">View All</a>
		</div>
	<?php endif; wp_reset_postdata(); ?>

	<div class="widget insta">

		<h3>Instagram</h3>
		<?php echo do_shortcode('[instagram-feed]'); ?>
		<a href="https://www.instagram.com/nexitapp/" target="_blank" class="link-more">Visit Our Profile</a>

	</div>

	<div class="widget tags">

		<h3>Tags</h3>

		<?php
		$tags = get_tags(array(
			'hide_empty' => true,
			'orderby' => 'count',
			'number' => 30
		));
		echo '<ul class="tag-list">';
		foreach ($tags as $tag) {
			echo '<li><a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a></li>';
		}
		echo '</ul>';
		?>

	</div>
