<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Nisarg
 */
?>
	</div><!-- #content -->
	<footer id="colophon" class="site-footer" role="contentinfo">
	<!-- ajout de d'une nouvelle zone widget  -->
	 <?php if ( is_active_sidebar( 'new-widget-area' ) ) : ?>
	 <div id="footer-widget-area" class="nwa-footer-widget widget-area" role="complementary">
	 <?php dynamic_sidebar( 'new-widget-area' ); ?>
 	</div>
 <?php endif; ?>
 <!-- fin nouvelle widget area -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
