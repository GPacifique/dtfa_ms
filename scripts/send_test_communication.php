<?php


require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// create staff if missing
$staff = App\Models\Staff::firstOrCreate(
    ['email' => 'gashumbaaimable@gmail.com'],
    ['first_name' => 'Gashumba', 'last_name' => 'Aimable']
);

// create communication
$comm = App\Models\Communication::create([
    'title' => 'Test communication',
    'body' => "This is a test sent to gashumbaaimable@gmail.com",
    'sender_id' => 1,
    'audience' => 'staff',
]);

// queue email
// For local testing, use the 'log' mailer so we don't rely on external SMTP.
config(['mail.default' => 'log']);
Illuminate\Support\Facades\Mail::to('gashumbaaimable@gmail.com')->send(new App\Mail\CommunicationSent($comm));

echo "Sent (logged) communication id={$comm->id}\n";
