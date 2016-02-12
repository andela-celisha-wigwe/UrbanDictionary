# **UrbanDictionary**
**Check Point 1A**
[![Coverage Status](https://coveralls.io/repos/github/andela-celisha-wigwe/UrbanDictionary/badge.svg?branch=development)](https://coveralls.io/github/andela-celisha-wigwe/UrbanDictionary?branch=development)
[![Build Status](https://travis-ci.org/andela-celisha-wigwe/UrbanDictionary.svg?branch=development)](https://travis-ci.org/andela-celisha-wigwe/UrbanDictionary)
[![Circle CI](https://circleci.com/gh/andela-celisha-wigwe/UrbanDictionary/tree/development.svg?style=svg)](https://circleci.com/gh/andela-celisha-wigwe/UrbanDictionary/tree/development)

## **Urban Dictionary Agnistic PHP Package**

This package is a Urban Dictionary built with PHP. It contains slangs (urban words), with some descriptions of those words and some sample sentences showing how to use such slangs.

### **File List**



File LIST
* Word.php
* WordEngine.php
* WordException.php
* Category.php

#### **Word Class**

The Word Class is stored in the Word.php file. The class has a static associative array.
This class is also located in the `Elchroy\UrbanDictionary` namespace.
```
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
}
```

#### **WordEngine Class**

The WordEngine Class is stored in the WordEngine.php file and in the `Elchroy\UrbanDictionary` namespace.
This class fetches the value of the static associative array in the Word class.
The majormethods used by instances of this class include :

* `add()` : This method is public and it adds slangs to the main array that contains all the words in the UrbanDictionary. At least the slang and its description must be provided for this method to work.
* `retrieve()` : This method is also public and it retrieves information from the dictionary. This information defaults to the description of the slang but the smaple sentence can also be retrieved. At least, the slang must be located in the dictionary.
* `update()` : This is also a public method. It updates the given slang with other new information. The property to be updated must be provided but defaults to its desciption.
* `delete()` : This is a public function that deletes a slang from the dictionary. The slang must be located in the dictionary and this action is irreversible.

##### **Other methods include**
*These methods are called by the four major methods*
* `slang_exists(slang)` : This methods return `true` if the slang exists in the main array (i.e in the dictionary). Otherwise, it return `false`.
* `throwError()` : This method throws an error to the WordException class (which inherits properties from the global Exception class).


#### **Category Class**

This Category Class is located in the Category.php file and in the `Elchroy\UrbanDictionary` namespace. it inherits from the `WordEngine` class.

The major methods here include
* `categorize()` : This method accepts at least one parameters (as arguments), a slang and its property (defaults to the sample_sentence. The description can also be passed as the second argument.
This method returns an array of each word with the number of occurences. The return value is an associative array with words as keys and count as the values.
* `categorize_i()` : This is imilar similar to the `categorize()` method above. The only difference is that it is case-insensitive.
The example below illustrates the use of both methods.
```
public $sentence;
$this->sentence = 'Hey, hey, sup, Sup, SUP, sup, 1 1 1 1 ';
$this->sentence->categorize()
```


describe the package



How to install and run the package



How to run the program once you have cloned it to your local machine