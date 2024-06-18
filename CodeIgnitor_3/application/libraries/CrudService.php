<!--Codeignitor_3/application/libraries/CrudService.php-->

<?php 

defined('BASEPATH') OR exit('No direct script access allowed');


class CrudService{

    protected $CS;

    public function __construct(){
        $this->CS =& get_instance();
        $this->CS->load->helper('validation'); //Load Custom Helper
        $this->CS->load->model('crudrepository'); // Load CrudRepository Model 
        $this->CS->load->model('viewhandler'); // Load ViewHandler Model 
        $this->CS->load->library('form_validation'); // Load Library for form validation 
    }

    // Loads the login view.
    public function load_view(){
        $this->CS->load->view($this->CS->viewhandler->getView('login'));
    }

    // Loads the insert view.
    public function register(){
        $this->CS->load->view($this->CS->viewhandler->getView('insert'));
    }

    // Adds new data.
    public function add_data(){
        // Pass a flag to indicate add operation
        set_custom_validation_rules(true);

        if($this->CS->form_validation->run()){

            // Retrieve all POST data submitted from a form and assign it to the variable $post
            $post = $this->CS->input->post();

            // Hash the new password
            $hashed_password = password_hash($post['password'], PASSWORD_DEFAULT);

            // Replace the plain text password with the hashed password in the $post array
            $post['password'] = $hashed_password;
        
            // Convert qualification array to string if it is set, otherwise set it to an empty string
            $post['qualification'] = isset($post['qualification']) ? implode(',', $post['qualification']) : '';
        
            // Load the upload configuration settings for file uploads
            $this->load_upload_config();
          
            // Check if file is uploaded
            if($this->CS->upload->do_upload('image')){
                $data = $this->CS->upload->data();
                $post['image'] = $data['file_name'];
                log_message('debug', 'Image uploaded successfully: ' . $data['file_name']);
            }
        
            // Send the form data stored in $post to the CrudRepository model's add_data method
            $this->CS->crudrepository->add_data($post);
                                
        }
        else{
            log_message('error', 'Form validation failed.');
            $this->CS->load->view($this->CS->viewhandler->getView('insert'));
        }
        
    }

    // Retrieves all data.
    public function all_data(){
        // Check if the user is already logged in
        if ($this->CS->session->userdata('logged_in')) {
            // Retrieve all data and load the 'all-data' view
            $data['arr'] = $this->CS->crudrepository->all_data();
            $this->CS->load->view($this->CS->viewhandler->getView('all_data'),$data);
        }
        else {
            redirect($this->CS->viewhandler->getRedirect('login'));
        }
    }

    // If an ID is provided, retrieve specific data and load the 'insert' view
    public function get_data($id){
        if($id!=''){
            $data['arr'] = $this->CS->crudrepository->get_data($id);
            $this->CS->load->view($this->CS->viewhandler->getView('insert'),$data);
        }
    }

    // Updates existing data.
    public function update_data(){
        // Pass a flag to indicate update operation
        set_custom_validation_rules(false);        

        if($this->CS->form_validation->run()){   
            // Retrieve all POST data submitted from a form and assign it to the variable $post
            $post = $this->CS->input->post();
                                
            // Convert qualification array to string if it is set, otherwise set it to an empty string
            $post['qualification'] = isset($post['qualification']) ? implode(',', $post['qualification']) : '';
        
            // Load the upload configuration settings for file uploads
            $this->load_upload_config();
                   
            // Check if file is uploaded
            if($this->CS->upload->do_upload('image')){
                $data = $this->CS->upload->data();
                $post['image'] = $data['file_name'];
                log_message('debug', 'Image uploaded successfully: ' . $data['file_name']);                   
            }
                
            // Send Data to Crud Repository for Update
            $this->CS->crudrepository->update_data($post);

        }
        else{
            log_message('error', 'Form validation failed.');
            
            $id = $this->CS->session->userdata('user_id');

            //Remember to unset the session data if you don't need it anymore
            $this->CS->session->unset_userdata('user_id');

            // Retrieve data for the specified ID using CrudRepository
            $data['arr'] = $this->CS->crudrepository->get_data($id);

            $this->CS->load->view($this->CS->viewhandler->getView('insert'),$data);
        }
    }

    // Deletes data by ID.
    public function delete_data($id){

        if($this->CS->session->userdata('login_id') == $id){
            log_message('error', 'Attempted to delete own record.');
            $this->CS->session->set_flashdata('deleteMsg','You cannot delete your own record.');
            redirect($this->CS->viewhandler->getRedirect('all_data'));
        }
        else{ 
            // Delete data for the specified ID using CrudRepository
            $this->CS->crudrepository->delete_data($id);
        }
    }

    // Resets password for a user with the specified ID.
    public function reset_password($id){

        if($this->CS->session->userdata('logged_in')){
            $data['arr'] = $this->CS->crudrepository->get_data($id);
            $this->CS->load->view($this->CS->viewhandler->getView('reset_password'),$data);
        }
        else {
            redirect($this->CS->viewhandler->getRedirect('login'));
        }
    }

    // Verifies a password.
    public function password_verify(){
        $data = $this->CS->input->post();

        if ($data['password'] === $data['confirm_password']) {

            log_message('info', 'Passwords match.');

            // Hash the new password
            $hashed_password = password_hash($data['password'], PASSWORD_DEFAULT);
            $username = $data['username'];
            $password = $hashed_password;
          
            $this->CS->crudrepository->reset_password($username,$password); 
        }
        else{
            log_message('error', 'Passwords do not match.');
            
            $this->CS->session->set_flashdata('errorMsg', 'Passwords do not match. Please try again.');            
            
            // Get user ID from session
            $id = $this->CS->session->userdata('user_id');
            
            // Call the method to reload the reset password view
            $this->reset_password($id);
        }
    }

    // Handles user login.
    public function login(){

        // Retrieve POST data
        $post = $this->CS->input->post();
        
        // Check if the form is submitted
        if(empty($post)){
            // If not submitted, load the login view
            $this->CS->load->view($this->CS->viewhandler->getView('login'));
        }
        else{
            $this->CS->crudrepository->login($post['username'],$post['password']);
        }
    }

    // Loads configuration for file uploads.
    private function load_upload_config() {
        log_message('debug', 'Loading upload configuration.');
        $config['upload_path'] = './uploads';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $this->CS->load->library('upload', $config);
    }

    // Handles user logout.
    public function logout(){
        // Destroy session and redirect to login page
        log_message('debug', 'logout method called.');
        $this->CS->session->unset_userdata('login_id');
        $this->CS->session->unset_userdata('user_id');
        $this->CS->session->unset_userdata('full_name');
        $this->CS->session->unset_userdata('user_image');
        $this->CS->session->unset_userdata('logged_in');
        redirect($this->CS->viewhandler->getRedirect('login'));
    }
  
}


?>