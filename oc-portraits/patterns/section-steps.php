<?php
/**
 * Title: Section: Three numbered steps
 * Slug: oc-portraits/section-steps
 * Categories: oc-portraits
 * Viewport Width: 1400
 * Description: 01 / 02 / 03 steps on pale sage.
 *
 * @package oc-portraits
 */

echo ocp_section_open( 'pale-sage', '', '50' ) . ocp_columns_open( 'ocp-steps', '', '40' );
foreach ( array( 'Plan together', 'Your session', 'Your gallery' ) as $i => $t ) {
	echo ocp_column_open() . ocp_p( '0' . ( $i + 1 ), array( 'class' => 'ocp-step-number' ) ) . ocp_heading( $t, 3, array( 'size' => 'large' ) ) . ocp_p( 'A sentence or two.' ) . ocp_column_close();
}
echo ocp_columns_close() . ocp_section_close();
