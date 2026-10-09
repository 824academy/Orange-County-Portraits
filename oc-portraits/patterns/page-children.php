<?php
/**
 * Title: Page: Children
 * Slug: oc-portraits/page-children
 * Categories: oc-portraits-pages
 * Block Types: core/post-content
 * Post Types: page
 * Viewport Width: 1400
 *
 * @package oc-portraits
 */

$children = ocp_inquiry_url( "Children's Session" );

echo ocp_split_hero(
	'Children’s portraits',
	'Portraits of your child as they are right now — the expressions, habits and in-between moments that change faster than anyone expects.',
	'children-hero',
	array( array( 'Plan a children’s session', $children, 'arrow' ) ),
	'Children’s photography'
);

echo ocp_section_open( '', '', '60' );
echo ocp_columns_open( 'ocp-divided', '', '50' );
echo ocp_column_open()
	. ocp_eyebrow( 'Personality first' )
	. ocp_heading( 'Let them be themselves' )
	. ocp_p( 'Children are easier to photograph when they don’t feel watched. I give them time to warm up, follow their lead with a favorite toy, game or song, and guide them gently once they’re comfortable.' )
	. ocp_p( 'The goal is a portrait that looks like your child — curious, shy, silly or serious — rather than a stiff version of them.' )
	. ocp_column_close();
echo ocp_column_open()
	. ocp_eyebrow( 'Birthdays &amp; milestones' )
	. ocp_heading( 'Moments worth marking' )
	. ocp_p( 'A first birthday, a new school year, becoming a big sibling, or simply an age you want to remember. Tell me what the session is for and we’ll plan around it, in the studio or outdoors.' )
	. ocp_column_close();
echo ocp_columns_close();
echo ocp_section_close();

echo ocp_photo_row( array( 'children-1', 'children-2', 'children-3' ) );

echo ocp_section_open( 'pale-sage', '', '50' );
echo ocp_heading( 'Childhood Portraits collection', 2, array( 'center' => true ) );
echo ocp_p( 'A shorter session designed around one child’s attention span. See what’s included, and what can add to the total, on the experience &amp; pricing page.', array( 'center' => true ) );
echo ocp_buttons( array( array( 'Experience &amp; pricing', ocp_url( '/experience-pricing/' ), 'outline-arrow' ) ), 'center' );
echo ocp_section_close();

echo ocp_inquiry_band( 'Plan a children’s session', 'Personality · birthdays · milestones', 'Start an inquiry', $children );
