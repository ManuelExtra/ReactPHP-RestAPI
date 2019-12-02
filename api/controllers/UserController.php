<?php

    /*
    ****For User
    */

    class UserController extends db{

        /*
        * ## ------>
        ****Property for storing user ID
        */

        public static $user_id = '';

        /*
        * ## ------>
        ****
        **** returns boolean ( true or false )
        */

        public static function create($data){

            //checking if all elements in the array are not empty
            
            // print_r(json_encode($data));
            if(empty($data['first_name']) || empty($data['last_name']) || empty($data['email']) || empty($data['password']) || empty($data['retype_password']) ){
                echo '{"error": "required"}';
            }
            else {
                //check if email exists
                if(self::queryDB('SELECT * from users WHERE email=:email', array(':email' => $data['email']))){
                    echo '{"error": "email exists"}';
                }
                else {
                    //check if password meets up with the default length
                    if(strlen($data['password']) < 6 || strlen($data['retype_password']) < 6){
                        echo '{"error": "short" }';
                    }
                    
                    else {
                        //check if password matches
                        if($data['password'] != $data['retype_password']){
                            echo '{"error": "mismatch"}';
                        }
                        else {
                            //Auto generate admin's username
                            $username = 'admin-'.time();

                            //Inserting the data into the users table
                            self::queryDB('INSERT INTO users VALUES(\'\', :first_name, :last_name, :display_name, :email, \'\', :password, :dt_created, \'\')', array(
                                ':first_name' => $data['first_name'],
                                ':last_name' => $data['last_name'],
                                ':display_name' => $username,
                                ':email' => $data['email'],
                                ':password' => md5($data['password']),
                                ':dt_created' => date('Y-m-d h:i:s')
                            ));

                            //Getting the user_id
                            $user_id = self::queryDB('SELECT id FROM users WHERE email=:email', array(':email'=>$data['email']))[0]['id'];

                            //success
                            echo '{"success": "true", "user_id": "'.$user_id.'"}';
                        }
                    }
                }
            }

        }

        /*
        * ## ------>
        ****Logging A User In
        */

        public static function sign_in($data){
            //checking if all elements in the array are not empty
            
            if( empty($data['email']) || empty($data['password']) ){
                echo '{"error": "required"}';
            }
            else {
                //check if email exists
                if(!self::queryDB('SELECT * from users WHERE email=:email', array(':email' => $data['email']))){
                    echo '{"error": "email"}';
                }
                else {
                    //check if password exists
                    if(!self::queryDB('SELECT * from users WHERE email=:email AND password=:password', array(':email' => $data['email'], 'password' => md5($data['password'])) ) ){
                        echo '{"error": "password"}';
                    }
                    else {
                        //Getting the user_id
                        $user_id = self::queryDB('SELECT id FROM users WHERE email=:email', array(':email'=>$data['email']))[0]['id'];
                        //success
                        echo '{"success": "true", "user_id": "'.$user_id.'"}';
                    }
                }
            }
        }
        
        
        /*
        * ## ------>
        ****Check if a user is logged in
        **** returns boolean ( true or false )
        */

        public static function is_logged_in($data){
            //
        }

        /*
        * ## ------>
        ****Logging A User Out
        */

        public static function sign_out(){
            //
        }

        /*
        * ## ------>
        ****Change Password For User
        */

        public static function change_password($data){
            //
        }

        /*
        * ## ------>
        ****Request to reset Password For User
        ****Usually, email is received to reset Password
        */

        public static function reset_password($data){
            //
        }

        /*
        * ## ------>
        ****View Profile For User
        */

        public static function view_profile($data){
            //check if the user's id exists
            if(self::queryDB('SELECT * FROM users WHERE id=:id', array(':id'=>$data))){
                //Getting the user_id
                $details = json_encode(self::queryDB('SELECT * FROM users WHERE id=:id', array(':id'=>$data)));

                //success
                echo '{"success": "true", "userData": '.$details.'}';
            }
            else {
                //error
                echo '{"error": "Not found"}';
            }
        }

        /*
        * ## ------>
        ****Update Profile For User
        */

        public static function update_profile($data){
            //check if the user's id exists
            // print_r($data);
            
            if(self::queryDB('SELECT * FROM users WHERE id=:id', array(':id'=>$data['request']['user_id']))){
                if ($data['request']['password'] !== $data['request']['password_confirmation']) {

                    //error
                    echo '{"error": "mismatch"}';
                    
                }
                else {
                    
                    // Creating an instance of the ImageController Class
                    $Img = new ImageController();

                    //Setting the dirname
                    $Img->dir_name = '../src/uploads';

                    //Setting the file_format
                    array_push($Img->file_format, [
                        'png', 'jpg', 'jpeg', 'gif', 'svg'
                    ]);

                    //Upload file
                    $filename = $Img->upload($data['image']);

                    //Check if file has been uploaded
                    if($Img->uploaded){
                        
                        //Update users table

                        self::queryDB('UPDATE users SET first_name=:first_name, last_name=:last_name, display_name=:display_name, email=:email, display_picture=:display_picture, password=:password, dt_updated=:dt_updated WHERE id=:id', 
                            array(
                                ':first_name'=>$data['request']['first_name'], 
                                ':last_name'=>$data['request']['last_name'], 
                                ':display_name'=>$data['request']['display_name'], 
                                ':email'=>$data['request']['email'], 
                                ':display_picture' => $filename,
                                ':password' =>$data['request']['password'], 
                                ':dt_updated'=>date('Y-m-d h:i:s'),
                                ':id'=>$data['request']['user_id']
                            )
                        );
                    }
                    
                                       
                    
                }
                
                
            }
            else {
                // error
                echo '{"error": "Not found"}';
            }

            
        }




    }


