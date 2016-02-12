<?php
        // use Elchroy\UrbanDictionary\Word;
        include "src/Word.php";
        $word = new Elchroy\UrbanDictionary\Word;
        var_dump($word->getStaticSlang());
        var_dump($word->getStaticDescription());
        var_dump($word->getStaticSentence());