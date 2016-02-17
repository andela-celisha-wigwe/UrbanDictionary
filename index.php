<?php

require 'vendor/autoload.php';

// use Elchroy\UrbanDictionary\Word;
use Elchroy\UrbanDictionary\WordBook;
// use Elchroy\Interfaces\BookInterface;
// Use Elchroy\UrbanDictionary\Categorize;
// include_once('src/WordBook.php');

$b = new WordBook;
$b->add('asfgtisfdn', 'This is another way of saying What?', 'Wetin de worry you');
$b->add('tisdfn', 'This is another way of saying What?', 'Wetin de worry you');
$b->add('tissfdn', 'This is another way of saying What?', 'Wetin de worry you');
$b->add('dnsdtisfndnsf', 'This is another way of saying What?', 'Wetin de worry you');
$b->add('tisdtisffdn', 'This is another way of saying What?', 'Wetin de worry you');
$b->add('sdtisfnffdn', 'This is another way of saying What?', 'Wetin de worry you');

print_r($b->ends_with('dn'));

print_r($b->starts_with('ti'));