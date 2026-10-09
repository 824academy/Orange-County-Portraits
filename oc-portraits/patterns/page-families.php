<?php
/**
 * Title: Page: Families
 * Slug: oc-portraits/page-families
 * Categories: oc-portraits-pages
 * Block Types: core/post-content
 * Post Types: page
 * Viewport Width: 1400
 *
 * @package oc-portraits
 */

$family = ocp_inquiry_url( 'Family Session' );

echo ocp_split_hero(
	'Family portraits in Orange County',
	'Studio and outdoor sessions for families of every size, photographed by Zharmaine Boatman in Cypress and across Orange County.',
	'families-hero',
	array( array( 'Plan a family session', $family, 'arrow' ) ),
	'Family photography'
);

echo ocp_section_open( '', '', '60' );
echo ocp_section_intro( 'How it works', 'Planned together, guided gently' );
echo ocp_columns_open( 'ocp-steps', '', '40' );
echo ocp_column_open() . ocp_p( '01', array( 'class' => 'ocp-step-number' ) ) . ocp_heading( 'Before the session', 3, array( 'size' => 'large' ) ) . ocp_p( 'We talk through who’s included, studio or outdoors, the best time of day for your children, and what everyone might wear. You’ll have a clear plan and a confirmed total before you book.' ) . ocp_column_close();
echo ocp_column_open() . ocp_p( '02', array( 'class' => 'ocp-step-number' ) ) . ocp_heading( 'During the session', 3, array( 'size' => 'large' ) ) . ocp_p( 'I give simple prompts — where to stand, who to hold, something to talk about — and leave time for the moments in between. Children don’t need to sit still or smile on cue.' ) . ocp_column_close();
echo ocp_column_open() . ocp_p( '03', array( 'class' => 'ocp-step-number' ) ) . ocp_heading( 'After the session', 3, array( 'size' => 'large' ) ) . ocp_p( 'Your edited images arrive in a private online gallery, ready to download and print.' ) . ocp_column_close();
echo ocp_columns_close();
echo ocp_section_close();

echo ocp_photo_row( array( 'families-1', 'families-2', 'families-3' ) );

echo ocp_section_open( 'pale-sage', '', '60' );
echo ocp_section_intro( 'Studio or outdoors', 'Two ways to photograph your family' );
echo ocp_columns_open( 'ocp-divided', '', '50' );
echo ocp_column_open() . ocp_heading( 'Studio sessions', 3 ) . ocp_p( 'Consistent light, a clean backdrop, and no weather or crowds to work around. Studio sessions suit families with very young children and anyone who prefers a timeless, simple look.' ) . ocp_column_close();
echo ocp_column_open() . ocp_heading( 'Outdoor sessions', 3 ) . ocp_p( 'Natural light and space to walk, play and explore at a location we choose together. Outdoor sessions suit active families and portraits with a sense of place.' ) . ocp_column_close();
echo ocp_columns_close();
echo ocp_p( 'Not sure which to choose? We’ll decide together while planning.', array( 'center' => true, 'class' => 'ocp-note' ) );
echo ocp_section_close();

echo ocp_section_open( '', '', '60' );
echo ocp_heading( 'Collections and pricing', 2, array( 'center' => true ) );
echo ocp_p( 'Family collections differ by session length and how many finished images are included. Studio rental, permits, admission or parking may add to the total, and you’ll know the full price before booking.', array( 'center' => true ) );
echo ocp_buttons(
	array(
		array( 'See the experience &amp; pricing', ocp_url( '/experience-pricing/' ), 'outline-arrow' ),
	),
	'center'
);
echo ocp_section_close();

echo ocp_inquiry_band( 'Plan your family session', 'Studio or outdoors · Cypress &amp; Orange County', 'Start a family inquiry', $family );
