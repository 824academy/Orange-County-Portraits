<?php
/**
 * Title: Section: Photo beside text
 * Slug: oc-portraits/section-image-text
 * Categories: oc-portraits
 * Viewport Width: 1400
 * Description: Image on one side, heading, text and button on the other.
 *
 * @package oc-portraits
 */

echo ocp_image_text( 'families-1', ocp_eyebrow( 'Eyebrow label' ) . ocp_heading( 'Section heading' ) . ocp_rule() . ocp_p( 'A short paragraph.' ) . ocp_buttons( array( array( 'Plan Your Session', ocp_inquiry_url(), 'arrow' ) ) ) );
