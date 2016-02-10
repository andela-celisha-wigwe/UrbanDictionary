<?php

namespace Elchroy\UrbanDictionary;

use Elchroy\UrbanDictionary\Word;

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
        $sentence = preg_replace("/[^a-zA-Z0-9\s]/", '', $sentence); // remove all non-alphanumercic charaters.
        $count_array = [];
        // $count_array = array();
        $words = explode(' ', $sentence);
        foreach ($words as $word) {
            $count = $this->getCount($words, $word);
            $count_array[$word] = $count;
        }
        return $count_array;
    }

    private function getCount($words, $word)
    {
        $count = 0;
        foreach ($words as $second_word) {
            if ($word == $second_word) {
                $count++;
            }
        }
        return $count;
    }
}