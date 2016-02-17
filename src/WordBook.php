<?php

namespace Elchroy\UrbanDictionary;

use Elchroy\Interfaces\BookInterface;
// require_once('interfaces/BookInterface.php');

/**
 * The WordBook. Has an associative arrayof words thus the urban dictionary.
 * It can add slangs to this array, retrieve infomation from the dicitonary.
 * It can also update certain properties of word in the array and can delete slang from the array.
 */
class WordBook
{
    /**
     * $main THe public varaible. This is accessible to both the class and its instances.
     *
     * @var array
     */
    public $main;

    /**
     * The public variable for the selections
     * @var array.
     */
    public $selections;

    /**
     * $properties The array of all properties of slangs inside the dicntionary. This is a private variable
     *
     * @var array
     */
    private static $properties = ['slang', 'description', 'sample_sentence'];

    /**
     * __construct Assigns some randome data inside the public main array.
     */
    public function __construct()
    {
        $this->main = [
            'tight' => [
                            'slang'             => 'tight',
                            'description'       => 'When someone performs an awesome task',
                            'sample_sentence'   => 'Prosper has finished the curriculum, Tight.',
                            'likes'             => 0,
                            'unlikes'           => 0,
                        ]
        ];
    }


    /**
     * [__get description]
     * @param  string $slang The slang to be 'gotten' from the array.
     * @return [type] The array of the slang that was called. This is a simple use of the magic method.
     */
    public function __get($slang)
    {
        return $this->fetch($slang);
    }

    /**
     * The previous slang in the dictionary.
     * @return array The array of the previous slang in the dictionary
     */
    public function prev()
    {
        return prev($this->main);
    }

    /**
     * The next slang in the dictionary
     * @return array The array of the next slang in the dictionary
     */
    public function next()
    {
        return next($this->main);
    }

    /**
     * The last slang inside the dictionary.
     * @return array The array containing the last slang in the dictionary.
     */
    public function last()
    {
        return end($this->main);
    }


    /**
     * The current slang inside the dictionary
     * @return array The array containing the current element being focused on in the array.
     */
    public function current()
    {
        return current($this->main);
    }

    /**
     * The first slang in the array
     * @return array The array contataining the first slang in the array.
     * This moves the pointer to the first slang int he dictionary
     */
    public function first()
    {
        return reset($this->main);
    }

    /**
    * Select all slangs whose slangs are similar.
    * @param  'string' $string The string to be used for the search.
    * @return array The return value is the array of all words that start with the letter of the string.
    */
    public function starts_with($string)
    {
        $n = strlen($string);
        $sels = array_filter($this->allSlangs(), function ($slang) use ($string, $n) { return $string == substr($slang, 0, $n); });
        return $sels;
        // return array_map(function ($sel) {return $this->$sel;}, $sels);
    }

    /**
     * Selects all slang that end with the letters of the parameter string.
     * @param  string $string The string to be used for the search.
     * @return array The return value is teh arry of all words that end wtith the letters of the string.
     */
    public function ends_with($string)
    {
        $n = strlen($string);
        $sels = array_filter($this->allSlangs(), function ($slang) use ($string, $n) { return $string == substr($slang, -$n, $n); });
        return $sels;
        // return array_map(function ($sel) { return $this->$sel;});

    }

    public function allSlangs()
    {
        return array_keys($this->main);
    }

    public function fetch($slang)
    {
        return $this->main[$slang];
    }

    public function likes($slang)
    {
        return $this->main[$slang]['likes'];
    }

    public function unlikes($slang)
    {
        return $this->main[$slang]['unlikes'];
    }

    public function like($slang)
    {
        return ++$this->main[$slang]['likes'];
    }


    public function unlike($slang)
    {
        return ++$this->main[$slang]['unlikes'];
    }


    public function removeLike($slang)
    {
        return --$this->main[$slang]['likes'];
    }


    public function removeUnlike($slang)
    {
        return --$this->main[$slang]['unlikes'];
    }

    public function rating($slang)
    {
        $total = $this->likes($slang) + $this->unlikes($slang);
        $likes = $this->likes($slang);
        $rating = (($likes / $total)*5);
        return $rating;
    }




