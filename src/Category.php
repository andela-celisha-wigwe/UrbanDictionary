<?php

/**
 * @author Elisha-Wigwe CHijioke O. <chijioke.elisha-wigwe@andela.com>
 * @copyright 2016 Elisha-Wigwe Chijioke O.
 */

namespace Elchroy\UrbanDictionary;

/**
 * The categrry class - Inherits some funcitons form the WordBook class.
 */
class Category extends WordBook
{
    /**
     * [categorize description] - This returns an associative array of words as keys and counts (number of occurences) as values. This action is case-sensitive. Thus 'This' is different from 'THIS' and 'this'. This method calls on the group method to categorize the sentence input
     *
     * @param  string $slang - this is the slang to be wworked on. It is the key of the associative array
     * @param  string $property - This is the property to be used to categorize. It defaults to sample_sentence but can be the 'description'.s
     * @return array - the return value is an associative array of slangs with descriptions and sample usage sentence..
     */
    public function categorize($slang, $property = 'sample_sentence')
    {
        $sentence = $this->retrieve($slang, $property);
        return $this->group($sentence);
    }

    /**
     * [categorize_i description] - this is simiar to the categorize function except that it is case -insensitive.
     * Thus 'THis', 'this' and 'THIS' are considered the same. The function first converts all characters to lovercsase using strtolower(). This method calls on the group method to categorize the sentence input
     *
     * @param  string $slang - This is the urban word to be worked on. It acts as one of the keys of the associative array.
     * @param  string $property - This is the property to be used to categorize. It defaults to sample_sentence but can be the 'description'
     * @return array - The return value is an associative array of slangs with descriptions and sample usage sentence. All keys in this array are lowercase.
     */
    public function categorizeI($slang, $property = 'sample_sentence')
    {
        $sentence = $this->retrieve($slang, $property);
        $sentence = strtolower($sentence);
        return $this->group($sentence);
    }


    /**
     * [group This method is the called by both categorize and categorize_i. It is the function that does the main categorization before passing it results to the dependent methods.
     *
     * @param  string $sentence the sentence to categorize. This defaults to the value of the sample_sentence key but can be set as the value of the description key.
     * @return array - this is the reti=urn value after combination of the $words array with the $couns array.
     */
    protected function group($sentence)
    {
        $sentence = $this->removeNonAlphaNum($sentence);
        $words = explode(' ', $sentence); // Create an array of all words.
        $counts = (array_map(function ($word) use ($words) {return $this->getCount($words, $word); }, $words)); // Create an array of number of occurences of each word.
        return array_combine($words, $counts); // Combine the two arrays and return the combined array. $words as keys, $counts as values
    }


    /**
     * [removeNonAlphaNum - This is a protected function. It removes all non-alphanumeric characters from a string. Only letters, numbers, and spaces within the sentence(string) can be sllowed.)
     *
     * @param  string - the string with all unwanted charaters and end white spaces.
     * @return string - the sentence with all unwanted charaters removed. Any leading or trailing white spaces are also remived.
     */
    protected function removeNonAlphaNum($sentence)
    {
        $sentence = trim($sentence);
        return preg_replace("/[^a-zA-Z0-9\s]/", '', $sentence); // remove all non-alphanumercic charaters.
    }

    /**
     * [getCount description] - This function return the number of occurences of a word in an array of words.
     * @param  array $words - The array of word[description]
     * @param  string $word - The word for which it is required to find its number of occurences.
     * @return int $count - THhe number of occurences of the word in the sentece.
     */
    protected function getCount($words, $word)
    {
        $count = 0;
        array_map(function ($word2) use (&$word, &$count) {return $word2 == $word ? $count++ : $count; }, $words);
        return $count;
    }

}