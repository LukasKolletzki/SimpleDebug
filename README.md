#SimpleDebug
SimpleDebug is a small class that makes it easy to add,  bundle, fomat and finally print debug information in a PHP script.

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

##Example
```php
<?php
//Include class and create an object
include('simpledebug.php');
$simpledebug = new simpleDebug();

//Add some events
$simpledebug->addEvent('Test', 'Testing it!');
$simpledebug->addEvent('Another Test', 'This is the second event.');
$simpledebug->addEvent('Test no. 3', 'And another event.');

//Print the formated version of the events
echo $simpledebug->getEvents(true);
?>
```
This will print a table like this:
```
\#1 Test:         Testing it!
\#1 Another Test: This is the second event.
\#1 Test no. 3:   And another event.
```