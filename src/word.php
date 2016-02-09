<?php

namespace Elchroy\UrbanDictionary;

class Word
{
    public function __construct()
    {
        echo __CLASS__."<br />";
    }

    static $data = [
            'tight' => [
                            'slang' => 'tight',
                            'description' => "When someone perform an awesome task",
                            'sample_sentence' => "Prosper has finished the curriculum, Tight."
                        ]
        ];
}
