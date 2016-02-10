<?php

use Elchroy\Tests;
use Elchroy\UrbanDictionary\Word;

class WordTest extends \PHPUnit_Framework_TestCase
{

    public $word_class;

    public function setUp()
    {
        $this->word_class = Word::$data;
    }

    public function testWordClassHasAStaticVariable ()
    {
        // var_dump($this->word_class);
        print_r($this->word_class);
        $this->assertArrayHasKey("tight", $this->word_class);
    }

    // public function testWord
}