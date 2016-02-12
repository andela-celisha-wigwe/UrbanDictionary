<?php

namespace Elchroy\UrbanDictionary;

// use Elchroy\UrbanDictionary\WordException;

class WordEngine
{
    public $main;

    public $properties = ['slang', 'description', 'sample_sentence'];

    public function __construct()
    {
        $this->main = Word::$data;
    }

    public function getData()
    {
        return $this->main;
    }

    // Add - This adds words to the dictionary array.
    // First argument is the slang to be added. This is compulsory
    // Second argument is the description (meaning) of the slang that was given. This is also compusory.
    // Third argument is a sample sentence showing how the new slang can be used. This is optional and defaults to an empty string.
    public function add($slang, $description, $sentence = '')
    {
        if ($this->slang_exists($slang)) {
            $this->throwError("'$slang' already exists in the dictionary.");
        }
        $this->main[$slang] = [
            'slang'             => $slang,
            'description'       => $description,
            'sample_sentence'   => $sentence,
            ];
    }


    // Retrieve - This function retrieves infomration about a given slang.
    // The first argument is the slang. This is compulsory.
    // the second argument is the property whose value is to be retrieved. This is optional and defaults to 'description'
    public function retrieve($slang, $property = 'description')
    {
        if (!($this->slang_exists($slang))) {
            // Throw an error is the slang to be retrieved is not found in the dictionary
            $this->throwError("'$slang' cannot be found in the dictionary.");
        }
        if (!(in_array($property, $this->properties))) {
            // Throw an error is the property to be retireved is not listed as one of the properties of the words in the dictionary
            $this->throwError("No defined property - '$property'");
        }
        //If everything is OK, return the value of the property that was asked for.
        return $this->main[$slang][$property];
    }

    // Update - This methods updates the slang with new values as given in the arguments
    // The first argument is the slang to be updated. This value must be provided. Not optional
    // The second value is value to be provided. This must be provided.
    // The third value is the property whose value is to be updated. THis is optional and defaults to 'description'
    public function update($slang, $value = '', $property = 'description')
    {
        if (func_num_args() < 2) {
            // Throw an error if the number of arguments passed to thge function is less than 2.
            $this->throwError('Wrong number of arguments: Please specify updated value.');
        }

        if (!($this->slang_exists($slang))) {
            // Throw an error if the slang the first argument given to the function does not exist in the dictionary
            $this->throwError("'$slang' cannot be found in the dictionary.");
        }

        if (!(in_array($property, $this->properties))) {
            // Throw an error is the property to be updated is not among the defined properties of the words in the dictionary.
            $this->throwError("No defined property - '$property'");
        }
        // If everything is OK, return the main array (the dicitonary array) with the updated information.
        $this->main[$slang][$property] = $value;
        return $this->main;
    }

    // Delete - This method deletes a slang from the dictionary array. It accepts only one argument.
    // The argument is the slang to be deleted.
    public function delete($slang)
    {
        if (!($this->slang_exists($slang))) {
            // Throw an error if the slang to be deleted is not found in the dictionary.
            $this->throwError("'$slang' cannot be found in the dictionary.");
        }
        // If everything is OK, delete(unset) the slang from the main array (that contains the diciotnary words)
        unset($this->main[$slang]);
    }

    // SlangExitst. This method return TRUE is a slang exists int he main dictioanry. Otherwise, it returns FALSE
    public function slang_exists($slang)
    {
        // Return true if the given slang exists in the dictionary. Otherwise, return false.
        return array_key_exists($slang, $this->main);
    }

    // ThrowError - This method throws an error to the Exceton class.
    public function throwError($msg)
    {
        // Throw a new WordException with a customized message that depends on what was passed to it.
        throw new WordException($msg);
    }
}