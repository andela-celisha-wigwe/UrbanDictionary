<?php

use Elchroy\UrbanDictionary\Word;
use Elchroy\UrbanDictionary\WordEngine;
use Elchroy\UrbanDictionary\Category;


class CategoryTest extends PHPUnit_Framework_TestCase
{
    public $cat;
    public function setUp()
    {
        $this->cat = new Category();
        $this->cat->add("Wahala", "This means trouble", "that wahala is too much wahala and the wahala is too too much");
        // $this->main->update("Tight", "This means when someone does somethign exceptinally good and beyond the ordinary", "Prosper has finished the curriculum and he will submit it to Nadayar. Tight Tight Tight");
    }

    public function testClassExists()
    {
        // var_dump($this->cat);
    }

    public function testCategorizeFunctionWorksForPlainText()
    {
        $expected = [
                        "that" => 1,
                        "wahala" => 3,
                        "is" => 2,
                        "too" => 3,
                        "much" => 2,
                        "and" => 1,
                        "the" => 1
                    ];
        $categories = $this->cat->categorize("Wahala");
        $this->assertEquals($expected, $categories);
    }

    public function testCategorizeFunctionWorksForCaseMode()
    {
        $this->cat->add("Sup", "This means 'What up...?'.", "Hey hey sup Sup SUP sup");
        $expected = ["Hey" => 1, "hey" => 1, "sup" => 2, "Sup" => 1, "SUP" => 1];
        $categories = $this->cat->categorize("Sup");
        $this->assertEquals($expected, $categories);
    }
}