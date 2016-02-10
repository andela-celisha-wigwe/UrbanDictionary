<?php

use Elchroy\UrbanDictionary\Word;
use Elchroy\UrbanDictionary\WordEngine;

class WordEngineTest extends PHPUnit_Framework_TestCase
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
     * @expectedException Exception
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
     *  @expectedException Exception
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
     * @expectedException Exception
     * @expectedExceptionMessage 'badt' cannot be found in the dictionary.
     */
    public function testUpdateFunctionFailsIfSlangDoesNotExist()
    {
        $this->wordEngine->delete('badt');
    }

    public function testUpdateFunctionWorksIfTheSlangExistsInTheDictionary()
    {
        $this->wordEngine->update('bromance', 'description', 'This is the updated description for the slang.');
        $this->wordEngine->update('bromance', 'sample_sentence', 'This is the updated sample_sentence for the slang.');
        $this->assertEquals('This is the updated description for the slang.', $this->wordEngine->main['bromance']['description']);
        $this->assertEquals('This is the updated sample_sentence for the slang.', $this->wordEngine->main['bromance']['sample_sentence']);
    }

    /**
     *  @expectedException Exception
     *  @expectedExceptionMessage 'badt' cannot be found in the dictionary.
     */
    public function testRetrieveFunctionFailsIfSlangDoesNotExistsInTheDictionary()
    {
        $this->wordEngine->retrieve('badt');
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage No defined property - 'usage'
     */
    public function testRetrieveFunctionFailsIfWrongPropertyIsProvidedAsSecondArgument()
    {
        $this->wordEngine->retrieve('bromance', 'usage');
    }



    public function testRetrieveFunctionWorksIfSlangExistsInTheDictionary()
    {
        $this->wordEngine->add("sup", "This is another way of saying What's Up", "Hey Bro, Sup!!!");
        $descriptiona = $this->wordEngine->retrieve("bromance");
        $this->assertEquals("This is the romance that exists between two men.", $descriptiona);
        $descriptionb = $this->wordEngine->retrieve("bromance", "description");
        $this->assertEquals("This is the romance that exists between two men.", $descriptionb);
        $sample_sentencea = $this->wordEngine->retrieve("bromance", "sample_sentence");
        $this->assertEquals("", $sample_sentencea);
        $sample_sentenceb = $this->wordEngine->retrieve("sup", "sample_sentence");
        $this->assertEquals("Hey Bro, Sup!!!", $sample_sentenceb);
    }
}