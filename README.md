# **UrbanDictionary**
##*Check Point 1A*
[![Coverage Status](https://coveralls.io/repos/github/andela-celisha-wigwe/UrbanDictionary/badge.svg?branch=development)](https://coveralls.io/github/andela-celisha-wigwe/UrbanDictionary?branch=development)
[![Build Status](https://travis-ci.org/andela-celisha-wigwe/UrbanDictionary.svg?branch=development)](https://travis-ci.org/andela-celisha-wigwe/UrbanDictionary)
[![Circle CI](https://circleci.com/gh/andela-celisha-wigwe/UrbanDictionary/tree/development.svg?style=svg)](https://circleci.com/gh/andela-celisha-wigwe/UrbanDictionary/tree/development)

## **Urban Dictionary Agnostic PHP Package**

This package is a Urban Dictionary built with PHP. It contains slangs (urban words), with some descriptions of those words and some sample sentences showing how to use such slangs.

##**INSTALLATION**
This package requires both [PHP 5.5+](http://php.net/) and [Composer](https://getcomposer.org/)

`$ composer require Elchroy/UrbanDictionary`

##**USAGE**


###**Word**
This class contains a static associative array. It defines the structure for storing the slangs in the dictionary.
This class is in the 'src/Word.php' file and in the `Elchroy\UrbanDictionary` namespace.
```
$slang = new Word(); // Create a new instance of the Word class.
$slang->getStaticSlang(); // ==> tight
$slang->getStaticDescription(); // ==> When someone performs an awesome task
$slang->getStaticSentence(); // ==> Prosper has finished the curriculum, Tight.
```


###**WordEngine**
This class is the 'dynamic' array that contains slangs. It is the dictionary. You can add to, update, retrieve, and delete from the dictionary.
This class is in the 'src/WordEngine.php' file and in the `Elchroy\UrbanDictionary` namespace. The data structure of the dictionary is similar to that of the static associative array in the Word class. It is however dynamic.
```
$slang = new WordEngine(); // Create a new instance of the WordEngine Class
$slang->add('Naa', "This is another way of saying 'No'.", 'Naa I do not think I will come home this weekend.');
$slang->retrieve('Naa'); // ==> This is another way of saying 'No'.
$slang->update('Naa', "This is the updated value of the sample_sentence of the slang 'Naa'.");
$slang->retrieve('Naa', 'sample_sentence'); // ==> This is the updated value of the sample_sentence of the slang 'Naa'.
$slang->delete('Naa'); // This deletes the slang from the dictionary.
$slang->retrieve('Naa'); // This returns an error, since the slang 'Naa' has been deleted from the dictionary.
```


###**Category**
This class is responsible for pairing each word in a sentence with the number of occurences of the word in the sentence.
This class is located in the 'src/Category.php' file and in the `Elchroy\UrbanDictionary` namespace. This class inherits from the WordEngine class.
```
$sland = new Category();
$slang->add('Naa', "This is another way of saying 'No'.", 'Naa I do not think so. I do DO not want to come there. NAA!');
$slang->categorize('Naa');  // This is the case-sensitive function.
// ==> ['Naa' => 1, 'I' => 2, 'do' => 2, 'not' => 2, 'think' => 1, 'so' => 1, 'DO' => 1, 'want' => 1, 'to' => 1, 'come' => 1, 'there' => 1, 'NAA' => 1]
$slang->categorize_i('Naa'); // This is the case-insensitive function
// ==> ['Naa' => 2, 'I' => 2, 'do' => 3, 'not' => 2, 'think' => 1, 'so' => 1, 'want' => 1, 'to' => 1, 'come' => 1, 'there' => 1]
```


###**Test**
For tests, run `phpunit` from command line (WindowsOS) or terminal(MacOS).
*Ensure to cd to the application directory.*