<?php

namespace Elchroy\UrbanDictionary;

class Word
{
    public static $data = [
            'tight' => [
                            'slang'             => 'tight',
                            'description'       => 'When someone performs an awesome task',
                            'sample_sentence'   => 'Prosper has finished the curriculum, Tight.'
                        ]
        ];

    static function getStaticSlang()
    {
        return self::$data['tight']['slang'];
    }

    static function getStaticDescription()
    {
        return self::$data['tight']['description'];
    }

    static function getStaticSentence()
    {
        return self::$data['tight']['sample_sentence'];
    }
}
