<?php
namespace Elchroy\Tests;
use Elchroy\UrbanDictionary\Word;
use Elchroy\UrbanDictionary\WordEngine;
use Elchroy\UrbanDictionary\WordException as Exception;

class WordEngineTest extends \PHPUnit_Framework_TestCase
{
    public $data;
    public $wordEngine;

    public function setUp()
    {
        $this->wordEngine = new WordEngine();
        $this->wordEngine->add('bromance', 'This is the romance that exists between two men.');
        $this->data = $this->wordEngine->getData();
    }

    public function testClassContainsOneStaticArray()
    {
        $this->assertCount(2, $this->data);
    }

    /**
     * @expectedException Elchroy\UrbanDictionary\WordException
     * @expectedExceptionMessage 'bromance' already exists in the dictionary.
     */
    public function testAddFuncitonFailsForAlreadyExistingSlang()
    {
        $this->wordEngine->add('bromance', 'This is another description for the word. This should fail.');
    }

    public function testAddFunctionWorksForANewWord()
    {
        $initial_count = count($this->wordEngine->main);
        $this->wordEngine->add('wetin', "Another way of saying 'What?'.");
        $final_count = count($this->wordEngine->main);
        $this->assertEquals(1, ($final_count - $initial_count));
    }

    /**
     *  @expectedException Elchroy\UrbanDictionary\WordException
     *  @expectedExceptionMessage 'badt' cannot be found in the dictionary.
     */
    public function testDeleteFunctionFailsIfSlangDoesNotExist()
    {
        $this->wordEngine->delete('badt');
    }

    public function testDeleteFunctionWorks()
    {
        $initial_count = count($this->wordEngine->main);
        $this->wordEngine->delete('bromance');
        $final_count = count($this->wordEngine->main);
        $this->assertEquals(-1, ($final_count - $initial_count));
        $this->assertNotContains('bromance', array_keys($this->wordEngine->main));
    }

    /**
     * @expectedException Elchroy\UrbanDictionary\WordException
     * @expectedExceptionMessage 'badt' cannot be found in the dictionary.
     */
    public function testUpdateFunctionFailsIfSlangDoesNotExist()
    {
        $this->wordEngine->update('badt', 'This is the definition of a very very bad guy!', 'description');
    }

    /**
     * @expectedException Elchroy\UrbanDictionary\WordException
     * @expectedExceptionMessage Wrong number of arguments: Please specify updated value.
     */
    public function testUpdateFunctionFailsIfWrongNumberOfParametersAreGiven()
    {
        $this->wordEngine->update('bromance');
    }


    public function testUpdateFunctionWorksIfTheSlangExistsInTheDictionary()
    {
        $this->wordEngine->update('bromance', 'This is the updated description for the slang.', 'description');
        $this->wordEngine->update('bromance', 'This is the updated sample_sentence for the slang.', 'sample_sentence');
        $this->assertEquals('This is the updated description for the slang.', $this->wordEngine->main['bromance']['description']);
        $this->assertEquals('This is the updated sample_sentence for the slang.', $this->wordEngine->main['bromance']['sample_sentence']);
    }

    /**
     *  @expectedException Elchroy\UrbanDictionary\WordException
     *  @expectedExceptionMessage 'badt' cannot be found in the dictionary.
     */
    public function testRetrieveFunctionFailsIfSlangDoesNotExistsInTheDictionary()
    {
        $this->wordEngine->retrieve('badt');
    }

    /**
     * @expectedException Elchroy\UrbanDictionary\WordException
     * @expectedExceptionMessage No defined property - 'usage'
     */
    public function testRetrieveFunctionFailsIfWrongPropertyIsProvidedAsSecondArgument()
    {
        $this->wordEngine->retrieve('bromance', 'usage');
    }



    public function testRetrieveFunctionWorksIfSlangExistsInTheDictionary()
    {
        $descriptiona = $this->wordEngine->retrieve("bromance");
        $this->assertEquals("This is the romance that exists between two men.", $descriptiona);
        $descriptionb = $this->wordEngine->retrieve("bromance", "description");
        $this->assertEquals("This is the romance that exists between two men.", $descriptionb);
        $sample_sentencea = $this->wordEngine->retrieve("bromance", "sample_sentence");
        $this->assertEquals("", $sample_sentencea);
        $this->wordEngine->add("sup", "This is another way of saying What's Up", "Hey Bro, Sup!!!");
        $sample_sentenceb = $this->wordEngine->retrieve("sup", "sample_sentence");
        $this->assertEquals("Hey Bro, Sup!!!", $sample_sentenceb);
    }


    public function testsSlangExistsFunctionReturnTrueIfSlangParameterIsInTheDictionary()
    {
        $slang_exists = $this->wordEngine->slang_exists('bromance');
        $this->assertTrue(true, $slang_exists);
    }

    public function testsSlangExistsFunctionReturnFalseIfSlangParameterIsNotInTheDictionary()
    {
        $slang_exists = $this->wordEngine->slang_exists('nonExistingWord');
        $this->assertNotTrue(false, $slang_exists);
    }
}