<?php 

function getProductFileLines($file)
{
    return file($file);
}

function getProductObjectFromId($id, $productName)
{
    // some kind of database lookup
    return new Product($id, $productName);
}

function getNameFromLine($line)
{
    if (preg_match("/.*-(.*)\s\d+/", $line, $array)) {
        return str_replace('_', ' ', $array[1]);
    }
    return '';
}

function getIDFromLine($line)
{
    if (preg_match("/^(\d{1,3})-/", $line, $array)) {
        return $array[1];
    }
    return -1;
}

class Product
{
    public $id;
    public $name;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}

$dataFile = __DIR__ . '/data.txt';

if (! file_exists($dataFile)) {
    exit('Data file does not exist.' . PHP_EOL);
}

$lines = getProductFileLines($dataFile);

$objects = [];

foreach ($lines as $line) {
    $id = getIDFromLine($line);
    $name = getNameFromLine($line);
    $objects[$id] = getProductObjectFromId($id, $name);
}

print_r($objects) . PHP_EOL;
