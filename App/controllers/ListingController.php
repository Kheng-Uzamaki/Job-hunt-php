<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;

class ListingController
{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    /**
     * show the listings
     *
     * @return void
     */
    public function index()
    {


        $listings = $this->db->query('SELECT * FROM listings')->fetchAll();


        loadView('listings/index', [
            'listings' => $listings
        ]);
    }

    /**
     * create a new listing
     *
     * @return void
     */
    public function create()
    {
        loadView('/listings/create');
    }


    /**
     * show a details listing
     *
     * @return void
     */
    public function show($params)
    {
        $id = $params['id'] ?? '';

        $params = [
            'id' => $id
        ];

        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

        //check if listing not exist
        if (!$listing) {
            ErrorController::notFound('Listing not found!');
            return;
        }



        loadView('listings/show', [
            'listing' => $listing
        ]);
    }
}
