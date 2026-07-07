<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->boot();

$gate = $app->make('Illuminate\Contracts\Auth\Access\Gate');
$policies = $gate->policies();

echo "Registered Policies: " . count($policies) . PHP_EOL;
echo PHP_EOL;

foreach ($policies as $model => $policy) {
    echo "  ✓ " . class_basename($model) . " => " . class_basename($policy) . PHP_EOL;
}

echo PHP_EOL;
echo "Policy registration successful!" . PHP_EOL;
