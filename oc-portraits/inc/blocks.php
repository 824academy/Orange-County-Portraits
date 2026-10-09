<?php
/**
 * Small helpers that print static block markup for the theme's patterns.
 *
 * Everything returned here is ordinary block markup; once a pattern is
 * inserted into a page it is plain, editable content in the database.
 *
 * @package oc-portraits
 */

/**
 * Site-relative URL helper.
 *
 * @param string $path Path such as "/families/".
 * @return string
 */
function ocp_url( $path = '/' ) {
	return esc_url( home_url( $path ) );
}

/**
 * Contact page URL with the inquiry type preselected (Contact Form 7 "default:get").
 *
 * @param string $type One of the inquiry type labels.
 * @return string
 */
function ocp_inquiry_url( $type = '' ) {
	$url = home_url( '/contact/' );
	if ( $type ) {
		$url = add_query_arg( 'inquiry-type', rawurlencode( $type ), $url );
	}
	return esc_url( $url );
}

/**
 * Image placement data.
 *
 * @return array
 */
function ocp_image_slots() {
	static $slots = null;
	if ( null === $slots ) {
		$slots = require __DIR__ . '/image-slots.php';
	}
	return $slots;
}

/**
 * Labelled placeholder image block. Replace via the block toolbar → Replace.
 *
 * @param string $slot  Key from inc/image-slots.php.
 * @param array  $args  Optional: ratio (CSS aspect ratio), class.
 * @return string
 */
function ocp_image( $slot, $args = array() ) {
	$slots = ocp_image_slots();
	$data  = isset( $slots[ $slot ] ) ? $slots[ $slot ] : array( 'id' => '?', 'place' => $slot, 'ratio' => '3/2' );
	$ratio = isset( $args['ratio'] ) ? $args['ratio'] : $data['ratio'];
	$class = trim( 'ocp-placeholder ' . ( isset( $args['class'] ) ? $args['class'] : '' ) );
	$src   = esc_url( get_theme_file_uri( 'assets/placeholders/' . $slot . '.svg' ) );
	$alt   = esc_attr( sprintf( 'Photo placeholder %1$s (%2$s) – replace with your own photograph', $data['id'], $data['place'] ) );

	$attrs = wp_json_encode(
		array(
			'aspectRatio'     => $ratio,
			'scale'           => 'cover',
			'linkDestination' => 'none',
			'className'       => $class,
		),
		JSON_UNESCAPED_SLASHES
	);

	return '<!-- wp:image ' . $attrs . ' -->' . "\n"
		. '<figure class="wp-block-image ' . esc_attr( $class ) . '"><img src="' . $src . '" alt="' . $alt . '" style="aspect-ratio:' . esc_attr( $ratio ) . ';object-fit:cover"/></figure>' . "\n"
		. '<!-- /wp:image -->';
}

/**
 * Small uppercase label above a heading.
 *
 * @param string $text  Label.
 * @param bool   $center Center aligned.
 * @return string
 */
function ocp_eyebrow( $text, $center = false ) {
	if ( $center ) {
		return '<!-- wp:paragraph {"align":"center","className":"ocp-eyebrow"} -->' . "\n"
			. '<p class="has-text-align-center ocp-eyebrow">' . $text . '</p>' . "\n"
			. '<!-- /wp:paragraph -->';
	}
	return '<!-- wp:paragraph {"className":"ocp-eyebrow"} -->' . "\n"
		. '<p class="ocp-eyebrow">' . $text . '</p>' . "\n"
		. '<!-- /wp:paragraph -->';
}

/**
 * Short dusty-rose rule.
 *
 * @return string
 */
function ocp_rule() {
	return '<!-- wp:separator {"className":"ocp-rule"} -->' . "\n"
		. '<hr class="wp-block-separator has-alpha-channel-opacity ocp-rule"/>' . "\n"
		. '<!-- /wp:separator -->';
}

/**
 * Heading block.
 *
 * @param string $text   Heading text.
 * @param int    $level  1–6.
 * @param array  $args   Optional: center (bool), size (font size slug).
 * @return string
 */
