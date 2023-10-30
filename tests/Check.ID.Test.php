<?php
declare(strict_types=1);

use App\Utils\Check;
use Tester\Assert;

require '..\vendor\autoload.php';

Tester\Environment::setup();

$result = Check::ID(-1);
Assert::same(false, $result);

$result = Check::ID(0);
Assert::same(false, $result);

$result = Check::ID(1);
Assert::same(true, $result);