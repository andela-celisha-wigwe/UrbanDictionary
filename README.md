# **UrbanDictionary**
##*Check Point 1A*
[![Coverage Status](ht,khjgkhtps://coveralls.io/repos/github/andela-celisha-wigwe/UrbanDictionary/badge.svg?branch=development)](https://coveralls.io/github/andela-celisha-wigwe/UrbanDictionary?branch=development)
[![Build Status](https://travis-ci.org/andela-celisha-wigwe/UrbanDictionary.svg?branch=development)](https://travis-ci.org/andela-celisha-wigwe/UrbanDictionary)
[![Circle CI](https://circleci.com/gh/andela-celisha-wigwe/UrbanDictionary/tree/development.svg?style=svg)](https://circleci.com/gh/andela-celisha-wigwe/UrbanDictionary/tree/development)

## **Urban Dictionary Agnostic PHP Package**

This package is a Urban Dictionary built with PHP. It contains slangs (urban words), with some descriptions of those words and some sample sentences showing how to use such slangs.

##**Installation**
This package requires both [PHP 5.5+](http://php.net/) and [Composer](https://getcomposer.org/)

`$ composer require Elchroy/UrbanDictionary`

##**Usage**


###**Word**
This class contains a static associative array. It defines the structure for storing the slangs in the dictionary.
This class is in the 'src/Word.php' file and in the `Elchroy\UrbanDictionary` namespace.
```
$slang = new Word(); // Create a new instance of the Word class.
$slang->getStaticSlang(); // ==> tight
$slang->getStaticDescription(); // ==> When someone performs an awesome task
$slang->getStaticSentence(); // ==> Prosper has finished the curriculum, Tight.
```


###**WordBook**
This class is the 'dynamic' array that contains slangs. It is the dictionary. You can add to, update, retrieve, and delete from the dictionary.
This class is in the 'src/WordBook.php' file and in the `Elchroy\UrbanDictionary` namespace. The data structure of the dictionary is similar to that of the static associative array in the Word class. It is however dynamic.
```
$wordBook = new WordBook(); // Create a new instance of the WordBook Class
$wordBook->add('Naa', "This is another way of saying 'No'.", 'Naa I do not think I will come home this weekend.');
$wordBook->retrieve('Naa'); // ==> This is another way of saying 'No'.
$wordBook->update('Naa', "This is the updated value of the sample_sentence of the slang 'Naa'.");
$wordBook->retrieve('Naa', 'sample_sentence'); // ==> This is the updated value of the sample_sentence of the slang 'Naa'.
$wordBook->delete('Naa'); // This deletes the slang from the dictionary.
$wordBook->retrieve('Naa'); // This returns an error, since the slang 'Naa' has been deleted from the dictionary.
$wordBook->fetch($slang); // Return the array containing a slang and its properties (slang name, description, sample_sentence, likes and unlikes).
$wordBook->first(); // Return the first slang in the dictionary.
$wordBook->current(); // Return the current slang being focused on.
$wordBook->next(); // Return the next slang, i.e after the current slang.
$wordBook->prev(); // Return the previous slang, i.e before the current slang.
$wordBook->last(); // Return the last slang in the dictionary.
$wordBook->startsWith('ti'); // Returns an array of all slangs that start with the string 'ti'.
$wordBook->endsWith('ti'); // Returns an array of all slangs that end with the string 'ti'.
$wordBook->likes($slang); // Return the number of ranks that a slang has.
$wordBook->unlikes($slang); // Return the number of unlikes that a slang has.
$wordBook->like($slang); // Increment the number of likes by 1 and return it.
$wordBook->removeLike($slang); // Decrement the number of likes by 1 and return it.
$wordBook->unlike($slang); // Increment the number of unlikes by 1 and return it.
$wordBook->removeUnlike($slang); // Decrement the number of unlikes by 1 and return it.
$wordBook->rating($slang); // Return a rating measure for the slang. Maximum rating is 100%.
```


###**Category**
This class is responsible for pairing each word in a sentence with the number of occurences of the word in the sentence.
This class is located in the 'src/Category.php' file and in the `Elchroy\UrbanDictionary` namespace. This class inherits from the WordBook class.
```
$sland = new Category();
$wordBook->add('Naa', "This is another way of saying 'No'.", 'Naa I do not think so. I do DO not want to come there. NAA!');
$wordBook->categorize('Naa');  // This is the case-sensitive function.
// ==> ['Naa' => 1, 'I' => 2, 'do' => 2, 'not' => 2, 'think' => 1, 'so' => 1, 'DO' => 1, 'want' => 1, 'to' => 1, 'come' => 1, 'there' => 1, 'NAA' => 1]
$wordBook->categorize_i('Naa'); // This is the case-insensitive function
// ==> ['Naa' => 2, 'I' => 2, 'do' => 3, 'not' => 2, 'think' => 1, 'so' => 1, 'want' => 1, 'to' => 1, 'come' => 1, 'there' => 1]
```


###**Test**
For tests, run `phpunit` from command line (WindowsOS) or terminal(MacOS).
*Ensure to cd to the application directory.*