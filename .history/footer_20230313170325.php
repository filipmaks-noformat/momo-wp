	</div>

	<?php 
		$footer_copyright	= get_field('footer_copyright', 'option');
		$footer_text		= get_field('footer_text', 'option');
		$footer_uen			= get_field('footer_uen', 'option');
	?>

	<footer>
		<div class="wrapper">
			<div class="holder">

				<?php if ( $footer_copyright ) : ?>
					<p><?php echo $footer_copyright; ?></p>
				<?php endif; ?>
				
				<?php if ( $footer_text ) : ?>
					<p class="bold"><?php echo $footer_text; ?></p>
				<?php endif; ?>

				<?php if ( $footer_uen ) : ?>
					<p><?php echo $footer_uen; ?></p>
				<?php endif; ?>

			</div>
		</div>
	</footer>

	<script>
  		var themeUrl = "<?php echo get_stylesheet_directory_uri() ?>";
  	</script>
	
	<?php wp_footer(); ?>

</body>
</html>