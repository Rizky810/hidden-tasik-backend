<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

\App\Models\User::firstOrCreate(
    ['email' => 'admin'],
    ['name' => 'Administrator', 'password' => \Illuminate\Support\Facades\Hash::make('tasik2024')]
);

echo "Admin user created successfully.";
