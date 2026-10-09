<?php
/**
 * Title: Page: Experience & Pricing
 * Slug: oc-portraits/page-experience-pricing
 * Categories: oc-portraits-pages
 * Block Types: core/post-content
 * Post Types: page
 * Viewport Width: 1400
 *
 * @package oc-portraits
 */

/**
 * One collection card.
 */
$ocp_collection = function ( $slot, $name, $price, $length, $images ) {
	$out  = ocp_column_open();
	$out .= ocp_group_open( 'pale-sage', 'ocp-card' );
	$out .= ocp_image( $slot );
	$out .= '<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|30","right":"var:preset|spacing|30"},"blockGap":"0.75rem"}},"layout":{"type":"constrained"}} -->' . "\n";
	$out .= '<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--30)">';
	$out .= ocp_heading( $name, 3, array( 'center' => true, 'size' => 'large' ) );
	$out .= ocp_p( $price, array( 'center' => true, 'class' => 'ocp-price' ) );
	$out .= ocp_rule();
	$out .= ocp_p( $length . '<br>' . $images, array( 'center' => true ) );
	$out .= "</div>\n<!-- /wp:group -->";
	return $out . ocp_group_close() . ocp_column_close();
};

/**
 * One FAQ item (native details/summary).
 */
$ocp_faq = function ( $question, $answer ) {
	return '<!-- wp:details -->' . "\n" . '<details class="wp-block-details"><summary>' . $question . '</summary>'
		. ocp_p( $answer )
		. "</details>\n<!-- /wp:details -->";
};

echo ocp_split_hero(
	'The portrait experience',
	'How sessions are planned, photographed and delivered, and what each collection includes.',
	'pricing-hero',
	array(),
	'Experience &amp; pricing'
);

// Steps.
echo ocp_section_open( 'pale-sage', '', '50' );
echo ocp_columns_open( 'ocp-steps', '', '40' );
echo ocp_column_open() . ocp_p( '01', array( 'class' => 'ocp-step-number' ) ) . ocp_heading( 'Plan together', 3, array( 'size' => 'large' ) ) . ocp_p( 'We talk through who’s included, studio or outdoors, location, timing and what to wear. I’ll confirm your total — including any studio, permit, admission or parking costs — before you book.' ) . ocp_column_close();
echo ocp_column_open() . ocp_p( '02', array( 'class' => 'ocp-step-number' ) ) . ocp_heading( 'Your session', 3, array( 'size' => 'large' ) ) . ocp_p( 'I guide with simple prompts and keep the pace relaxed, adjusting as we go for children’s energy and attention.' ) . ocp_column_close();
echo ocp_column_open() . ocp_p( '03', array( 'class' => 'ocp-step-number' ) ) . ocp_heading( 'Your private gallery', 3, array( 'size' => 'large' ) ) . ocp_p( 'Your finished images are delivered through a private online gallery, where you can view and download them.' ) . ocp_column_close();
echo ocp_columns_close();
echo ocp_section_close();

// Collections.
echo ocp_section_open( '', 'ocp-collections', '60' );
echo ocp_section_intro( 'Digital collections', 'Collections' );
echo ocp_p( '<span class="ocp-badge">Provisional pricing — draft for review</span>', array( 'center' => true ) );
echo ocp_p( 'These collections are a working draft and may change before booking opens.', array( 'center' => true, 'class' => 'ocp-note' ) );
echo ocp_columns_open( '', '', '30' );
echo $ocp_collection( 'pricing-childhood', 'Childhood Portraits', '$750', 'Up to 45 minutes', '10 finished digital images' ); // phpcs:ignore WordPress.Security.EscapeOutput
echo $ocp_collection( 'pricing-signature', 'Signature Family', '$1,100', 'Up to 75 minutes', '25 finished digital images' ); // phpcs:ignore WordPress.Security.EscapeOutput
echo $ocp_collection( 'pricing-complete', 'Complete Family', '$1,500', 'Up to 90 minutes', 'Full curated gallery<br>[Final image count to be confirmed]' ); // phpcs:ignore WordPress.Security.EscapeOutput
echo ocp_columns_close();

echo ocp_columns_open( 'ocp-divided', 'top', '50' );
echo ocp_column_open()
	. ocp_heading( 'What “finished digital images” means', 3, array( 'size' => 'large' ) )
	. ocp_p( 'Every collection includes edited, full-resolution JPEG files with permission to print them for personal use. “Full resolution” describes the size of each finished file. It doesn’t mean every photograph taken, and RAW files aren’t included.' )
	. ocp_column_close();
echo ocp_column_open()
	. ocp_heading( 'Costs that can be added', 3, array( 'size' => 'large' ) )
	. ocp_p( 'Studio rental, location permits, admission fees and parking aren’t part of the collection price and may add to your total. I’ll confirm the full amount with you before you book.' )
	. ocp_column_close();
echo ocp_columns_close();
echo ocp_section_close();

// FAQ.
echo ocp_section_open( 'pale-sage', 'ocp-faq', '60' );
echo ocp_section_intro( 'Questions', 'Frequently asked questions' );
echo $ocp_faq( 'What do I receive?', 'Edited, full-resolution JPEG files, delivered through a private online gallery, with permission to print them for personal use. The number of images depends on your collection.' ); // phpcs:ignore WordPress.Security.EscapeOutput
echo $ocp_faq( 'Will I get every photo, or the RAW files?', 'No. I select and edit the strongest images from your session. Unedited photographs and RAW files aren’t included.' ); // phpcs:ignore WordPress.Security.EscapeOutput
echo $ocp_faq( 'Can I print my photos?', 'Yes. Your files come with permission to print them for personal use, at the print lab of your choice.' ); // phpcs:ignore WordPress.Security.EscapeOutput
echo $ocp_faq( 'Should we choose the studio or outdoors?', 'Either can work well. We’ll talk it through while planning, based on your children’s ages, the look you prefer, and the time of year.' ); // phpcs:ignore WordPress.Security.EscapeOutput
echo $ocp_faq( 'Are there costs beyond the collection price?', 'Sometimes. Studio rental, permits, admission and parking can add to the total. You’ll have the full amount before you book.' ); // phpcs:ignore WordPress.Security.EscapeOutput
echo $ocp_faq( 'Where are sessions held?', 'I’m based in Cypress and photograph in a studio or at outdoor locations throughout Orange County.' ); // phpcs:ignore WordPress.Security.EscapeOutput
echo $ocp_faq( 'How do I book?', 'Send an inquiry with your preferred dates and the kind of session you’re planning. I’ll reply to talk through the details and confirm your total.' ); // phpcs:ignore WordPress.Security.EscapeOutput
echo ocp_section_close();

echo ocp_inquiry_band( 'Find your session', 'Tell me what you have in mind', 'Plan Your Session', ocp_inquiry_url() );
