<?php 

class Products
{
    private static $products = [];
    private static $file = __DIR__ . '/products.txt';

    private static function compile()
    {
        $lines = getProductFileLines(self::$file);

        foreach ($lines as $line) {
            $id = getIDFromLine($line);
            $name = getNameFromLine($line);
            self::$products[$id] = getProductObjectFromId($id, $name);
        }
    }

    public static function get(string $id = null, string $file = __DIR__ . '/products.txt')
    {
        if (! empty($file)) {
            self::$file = $file;
        }

        self::compile();

        if (empty($id)) {
            return self::$products;
        }

        if (isset(self::$products[$id]))
        {
            return self::$products[$id];
        }
    }
}

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

$productsData = __DIR__ . '/products.txt';

if (! file_exists($productsData)) {
    exit('Data file does not exist.' . PHP_EOL);
}

$products = Products::get();

print_r($products) . PHP_EOL;

$product345 = Products::get('345');

print_r($product345) . PHP_EOL;
