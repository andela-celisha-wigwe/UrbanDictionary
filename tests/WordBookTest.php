<?php
namespace Elchroy\Tests;
use Elchroy\UrbanDictionary\Word;
use Elchroy\UrbanDictionary\WordBook;
use Elchroy\UrbanDictionary\WordException;

class WordBookTest extends \PHPUnit_Framework_TestCase
{
    public $data;
    public $wordBook;

    public function setUp()
    {
        $this->wordBook = new WordBook();
        $this->wordBook->add('bromance', 'This is the romance that exists between two men.');
        $this->data = [
                'slang'             => 'bromance',
                'description'       => 'This is the romance that exists between two men.',
                'sample_sentence'   => '',
                'likes'             => 0,
                'unlikes'           => 0,
        ];
    }

    /**
     * @expectedException Elchroy\UrbanDictionary\WordException
     * @expectedExceptionMessage 'bromance' already exists in the dictionary.
     */
    public function testAddFuncitonFailsForAlreadyExistingSlang()
    {
        $this->wordBook->add('bromance', 'This is another description for the word. This should fail.');
    }

    public function addToMain()
    {
        $this->wordBook->add('wetin', "Another way of saying 'What?'.");
        $this->wordBook->add('Eh-en', 'This has different meanings', 'Eh-en, eh-en');
    }

    public function testFirstFunctionWorks()
    {
        $first = $this->wordBook->first();
        $expected = array(
                            'slang'             => 'tight',
                            'description'       => 'When someone performs an awesome task',
                            'sample_sentence'   => 'Prosper has finished the curriculum, Tight.',
                            'likes'             => 0,
                            'unlikes'           => 0,
            );
        $this->assertEquals($expected, $first);
    }


    public function testCurrentFunctionworksAfterNextIsCalled()
    {
        $this->wordBook->next();
        $current = $this->wordBook->current();
        $this->assertEquals($this->data, $current);
    }


    public function testCurrentFunctionWorksAFterPrevIsCalled()
    {
        $this->addToMain();
        $this->wordBook->next();
        $this->wordBook->next();
        $this->wordBook->prev();
        $current = $this->wordBook->current();
        $this->assertEquals($this->data, $current);
    }


    public function testNextFunctionWorks()
    {
        $this->addToMain();
        $next = $this->wordBook->next();
        $this->assertEquals($this->data, $next);
    }




    public function testPrevFunctionWorksWell()
    {
        $this->addToMain();
        $this->wordBook->next();
        $this->wordBook->next();
        $this->wordBook->next();
        $prev = $this->wordBook->prev();
        $expected = array(
                    'slang'             => 'wetin',
                    'description'       => "Another way of saying 'What?'.",
                    'sample_sentence'   => '',
                    'likes'             => 0,
                    'unlikes'           => 0,
            );
        $this->assertEquals($expected, $prev);

    }


    public function testLastFunctionWorks()
    {
        $this->addToMain();
        $last = $this->wordBook->last();
        $expected = array(
                            'slang'             => 'Eh-en',
                            'description'       => 'This has different meanings',
                            'sample_sentence'   => 'Eh-en, eh-en',
                            'likes'             => 0,
                            'unlikes'           => 0,
            );
        $this->assertEquals($expected, $last);
    }



    public function testAddFunctionIncreasesTheNumberOfWordsInTheDictionary()
    {
        $initial_count = count($this->wordBook->main);
        $this->addToMain();
        $final_count = count($this->wordBook->main);
        $this->assertEquals(2, ($final_count - $initial_count));
    }

    public function testAddFunctionAddsANewWordToTheDictionary()
    {
        $this->addToMain();
        $this->assertContains('wetin', $this->wordBook->allSlangs());
    }

    public function testAllSlangsFunctionReturnsAnArrayOfAllSlangsInThedictionary()
    {
        $this->addToMain();
        $this->assertEquals(4, count($this->wordBook->allSlangs()));
    }

    /**
     *  @expectedException Elchroy\UrbanDictionary\WordException
     *  @expectedExceptionMessage 'badt' cannot be found in the dictionary.
     */
    public function testDeleteFunctionFailsIfSlangDoesNotExist()
    {
        $this->wordBook->delete('badt');
    }

    public function testDeleteFunctionWorks()
    {
        $initial_count = count($this->wordBook->main);
        $this->wordBook->delete('bromance');
        $final_count = count($this->wordBook->main);
        $this->assertEquals(-1, ($final_count - $initial_count));
        $this->assertNotContains('bromance', array_keys($this->wordBook->main));
    }

