<?php
/**
 * Title: Page: For Photographers & Organizations
 * Slug: oc-portraits/page-for-photographers
 * Categories: oc-portraits-pages
 * Block Types: core/post-content
 * Post Types: page
 * Viewport Width: 1400
 *
 * @package oc-portraits
 */

echo ocp_split_hero(
	'For photographers &amp; organizations',
	'Associate photography for studios and photographers, and hosted workshops for groups that want to learn photography.',
	'photographers-hero'
);

echo ocp_image_text(
	'photographers-assoc',
	ocp_eyebrow( 'Associate photography' )
	. ocp_heading( 'An extra photographer for your assignments' )
	. ocp_rule()
	. ocp_p( 'Photographers and studios can hire me as an associate or second photographer — for overflow sessions, busy weeks, or assignments that need another experienced person behind a camera.' )
	. ocp_p( 'My experience includes portraits, families, corporate photography, events and live music.' )
	. ocp_p( 'Rates are quoted per assignment, based on the coverage you need, who handles editing, the location and any travel. Include those details in your inquiry and I’ll reply with a quote.' )
	. ocp_buttons( array( array( 'Discuss an Assignment', ocp_inquiry_url( 'Associate Photography' ), 'arrow' ) ) ),
	true,
	'',
	'associate'
);

echo ocp_image_text(
	'photographers-teach',
	ocp_eyebrow( 'Hosted workshops' )
	. ocp_heading( 'Photography workshops for your group' )
	. ocp_rule()
	. ocp_p( 'Organizations can hire me to teach photography workshops for children, teens or adults. Hosts might be studios, schools, homeschool groups or community organizations.' )
	. ocp_p( 'Topics can include:' )
	. '<!-- wp:group {"className":"ocp-chips","layout":{"type":"flex","flexWrap":"wrap"}} -->' . "\n" . '<div class="wp-block-group ocp-chips">'
	. ocp_p( 'Camera fundamentals', array( 'class' => 'ocp-chip' ) )
	. ocp_p( 'Portrait lighting', array( 'class' => 'ocp-chip' ) )
	. ocp_p( 'Composition', array( 'class' => 'ocp-chip' ) )
	. ocp_p( 'Visual storytelling', array( 'class' => 'ocp-chip' ) )
	. "</div>\n<!-- /wp:group -->"
	. ocp_p( 'Each workshop is arranged directly with the host and shaped around the group’s ages, experience and the time available. Tell me about your audience in your inquiry.' )
	. ocp_buttons( array( array( 'Host a Workshop', ocp_inquiry_url( 'Host a Workshop' ), 'arrow' ) ) ),
	false,
	'pale-sage',
	'workshops'
);
