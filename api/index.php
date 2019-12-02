<?php

    // Require the includes.php file - this file has all the stuffs you need to include
    require 'includes.php';

    /*
    ***** Router
    ***** Route with your object Name and $data to be processed
    */

    //Default Route Example
    // first param -- ImageController/upload
    // second param -- data to be passed
    
    //retrieve data by id - GET
    if (isset($_GET['id'])) {
        Router::get($_GET['obj'], $_GET['id']);
    }

    //retrieve all data - GET
    elseif (isset($_GET['criteria'])) {
        Router::getAll($_GET['obj']);
    }

    //Post data - for uploading images
    elseif (isset($_GET['details'])) {
        
        $request = [
            'image' => $_FILES['image'],
            'request' => json_decode(html_entity_decode($_GET['details']), true)
        ];

        Router::post($_GET['obj'], $request);
    }

    // POST data - for creating, updating and deleting
    else {
        Router::post($_GET['obj'], json_decode(file_get_contents("php://input"), true));
        
    }