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
		<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', '10011mag' ); ?></h2>
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
		/* translators: %s: Post title. */
		sprintf( esc_html__( 'Continue reading %s', '10011mag' ), '<span class="screen-reader-text">' . esc_html( get_the_title( get_the_ID() ) ) . '</span>' )
	);
	return $the_excerpt;
}
add_filter( 'the_excerpt', 'mag10011_continue_reading', 9 );
endif;

/**
 * Prints the post subtitle saved in the Post Options meta box.
 *
 * @param string $tag HTML tag for the subtitle.
 */
function mag10011_entry_subtitle( $tag = 'h3' ) {
	$subtitle = get_post_meta( get_the_ID(), 'bb_sub_title', true );

	if ( '' === $subtitle ) {
		return;
	}

	printf( '<%1$s class="entry-subtitle">%2$s</%1$s>', tag_escape( $tag ), esc_html( $subtitle ) );
}

/**
 * Prints the post author and publish date.
 */
function mag10011_entry_byline() {
	$author = get_the_author();

	printf(
		'<div class="entry-author"><span class="screen-reader-text">%1$s </span><a href="%2$s" title="%3$s" class="author url fn" rel="author">%4$s</a></div>',
		esc_html__( 'Posted by', '10011mag' ),
		esc_url( get_author_posts_url( (int) get_the_author_meta( 'ID' ) ) ),
		/* translators: %s: Author name. */
		esc_attr( sprintf( __( 'Posts by %s', '10011mag' ), $author ) ),
		esc_html( $author )
	);

	printf(
		'<div class="entry-date"><span class="posted-on"><span class="screen-reader-text">%1$s </span><time class="entry-date published" datetime="%2$s">%3$s</time></span></div>',
		esc_html__( 'Posted on', '10011mag' ),
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() )
	);
}

/**
 * Prints links to the post's categories.
 *
 * @param string $separator Text printed between the links.
 */
function mag10011_entry_categories( $separator = ' ' ) {
	$categories = get_the_category();

	if ( empty( $categories ) ) {
		return;
	}

	$links = array();
	foreach ( $categories as $category ) {
		$links[] = sprintf(
			'<a class="entry-primary-category" href="%1$s">%2$s</a>',
			esc_url( get_category_link( $category ) ),
			esc_html( $category->name )
		);
	}

	echo implode( esc_html( $separator ), $links ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Each link is escaped above.
}

/**
 * Prints the published and last-modified dates.
 */
function mag10011_entry_dates() {
	printf(
		'<span class="posted-on"><span class="screen-reader-text">%1$s </span><time class="entry-date published" datetime="%2$s">%3$s</time><time class="updated" datetime="%4$s">%5$s</time></span>',
		esc_html__( 'Posted on', '10011mag' ),
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( DATE_W3C ) ),
		esc_html( get_the_modified_date() )
	);
}

/**
 * Prints the full-width featured header used by featured posts.
 *
 * @param string $title_tag HTML tag for the post title.
 * @param string $separator Text printed between category links.
 */
function mag10011_featured_header( $title_tag = 'h2', $separator = ' — ' ) {
	?>
	<div class="entry-header-background" style="background-image: url(<?php echo esc_url( (string) get_the_post_thumbnail_url( get_the_ID(), 'full' ) ); ?>); height: 723px; margin-left: -407.5px; margin-right: -407.5px;">
		<div class="entry-header-wrapper">
			<div class="entry-header-inner">
				<header id="entry-header" class="entry-header">
					<?php the_title( '<' . tag_escape( $title_tag ) . ' class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></' . tag_escape( $title_tag ) . '>' ); ?>
					<?php mag10011_entry_subtitle(); ?>
					<div class="entry-metadata">
						<?php mag10011_entry_byline(); ?>
					</div>
					<div class="entry-category">
						<?php mag10011_entry_categories( $separator ); ?>
					</div>
				</header>
				<div class="scroll-indicator-wrapper"><a href="#" id="scroll-indicator" class="scroll-indicator"><span class="screen-reader-text"><?php esc_html_e( 'Scroll down to see more content', '10011mag' ); ?></span></a></div>
			</div>
		</div>
		<a class="mobile-image-link" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" aria-hidden="true"></a>
	</div>
	<?php
}
