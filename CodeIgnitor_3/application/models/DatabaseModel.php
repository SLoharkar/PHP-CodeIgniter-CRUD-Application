<!--Codeignitor_3/application/models/DatabaseModel.php-->
<?php
//Below Controller work on this base path only http://localhost/Codeignitor_3/ 
defined('BASEPATH') OR exit('No direct script access allowed');

class DatabaseModel extends CI_Model{

    // Method to add data to the 'register' table
    public function add_data($query){
        $this->db->insert('register',$query);
        return $this->db->insert_id();
    }

    // Method to update data in the 'register' table
    public function update_data($query){
        return $this->db->where('id',$query['id'])->update('register',$query);
    }

    // Method to delete data from the 'register' table by ID
    public function delete_data($id){
        return $this->db->where('id',$id)->delete('register');
    }

    // Method to retrieve all data from the 'register' table
    public function all_data(){
        return $this->db->order_by('id','desc')->get('register')->result();
    }

    // Method to get data from the 'register' table by ID
    public function get_data($id){
        return $this->db->where('id',$id)->get('register')->row();
    }

    // Method to get user data by username from the 'register' table
    public function get_user_by_username($username){
        return $this->db->where('username',$username)->get('register')->row();
    }

    // Method to reset password for a user in the 'register' table
    public function reset_password($username, $password){
        $this->db->set('password', $password);
        return $this->db->where('username',$username)->update('register');
    }

}

?>