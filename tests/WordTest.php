<?php
namespace Elchroy\Tests;
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
        $this->assertArrayHasKey("tight", $this->word_class);
    }

}