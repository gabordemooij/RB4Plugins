<?php

require 'rb.phar';
require 'Preloader.php';

R::setup();


list($books, $pages1, $pages2) = R::dispenseAll('book*2,page*3,page*7');
$books[0]->ownPageList = $pages1;
$books[1]->ownPageList = $pages2;
R::storeAll($books);

$books = R::find('book');
R::preload($books, 'ownPage');
print_r($books);


