<?php

// // namespace Elchroy\Tests;

// use Elchroy\UrbanDictionary\Word;
// use Elchroy\UrbanDictionary\WordEngine;

// // use \Elchroy\UrbanDictionary\Category;
// // use Elchroy\Tests\Category;
// // use Elchroy\UrbanDictionary\WordEngine;
// //
// include 'Category.php';



class Category extends \Elchroy\UrbanDictionary\WordEngine
{
    public $main;

    public function __construct()
    {
        $this->main = \Elchroy\UrbanDictionary\Word::$data;
    }

    public function categorize($slang, $property = 'sample_sentence')
    {
        $sentence = $this->retrieve($slang, $property);
        return $this->groupOf($sentence);
    }

    public function categorize_i($slang, $property = 'sample_sentence')
    {
        $sentence = $this->retrieve($slang, $property);
        $sentence = strtolower($sentence);
        return $this->groupOf($sentence);
    }

    public function groupOf($sentence)
    {
        $sentence = trim($sentence); //trim the sentence of all leading and trailing white spaces
        $sentence = preg_replace("/[^a-zA-Z0-9\s]/", "", $sentence); // remove all non-alphanumercic charaters.
        $count_array = array();
        $words = explode(" ", $sentence);
        foreach ($words as $word) {
            $count = $this->getCount($words, $word);
            $count_array[$word] = $count;
        }
        return $count_array;
    }

    private function getCount($words, $word)
    {
        $count = 0;
        foreach($words as $second_word){
            if($word == $second_word){
                $count++;
            }
        }
        return $count;
    }
}




class CategoryTest extends PHPUnit_Framework_TestCase
{
    public $cat;
    public function setUp()
    {
        $this->cat = new Category;
        $this->cat->add("Wahala", "This means trouble", "that wahala is too much wahala and the wahala is too too much");
        // $this->main->update("Tight", "This means when someone does somethign exceptinally good and beyond the ordinary", "Prosper has finished the curriculum and he will submit it to Nadayar. Tight Tight Tight");
    }

    public function testClassExists()
    {
        // var_dump($this->cat);
    }

    public function testCategorizeFunctionWorksForPlainText()
    {
        $expected = array(
                        "that" => 1,
                        "wahala" => 3,
                        "is" => 2,
                        "too" => 3,
                        "much" => 2,
                        "and" => 1,
                        "the" => 1
                    );
        $categories = $this->cat->categorize("Wahala");
        $this->assertEquals($expected, $categories);
    }

    public function testCategorizeIFunctionWorksIfCaseModeIsInsensitive()
    {
        $this->cat->add("Tinz", "This is another way of saying 'things'.", "This this Is is the THIS And and Things things THINGS ");
        $expected = array("this" => 3, "is" => 2, "the" => 1, "and" => 2, "things" => 3);
        $categories = $this->cat->categorize_i("Tinz");
        $this->assertEquals($expected, $categories);
    }

    public function testCategorizeFunctionWorksAndEliminatesNoisyCharacterFromSentence()
    {
        $this->cat->add("Sup", "This means 'What up...?'.", "Hey,÷≥ ÷≥÷hey÷÷≥≤ªº§¶•, ¶§∞•¢sup Sup ª•§∞¢¶§SUP º•ª¶§∞sup");
        $expected = array("Hey" => 1, "hey" => 1, "sup" => 2, "Sup" => 1, "SUP" => 1);
        $categories = $this->cat->categorize("Sup");
        $this->assertEquals($expected, $categories);
    }


    public function testCategorizeFunctionWorksForSentencesThatIncludeNumbers()
    {
        $this->cat->add("Supa", "This means 'What up again...?'.", "Hey, hey, sup, Sup, SUP, sup, 1 1 1 1 ");
        $expected = array("Hey" => 1, "hey" => 1, "sup" => 2, "Sup" => 1, "SUP" => 1, "1" => 4);
        $categories = $this->cat->categorize("Supa");
        $this->assertEquals($expected, $categories);
    }
}