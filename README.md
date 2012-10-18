#SimpleDebug
SimpleDebug is a small class that makes it easy to add,  bundle, fomat and finally print debug information in a PHP script.

##How to use
SimpleDebug is pretty easy to use in your PHP script. First You've got to include the class and create an object:
```php
include('simpledebug.php');
$simpledebug = new simpleDebug();
```
After that, you can add some debug information everywhere in your script in using this funtion:
```php
$simpledebug->addEvent('Identifier for event', 'Text/message for event');
```
Finally, if you want to get all events sorted in a table, you simply use:
```php
$simpledebug->formatEvents();
```
If you want to show the events, you can use `echo`.