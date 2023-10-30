<?php
declare(strict_types=1);

use App\Utils\Check;
use Tester\Assert;

require '..\vendor\autoload.php';

Tester\Environment::setup();

$result = Check::IsEmpty('');
Assert::same(true, $result);

$result = Check::IsEmpty(' ');
Assert::same(true, $result);

$result = Check::IsEmpty('foo');
Assert::same(false, $result);