function ocp_heading( $text, $level = 2, $args = array() ) {
	$attrs   = array();
	$classes = array( 'wp-block-heading' );
	if ( ! empty( $args['center'] ) ) {
		$attrs['textAlign'] = 'center';
		$classes[]          = 'has-text-align-center';
	}
	if ( 2 !== $level ) {
		$attrs['level'] = $level;
	}
	if ( ! empty( $args['size'] ) ) {
		$attrs['fontSize'] = $args['size'];
		$classes[]         = 'has-' . $args['size'] . '-font-size';
	}
	$json = $attrs ? ' ' . wp_json_encode( $attrs ) : '';
	return '<!-- wp:heading' . $json . ' -->' . "\n"
		. '<h' . $level . ' class="' . implode( ' ', $classes ) . '">' . $text . '</h' . $level . '>' . "\n"
		. '<!-- /wp:heading -->';
}

/**
 * Paragraph block.
 *
 * @param string $text  HTML allowed.
 * @param array  $args  Optional: center (bool), class, size.
 * @return string
 */
function ocp_p( $text, $args = array() ) {
	$attrs   = array();
	$classes = array();
	if ( ! empty( $args['center'] ) ) {
		$attrs['align'] = 'center';
		$classes[]      = 'has-text-align-center';
	}
	if ( ! empty( $args['class'] ) ) {
		$attrs['className'] = $args['class'];
		$classes[]          = $args['class'];
	}
	if ( ! empty( $args['size'] ) ) {
		$attrs['fontSize'] = $args['size'];
		$classes[]         = 'has-' . $args['size'] . '-font-size';
	}
	$json  = $attrs ? ' ' . wp_json_encode( $attrs ) : '';
	$class = $classes ? ' class="' . implode( ' ', $classes ) . '"' : '';
	return '<!-- wp:paragraph' . $json . ' -->' . "\n<p" . $class . '>' . $text . "</p>\n<!-- /wp:paragraph -->";
}

/**
 * Buttons block.
 *
 * @param array  $buttons List of [ text, url, style ] (style: arrow|outline|outline-arrow|'').
 * @param string $justify left|center.
 * @return string
 */
function ocp_buttons( $buttons, $justify = 'left' ) {
	$layout = 'center' === $justify ? ' {"layout":{"type":"flex","justifyContent":"center"}}' : '';
	$out    = '<!-- wp:buttons' . $layout . ' -->' . "\n" . '<div class="wp-block-buttons">';
	foreach ( $buttons as $button ) {
		$style = isset( $button[2] ) ? $button[2] : 'arrow';
		$attrs = $style ? ' {"className":"is-style-' . $style . '"}' : '';
		$class = $style ? ' is-style-' . $style : '';
		$out  .= '<!-- wp:button' . $attrs . ' -->' . "\n"
			. '<div class="wp-block-button' . $class . '"><a class="wp-block-button__link wp-element-button" href="' . $button[1] . '">' . $button[0] . '</a></div>' . "\n"
			. '<!-- /wp:button -->';
	}
	return $out . "</div>\n<!-- /wp:buttons -->";
}

/**
 * Open a full-width section group.
 *
 * @param string $bg      Palette slug or '' for white.
 * @param string $class   Extra class.
 * @param string $pad     Spacing preset for top/bottom padding.
 * @param string $text    Text colour palette slug or ''.
 * @return string
 */
function ocp_section_open( $bg = '', $class = '', $pad = '60', $text = '' ) {
	$attrs = array(
		'align' => 'full',
		'style' => array(
			'spacing' => array(
				'padding' => array(
					'top'    => 'var:preset|spacing|' . $pad,
					'bottom' => 'var:preset|spacing|' . $pad,
				),
				'margin'  => array(
					'top'    => '0',
					'bottom' => '0',
				),
			),
		),
	);
	$classes = array( 'wp-block-group', 'alignfull' );
	if ( $bg ) {
		$attrs['backgroundColor'] = $bg;
		$classes[]                = 'has-' . $bg . '-background-color';
		$classes[]                = 'has-background';
	}
	if ( $text ) {
		$attrs['textColor'] = $text;
		$classes[]          = 'has-' . $text . '-color';
		$classes[]          = 'has-text-color';
	}
	if ( $class ) {
		$attrs['className'] = $class;
		$classes[]          = $class;
	}
	$attrs['layout'] = array( 'type' => 'constrained' );
	return '<!-- wp:group ' . wp_json_encode( $attrs ) . ' -->' . "\n"
		. '<div class="' . implode( ' ', $classes ) . '" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--' . $pad . ');padding-bottom:var(--wp--preset--spacing--' . $pad . ')">';
}

