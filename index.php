<?php
// namespace Elchroy\UrbanDictionary;
// namespace Elchroy\UrbanDictionary;


use Elchroy\UrbanDictionary\Word;
use Elchroy\UrbanDictionary\WordEngine;
use Elchroy\UrbanDictionary\Category;



$wordEngine = new WordEngine();

$result = $wordEngine->add("newslang", "this is a new slang", "This is a sample sentence for the nw slang");

print_r($result);

// what is create_function();
