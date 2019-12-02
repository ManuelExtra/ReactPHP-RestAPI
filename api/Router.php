<?php
    
    class Router
    {

        // POST - two params
        // The method that maps the url and the callback data together
        // -- Note: Object must be separated by a / e.g: 'className/method'
        public static function post($object, $callback){

            //Get class_name
            $class_name = explode('/', $object)[0];

            //Get method_name or property name
            $method_or_property = explode('/', $object)[1];

            //Check if a method exists in a class
            if(method_exists($class_name, $method_or_property)){
                $class_name::$method_or_property($callback);
            }
            
            //Check if a property exists in a class
            else if(property_exists($class_name, $method_or_property)){
                $class_name::$method_or_property = $callback;
            }

            //Otherwise
            else{
                // echo something
            }
        }

        // GET - two params
        // The method that maps the url and the callback data together
        // -- Note: Object must be separated by a / e.g: 'className/method'
        public static function get($object, $callback){

            //Get class_name
            $class_name = explode('/', $object)[0];

            //Get method_name or property name
            $method_or_property = explode('/', $object)[1];

            //Check if a method exists in a class
            if(method_exists($class_name, $method_or_property)){
                $class_name::$method_or_property($callback);
            }
            
            //Check if a property exists in a class
            else if(property_exists($class_name, $method_or_property)){
                $class_name::$method_or_property = $callback;
            }

            //Otherwise
            else{
                // echo something
            }
        }

        // GET - one param
        // The method that maps the url and the callback together
        // -- Note: Object must be separated by a / e.g: 'className/method'
        public static function getAll($object){

            //Get class_name
            $class_name = explode('/', $object)[0];

            //Get method_name or property name
            $method_or_property = explode('/', $object)[1];

            //Check if a method exists in a class
            if(method_exists($class_name, $method_or_property)){
                $class_name::$method_or_property();
            }

            //Otherwise
            else{
                // echo something
            }
        }
    }