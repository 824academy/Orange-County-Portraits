<?php
/**
 * Title: Page: About
 * Slug: oc-portraits/page-about
 * Categories: oc-portraits-pages
 * Block Types: core/post-content
 * Post Types: page
 * Viewport Width: 1400
 *
 * @package oc-portraits
 */

echo ocp_title_band( 'Meet Zharmaine', 'The photographer behind Orange County Portraits' );

echo ocp_image_text(
	'about-portrait',
	ocp_eyebrow( 'Based in Cypress' )
	. ocp_heading( 'Photographing families across Orange County' )
	. ocp_rule()
	. ocp_p( 'I’m Zharmaine Boatman, a photographer based in Cypress, California. Orange County Portraits is my family work: portraits of families, children, mothers and mothers-to-be, in the studio and outdoors.' )
	. ocp_p( '[Add two or three sentences in your own words — why you photograph families, what you notice, and what a session with you feels like.]' )
	. ocp_p( 'My approach is simple: plan carefully together, guide gently on the day, and deliver finished images you’ll want to print.' )
	. ocp_buttons(
		array(
			array( 'Plan Your Session', ocp_inquiry_url(), 'arrow' ),
			array( 'Experience &amp; pricing', ocp_url( '/experience-pricing/' ), 'outline' ),
		)
	),
	true
);

// Other work. The anchor is used by the footer "Corporate Photography" link until the 824 Brand Productions URL is confirmed.
echo ocp_section_open( 'pale-sage', '', '60' );
echo str_replace(
	array( '<!-- wp:paragraph {"align":"center","className":"ocp-eyebrow"} -->' . "\n" . '<p class="has-text-align-center ocp-eyebrow">' ),
	array( '<!-- wp:paragraph {"align":"center","className":"ocp-eyebrow","anchor":"other-work"} -->' . "\n" . '<p id="other-work" class="has-text-align-center ocp-eyebrow">' ),
	ocp_eyebrow( 'A wider creative practice', true )
);
echo ocp_heading( 'My other work', 2, array( 'center' => true ) );
echo ocp_p( 'Family portraiture is the focus here. Alongside it, I photograph businesses, events and live music under two other names.', array( 'center' => true ) );
echo ocp_columns_open( '', '', '30' );
foreach (
	array(
		array( '824 Brand Productions', 'Corporate portraits, branding and events', 'Professional photography for businesses, teams and events.', '[Add the 824 Brand Productions website link]' ),
		array( 'The 824 Journal', 'Live music &amp; culture', 'Live music and culture coverage from Southern California.', '<a href="https://the824journal.press/">Visit The 824 Journal</a>' ),
		array( 'Zharmaine.com', 'Photography portfolio', 'A broader look at my photography across subjects.', '<a href="https://zharmaine.com/">Visit Zharmaine.com</a>' ),
	) as $ocp_item
) {
	echo ocp_column_open();
	echo ocp_group_open( 'white', 'ocp-card', '40' );
	echo ocp_heading( $ocp_item[0], 3 );
	echo ocp_eyebrow( $ocp_item[1] );
	echo ocp_p( $ocp_item[2] );
	echo ocp_p( $ocp_item[3], array( 'class' => 'ocp-arrow-link' ) );
	echo ocp_group_close();
	echo ocp_column_close();
}
echo ocp_columns_close();
echo ocp_section_close();

echo ocp_section_open( '', '', '60' );
echo ocp_section_intro( 'For photographers &amp; organizations', 'Working with other photographers and groups' );
echo ocp_columns_open( 'ocp-divided', '', '50' );
echo ocp_column_open() . ocp_heading( 'Associate photography', 3 ) . ocp_p( 'Photographers and studios can hire me as an associate or second photographer for assignments and overflow work.' ) . ocp_p( '<a href="' . ocp_url( '/for-photographers/#associate' ) . '">Associate photography</a>', array( 'class' => 'ocp-arrow-link' ) ) . ocp_column_close();
echo ocp_column_open() . ocp_heading( 'Hosted workshops', 3 ) . ocp_p( 'Studios, schools, homeschool groups and community organizations can hire me to teach photography workshops for children, teens or adults.' ) . ocp_p( '<a href="' . ocp_url( '/for-photographers/#workshops' ) . '">Hosted workshops</a>', array( 'class' => 'ocp-arrow-link' ) ) . ocp_column_close();
echo ocp_columns_close();
echo ocp_p( 'You can also follow my work on <a href="https://www.instagram.com/starlitnestphotography/">Instagram</a>.', array( 'center' => true, 'class' => 'ocp-note' ) );
echo ocp_section_close();

echo ocp_inquiry_band( 'Inquire about a portrait session', 'Families · Children · Motherhood &amp; Maternity', 'Plan Your Session', ocp_inquiry_url() );
