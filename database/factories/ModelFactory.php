<?php


/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Client::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company(),
    ];
});

$factory->defineAs(App\ClientMeta::class, 'rate', function (Faker\Generator $faker) {
    return [
        'meta_key' => 'rate',
        'meta_value' => $faker->numberBetween(100, 1000),
    ];
});

$factory->defineAs(App\ClientMeta::class, 'currency', function (Faker\Generator $faker) {
    return [
        'meta_key' => 'currency',
        'meta_value' => $faker->currencyCode(),
    ];
});

$factory->defineAs(App\ClientMeta::class, 'gdrive', function (Faker\Generator $faker) {
    return [
        'meta_key' => 'gdrive',
        'meta_value' => $faker->url(),
    ];
});

$factory->define(App\Inbox::class, function (Faker\Generator $faker) {
    $created_at = $faker->dateTimeThisYear();
    $updated_at = $faker->dateTimeThisYear($created_at);

    return [
        'description' => $faker->text(),
        'source_int' => $faker->url(),
        'source_ext' => $faker->url(),
        'done' => $faker->boolean(),
        'created_at' => $created_at,
        'updated_at' => $updated_at,
    ];
});


$factory->define(App\Project::class, function (Faker\Generator $faker) {
    return [
        'status_id' => 1,
        'name' => $faker->text($faker->numberBetween(10, 20)),
        'type' => $faker->text(10),
        'note' => $faker->text(),
        'deadline' => $faker->dateTimeThisYear(date('Y').'-12-31'),
    ];
});

$factory->define(App\Task::class, function (Faker\Generator $faker) {
    return [
        'status_id' => $faker->numberBetween(1, 9),
        'name' => $faker->text($faker->numberBetween(10, 20)),
        'description' => $faker->text(),
        'source_int' => $faker->url(),
        'source_ext' => $faker->url(),
        'estimate' => $faker->randomFloat(2, 0, 30),
        'deadline' => $faker->dateTimeThisYear(date('Y').'-12-31'),
        'checked' => $faker->dateTimeThisYear(),
    ];
});

$factory->define(App\Worker::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name(),
        'email' => $faker->email(),
    ];
});

$factory->defineAs(App\WorkerMeta::class, 'type', function (Faker\Generator $faker) {
    return [
        'meta_key' => 'type',
        'meta_value' => $faker->word(),
    ];
});

$factory->defineAs(App\WorkerMeta::class, 'job', function (Faker\Generator $faker) {
    return [
        'meta_key' => 'job',
        'meta_value' => $faker->jobTitle(),
    ];
});

$factory->defineAs(App\WorkerMeta::class, 'birthday', function (Faker\Generator $faker) {
    return [
        'meta_key' => 'birthday',
        'meta_value' => $faker->dateTimeThisCentury(),
    ];
});

$factory->defineAs(App\WorkerMeta::class, 'rate', function (Faker\Generator $faker) {
    return [
        'meta_key' => 'rate',
        'meta_value' => $faker->numberBetween(100, 1000),
    ];
});

$factory->defineAs(App\WorkerMeta::class, 'note', function (Faker\Generator $faker) {
    return [
        'meta_key' => 'note',
        'meta_value' => $faker->text(),
    ];
});

$factory->defineAs(App\WorkerMeta::class, 'gdrive', function (Faker\Generator $faker) {
    return [
        'meta_key' => 'gdrive',
        'meta_value' => $faker->url(),
    ];
});

$factory->defineAs(App\WorkerMeta::class, 'status', function (Faker\Generator $faker) {
    return [
        'meta_key' => 'status',
        'meta_value' => $faker->randomElement(['active', 'inactive']),
    ];
});

$factory->defineAs(App\WorkerMeta::class, 'bank', function (Faker\Generator $faker) {
    return [
        'meta_key' => 'bank',
        'meta_value' => $faker->bankAccountNumber().'/'.$faker->randomNumber(4),
    ];
});


$factory->define(App\Worksheet::class, function (Faker\Generator $faker) {
    $end = $faker->dateTimeThisYear();

    return [
        'client' => $faker->company(),
        'project' => $faker->text($faker->numberBetween(10, 20)),
        'task' => $faker->text($faker->numberBetween(10, 20)),
        'description' => $faker->text(),
        'start' => $faker->dateTimeThisYear($end),
        'end' => $end,
        'duration' => $faker->randomFloat(2, 0, 30),
        'tags' => $faker->words(3, true),
        'amount' => $faker->randomFloat(2, 0, 10000),
        'currency' => $faker->currencyCode(),
        'billable' => $faker->boolean(),
    ];
});

$factory->define(App\Bank::class, function (Faker\Generator $faker) {
    return [
        'date' => $faker->dateTimeThisYear(),
        'cash' => $faker->randomFloat(),
        'currency' => $faker->currencyCode(),
        'account_num' => $faker->bankAccountNumber(),
        'account_name' => $faker->word(),
        'bank_num' => $faker->randomNumber(4),
        'bank_name' => $faker->word(),
        'const_sym' => $faker->randomNumber(),
        'var_sym' => $faker->randomNumber(),
        'spec_sym' => $faker->randomNumber(),
        'description' => $faker->text(),
        'message' => $faker->text(140),
        'type' => $faker->text(),
        'user' => $faker->name(),
        'specification' => $faker->text(),
        'comment' => $faker->text(),
        'bic_id' => $faker->text(11),
        'payment_id' => $faker->randomNumber(),
    ];
});

$factory->defineAs(App\Role::class, 'admin', function () {
    return [
        'name' => 'admin',
        'display_name' => 'Administrator',
        'description' => 'Almighty',
    ];
});

$factory->defineAs(App\Role::class, 'manager', function () {
    return [
        'name' => 'manager',
        'display_name' => 'Manager',
        'description' => 'Managing team',
    ];
});

$factory->defineAs(App\Role::class, 'worker', function () {
    return [
        'name' => 'worker',
        'display_name' => 'Worker',
        'description' => 'Hard working person',
    ];
});

$factory->defineAs(App\Role::class, 'guest', function () {
    return [
        'name' => 'guest',
        'display_name' => 'Guest',
        'description' => 'Very limited access',
    ];
});

$factory->define(App\TaskLog::class, function (Faker\Generator $faker) {
    $end = $faker->dateTimeThisYear();

    return [
        'start' => $faker->dateTimeThisYear($end),
        'end' => $end,
    ];
});

$factory->defineAs(App\SocialAccount::class, 'primary', function () {
    return [
        'provider_user_id' => '595706863941058',
        'provider' => 'facebook',
        'name' => 'Patrik Šíma',
        'avatar' => 'https://graph.facebook.com/v2.6/595706863941058/picture?type=normal',
    ];
});
