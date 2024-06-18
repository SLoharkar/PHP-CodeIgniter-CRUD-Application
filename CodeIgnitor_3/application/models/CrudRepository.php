<!--Codeignitor_3/application/models/CrudRepository.php-->
<?php
//Below Controller work on this base path only http://localhost/Codeignitor_3/ 
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudRepository extends CI_Model{

    public function __construct(){
        $this->load->model('databasemodel'); // Load CrudRepository Model 
        $this->load->model('viewhandler'); // Load ViewHandler Model
    } 

    // Adds new data with the provided post data.
    public function add_data($post){

        $post['added_on'] = date('d M, Y');
        $post['status'] = 1;
    
        // Send form data to the database model and receive the newly generated user ID
        $dbId = $this->databasemodel->add_data($post);
    
        if($dbId) {
            $this->session->set_userdata('full_name', $post['name']);
            $this->session->set_userdata('user_image', $post['image']);
            $this->session->set_userdata('login_id', $dbId);
            $this->session->set_userdata('logged_in', TRUE);
            $this->session->set_flashdata('successMsg','Data has been inserted Sucessfully');
            redirect($this->viewhandler->getRedirect('all_data'));
        }
        else{
            log_message('error', 'Data insertion problem');
        }
    }

    // Updates existing data with the provided post data.
    public function update_data($post){

        $post['updated_on'] = date('Y-m-d h:i:s');
        
            // Check if the logged-in user is the same as the user being updated
            if ($this->session->userdata('login_id') == $this->session->userdata('user_id')) {

                $this->session->set_userdata('full_name', $post['name']);

                //this code check if user not upload image then not update this field
                if(empty($post['image'])){
                    unset($post['image']);
                }
                else{
                    $this->session->set_userdata('user_image', $post['image']);
                }
            }         

        // Retrieve the user ID from the session and assign it to the $post array
        $post['id'] = $this->session->userdata('user_id');
        
        //Remember to unset the session data if you don't need it anymore
        $this->session->unset_userdata('user_id');
                        
        $result = $this->databasemodel->update_data($post);

        if($result){
            $this->session->set_flashdata('successMsg','Data has been updated Sucessfully');
            redirect($this->viewhandler->getRedirect('all_data'));
        }  

    }

    // Authenticates user with provided username and password.
    public function login($username,$password){

        // Load the user from the database using the CRUD repository
        $user = $this->get_user_by_username($username);

        // Check if user exists, password is correct, and user status is active
        if ($user && password_verify($password, $user->password) && $user->status == '1') {
            $this->session->set_userdata('login_id', $user->id);
            $this->session->set_userdata('full_name', $user->name);
            $this->session->set_userdata('user_image', $user->image);
            $this->session->set_userdata('logged_in', TRUE);
            $this->session->set_flashdata('successMsg', 'Login successful!');
            redirect($this->viewhandler->getRedirect('all_data'));
        } 
        else{
            // If login fails, set error message and reload the login view
            $this->session->set_flashdata('errorMsg', 'Invalid username or password.');
            log_message('error', 'Login failed for username: ' . $username);
            $this->load->view($this->viewhandler->getView('login'));
        }
    }

    // Deletes data by ID.
    public function delete_data($id){

        $result = $this->databasemodel->delete_data($id);

        if($result){
            $this->session->set_flashdata('deleteMsg','Data has been deleted Sucessfully');
            redirect($this->viewhandler->getRedirect('all_data'));
        }
    }

    // Resets password for the user with the provided username.
    public function reset_password($username,$password){

        $result = $this->databasemodel->reset_password($username,$password);

        if($result){
            $this->session->set_flashdata('successMsg','Password has been updated Sucessfully');
            redirect($this->viewhandler->getRedirect('all_data'));
        }
    }

    // Retrieves data by ID.
    public function get_data($id){
        return $this->databasemodel->get_data($id);      
    }

    // Retrieves all data.
    public function all_data(){
        return $this->databasemodel->all_data();      
    }

    // Retrieves user data by username.
    public function get_user_by_username($username){
        return $this->databasemodel->get_user_by_username($username);
    }



}
?>