/**
 * Close a section group.
 *
 * @return string
 */
function ocp_section_close() {
	return "</div>\n<!-- /wp:group -->";
}

/**
 * Columns wrapper (wide).
 *
 * @param string $class   Extra class.
 * @param string $valign  Vertical alignment (center|top|'').
 * @param string $gap     Spacing preset for the horizontal gap.
 * @return string
 */
function ocp_columns_open( $class = '', $valign = 'center', $gap = '50' ) {
	$attrs   = array( 'align' => 'wide' );
	$classes = array( 'wp-block-columns', 'alignwide' );
	if ( $valign ) {
		$attrs['verticalAlignment'] = $valign;
		$classes[]                  = 'are-vertically-aligned-' . $valign;
	}
	if ( $class ) {
		$attrs['className'] = $class;
		$classes[]          = $class;
	}
	$attrs['style'] = array(
		'spacing' => array(
			'blockGap' => array(
				'top'  => 'var:preset|spacing|40',
				'left' => 'var:preset|spacing|' . $gap,
			),
		),
	);
	return '<!-- wp:columns ' . wp_json_encode( $attrs ) . ' -->' . "\n" . '<div class="' . implode( ' ', $classes ) . '">';
}

/**
 * Close columns.
 *
 * @return string
 */
function ocp_columns_close() {
	return "</div>\n<!-- /wp:columns -->";
}

/**
 * Open a column.
 *
 * @param string $width   Flex basis, e.g. "50%" or ''.
 * @param string $valign  Vertical alignment.
 * @param string $extra   Optional: 'card' for a pale-sage card column.
 * @return string
 */
function ocp_column_open( $width = '', $valign = '', $extra = '' ) {
	$attrs   = array();
	$classes = array( 'wp-block-column' );
	$style   = '';
	if ( $valign ) {
		$attrs['verticalAlignment'] = $valign;
		$classes[]                  = 'is-vertically-aligned-' . $valign;
	}
	if ( $width ) {
		$attrs['width'] = $width;
		$style          = ' style="flex-basis:' . $width . '"';
	}
	$json = $attrs ? ' ' . wp_json_encode( $attrs ) : '';
	return '<!-- wp:column' . $json . ' -->' . "\n" . '<div class="' . implode( ' ', $classes ) . '"' . $style . '>';
}

/**
 * Close a column.
 *
 * @return string
 */
function ocp_column_close() {
	return "</div>\n<!-- /wp:column -->";
}

/**
 * Plain group (flow layout), optionally coloured and padded — used for cards.
 *
 * @param string $bg     Palette slug or ''.
 * @param string $class  Extra class.
 * @param string $pad    Spacing preset for all-round padding or ''.
 * @return string
 */
function ocp_group_open( $bg = '', $class = '', $pad = '' ) {
	$attrs   = array();
	$classes = array( 'wp-block-group' );
	$style   = '';
	if ( $class ) {
		$attrs['className'] = $class;
		$classes[]          = $class;
	}
	if ( $bg ) {
		$attrs['backgroundColor'] = $bg;
		$classes[]                = 'has-' . $bg . '-background-color';
		$classes[]                = 'has-background';
	}
	if ( $pad ) {
		$v              = 'var:preset|spacing|' . $pad;
		$attrs['style'] = array(
			'spacing' => array(
				'padding' => array(
					'top'    => $v,
					'bottom' => $v,
					'left'   => $v,
					'right'  => $v,
				),
			),
		);
		$css   = 'var(--wp--preset--spacing--' . $pad . ')';
		$style = ' style="padding-top:' . $css . ';padding-right:' . $css . ';padding-bottom:' . $css . ';padding-left:' . $css . '"';
	}
	$attrs['layout'] = array( 'type' => 'default' );
	return '<!-- wp:group ' . wp_json_encode( $attrs ) . ' -->' . "\n" . '<div class="' . implode( ' ', $classes ) . '"' . $style . '>';
}

/**
 * Close a plain group.
 *
 * @return string
 */
function ocp_group_close() {
	return "</div>\n<!-- /wp:group -->";
}

