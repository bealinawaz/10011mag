<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package 10011mag
 */

if ( ! function_exists( 'mag10011_comment_nav' ) ) :
/**
 * Display navigation to next/previous comments when applicable.
 *
 * @since Resonar 1.0
 */
function mag10011_comment_nav() {
	// Are there comments to navigate through?
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
	?>
	<nav class="navigation comment-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Comment navigation', '10011mag' ); ?></h2>
		<div class="nav-links">
			<?php
				if ( $prev_link = get_previous_comments_link( __( 'Older Comments', '10011mag' ) ) ) :
					printf( '<div class="nav-previous">%s</div>', $prev_link );
				endif;

				if ( $next_link = get_next_comments_link( __( 'Newer Comments', '10011mag' ) ) ) :
					printf( '<div class="nav-next">%s</div>', $next_link );
				endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .comment-navigation -->
	<?php
	endif;
}
endif;

if ( ! function_exists( 'mag10011_entry_date' ) ) :
/**
 * Prints HTML with meta information for the post date.
 *
 * @since Resonar 1.0
 */
function mag10011_entry_date() {
	if ( is_sticky() && is_home() && ! is_paged() ) {
		printf( '<span class="sticky-post">%s</span>', __( 'Featured', '10011mag' ) );
	}

	if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			get_the_date(),
			esc_attr( get_the_modified_date( 'c' ) ),
			get_the_modified_date()
		);

		printf( '<span class="posted-on"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>',
			_x( 'Posted on', 'Used before publish date.', '10011mag' ),
			esc_url( get_permalink() ),
			$time_string
		);
	}
}
endif;

if ( ! function_exists( 'mag10011_entry_meta' ) ) :
/**
 * Prints HTML with meta information for the categories, tags.
 *
 * @since Resonar 1.0
 */
function mag10011_entry_meta() {
	if ( 'post' == get_post_type() ) {
		$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', '10011mag' ) );
		if ( $categories_list && mag10011_categorized_blog() ) {
			printf( '<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
				_x( 'Categories', 'Used before category names.', '10011mag' ),
				$categories_list
			);
		}

		$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', '10011mag' ) );
		if ( $tags_list && ! is_wp_error( $tags_list ) ) {
			printf( '<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
				_x( 'Tags', 'Used before tag names.', '10011mag' ),
				$tags_list
			);
		}
	}

	if ( 'jetpack-portfolio' == get_post_type() ) {
		global $post;

		$project_types_list = get_the_term_list( $post->ID, 'jetpack-portfolio-type', '', _x( ', ', 'Used between list items, there is a space after the comma.', '10011mag' ), '' );
		if ( $project_types_list ) {
			printf( '<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
				_x( 'Project Types', 'Used before project type names.', '10011mag' ),
				$project_types_list
			);
		}

		$project_tag_list = get_the_term_list( $post->ID, 'jetpack-portfolio-tag', '', _x( ', ', 'Used between list items, there is a space after the comma.', '10011mag' ), '' );
		if ( $project_tag_list ) {
			printf( '<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
				_x( 'Project Tags', 'Used before project tag names.', '10011mag' ),
				$project_tag_list
			);
		}
	}

	if ( is_attachment() && wp_attachment_is_image() ) {
		// Retrieve attachment metadata.
		$metadata = wp_get_attachment_metadata();

		printf( '<span class="full-size-link"><span class="screen-reader-text">%1$s </span><a href="%2$s">%3$s &times; %4$s</a></span>',
			_x( 'Full size', 'Used before full size attachment link.', '10011mag' ),
			esc_url( wp_get_attachment_url() ),
			$metadata['width'],
			$metadata['height']
		);
	}

	if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( 'Leave a comment', '10011mag' ), __( '1 Comment', '10011mag' ), __( '% Comments', '10011mag' ) );
		echo '</span>';
	}

}
endif;

/**
 * Determine whether blog/site has more than one category.
 *
 * @since Resonar 1.0
 *
 * @return bool True of there is more than one category, false otherwise.
 */
function mag10011_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'mag10011_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'mag10011_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so mag10011_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so mag10011_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in {@see mag10011_categorized_blog()}.
 *
 * @since Resonar 1.0
 */
function mag10011_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'mag10011_categories' );
}
add_action( 'edit_category', 'mag10011_category_transient_flusher' );
add_action( 'save_post',     'mag10011_category_transient_flusher' );


if ( ! function_exists( 'mag10011_excerpt_more' ) && ! is_admin() ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ...
 *
 * @since Resonar 1.0
 */
function mag10011_excerpt_more( $more ) {
	return ' &hellip;';
}
add_filter( 'excerpt_more', 'mag10011_excerpt_more' );
endif;

if ( ! function_exists( 'mag10011_continue_reading' ) && ! is_admin() ) :
/**
 * Adds a "Continue reading" link to all instances of the_excerpt
 *
 * @since Resonar 1.0.6
 *
 * @return string The excerpt with a 'Continue reading' link appended.
 */
function mag10011_continue_reading( $the_excerpt ) {
	$the_excerpt = sprintf( '%1$s <a href="%2$s" class="more-link">%3$s</a>',
		$the_excerpt,
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading %s', '10011mag' ), '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>' )
	);
	return $the_excerpt;
}
add_filter( 'the_excerpt', 'mag10011_continue_reading', 9 );
endif;
