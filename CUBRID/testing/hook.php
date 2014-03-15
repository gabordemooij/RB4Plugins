<?php

if ( isset( $ini['CUBRID'] ) ) {
	$dsn = "cubrid:host={$ini['CUBRID']['host']};port=33000;dbname={$ini['CUBRID']['schema']}";

	R::addDatabase( 'CUBRID', $dsn, $ini['CUBRID']['user'], $ini['CUBRID']['pass'], FALSE );

	R::selectDatabase( 'CUBRID' );

	R::exec( 'AUTOCOMMIT IS ON' );
}