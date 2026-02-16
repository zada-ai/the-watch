<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$p = \App\Models\Product::first();
if (!$p) {
    echo "No products found\n";
    exit;
}

echo "Product ID: " . $p->id . "\n";
echo "Name: " . $p->name . "\n";
echo "Images (raw):\n";
print_r($p->images);

echo "Images (as stored JSON):\n";
echo json_encode($p->getRawOriginal('images')) . "\n";
