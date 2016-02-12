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

    public function testGetStaticSlangFunctionReturnsStaticSlangName()
    {
        $this->assertEquals('tight', Word::getStaticSlang('tight'));
    }

    public function testGetStaticDescriptionFunctionReturnsStaticDescription()
    {
        $this->assertEquals('When someone performs an awesome task', Word::getStaticDescription('tight'));
    }

    public function testGetStaticDescriptionFunctionReturnsStaticSampleSentence()
    {
        $this->assertEquals('Prosper has finished the curriculum, Tight.', Word::getStaticSentence('tight'));
    }

}