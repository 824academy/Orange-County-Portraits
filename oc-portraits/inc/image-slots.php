<?php
/**
 * Image placements used by the starter page patterns.
 *
 * Single source for: the labelled placeholder SVGs (assets/placeholders/),
 * the placeholder alt text, and docs/IMAGE-CHECKLIST.md (tools/build-placeholders.php).
 *
 * ratio      => CSS aspect ratio applied by the image block (crop on screen).
 * size       => recommended upload size in pixels (long edge ~2000–2400px is plenty).
 * subject    => suggestion only; use your own photographs.
 *
 * @package oc-portraits
 */

return array(
	// Home.
	'home-hero'           => array( 'id' => 'H1', 'page' => 'Home', 'place' => 'Hero, right of the introduction', 'ratio' => '4/5', 'size' => '1600 × 2000', 'subject' => 'Your strongest family portrait — warm, connected, faces visible. Loads first, so export carefully (~300–400 KB).' ),
	'home-families'       => array( 'id' => 'H2', 'page' => 'Home', 'place' => 'Service card: Families', 'ratio' => '4/5', 'size' => '1200 × 1500', 'subject' => 'Family group, studio or outdoor. May reuse a Families page image.' ),
	'home-children'       => array( 'id' => 'H3', 'page' => 'Home', 'place' => 'Service card: Children', 'ratio' => '4/5', 'size' => '1200 × 1500', 'subject' => 'A single child with real expression. May reuse a Children page image.' ),
	'home-motherhood'     => array( 'id' => 'H4', 'page' => 'Home', 'place' => 'Service card: Motherhood & Maternity', 'ratio' => '4/5', 'size' => '1200 × 1500', 'subject' => 'Mother and child, or maternity portrait. May reuse a Motherhood page image.' ),
	'home-studio'         => array( 'id' => 'H5', 'page' => 'Home', 'place' => 'Studio & outdoor section — studio image', 'ratio' => '3/2', 'size' => '1800 × 1200', 'subject' => 'A studio portrait (clean backdrop, controlled light).' ),
	'home-outdoor'        => array( 'id' => 'H6', 'page' => 'Home', 'place' => 'Studio & outdoor section — outdoor image', 'ratio' => '3/2', 'size' => '1800 × 1200', 'subject' => 'An outdoor portrait in natural light.' ),
	'home-about'          => array( 'id' => 'H7', 'page' => 'Home', 'place' => 'Meet Zharmaine section', 'ratio' => '4/5', 'size' => '1200 × 1500', 'subject' => 'A real photograph of Zharmaine (headshot or at work). Same file as A1 is fine.' ),

	// Families.
	'families-hero'       => array( 'id' => 'F1', 'page' => 'Families', 'place' => 'Hero, right of the heading', 'ratio' => '4/3', 'size' => '2000 × 1500', 'subject' => 'Family portrait with everyone connected; leave space around heads for the crop.' ),
	'families-1'          => array( 'id' => 'F2', 'page' => 'Families', 'place' => 'Photo row, left', 'ratio' => '4/5', 'size' => '1200 × 1500', 'subject' => 'Studio family portrait.' ),
	'families-2'          => array( 'id' => 'F3', 'page' => 'Families', 'place' => 'Photo row, centre', 'ratio' => '4/5', 'size' => '1200 × 1500', 'subject' => 'Outdoor family portrait.' ),
	'families-3'          => array( 'id' => 'F4', 'page' => 'Families', 'place' => 'Photo row, right', 'ratio' => '4/5', 'size' => '1200 × 1500', 'subject' => 'Candid in-between moment (siblings, parent and child).' ),

	// Children.
	'children-hero'       => array( 'id' => 'C1', 'page' => 'Children', 'place' => 'Hero, right of the heading', 'ratio' => '4/3', 'size' => '2000 × 1500', 'subject' => 'A child mid-expression — laughing, thinking, playing.' ),
	'children-1'          => array( 'id' => 'C2', 'page' => 'Children', 'place' => 'Photo row, left', 'ratio' => '4/5', 'size' => '1200 × 1500', 'subject' => 'Close portrait with personality.' ),
	'children-2'          => array( 'id' => 'C3', 'page' => 'Children', 'place' => 'Photo row, centre', 'ratio' => '4/5', 'size' => '1200 × 1500', 'subject' => 'Birthday or milestone portrait.' ),
	'children-3'          => array( 'id' => 'C4', 'page' => 'Children', 'place' => 'Photo row, right', 'ratio' => '4/5', 'size' => '1200 × 1500', 'subject' => 'Outdoor or movement shot.' ),

	// Motherhood & Maternity.
	'motherhood-hero'     => array( 'id' => 'M1', 'page' => 'Motherhood & Maternity', 'place' => 'Hero, right of the heading', 'ratio' => '4/3', 'size' => '2000 × 1500', 'subject' => 'Mother and child together.' ),
	'motherhood-1'        => array( 'id' => 'M2', 'page' => 'Motherhood & Maternity', 'place' => 'Maternity section', 'ratio' => '4/5', 'size' => '1200 × 1500', 'subject' => 'Maternity portrait (studio or outdoor).' ),
	'motherhood-2'        => array( 'id' => 'M3', 'page' => 'Motherhood & Maternity', 'place' => 'Photo row, left', 'ratio' => '4/5', 'size' => '1200 × 1500', 'subject' => 'Studio motherhood portrait.' ),
	'motherhood-3'        => array( 'id' => 'M4', 'page' => 'Motherhood & Maternity', 'place' => 'Photo row, right', 'ratio' => '4/5', 'size' => '1200 × 1500', 'subject' => 'Outdoor motherhood portrait.' ),

	// Experience & Pricing.
	'pricing-hero'        => array( 'id' => 'P1', 'page' => 'Experience & Pricing', 'place' => 'Hero, right of the heading', 'ratio' => '4/3', 'size' => '2000 × 1500', 'subject' => 'A relaxed session moment. Reuse of a Families image is fine.' ),
	'pricing-childhood'   => array( 'id' => 'P2', 'page' => 'Experience & Pricing', 'place' => 'Collection card: Childhood Portraits', 'ratio' => '3/2', 'size' => '1200 × 800', 'subject' => 'Child portrait (reuse C2–C4).' ),
	'pricing-signature'   => array( 'id' => 'P3', 'page' => 'Experience & Pricing', 'place' => 'Collection card: Signature Family', 'ratio' => '3/2', 'size' => '1200 × 800', 'subject' => 'Family portrait (reuse F2–F4).' ),
	'pricing-complete'    => array( 'id' => 'P4', 'page' => 'Experience & Pricing', 'place' => 'Collection card: Complete Family', 'ratio' => '3/2', 'size' => '1200 × 800', 'subject' => 'Larger family or extended family portrait.' ),

	// About.
	'about-portrait'      => array( 'id' => 'A1', 'page' => 'About', 'place' => 'Beside the introduction', 'ratio' => '4/5', 'size' => '1200 × 1500', 'subject' => 'A real photograph of Zharmaine. Do not use a generated or stock headshot.' ),

	// For Photographers & Organizations.
	'photographers-hero'  => array( 'id' => 'X1', 'page' => 'For Photographers', 'place' => 'Hero, right of the heading', 'ratio' => '4/3', 'size' => '2000 × 1500', 'subject' => 'Zharmaine photographing (behind-the-scenes), or one of your event/corporate images.' ),
	'photographers-assoc' => array( 'id' => 'X2', 'page' => 'For Photographers', 'place' => 'Associate Photography section', 'ratio' => '1/1', 'size' => '1500 × 1500', 'subject' => 'Your work on assignment — event, corporate or family coverage.' ),
	'photographers-teach' => array( 'id' => 'X3', 'page' => 'For Photographers', 'place' => 'Hosted Workshops section', 'ratio' => '4/3', 'size' => '1600 × 1200', 'subject' => 'A real teaching photo, only if you have one with permission from those pictured. Otherwise delete this image.' ),

	// Contact.
	'contact-image'       => array( 'id' => 'K1', 'page' => 'Contact', 'place' => 'Left of the inquiry form', 'ratio' => '3/4', 'size' => '1200 × 1600', 'subject' => 'A warm portrait (motherhood or family). Reuse is fine.' ),
);
