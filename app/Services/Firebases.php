<?php

namespace App\Services;

use Kreait\Firebase\Factory;

class Firebases
{
    protected $factory;
    protected $database;
    // protected
    public function __construct()
    {
        $this->factory = (new Factory)
            ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
            ->withDatabaseUri(env('FIREBASE_API_URL'));


        $this->database = $this->factory->createDatabase();
    }

    public function getDatabase()
    {
        return $this->database;
    }
}
