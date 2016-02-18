<?php

namespace Elchroy\UrbanDictionary;


/**
 * This is the Word class.
 *
 * It contains an associative array of urban words, the descriptions of
 * each slang and a sample sentence showing the usage of each slang.
 */
class Word
{
    public static $data = [
            'tight' => [
                            'slang'             => 'tight',
                            'description'       => 'When someone performs an awesome task',
                            'sample_sentence'   => 'Prosper has finished the curriculum, Tight.',
                        ]
        ];

    /**
     * This static function returns the value of the 'slang' key in the public static variable self::$data.
     * @return string tight
     */
    public static function getStaticSlang()
    {
        return self::$data['tight']['slang'];
    }

    /**
     * This static function returns the value of the 'description' key of the public static variable self::$data above.
     * @return string When someone perform an awesome task
     */
    public static function getStaticDescription()
    {
        return self::$data['tight']['description'];
    }

    /**
     * This static function returns the value of the 'sample_sentence'  key of the public static variable self::$data.
     * @return string Prosper has finished the curriculum, Tight.
     */
    public static function getStaticSentence()
    {
        return self::$data['tight']['sample_sentence'];
    }
}
