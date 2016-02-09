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
        // $sentence = $this->main[$slang][$property];
        $sentence = $this->retrieve($slang, $property);
        return $this->numberOf($sentence);
    }

    public function numberOf($sentence)
    {
        $count_array = array();
        $words = explode(" ", $sentence);
        $to_trim = [",", ".", "!"];
        foreach ($words as $word) {
            $word = trim($word, ".");
            $count = $this->getCount($words, $word);
            $count_array[$word] = $count;
        }
        return $count_array;
    }

    private function getCount($words, $word)
    {
        $count = 0;
        foreach($words as $second_word){
            if($word == $second_word){
                $count++;
            }
        }
        return $count;
    }
}

