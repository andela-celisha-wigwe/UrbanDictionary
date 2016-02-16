<?php

require 'vendor/autoload.php';

// use Elchroy\UrbanDictionary\Word;
use Elchroy\UrbanDictionary\WordBook;
// use Elchroy\Interfaces\BookInterface;
// Use Elchroy\UrbanDictionary\Categorize;
// include_once('src/WordBook.php');

$b = new WordBook;

 $b->like('tight');
 $b->like('tight');
 $b->like('tight');
 $b->unlike('tight');
echo 'Numebr of likes is : ', $b->likes('tight');
echo 'Numebr of unlikes is : ', $b->unlikes('tight');

echo 'Rating is: ',$b->rating('tight');