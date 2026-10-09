<?php
/**
 * Title: Page: Motherhood & Maternity
 * Slug: oc-portraits/page-motherhood
 * Categories: oc-portraits-pages
 * Block Types: core/post-content
 * Post Types: page
 * Viewport Width: 1400
 *
 * @package oc-portraits
 */

$mother = ocp_inquiry_url( 'Motherhood or Maternity' );

echo ocp_split_hero(
	'Motherhood &amp; maternity portraits',
	'Portraits of you with your children, and of the season before a new baby arrives — in the studio or outdoors around Orange County.',
	'motherhood-hero',
	array( array( 'Plan your session', $mother, 'arrow' ) ),
	'Motherhood &amp; maternity'
);

echo ocp_section_open( '', '', '60' );
echo ocp_section_intro(
	'Motherhood',
	'In the picture with your children',
	'Mothers are often the ones holding the camera. These sessions put you in the frame — holding, reading, laughing, the ordinary closeness that’s easy to overlook.'
);
echo ocp_section_close();

echo ocp_image_text(
	'motherhood-1',
	ocp_eyebrow( 'Maternity' )
	. ocp_heading( 'Maternity portraits' )
	. ocp_rule()
	. ocp_p( 'Maternity portraits can be quiet and simple, or include a partner and older children. We’ll choose a date and setting that feel comfortable for you, and keep the pace relaxed.' )
	. ocp_p( '<strong>Studio:</strong> soft, consistent light and clean backdrops.' )
	. ocp_p( '<strong>Outdoors:</strong> natural light and open space at a location we choose together.' ),
	true,
	'pale-sage'
);

echo ocp_photo_row( array( 'motherhood-2', 'motherhood-3' ) );

echo ocp_section_open( '', '', '50' );
echo ocp_p( 'Wondering what’s included? Read about <a href="' . ocp_url( '/experience-pricing/' ) . '">the experience and pricing</a>, including how your finished images are delivered.', array( 'center' => true ) );
echo ocp_section_close();

echo ocp_inquiry_band( 'Plan your motherhood or maternity session', 'Studio or outdoors · Cypress &amp; Orange County', 'Start an inquiry', $mother );
