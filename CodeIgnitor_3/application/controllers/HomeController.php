<!--Codeignitor_3/application/controllers/HomeController.php-->
<?php
// Controller for handling login and register functionality
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends CI_Controller{

    public function __construct(){
        parent::__construct();
        // Load the CrudService library
        $this->load->library('crudservice');
    }

    // Default method, loads the view
    public function index(){
        $this->crudservice->load_view();
    }

    // Handle user login process.
    public function login(){
        $this->crudservice->login(); 
    }
    
    // Handle user registration process.
    public function register(){
        $this->crudservice->register(); 
    }
    
    // Logs out the current user.
    public function logout(){
        $this->crudservice->logout();
    }

}
