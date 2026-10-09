<?php
/**
 * Title: Section: Three service cards
 * Slug: oc-portraits/section-service-cards
 * Categories: oc-portraits
 * Viewport Width: 1400
 * Description: Photo, heading, text and link for each service.
 *
 * @package oc-portraits
 */

echo ocp_section_open( '', '', '60' ) . ocp_section_intro( 'Sessions', 'Portrait sessions' ) . ocp_columns_open( '', '', '40' )
	. ocp_card( 'home-families', 'Families', 'Short description.', 'Family sessions', ocp_url( '/families/' ) )
	. ocp_card( 'home-children', 'Children', 'Short description.', 'Children’s sessions', ocp_url( '/children/' ) )
	. ocp_card( 'home-motherhood', 'Motherhood &amp; Maternity', 'Short description.', 'Motherhood &amp; maternity', ocp_url( '/motherhood-maternity/' ) )
	. ocp_columns_close() . ocp_section_close();