    /**
     * @expectedException Elchroy\UrbanDictionary\WordException
     * @expectedExceptionMessage 'badt' cannot be found in the dictionary.
     */
    public function testUpdateFunctionFailsIfSlangDoesNotExist()
    {
        $this->wordBook->update('badt', 'This is the definition of a very very bad guy!', 'description');
    }

    /**
     * @expectedException Elchroy\UrbanDictionary\WordException
     * @expectedExceptionMessage Wrong number of arguments: Please specify updated value.
     */
    public function testUpdateFunctionFailsIfWrongNumberOfParametersAreGiven()
    {
        $this->wordBook->update('bromance');
    }


    /**
     * @expectedException Elchroy\UrbanDictionary\WordException
     * @expectedExceptionMessage No defined property - 'UnrecognizedProperty'
     */
    public function testUpdateFunctionFailsIfPropertyDoesNotExist()
    {
        $this->wordBook->update('bromance', 'this is the value to update', 'UnrecognizedProperty');
    }


    public function testUpdateFunctionWorksIfTheSlangExistsInTheDictionary()
    {
        $updates = array(
                    ['bromance', 'This is the updated description for the slang.', 'description' ],
                    ['bromance', 'This is the updated sample_sentence for the slang.', 'sample_sentence'],
            );
        foreach ($updates as $update) {
            $this->wordBook->update($update[0], $update[1], $update[2]);
            $this->assertEquals($update[1], $this->wordBook->main[$update[0]][$update[2]]);
        }
    }

    /**
     *  @expectedException Elchroy\UrbanDictionary\WordException
     *  @expectedExceptionMessage 'badt' cannot be found in the dictionary.
     */
    public function testRetrieveFunctionFailsIfSlangDoesNotExistsInTheDictionary()
    {
        $this->wordBook->retrieve('badt');
    }

    /**
     * @expectedException Elchroy\UrbanDictionary\WordException
     * @expectedExceptionMessage No defined property - 'usage'
     */
    public function testRetrieveFunctionFailsIfWrongPropertyIsProvidedAsSecondArgument()
    {
        $this->wordBook->retrieve('bromance', 'usage');
    }

    public function testRetrieveFunctionWorksWhenOnlySlangIsProvidedUsingDescriptionAsProperty()
    {
        $descriptiona = $this->wordBook->retrieve("bromance");
        $this->assertEquals("This is the romance that exists between two men.", $descriptiona);
    }


    public function testRetrieveFunctionWorksIfSlangExistsInTheDictionaryAndPropertyIsProvidedAsSecondArgument()
    {
        $this->wordBook->add("sup", "This is another way of saying What's Up", "Hey Bro, Sup!!!");
        $retrievals = array(
                        ['This is the romance that exists between two men.', 'bromance', 'description'],
                        ['', 'bromance', 'sample_sentence'],
                        ['Hey Bro, Sup!!!', 'sup', 'sample_sentence'],
            );
        foreach ($retrievals as $retrieval) {
            $this->assertEquals($retrieval[0], $this->wordBook->retrieve($retrieval[1], $retrieval[2]));
        }

    }


    public function testsSlangExistsFunctionReturnTrueIfSlangParameterIsInTheDictionary()
    {
        $slang_exists = $this->wordBook->slang_exists('bromance');
        $this->assertTrue(true, $slang_exists);
    }

    public function testsSlangExistsFunctionReturnFalseIfSlangParameterIsNotInTheDictionary()
    {
        $slang_exists = $this->wordBook->slang_exists('nonExistingWord');
        $this->assertNotTrue(false, $slang_exists);
    }

     public function testFetchfunctionWorks()
    {
        $expected = $this->wordBook->fetch('bromance');
        $this->assertEquals($expected, $this->data);
    }


    public function testMagicMethodWorks()
    {
        $slang = $this->wordBook->bromance;
        $this->assertEquals($slang, $this->data);
    }


     public function testLikeFunction()
    {
        $init = $this->wordBook->likes('bromance');
        $this->wordBook->like('bromance');
        $final = $this->wordBook->likes('bromance');
        $this->assertEquals(1, $final - $init);
    }


    public function testLikesFunction()
    {
        $likes = $this->wordBook->likes('bromance');
        $this->assertEquals(0, $likes);
    }


    public function testUnlikeFunction()
    {
        $init = $this->wordBook->unlikes('bromance');
        $this->wordBook->unlike('bromance');
        $final = $this->wordBook->unlikes('bromance');
        $this->assertEquals(1, $final - $init);
    }



