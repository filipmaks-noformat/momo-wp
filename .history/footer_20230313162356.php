	</div>

	<?php 
		$footer_copyright	= get_field('footer_copyright', 'option');
		$footer_text		= get_field('footer_text', 'option');
		$footer_uen			= get_field('footer_uen', 'option');
	?>

	<footer>
		<nav>
			<ul>
				<?php wp_nav_menu(array('menu' => 'Footer Menu', 'container' => false, 'items_wrap' => '%3$s')); ?>
			</ul>
		</nav>
	</footer>

	<script>
  		var themeUrl = "<?php echo get_stylesheet_directory_uri() ?>";
  	</script>
	
	<?php wp_footer(); ?>

</body>
</html>