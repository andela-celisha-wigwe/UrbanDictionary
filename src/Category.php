<?php

namespace Elchroy\UrbanDictionary;

class Category extends WordEngine
{
    public $main;

    public function __construct()
    {
        $this->main = Word::$data;
    }

    public function categorize($slang, $property = 'sample_sentence')
    {
        $sentence = $this->retrieve($slang, $property);
        return $this->group($sentence);
    }

    public function categorize_i($slang, $property = 'sample_sentence')
    {
        $sentence = $this->retrieve($slang, $property);
        $sentence = strtolower($sentence);
        return $this->group($sentence);
    }

    protected function group($sentence)
    {
        $sentence = $this->removeNonAlphaNum($sentence);
        $words = explode(' ', $sentence); // Create an array of all words.
        $counts = (array_map(function ($word) use ($words) {return $this->getCount($words, $word); }, $words)); // Create an array of number of occurences of each word.
        return array_combine($words, $counts); // Combine the two arrays and return the combined array. $words as keys, $counts as values
    }

    protected function removeNonAlphaNum($sentence)
    {
        $sentence = trim($sentence);
        return preg_replace("/[^a-zA-Z0-9\s]/", '', $sentence); // remove all non-alphanumercic charaters.
    }

    protected function getCount($words, $word)
    {
        $count = 0;
        array_map(function ($word2) use (&$word, &$count) {return $word2 == $word ? $count++ : $count; }, $words);
        return $count;
    }

}