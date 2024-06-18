<!--Codeignitor_3/application/controllers/CrudController.php-->
<?php
// This controller handles CRUD operations for the application
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudController extends CI_Controller{

    public function __construct(){
       parent::__construct();
       // Load the CrudService library
       $this->load->library('crudservice');
    }
    
    // Method to handle adding new data
    public function add_data(){
        $this->crudservice->add_data();
    }

    // Method to handle updating existing data
    public function update_data(){
        $this->crudservice->update_data();
    }

    // Method to handle deleting data based on the provided ID
    public function delete_data($id){
        $this->crudservice->delete_data($id);
    }

    // Method to handle retrieving data for a specific ID
    public function get_data($id){
        $this->crudservice->get_data($id);
    }

    // Method to handle retrieving all data
    public function all_data(){
        $this->crudservice->all_data();
    }

    // Load the reset password view for a specific user.
    public function reset_password($id){
        $this->crudservice->reset_password($id);
    }

    // Handle password verification process.
    public function password_verify(){
        $this->crudservice->password_verify();
    }


}
