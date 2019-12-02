<?php

    /*
    ****For Uploading Images
    */

    class ImageController{

        // property to confirm if file has been uploaded
        public $uploaded = false;

        // property for name of the directory where the file will be stored in 
        public $dir_name = '';

        //Array property for storing file formats
        public $file_format = [];

        /*
        * ---- A General method for uploading files ----
        */ 
        public function upload($data){
            //Getting the file name and extension
            $file = basename($data['name']);

            //Directory
            $dir = $this->dir_name."/";

            //get the filename only
            $fileNameOnly = pathinfo($file, PATHINFO_FILENAME);

            //Getting file extension only
            $imageFileType = pathinfo($file,PATHINFO_EXTENSION);
            
            //File to be stored
            $img = $fileNameOnly."-".time().".".$imageFileType;

            //Directory with the file
            // $path_name = $dir.$img;

            // Check if image file is not empty
            if(empty($img)){
                echo '{"error": "empty"}';
                $this->uploaded = false;
            }
            
            // Check that file size is not above 500000 bytes
            else if ($data["size"] > 500000) {
                echo '{"error": "large size"}';
                $this->uploaded = false;
            }

            // Otherwise
            else {
                // Checking if the file extension gotten matches the one set
                print_r($this->file_format);
                if (count($this->file_format) > 0) {
                    foreach ($this->file_format as $format1) {
                        foreach ($format1 as $f) {
                            if($imageFileType != $f){
                                $isCorrect = false;
                            }
                            else {
                                $isCorrect = true;
                                break;
                            }
                        }
                    }
                    if($isCorrect === false){
                        echo '{"error": "wrong file"}';
                        $this->uploaded = false;
                    }
                    else {                   
                        
                        move_uploaded_file($data['tmp_name'], $dir.$img);
                        $this->uploaded = true;
                        return $img;
                    }
                }

            }
        }
    }