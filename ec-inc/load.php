<?php
/**
 * Loads the eCooby common files.
 *
 * @package eCooby
 */
	session_start();
	header('Content-Type: text/html; charset=utf-8', true);

	require( dirname( __FILE__ ) . '/config.php' );
	
	require( dirname( __FILE__ ) . '/options.php' );
	
	require( dirname( __FILE__ ) . '/version.php' );
