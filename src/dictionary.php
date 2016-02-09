<?php
namespace Elchroy\UrbanDictionary;

use Elchroy\UrbanDictioWord;
use Elchroy\UrbanDictionary\wordEngine;
use Elchroy\UrbanDictionary\Category;


// include "word.php";
// include "word_engine.php";

$w = new Category;


try {
    $w->add('bromance', 'The romance between two men', 'It has become a popular thing for bromance to exist between men.');
    $w->add('LLNP', 'Long Life and Properity', 'Happy Birthday Kenny, LLNP');
    $w->add('This is a new slang', 'This is a new description');
    $w->retrieve('bromance','sample_sentence');
    $w->add('release', 'this is the new word release');
    $w->update('release', 'sample_sentence', 'This is the updated word. Please confirm that you like this one.');
    $w->update('release', 'description', 'This is another description.');
    $w->add("Wetin", "Another way asking 'What...?' This is commonly used in pigin english.", "Wetin de worry you? (What is the matter with you?)");
    $w->delete('LLNP');
    $w->update('Wetin', 'description', "Wetin de happen.");
    print_r($w->categorize('bromance'));
    print_r($w);
} catch (Exception $e) {
    echo 'There was an error: ', $e->getMessage(),"\n";
}

// $c = new Category;



    // var_dump(Word::$data);

    // Category::group('tight');
    // echo WordEngine::$main;
    //
    // $s = "This is quick brown fox that jumps over the lazy dog. THis is the sentence that has all the letters of the english alphabet.";
    // $words = explode(" ", $s);


    // array_map("getCount", $words);






    // echo $s."\n\n";
    // print_r($count_array);
    // print_r(str_split($s));
    // print_r(explode(" ", $s));



