<?php
/**
 * Title: Page: Contact
 * Slug: oc-portraits/page-contact
 * Categories: oc-portraits-pages
 * Block Types: core/post-content
 * Post Types: page
 * Viewport Width: 1400
 * Description: Title band, photograph and inquiry form. Appearance → Site Setup places the Contact Form 7 form in the marked slot.
 *
 * @package oc-portraits
 */

echo ocp_title_band( 'Plan your session', 'Portrait sessions · associate photography · workshops' );

echo '<!-- wp:group {"align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"0","bottom":"0"}}},"layout":{"type":"default"}} -->' . "\n";
echo '<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0">';
echo '<!-- wp:columns {"className":"ocp-hero-split","style":{"spacing":{"blockGap":{"top":"0","left":"0"}}}} -->' . "\n" . '<div class="wp-block-columns ocp-hero-split">';
echo ocp_column_open( '45%' ) . ocp_image( 'contact-image' ) . ocp_column_close();
echo '<!-- wp:column {"width":"55%","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"clamp(1rem, 6vw, 5.5rem)"}}}} -->' . "\n";
echo '<div class="wp-block-column" style="padding-top:var(--wp--preset--spacing--50);padding-right:clamp(1rem, 6vw, 5.5rem);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50);flex-basis:55%">';
echo ocp_p( 'Tell me a little about what you have in mind. I’ll reply by email to talk through the details and confirm your total before anything is booked.' );
echo ocp_p( 'Photographers and organizations: use the message box for assignment requirements or details about your workshop audience.', array( 'class' => 'ocp-note' ) );
echo ocp_group_open( '', 'ocp-form' );
echo ocp_p( '[Inquiry form — appears here once Contact Form 7 is active and Appearance → Site Setup has been run.]', array( 'class' => 'ocp-form-slot' ) );
echo ocp_group_close();
echo ocp_p( 'Based in Cypress, serving Orange County.', array( 'center' => true, 'class' => 'ocp-note' ) );
echo ocp_p( 'Session details and any location costs are confirmed before booking.', array( 'center' => true, 'class' => 'ocp-note' ) );
echo ocp_column_close();
echo ocp_columns_close();
echo ocp_group_close();
