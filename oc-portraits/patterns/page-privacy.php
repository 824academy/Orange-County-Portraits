<?php
/**
 * Title: Page: Privacy (outline)
 * Slug: oc-portraits/page-privacy
 * Categories: oc-portraits-pages
 * Block Types: core/post-content
 * Post Types: page
 * Description: A factual outline to complete before launch. Not legal advice.
 *
 * @package oc-portraits
 */

echo ocp_p( '<strong>[Draft outline — review and complete before launch. This is not legal advice.]</strong>', array( 'class' => 'ocp-note' ) );

echo ocp_heading( 'Who we are' );
echo ocp_p( 'Orange County Portraits is the family photography work of Zharmaine Boatman, based in Cypress, California. This website’s address is ' . esc_html( home_url( '/' ) ) . '.' );

echo ocp_heading( 'Information you send through the inquiry form' );
echo ocp_p( 'The inquiry form asks for your name, email address, inquiry type, preferred dates, location or setting, and a message. This information is used to reply to your inquiry and plan your session. It is sent by email to zharmaine@824brandproductions.com.' );
echo ocp_p( '[Confirm: whether submissions are also stored on the website, and which spam-protection service checks them (for example Akismet or Cloudflare Turnstile).]' );

echo ocp_heading( 'Photographs from your session' );
echo ocp_p( '[Describe how client photographs are stored, how long, and whether you ask permission before sharing any images online.]' );

echo ocp_heading( 'Galleries and other services' );
echo ocp_p( 'Finished images are delivered through a private online gallery provided by [gallery service name], which has its own privacy policy. This site also links to Instagram and other websites; those sites are governed by their own policies.' );

echo ocp_heading( 'Cookies and analytics' );
echo ocp_p( '[List any analytics or cookies used on this site, or state that none are used beyond those WordPress needs for logged-in users.]' );

echo ocp_heading( 'Your choices' );
echo ocp_p( 'To ask what information you’ve sent us, or to have it deleted, contact <a href="mailto:zharmaine@824brandproductions.com">zharmaine@824brandproductions.com</a>.' );
