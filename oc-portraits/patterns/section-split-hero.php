<?php
/**
 * Title: Section: Split hero (text + photo)
 * Slug: oc-portraits/section-split-hero
 * Categories: oc-portraits
 * Viewport Width: 1400
 * Description: Sage text panel beside a large photograph.
 *
 * @package oc-portraits
 */

echo ocp_split_hero( 'Page heading', 'One or two sentences introducing the page.', 'families-hero', array( array( 'Plan Your Session', ocp_inquiry_url(), 'arrow' ) ), 'Eyebrow label' );
