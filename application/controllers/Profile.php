<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function rotate_pic() {
        print_array($_POST);

        $rotation = $this->input->post('rotate_value');

        if(isset($_POST['image_file']) && !empty($_POST['image_file'])) {
            $filename_base = $this->input->post('image_file');

            if($filename_base == "user_pic-225x225.png"){
                die();
            }
            echo "Filename is ".$filename_base;

            if(file_exists(FCPATH."uploads/user/".$filename_base)){

                echo "\n Image found at ".FCPATH."uploads/user/".$filename_base;
                echo "\n Main image file ".$filename = FCPATH."uploads/user/".$filename_base;
                echo "\n Thumb image file ".$filename_thumb=FCPATH."uploads/user/thumb/".$filename_base;
                
                rotate_image($filename, $rotation);
                rotate_image($filename_thumb, $rotation);
            }else{

                echo "\n Image not found";die();
            }
        }
    }
}
