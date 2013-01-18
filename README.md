#SimpleDebug
SimpleDebug is a small class that makes it easy to add,  bundle, fomat and finally print debug information in a PHP script.
SimpleDebug also provides time measurement with sections, so that you can find out which part of your script takes how much time.

##How to use
SimpleDebug is pretty easy to use in your PHP script. First you've got to include the class and create an object:
```php
include('simpledebug.php');
$simpledebug = new simpleDebug();
```
After that, you can add some debug information everywhere in your script in using this funtion:
```php
$simpledebug->addEvent('Identifier for event', 'Text/message for event');
```
Finally, if you want to get all events, you simply use:
```php
$simpledebug->getEvents();
```
If you want to get them sorted in a table, just write `true` into the parentheses.

For time measurement, just set a start point with `$simpledebug->startTime();` and an end point with `$simpledebug->endTime();`.
Between this points, you can add section markers with `$simpledebug->addSection();`. Each marker marks the end of an opened section and the beginning of a new.
If you want your measurements, `$simpledebug->getTimes();` will give you an array with all data.

##Example
###Events
```php
<?php
//include class and create an object
include('simpledebug.php');
$simpledebug = new simpleDebug();

//add some events
$simpledebug->addEvent('Test', 'Testing it!');
$simpledebug->addEvent('Another Test', 'This is the second event.');
$simpledebug->addEvent('Test no. 3', 'And another event.');

//print the formated version of the events
echo $simpledebug->getEvents(true);
?>
```
This will print a table like this:
```
#1 Test:         Testing it!
#2 Another Test: This is the second event.
#3 Test no. 3:   And another event.
```

###Time measurement
```php
<?php
//include class and create an object
include('simpledebug.php');
$simpledebug = new simpleDebug();

//start time measurement
$simpledebug->startTime();

//generating some test data
$testdata = array();
for ($i = 0; $i < 10000; $i++) {
    $testdata[] = rand();
}

//start new section
$simpledebug->addSection();

//print some of the testdata
foreach ($testdata as $key => $val) {
    if($val % 10 == 0) {
        echo $key . " => " . $val . "\n";
    }
}

//end measurement
$simpledebug->endTime();

//get all data of measurement and display them
var_dump($simpledebug->getTimes());
?>
```

##License
SimpleBug provides methods for a bundled output of debug information.
Copyright (C) 2012 Lukas Kolletzki

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see http://www.gnu.org/licenses/.