/**
 * Centered sage title band (Contact, About, Blog mockups).
 *
 * @param string $title    H1 text.
 * @param string $subtitle Letter-spaced line under the title.
 * @param string $eyebrow  Optional label above.
 * @return string
 */
function ocp_title_band( $title, $subtitle = '', $eyebrow = '' ) {
	$out = ocp_section_open( 'sage', 'ocp-title-band', '50' );
	if ( $eyebrow ) {
		$out .= ocp_eyebrow( $eyebrow, true );
	}
	$out .= ocp_heading( $title, 1, array( 'center' => true ) );
	if ( $subtitle ) {
		$out .= ocp_p( $subtitle, array( 'center' => true, 'class' => 'ocp-eyebrow' ) );
	}
	$out .= ocp_rule();
	return $out . ocp_section_close();
}

/**
 * Split hero: sage text panel + photograph (Experience & Photographers mockups).
 *
 * @param string $title     H1.
 * @param string $intro     Short paragraph or subtitle.
 * @param string $slot      Image slot key.
 * @param array  $buttons   Optional buttons for ocp_buttons().
 * @param string $eyebrow   Optional label above the heading.
 * @return string
 */
function ocp_split_hero( $title, $intro, $slot, $buttons = array(), $eyebrow = '' ) {
	$out  = '<!-- wp:group {"align":"full","backgroundColor":"sage","className":"ocp-hero","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"0","bottom":"0","left":"0","right":"0"}}},"layout":{"type":"default"}} -->' . "\n";
	$out .= '<div class="wp-block-group alignfull ocp-hero has-sage-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">';
	$out .= '<!-- wp:columns {"className":"ocp-hero-split","style":{"spacing":{"blockGap":{"top":"0","left":"0"}}}} -->' . "\n" . '<div class="wp-block-columns ocp-hero-split">';
	$out .= '<!-- wp:column {"verticalAlignment":"center","width":"50%","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"clamp(1rem, 6vw, 5.5rem)","right":"var:preset|spacing|50"}}}} -->' . "\n";
	$out .= '<div class="wp-block-column is-vertically-aligned-center" style="padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--60);padding-left:clamp(1rem, 6vw, 5.5rem);flex-basis:50%">';
	if ( $eyebrow ) {
		$out .= ocp_eyebrow( $eyebrow );
	}
	$out .= ocp_heading( $title, 1 );
	$out .= ocp_rule();
	$out .= ocp_p( $intro, array( 'size' => 'large' ) );
	if ( $buttons ) {
		$out .= ocp_buttons( $buttons );
	}
	$out .= ocp_column_close();
	$out .= ocp_column_open( '50%' );
	$out .= ocp_image( $slot );
	$out .= ocp_column_close();
	$out .= ocp_columns_close();
	return $out . ocp_group_close();
}

/**
 * Forest inquiry band used at the end of pages.
 *
 * @param string $heading  Heading.
 * @param string $sub      Letter-spaced subtitle.
 * @param string $button   Button text.
 * @param string $url      Button URL.
 * @return string
 */
function ocp_inquiry_band( $heading = 'Plan your session', $sub = 'Families, children, motherhood &amp; maternity — studio or outdoors', $button = 'Start an inquiry', $url = '' ) {
	$url  = $url ? $url : ocp_inquiry_url();
	$out  = ocp_section_open( 'forest', 'ocp-inquiry-band', '50', 'white' );
	$out .= '<!-- wp:heading {"textAlign":"center","textColor":"white"} -->' . "\n" . '<h2 class="wp-block-heading has-text-align-center has-white-color has-text-color">' . $heading . '</h2>' . "\n" . '<!-- /wp:heading -->';
	if ( $sub ) {
		$out .= ocp_p( $sub, array( 'center' => true, 'class' => 'ocp-eyebrow' ) );
	}
	$out .= ocp_buttons( array( array( $button, $url, 'outline-arrow' ) ), 'center' );
	return $out . ocp_section_close();
}

/**
 * Up to three recent posts. The whole section is removed on the front end
 * when there are no published posts (see functions.php).
 *
 * @param string $heading Heading above the posts.
 * @return string
 */
