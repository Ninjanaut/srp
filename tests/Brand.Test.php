<?php
declare(strict_types=1);

use App\Domain\Brand;
use Tester\Assert;

require '..\vendor\autoload.php';

Tester\Environment::setup();

$name = 'FooName';
$brand = new Brand($name);
Assert::same($name, $brand->getName());

$newName = 'NewName';
$brand->Update($newName);
Assert::same($newName, $brand->getName());

$id = 123;
$brand->setId($id);
Assert::same($id, $brand->getId());