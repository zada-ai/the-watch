<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\BestSeller;

$data = BestSeller::all()->toArray();
file_put_contents(__DIR__ . '/../storage/debug_bestsellers.json', json_encode($data, JSON_PRETTY_PRINT));
echo "WROTE\n";
