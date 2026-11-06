<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package 10011mag
 */
?>
		<?php get_sidebar(); ?>

	</div><!-- .site-content -->


    

    <footer id="colophon" class="site-footer" role="contentinfo">
        <div class="site-info">
            <div class="blog-info">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
            </div>
            <div class="blog-credits">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="uppercase"><?php bloginfo( 'name' ); ?></a>
			</div>
		</div><!-- .site-info -->
    </footer>
    
</div><!-- .site -->

<?php wp_footer(); ?>
</body>
</html>