    /**
     * [add description] - Adds a slang to the main array of the urban dicitonary.
     * Throws and error if the slang to be added is already existng in the dictioanry.
     *
     * @param string $slang       the slang to be added to dictionary
     * @param string $description a brief description or meaning of he slang to be added to the dictionary. Not optional
     * @param string $sample_sentence    A sample sentece showing a simple usage of the slang. THis is optinal
     * @return array The main array with the new slang added to it.
     */
    public function add($slang, $description, $sample_sentence = '')
    {
        // Throw an error if the slang already exists inside the dictionary.
        if ($this->slang_exists($slang)) { $this->throwError("'$slang' already exists in the dictionary."); }
        $this->main[$slang] = [
            'slang'             => $slang,
            'description'       => $description,
            'sample_sentence'   => $sample_sentence,
            'likes'             => 0,
            'unlikes'           => 0,
            ];
        return $this->main;
    }


    /**
     * [retrieve description] - Retrieves informstion form the main array.
     * Throws an exceptio if the given slang is not founc in the dictionary
     * Throws an exception if the property to be retrieved is not amnong the properties array.
     *
     * @param  string $slang    The slang whose data is to be retrieved.
     * @param  string $property The property whose value is to be retrieved. This defaults to description but can be set as the sample usage sentence.
     * @return string - The value of the property as defined byt the property paramenter/argument.
     */
    public function retrieve($slang, $property = 'description')
    {
        // Throw an error is the slang to be retrieved is not found in the dictionary
        if (!($this->slang_exists($slang))) { $this->throwError("'$slang' cannot be found in the dictionary."); }
        // Throw an error is the property to be retireved is not listed as one of the properties of the words in the dictionary
        if (!(in_array($property, self::$properties))) {$this->throwError("No defined property - '$property'");}
        //If everything is OK, return the value of the property that was asked for.
        return $this->main[$slang][$property];
    }

    /**
     * [update description] - Updated a slang in the main dicitonary array with upates passed in as arguments.
     * Throws an exception if the number of argument given to the function is less than 2.
     * Thwows an exception if the number of aguments given to the function is more than 3.
     * Throws an exception if the slang is not found in the main array.
     * Throws an exception if the property to be updated is not among the properties array.
     *
     * @param  string $slang - the slang ti be updated. THis is the key of the main array.
     * @param  string $value  - The new value with which to update the property.  THis must be provided.
     * @param  string $property - The is the property to update. It defaults to the description but can be set to the sample sentence.
     * @return array - The main array with the update effected.
     */
    public function update($slang, $value = '', $property = 'description')
    {
        // Throw an error if the number of arguments passed to thge function is less than 2.
        if (func_num_args() < 2) { $this->throwError('Wrong number of arguments: Please specify updated value.'); }
        // Throw an error if the slang the first argument given to the function does not exist in the dictionary
        if (!($this->slang_exists($slang))) { $this->throwError("'$slang' cannot be found in the dictionary."); }
        // Throw an error is the property to be updated is not among the defined properties of the words in the dictionary.
        if (!(in_array($property, self::$properties))) { $this->throwError("No defined property - '$property'"); }
        // If everything is OK, return the main array (the dicitonary array) with the updated information.
        $this->main[$slang][$property] = $value;
        return $this->main;
    }

    /**
     * [delete description] - Deletes a slang from the main array by unsetting the slang key within the main array
     *
     * @param  string $slang This is the slang to be deleted from the main array. Throws an exepotion if the slang cannot be found
     * @return array - Return the array with the slang deleted.
     */
    public function delete($slang)
    {
        // Throw an error if the slang to be deleted is not found in the dictionary.
        if (!($this->slang_exists($slang))) { $this->throwError("'$slang' cannot be found in the dictionary."); }
        // If everything is OK, delete(unset) the slang from the main array (that contains the diciotnary words)
        unset($this->main[$slang]);
        return $this->main;
    }

    /**
     * [slang_exists description] - Checks whether a slang is inside the main array.
     *
     * @param  string $slang the slang to be searched for inside the main array.
     * @return bool  - true is the slang exists or false otherwise.
     */
    public function slang_exists($slang)
    {
        // Return true if the given slang exists in the dictionary. Otherwise, return false.
        // return array_key_exists($slang, $this->main);
        return in_array($slang, $this->allSlangs());
    }

    /**
     * [throwError description] Throws an exception depending ont he message that was given to it.
     *
     * @param  string $msg The message to be displayed as the excetion pesssage when caught.
     * @return Stops the flow of code because an exception is thrown.
     */
    public function throwError($msg)
    {
        // Throw a new WordException with a customized message that depends on what was passed to it.
        throw new WordException($msg);
    }

}