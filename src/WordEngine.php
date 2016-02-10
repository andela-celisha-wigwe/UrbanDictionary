<?php

namespace Elchroy\UrbanDictionary;

use Elchroy\UrbanDictionary\Word;

class WordEngine
{
    public $main;
    public $properties = ['slang', 'description', 'sample_sentence'];


    public function __construct()
    {
        $this->main = Word::$data;
    }

    public function getData(){
        return $this->main;
    }


    public function add($slang, $description, $sentence='')
    {
        if($this->slang_exists($slang))
        {
            $this->throwError("'$slang' already exists in the dictionary.");
        }
            $this->main[$slang] = [
                'slang' => $slang,
                'description' => $description,
                'sample_sentence' => $sentence
            ];
    }

    public function retrieve($slang,$property='description')
    {
        if(!($this->slang_exists($slang)))
        {
            $this->throwError("'$slang' cannot be found in the dictionary.");
        }
        if(!(in_array($property, $this->properties)))
        {
            $this->throwError("No defined property - '$property'");
        }
        return $this->main[$slang][$property];
    }

    public function update($slang, $property, $value )
    {
        if(!($this->slang_exists($slang)))
        {
            $this->throwError("'$slang' cannot be found in the dictionary.");
        }

        if(!(in_array($property, $this->properties)))
        {
            $this->throwError("No defined property - '$property'");
        }
        $this->main[$slang][$property] = $value;
        return $this->main;
    }

    public function delete($slang)
    {
        if(!($this->slang_exists($slang)))
        {
            $this->throwError("'$slang' cannot be found in the dictionary.");
        }
        unset($this->main[$slang]);
    }

    function slang_exists($slang)
    {
        return array_key_exists($slang, $this->main);
    }

    function throwError($msg)
    {
        throw new \Exception($msg);
    }
}

