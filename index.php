<?php

       // This is mu first example of a php generator.
       //
       function num() {
            for ($i = 1; $i <=10; ++$i) {
                yield $i;
                echo "This is the next number: $i.\n";
            }
       }

      // print_r(num());

      foreach(num() as $v);


num();

num();

      // print_r(num());