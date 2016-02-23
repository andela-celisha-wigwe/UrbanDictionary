<?php

namespace Elchroy\UrbanDictionary;

/**
 * The WordBook. It has an associative array of words thus the urban dictionary.
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
     * $properties The array of all properties of slangs inside the dicntionary. This is a private variable.
     *
     * @var array
     */
    private static $properties = ['slang', 'description', 'sample_sentence', 'likes', 'unlikes'];

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
                        ],
        ];
    }

    /**
     * [__get description].
     *
     * @param string $slang The slang to be 'gotten' from the array.
     *
     * @return [type] The array of the slang that was called. This is a simple use of the magic method.
     */
    public function __get($slang)
    {
        return $this->fetch($slang);
    }

    /**
     * [add description] - Adds a slang to the main array of the urban dicitonary.
     * Throws and error if the slang to be added is already existng in the dictioanry.
     *
     * @param string $slang           the slang to be added to dictionary
     * @param string $description     a brief description or meaning of he slang to be added to the dictionary. Not optional
     * @param string $sample_sentence A sample sentece showing a simple usage of the slang. THis is optinal
     *
     * @return array The main array with the new slang added to it.
     */
    public function add($slang, $description, $sample_sentence = '')
    {
        // Throw an error if the slang already exists inside the dictionary.
        if ($this->slangExists($slang)) {
            $this->throwError("'$slang' already exists in the dictionary.");
        }
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
     * @param string $slang    The slang whose data is to be retrieved.
     * @param string $property The property whose value is to be retrieved. This defaults to description but can be set as the sample usage sentence.
     *
     * @return string - The value of the property as defined byt the property paramenter/argument.
     */
    public function retrieve($slang, $property = 'description')
    {
        // Throw an error is the slang to be retrieved is not found in the dictionary
        if (!($this->slangExists($slang))) {
            $this->throwError("'$slang' cannot be found in the dictionary.");
        }
        // Throw an error is the property to be retireved is not listed as one of the properties of the words in the dictionary
        if (!(in_array($property, self::$properties))) {
            $this->throwError("No defined property - '$property'");
        }
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
     * @param string $slang    - the slang ti be updated. THis is the key of the main array.
     * @param string $value    - The new value with which to update the property.  THis must be provided.
     * @param string $property - The is the property to update. It defaults to the description but can be set to the sample sentence.
     *
     * @return array - The main array with the update effected.
     */
    public function update($slang, $value = '', $property = 'description')
    {
        // Throw an error if the number of arguments passed to thge function is less than 2.
        if (func_num_args() < 2) {
            $this->throwError('Wrong number of arguments: Please specify updated value.');
        }
        // Throw an error if the slang the first argument given to the function does not exist in the dictionary
        if (!($this->slangExists($slang))) {
            $this->throwError("'$slang' cannot be found in the dictionary.");
        }
        // Throw an error is the property to be updated is not among the defined properties of the words in the dictionary.
        if (!(in_array($property, self::$properties))) {
            $this->throwError("No defined property - '$property'");
        }
        // If everything is OK, return the main array (the dicitonary array) with the updated information.
        $this->main[$slang][$property] = $value;

        return $this->main;
    }

    /**
     * [delete description] - Deletes a slang from the main array by unsetting the slang key within the main array.
     *
     * @param string $slang This is the slang to be deleted from the main array. Throws an exepotion if the slang cannot be found
     *
     * @return array - Return the array with the slang deleted.
     */
    public function delete($slang)
    {
        // Throw an error if the slang to be deleted is not found in the dictionary.
        if (!($this->slangExists($slang))) {
            $this->throwError("'$slang' cannot be found in the dictionary.");
        }
        // If everything is OK, delete(unset) the slang from the main array (that contains the diciotnary words)
        unset($this->main[$slang]);

        return $this->main;
    }

    /**
     * The previous slang in the dictionary.
     *
     * @return array The array of the previous slang in the dictionary
     */
    public function prev()
    {
        return prev($this->main);
    }

    /**
     * The next slang in the dictionary.
     *
     * @return array The array of the next slang in the dictionary
     */
    public function next()
    {
        return next($this->main);
    }

    /**
     * The last slang inside the dictionary.
     *
     * @return array The array containing the last slang in the dictionary.
     */
    public function last()
    {
        return end($this->main);
    }

    /**
     * The current slang inside the dictionary.
     *
     * @return array The array containing the current element being focused on in the array.
     */
    public function current()
    {
        return current($this->main);
    }

    /**
     * The first slang in the array.
     *
     * @return array The array contataining the first slang in the array.
     *               This moves the pointer to the first slang int he dictionary
     */
    public function first()
    {
        return reset($this->main);
    }

    /**
     * Select all slangs whose slangs are similar.
     *
     * @param 'string' $string The string to be used for the search.
     *
     * @return array The return value is the array of all words that start with the letter of the string.
     */
    public function startsWith($string)
    {
        $n = strlen($string);
        $sels = array_filter($this->allSlangs(), function ($slang) use ($string, $n) { return $string == substr($slang, 0, $n); });

        return array_values($sels);
    }

    /**
     * Selects all slang that end with the letters of the parameter string.
     *
     * @param string $string The string to be used for the search.
     *
     * @return array The return value is teh arry of all words that end wtith the letters of the string.
     */
    public function endsWith($string)
    {
        $n = strlen($string);
        $sels = array_filter($this->allSlangs(), function ($slang) use ($string, $n) { return $string == substr($slang, -$n, $n); });

        return array_values($sels);
    }

    /**
     * An array of all the words in the dictionary.
     *
     * @return array The return value is an array of all the slangs the words in the dictionary.
     */
    public function allSlangs()
    {
        return array_keys($this->main);
    }

    /**
     * Fetch the array of the slang beign requested for.
     *
     * @param string $slang The slang for which it is rrequired to find its details.
     *
     * @return array The return value is the full array containing all the properties of the slang,
     *               including the slang name, description, sample_sentence, likes and unlikes.
     */
    public function fetch($slang)
    {
        $this->throwExcpIfNoSlang($slang);

        return $this->main[$slang];
    }

    /**
     * Gets the number of likes ot the slang that is given.
     *
     * @param string $slang The slang for which we need to get its number of likes.
     *
     * @return int The integer value representing the number of likes of the slang in question.
     */
    public function likes($slang)
    {
        $this->throwExcpIfNoSlang($slang);

        return $this->main[$slang]['likes'];
    }

    /**
     * Gets the number of unlikes ot the slang that is given.
     *
     * @param string $slang The slang for which we need to get its number of unlikes.
     *
     * @return int The integer value representing the number of unlikes of the slang in question.
     */
    public function unlikes($slang)
    {
        $this->throwExcpIfNoSlang($slang);

        return $this->main[$slang]['unlikes'];
    }

    /**
     * The action to like the slang.
     *
     * @param string $slang The slang to be liked.
     *
     * @return interger The return value is the number of likes after being incremented by 1.
     */
    public function like($slang)
    {
        $this->throwExcpIfNoSlang($slang);

        return ++$this->main[$slang]['likes'];
    }

    /**
     * The action to unlike a slang.
     *
     * @param string $slang The slang to be unliked.
     *
     * @return int The number of unlikes if the slang after being incremented by 1.
     */
    public function unlike($slang)
    {
        $this->throwExcpIfNoSlang($slang);

        return ++$this->main[$slang]['unlikes'];
    }

    /**
     * the action to remove a 'like' from a slang.
     *
     * @param string $slang This is the slang tfor which it required to reduce it numebr of likes.
     *
     * @return int The number of likes of the slang in question, after being decremented by 1.
     */
    public function removeLike($slang)
    {
        $this->throwExcpIfNoSlang($slang);

        return --$this->main[$slang]['likes'];
    }

    /**
     * The action to remove an 'unlike' from a slang.
     *
     * @param string $slang The slang for which it is required to rduce uts number of unlikes.
     *
     * @return int The number of unlikes of the slang in question, after being decremented by 1.
     */
    public function removeUnlike($slang)
    {
        $this->throwExcpIfNoSlang($slang);

        return --$this->main[$slang]['unlikes'];
    }

    /**
     * The action to view the rating of a slang. This action word with like() and unlike().
     *
     * @param string $slang The slang for which its rating is required.
     *
     * @return int The rating value in percentage and float. highes rating is 100%.
     */
    public function rating($slang)
    {
        $total = $this->likes($slang) + $this->unlikes($slang);
        $likes = $this->likes($slang);
        $rating = (($likes / $total) * 100);

        return $rating;
    }

    /**
     * [slangExists description] - Checks whether a slang is inside the main array.
     *
     * @param string $slang the slang to be searched for inside the main array.
     *
     * @return bool - true is the slang exists or false otherwise.
     */
    public function slangExists($slang)
    {
        // Return true if the given slang exists in the dictionary. Otherwise, return false.
        return in_array($slang, $this->allSlangs());
    }

    /**
     * This function throws an exception if the $slang does not exist in the dictionary.
     *
     * @param string $slang This is the slang to be chcked in the dictionary.
     *
     * @return It throws an exception if slangExists function return false, but throws nothing (or null) otherwise.
     */
    public function throwExcpIfNoSlang($slang)
    {
        $this->slangExists($slang) ?: $this->throwError("$slang is not found in the dictionary.");
    }

    /**
     * [throwError description] Throws an exception depending ont he message that was given to it.
     *
     * @param string $msg The message to be displayed as the excetion pesssage when caught.
     *
     * @return Stops the flow of code because an exception is thrown.
     */
    public function throwError($msg)
    {
        // Throw a new WordException with a customized message that depends on what was passed to it.
        throw new WordException($msg);
    }
}
