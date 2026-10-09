<?php
/**
 * Orange County Portraits — theme functions.
 *
 * Kept deliberately small: styles, block styles, pattern categories,
 * a few render filters, a fallback meta description, and the one-time
 * setup screen (admin only).
 *
 * @package oc-portraits
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'OCP_VERSION', '1.1.0' );

require_once __DIR__ . '/inc/blocks.php';

if ( is_admin() ) {
	require_once __DIR__ . '/inc/setup.php';
}

/**
 * Theme supports and editor styles.
 */
function ocp_setup() {
	add_theme_support( 'editor-styles' );
	add_editor_style( 'style.css' );
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'after_setup_theme', 'ocp_setup' );

/**
 * Front-end stylesheet.
 */
function ocp_enqueue() {
	wp_enqueue_style( 'oc-portraits', get_stylesheet_uri(), array(), OCP_VERSION );
}
add_action( 'wp_enqueue_scripts', 'ocp_enqueue' );

/**
 * Preload the two body/heading font files (small, used above the fold).
 */
function ocp_preload_fonts() {
	foreach ( array( 'figtree-latin-wght-normal.woff2', 'newsreader-latin-wght-normal.woff2' ) as $file ) {
		printf(
			'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
			esc_url( get_theme_file_uri( 'assets/fonts/' . $file ) )
		);
	}
}
add_action( 'wp_head', 'ocp_preload_fonts', 1 );

/**
 * Block styles selectable in the editor sidebar.
 */
function ocp_block_styles() {
	register_block_style( 'core/button', array( 'name' => 'arrow', 'label' => __( 'Solid with arrow', 'oc-portraits' ) ) );
	register_block_style( 'core/button', array( 'name' => 'outline-arrow', 'label' => __( 'Outline with arrow', 'oc-portraits' ) ) );
	register_block_style( 'core/separator', array( 'name' => 'ocp-short', 'label' => __( 'Short rose rule', 'oc-portraits' ) ) );
}
add_action( 'init', 'ocp_block_styles' );

/**
 * Pattern categories.
 */
function ocp_pattern_categories() {
	register_block_pattern_category( 'oc-portraits', array( 'label' => __( 'OC Portraits: sections', 'oc-portraits' ) ) );
	register_block_pattern_category( 'oc-portraits-pages', array( 'label' => __( 'OC Portraits: full pages', 'oc-portraits' ) ) );
}
add_action( 'init', 'ocp_pattern_categories' );

/**
 * Wordmark: a site title with the class "ocp-wordmark" prints its last word
 * ("Portraits") as a small, letter-spaced second line.
 *
 * @param string $content Block HTML.
 * @param array  $block   Parsed block.
 * @return string
 */
function ocp_wordmark( $content, $block ) {
	$class = isset( $block['attrs']['className'] ) ? $block['attrs']['className'] : '';
	if ( false === strpos( $class, 'ocp-wordmark' ) ) {
		return $content;
	}
	return preg_replace_callback(
		'#(<a[^>]*>)([^<]+)(</a>)#',
		function ( $m ) {
			$words = preg_split( '/\s+/', trim( $m[2] ) );
			if ( count( $words ) < 2 ) {
				return $m[0];
			}
			$last = array_pop( $words );
			return $m[1] . '<span class="ocp-wordmark__main">' . implode( ' ', $words ) . '</span> <span class="ocp-wordmark__last">' . $last . '</span>' . $m[3];
		},
		$content,
		1
	);
}
add_filter( 'render_block_core/site-title', 'ocp_wordmark', 10, 2 );

/**
 * Mark custom navigation links that point at the current page, so the
 * header can underline the active section (and screen readers hear it).
 *
 * @param string $content Block HTML.
 * @param array  $block   Parsed block.
 * @return string
 */
function ocp_nav_current( $content, $block ) {
	if ( empty( $block['attrs']['url'] ) || is_front_page() ) {
		return $content;
	}
	$link_path = untrailingslashit( (string) wp_parse_url( $block['attrs']['url'], PHP_URL_PATH ) );
	$link_host = wp_parse_url( $block['attrs']['url'], PHP_URL_HOST );
	if ( '' === $link_path || ( $link_host && wp_parse_url( home_url(), PHP_URL_HOST ) !== $link_host ) ) {
		return $content;
	}
	$request = untrailingslashit( (string) wp_parse_url( home_url( add_query_arg( array() ) ), PHP_URL_PATH ) );

	// The Blog link also covers single posts and post archives.
	$is_blog_link = ( untrailingslashit( (string) wp_parse_url( get_permalink( get_option( 'page_for_posts' ) ), PHP_URL_PATH ) ) === $link_path );
	$match        = ( $request === $link_path ) || ( $is_blog_link && ( is_singular( 'post' ) || is_category() || is_tag() || is_date() || is_home() ) );

	if ( ! $match || false !== strpos( $content, 'current-menu-item' ) ) {
		return $content;
	}
	$content = preg_replace( '/class="wp-block-navigation-item /', 'class="wp-block-navigation-item current-menu-item ', $content, 1 );
	return preg_replace( '/<a class="wp-block-navigation-item__content"/', '<a class="wp-block-navigation-item__content" aria-current="page"', $content, 1 );
}
add_filter( 'render_block_core/navigation-link', 'ocp_nav_current', 10, 2 );

