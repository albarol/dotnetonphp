[![Build Status](https://travis-ci.org/fakeezz/dotnetonphp.png?branch=master)](https://travis-ci.org/fakeezz/dotnetonphp)

## .NETonPHP - .NET Framework implemented in PHP language

Author: Alexandre Barbieri (fakeezz)

## About
This project try encapsulate many functions scattered in cohesive objects. 
With this objects you can programming easier. 

Follows some example:


## General Libraries

### Old-style

```php
$date = strtotime("+7 day", $date);
echo date('M d, Y', $date);
```

### New-style

```php
$dateTime = DateTime::now();
echo $dateTime->addDays(7);
```

## IO

```php
$reader = new StreamReader("file.txt");
while(!$reader->endOfStream())
{
    echo $reader->read();
}
```


## Collections

```php
$queue = new Queue();
$queue->enqueue('dot');
echo $queue->dequeue();
```