<?php
/**
 * Loads the eCooby environment and template.
 *
 * @package Admin eCooby
 */

	require( dirname( __FILE__ ) . '/load.php' );

	require( dirname( __FILE__ ) . '/admin-handler.php' );

	admin_ec($mysqli);
