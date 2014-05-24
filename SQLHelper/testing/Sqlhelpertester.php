<?php

namespace RedUNIT\Blackhole;
use RedBeanPHP\Facade as R;
use RedBeanPHP\SQLHelper as SQLHelper;
use RedUNIT\Blackhole as Blackhole;

require __DIR__ . '/../SQLHelper.php';

class Sqlhelpertester extends Blackhole {

	public function testQueryBuilding()
	{

		$sqlHelper = new SQLHelper( R::getDatabaseAdapter() );
		$str = $sqlHelper->random();
		asrt( ( strlen( $str ) > 0 ), true );
		asrt( ( $sqlHelper->getNew() instanceof SQLHelper ), true );

		R::nuke();
		$book = R::dispense( 'book' );
		$book->ownPage[] = R::dispense( 'page' );
		$book->sharedCategory[] = R::dispense( 'category' );
		R::store( $book );

		$books = $sqlHelper
			->begin()
			->select('*')
			->from('book')->get();

		asrt( count($books), 1 );

		$books = $sqlHelper
			->begin()
			->select('*')
			->from('book')
			->where('id > ?')
			->put(0)->get();

		asrt( count($books), 1 );

		$books = $sqlHelper
			->begin()
			->select('*')
			->from('book')
			->orderBy('id')->get();

		asrt( count($books), 1 );

		$sqlHelper->clear();
		pass();

		asrt( $sqlHelper->genSlots( array( 1, 2, 3 ) ), '?,?,?' );

		$books = $sqlHelper
			->begin()
			->select('*')
			->from('book')
			->where('id')->in()
				->open()
				->select('id')
				->from('book')
				->close()
			->get();

		asrt( count( $books ), 1 );

		$books = $sqlHelper
			->begin()
			->select( '*' )
			->from( 'book' )
			->where( 'id' )->in()->open()->nest(
				$sqlHelper->getNew()->begin()
				->select( 'id' )
				->from( 'book' )
				)->close()->get();

		asrt( count( $books ), 1 );

		$books = $sqlHelper
			->begin()
			->select( '*' )
			->from( 'book' )
			->where( 'id' )->in()
			->addSQL( ' (select id FROM book) ' )->get();

		asrt( count($books), 1 );

		$sqlHelper->begin()->addSQL( 'whatever' )->put( 1 );
		$query = $sqlHelper->getQuery();

		asrt( count( $query ), 2 );
		asrt( $query[0], ' whatever ' );
		asrt( is_array( $query[1] ), TRUE );
		asrt( $query[1][0], 1 );


	}


}
