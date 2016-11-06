<?php

use Carbon\Carbon;

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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'email' => $faker->email,
        'name' => $faker->name,
        'allowed' => 1,
        'api_token' => str_random(60),
    ];
});

$factory->define(App\Client::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company(),
        'rate' => $faker->numberBetween(100, 1000),
        'currency' => $faker->currencyCode(),
        'gdrive' => $faker->url(),
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
        'status_id' => $faker->numberBetween(1, 11),
        'name' => $faker->text($faker->numberBetween(10, 20)),
        'description' => $faker->text(),
        'source_int' => $faker->url(),
        'source_ext' => $faker->url(),
        'estimate' => $faker->randomFloat(2, 0, 30),
        'deadline' => $faker->dateTimeThisYear(date('Y').'-12-31'),
    ];
});

$factory->define(App\Worker::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name(),
        'email' => $faker->email(),
        'address' => $faker->address(),
        'type' => $faker->word(),
        'job' => $faker->jobTitle(),
        'birthday' => $faker->dateTimeThisCentury(),
        'rate' => $faker->numberBetween(100, 1000),
        'note' => $faker->text(),
        'gdrive' => $faker->url(),
        'status' => $faker->randomElement(['active', 'inactive']),
        'bank' => $faker->bankAccountNumber().'/'.$faker->randomNumber(4),
    ];
});

$factory->define(App\Worksheet::class, function (Faker\Generator $faker) {
    $end = $faker->dateTimeThisYear();

    return [
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
    $start = Carbon::instance($end)->subMinutes(rand(1, 250));

    return [
        'start' => $start,
        'end' => $end,
    ];
});

$factory->define(App\SocialAccount::class, function (Faker\Generator $faker) {
    return [
        'provider_user_id' => $faker->numberBetween(100000, 999999),
        'provider' => $faker->word,
        'name' => $faker->name,
        'avatar' => $faker->url,
    ];
});

$factory->define(App\TaskRequest::class, function (Faker\Generator $faker) {
    return [
        'worker_id' => rand(1, 10),
        'task_id' => rand(1, 10),
        'estimate' => rand(1, 5),
        'reason' => $faker->sentence,
    ];
});

$factory->define(App\TaskStatus::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence,
        'type' => $faker->word,
        'slug' => $faker->slug,
        'order' => $faker->numberBetween(1, 11),
    ];
});
