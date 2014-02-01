<?php

class Model_Page extends \RedBeanPHP\SimpleModel
{
	public function mail( $who = 'nobody' )
	{
		return 'mail has been sent to ' . $who;
	}

	public function err()
	{
		throw new Exception( 'fake error', 123 );
	}
}

class Model_Setting extends \RedBeanPHP\SimpleModel
{
	public static $closed = FALSE;

	public function open()
	{
		if ( self::$closed ) throw new Exception( 'closed' );
	}
}

/**
 * Shared helper class for tests.
 * A Model class for testing Models/FUSE and related features.
 */
class Model_CandyBar extends RedBeanPHP\SimpleModel
{
	/**
	 * @param $custom
	 *
	 * @return string
	 */
	public function customMethod( $custom )
	{
		return $custom . "!";
	}

	/**
	 * @throws Exception
	 */
	public function customMethodWithException()
	{
		throw new Exception( 'Oops!' );
	}

	/**
	 * @return string
	 */
	public function __toString()
	{
		return 'candy!';
	}
}