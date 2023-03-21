<?php 
	get_header(); 
	
	$footer_text = get_field('footer_text', 'option');
?>

	<section class="main-content">
		<div class="logo-holder">
			<div id="logo"></div>
			<?php if ( $footer_text ) : ?>
				<p class="bold"><?php echo $footer_text; ?></p>
			<?php endif; ?>
		</div>
	</section>

<?php get_footer(); ?>