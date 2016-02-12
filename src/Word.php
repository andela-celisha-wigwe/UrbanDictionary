<?php

namespace Elchroy\UrbanDictionary;

class Word
{
    public static $data = [
            'tight' => [
                            'slang'             => 'tight',
                            'description'       => 'When someone perform an awesome task',
                            'sample_sentence'   => 'Prosper has finished the curriculum, Tight.'
                        ]
        ];

    public function getStaticSlang()
    {
        return self::$data['tight']['slang'];
    }

    public function getStaticDescription()
    {
        return self::$data['tight']['description'];
    }

    public function getStaticSentence()
    {
        return self::$data['tight']['sample_sentence'];
    }
}