function ocp_recent_posts( $heading = 'From the Portrait Journal' ) {
	$out  = ocp_section_open( '', 'ocp-recent', '60' );
	$out .= '<!-- wp:query {"queryId":11,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"align":"wide","className":"ocp-hide-when-empty"} -->' . "\n";
	$out .= '<div class="wp-block-query alignwide ocp-hide-when-empty">';
	$out .= ocp_eyebrow( 'Blog', true );
	$out .= ocp_heading( $heading, 2, array( 'center' => true ) );
	$out .= '<!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"grid","columnCount":3}} -->' . "\n";
	$out .= '<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"3/2"} /-->' . "\n";
	$out .= '<!-- wp:post-title {"level":3,"isLink":true,"fontSize":"large"} /-->' . "\n";
	$out .= '<!-- wp:post-excerpt {"excerptLength":22} /-->' . "\n";
	$out .= '<!-- /wp:post-template -->';
	$out .= ocp_p( '<a href="' . ocp_url( '/blog/' ) . '">Visit the blog</a>', array( 'center' => true, 'class' => 'ocp-arrow-link' ) );
	$out .= "</div>\n<!-- /wp:query -->";
	return $out . ocp_section_close();
}

/**
 * Two-column section: image beside text.
 *
 * @param string $slot        Image slot key.
 * @param string $inner       Block markup for the text column.
 * @param bool   $image_left  Image first (left on desktop).
 * @param string $bg          Background palette slug or ''.
 * @param string $anchor      Optional HTML id for the section.
 * @return string
 */
function ocp_image_text( $slot, $inner, $image_left = true, $bg = '', $anchor = '' ) {
	$out = ocp_section_open( $bg, '', '60' );
	if ( $anchor ) {
		$out = preg_replace( '/^<!-- wp:group \{/', '<!-- wp:group {"anchor":"' . $anchor . '",', $out );
		$out = str_replace( '<div class="wp-block-group alignfull', '<div id="' . $anchor . '" class="wp-block-group alignfull', $out );
	}
	$image = ocp_column_open( '50%' ) . ocp_image( $slot ) . ocp_column_close();
	$text  = ocp_column_open( '50%' ) . $inner . ocp_column_close();
	$out  .= ocp_columns_open( '', 'center', '60' );
	$out  .= $image_left ? $image . $text : $text . $image;
	$out  .= ocp_columns_close();
	return $out . ocp_section_close();
}

/**
 * Row of photographs (2–3), no captions.
 *
 * @param array $slots Image slot keys.
 * @return string
 */
function ocp_photo_row( $slots ) {
	$out = ocp_section_open( '', 'ocp-photo-row', '50' ) . ocp_columns_open( '', '', '30' );
	foreach ( $slots as $slot ) {
		$out .= ocp_column_open() . ocp_image( $slot ) . ocp_column_close();
	}
	return $out . ocp_columns_close() . ocp_section_close();
}

/**
 * Card: image, heading, text, arrow link.
 *
 * @param string $slot   Image slot key ('' for no image).
 * @param string $title  Heading (h3).
 * @param string $text   Paragraph.
 * @param string $link   Link text.
 * @param string $url    Link URL.
 * @return string
 */
function ocp_card( $slot, $title, $text, $link = '', $url = '' ) {
	$out  = ocp_column_open();
	$out .= ocp_group_open( '', 'ocp-card' );
	if ( $slot ) {
		$out .= ocp_image( $slot );
	}
	$out .= ocp_heading( $title, 3 );
	$out .= ocp_p( $text );
	if ( $link ) {
		$out .= ocp_p( '<a href="' . $url . '">' . $link . '</a>', array( 'class' => 'ocp-arrow-link' ) );
	}
	return $out . ocp_group_close() . ocp_column_close();
}

/**
 * Section intro: eyebrow, centered heading, optional text.
 *
 * @param string $eyebrow Label.
 * @param string $heading H2.
 * @param string $text    Optional paragraph.
 * @return string
 */
function ocp_section_intro( $eyebrow, $heading, $text = '' ) {
	$out = ( $eyebrow ? ocp_eyebrow( $eyebrow, true ) : '' ) . ocp_heading( $heading, 2, array( 'center' => true ) ) . ocp_rule();
	if ( $text ) {
		$out .= ocp_p( $text, array( 'center' => true ) );
	}
	return $out;
}