/**
 * Related posts: the Query block in templates/single.html (queryId 31) shows
 * other posts from the current post's categories, never the current post.
 *
 * @param array    $query Query vars.
 * @param WP_Block $block Post Template block.
 * @return array
 */
function ocp_related_query( $query, $block ) {
	if ( ! isset( $block->context['queryId'] ) || 31 !== (int) $block->context['queryId'] || ! is_singular( 'post' ) ) {
		return $query;
	}
	$post_id               = get_queried_object_id();
	$query['post__not_in'] = array_merge( isset( $query['post__not_in'] ) ? (array) $query['post__not_in'] : array(), array( $post_id ) );
	$cats                  = array_values( array_diff( wp_get_post_categories( $post_id ), array( (int) get_option( 'default_category' ) ) ) );
	if ( $cats ) {
		$query['category__in'] = $cats;
	}
	return $query;
}
add_filter( 'query_loop_block_query_vars', 'ocp_related_query', 10, 2 );

/**
 * Hide a Query block with the class "ocp-hide-when-empty" (including its
 * heading) when it finds no posts.
 *
 * @param string $content Block HTML.
 * @param array  $block   Parsed block.
 * @return string
 */
function ocp_hide_empty_query( $content, $block ) {
	if ( empty( $block['attrs']['className'] ) || false === strpos( $block['attrs']['className'], 'ocp-hide-when-empty' ) ) {
		return $content;
	}
	return preg_match( '/<li[^>]+class="[^"]*\bwp-block-post\b/', $content ) ? $content : '';
}
add_filter( 'render_block_core/query', 'ocp_hide_empty_query', 10, 2 );

/**
 * Remove an empty "recent posts" section wrapper too (the group around the query).
 *
 * @param string $content Block HTML.
 * @param array  $block   Parsed block.
 * @return string
 */
function ocp_hide_empty_section( $content, $block ) {
	if ( empty( $block['attrs']['className'] ) || ! preg_match( '/\bocp-(recent|related)\b/', $block['attrs']['className'] ) ) {
		return $content;
	}
	return false === strpos( $content, 'wp-block-query' ) ? '' : $content;
}
add_filter( 'render_block_core/group', 'ocp_hide_empty_section', 10, 2 );

/**
 * Is a dedicated SEO plugin handling meta tags?
 *
 * @return bool
 */
function ocp_seo_plugin_active() {
	return defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || defined( 'AIOSEO_VERSION' )
		|| defined( 'SEOPRESS_VERSION' ) || defined( 'THE_SEO_FRAMEWORK_VERSION' ) || defined( 'SLIM_SEO_VER' )
		|| ( class_exists( 'Jetpack' ) && method_exists( 'Jetpack', 'is_module_active' ) && Jetpack::is_module_active( 'seo-tools' ) );
}

/**
 * Fallback meta description from the page/post excerpt (Page settings → Excerpt).
 * Skipped automatically when an SEO plugin is active.
 */
function ocp_meta_description() {
	if ( ocp_seo_plugin_active() || ! ( is_singular() || is_front_page() || is_home() ) ) {
		return;
	}
	$post_id = is_home() ? (int) get_option( 'page_for_posts' ) : get_queried_object_id();
	$text    = $post_id && has_excerpt( $post_id ) ? get_the_excerpt( $post_id ) : '';
	if ( ! $text && is_singular( 'post' ) ) {
		$text = wp_trim_words( wp_strip_all_tags( strip_shortcodes( get_post_field( 'post_content', $post_id ) ) ), 28, '…' );
	}
	if ( ! $text && is_front_page() ) {
		$text = get_bloginfo( 'description' );
	}
	if ( $text ) {
		printf( '<meta name="description" content="%s">' . "\n", esc_attr( wp_strip_all_tags( $text ) ) );
	}
}
add_action( 'wp_head', 'ocp_meta_description', 2 );

/**
 * Only the first content image (the hero) loads eagerly; WordPress gives it
 * fetchpriority="high". Everything after it is lazy-loaded.
 *
 * @return int
 */
function ocp_eager_image_count() {
	return 1;
}
add_filter( 'wp_omit_loading_attr_threshold', 'ocp_eager_image_count' );

/**
 * Jetpack sharing buttons, likes and related posts don't belong in this
 * design (the article template has its own related posts).
 */
add_filter( 'sharing_show', '__return_false', 99 );
add_filter( 'wpl_is_likes_visible', '__return_false', 99 );
add_filter( 'jetpack_relatedposts_filter_options', function ( $options ) {
	$options['enabled'] = false;
	return $options;
} );