    public function testUnlikesFunction()
    {
        $unlikes = $this->wordBook->unlikes('bromance');
        $this->assertEquals(0, $unlikes);
    }

    public function testRatingfunciton()
    {
        $this->wordBook->like('bromance');
        $this->wordBook->like('bromance');
        $this->wordBook->like('bromance');
        $this->wordBook->like('bromance');
        $this->wordBook->unlike('bromance');
        $rating = $this->wordBook->rating('bromance');
        // $this->assertEquals(3, $rating);
    }


    public function testStartsWithFunctionWorks()
    {
        $this->wordBook->add('zptitip', 'This is another random word that starts with zp');
        $this->wordBook->add('ghgzzp', 'This is another random word that ends with zp');
        $this->wordBook->add('zpaqtgzp', 'This is another random word that starts and ends with zp');
        $starts_with = $this->wordBook->starts_with('zp');
        $this->assertEquals(['zptitip', 'zpaqtgzp'], $starts_with);

    }

    public function testEndsWithFunctionWorks()
    {
        $this->wordBook->add('zptitip', 'This is another random word that starts with zp');
        $this->wordBook->add('ghgzzp', 'This is another random word that ends with zp');
        $this->wordBook->add('zpaqtgzp', 'This is another random word that starts and ends with zp');
        $ends_with = $this->wordBook->ends_with('zp');
        $this->assertEquals(['ghgzzp', 'zpaqtgzp'], $ends_with);

    }


    public function testRemoveLkeFunctionWorks()
    {
        $slang = 'bromance';
        $init = $this->wordBook->likes($slang);
        $this->wordBook->removeLike($slang);
        $final = $this->wordBook->likes($slang);
        $this->assertEquals(-1, $final - $init);
    }


    public function testRemoveUnlikeFunctionWorks()
    {
        $slang = 'bromance';
        $init = $this->wordBook->unlikes($slang);
        $this->wordBook->removeUnlike($slang);
        $final = $this->wordBook->unlikes($slang);
        $this->assertEquals(-1, $final - $init);
    }

    /**
     * @expectedException Elchroy\UrbanDictionary\WordException
     * @expectedExceptionMessage zzzzz is not found in the dictionary.
     */
    public function testFetchFunctionReturnsThrowsExceptionIFSlangIsNotInTHeDictionary()
    {
        $this->wordBook->fetch('zzzzz');
    }


    /**
     * @expectedException Elchroy\UrbanDictionary\WordException
     * @expectedExceptionMessage zzzzz is not found in the dictionary.
     */
    public function testLikesFunctionReturnsThrowsExceptionIFSlangIsNotInTHeDictionary()
    {
        $this->wordBook->likes('zzzzz');
    }


    /**
     * @expectedException Elchroy\UrbanDictionary\WordException
     * @expectedExceptionMessage zzzzz is not found in the dictionary.
     */
    public function testUnLikesFunctionReturnsThrowsExceptionIFSlangIsNotInTHeDictionary()
    {
        $this->wordBook->unlikes('zzzzz');
    }


    /**
     * @expectedException Elchroy\UrbanDictionary\WordException
     * @expectedExceptionMessage zzzzz is not found in the dictionary.
     */
    public function testLikeFunctionReturnsThrowsExceptionIFSlangIsNotInTHeDictionary()
    {
        $this->wordBook->like('zzzzz');
    }

    /**
     * @expectedException Elchroy\UrbanDictionary\WordException
     * @expectedExceptionMessage zzzzz is not found in the dictionary.
     */
    public function testUnlikeFunctionReturnsThrowsExceptionIFSlangIsNotInTHeDictionary()
    {
        $this->wordBook->unlike('zzzzz');
    }

    /**
     * @expectedException Elchroy\UrbanDictionary\WordException
     * @expectedExceptionMessage zzzzz is not found in the dictionary.
     */
    public function testRemoveLikeFunctionReturnsThrowsExceptionIFSlangIsNotInTHeDictionary()
    {
        $this->wordBook->removeLike('zzzzz');
    }

    /**
     * @expectedException Elchroy\UrbanDictionary\WordException
     * @expectedExceptionMessage zzzzz is not found in the dictionary.
     */
    public function testRemoveUnlikeFunctionReturnsThrowsExceptionIFSlangIsNotInTHeDictionary()
    {
        $this->wordBook->removeUnlike('zzzzz');
    }

}