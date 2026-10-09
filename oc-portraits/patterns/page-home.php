<?php
/**
 * Title: Page: Home
 * Slug: oc-portraits/page-home
 * Categories: oc-portraits-pages
 * Block Types: core/post-content
 * Post Types: page
 * Viewport Width: 1400
 * Description: Hero, three services, studio/outdoor, meet Zharmaine, recent posts, inquiry.
 *
 * @package oc-portraits
 */

echo ocp_split_hero(
	'Family, children’s &amp; motherhood photography in Orange County',
	'Studio and outdoor portraits for families, children and mothers, from a photographer based in Cypress. Planned with you, guided gently, delivered as finished images ready to print.',
	'home-hero',
	array(
		array( 'Plan Your Session', ocp_inquiry_url(), 'arrow' ),
		array( 'Experience &amp; pricing', ocp_url( '/experience-pricing/' ), 'outline' ),
	),
	'Cypress · Orange County'
);

echo ocp_section_open( '', 'ocp-services', '60' );
echo ocp_section_intro( 'Sessions', 'Portrait sessions' );
echo ocp_columns_open( '', '', '40' );
echo ocp_card( 'home-families', 'Families', 'Studio and outdoor sessions for the whole family — parents, children, grandparents, and whoever else belongs in the picture.', 'Family sessions', ocp_url( '/families/' ) );
echo ocp_card( 'home-children', 'Children', 'Portraits that keep hold of who your child is right now, from birthdays and milestones to the everyday expressions you know best.', 'Children’s sessions', ocp_url( '/children/' ) );
echo ocp_card( 'home-motherhood', 'Motherhood &amp; Maternity', 'Portraits of you with your children, and of the months before a new baby arrives.', 'Motherhood &amp; maternity', ocp_url( '/motherhood-maternity/' ) );
echo ocp_columns_close();
echo ocp_section_close();

echo ocp_section_open( 'pale-sage', 'ocp-settings', '60' );
echo ocp_section_intro( 'Your setting', 'Studio &amp; outdoor sessions' );
echo ocp_columns_open( '', '', '50' );
echo ocp_card( 'home-studio', 'In the studio', 'A calm, controlled space with consistent light and no weather to plan around. A good fit for younger children, maternity portraits, and a clean, classic look.' );
echo ocp_card( 'home-outdoor', 'Outdoors', 'Natural light and open space at a park, garden or neighborhood spot around Orange County. A good fit for families who like to move, and for portraits with a sense of place.' );
echo ocp_columns_close();
echo ocp_p( 'Studio rental, permits, admission or parking can add to the total. You’ll know the full price before you book. <a href="' . ocp_url( '/experience-pricing/' ) . '">See the experience &amp; pricing</a>.', array( 'center' => true, 'class' => 'ocp-note' ) );
echo ocp_section_close();

echo ocp_image_text(
	'home-about',
	ocp_eyebrow( 'Your photographer' )
	. ocp_heading( 'Meet Zharmaine' )
	. ocp_rule()
	. ocp_p( 'I’m a portrait photographer based in Cypress, photographing families, children and mothers throughout Orange County.' )
	. ocp_p( 'Every session starts with a conversation about who’s included, where we’ll be, and what you’d like to remember. On the day, I keep direction simple and kind, so you can pay attention to each other instead of the camera.' )
	. ocp_p( '<a href="' . ocp_url( '/about/' ) . '">More about Zharmaine</a>', array( 'class' => 'ocp-arrow-link' ) ),
	true
);

echo ocp_recent_posts();

echo ocp_inquiry_band( 'Begin your portrait session', 'Families · Children · Motherhood &amp; Maternity', 'Plan Your Session', ocp_inquiry_url() );
