<!--Codeignitor_3/application/models/ViewHandler.php-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Define the ViewHandler class as a model extending CI_Model
class ViewHandler extends CI_Model{

    // Array containing views mapped to keys
    protected $getView = array(
        'login'=>'login.php',  
        'insert'=>'register.php',
        'all_data'=>'all-data.php',
        'reset_password'=>'reset-password.php'
    );

    // Array containing views mapped to keys
    protected $getRedirect = array(
        'all_data'=>'crudcontroller/all_data',
        'login'=>'homecontroller/login'
    );
    

    // Method to get a view by key
    public function getView($key) {
        // Check if the key exists in the getView array, if yes return the associated view, otherwise return null
        return isset($this->getView[$key]) ? $this->getView[$key] : null;
    }

    /**
    * Get the redirect URL associated with the given key.
    *
    * @param string $key The key to look up in the redirect mapping.
    * @return string|null The redirect URL if found, or null if the key is not found.
    */
    public function getRedirect($key) {
        // Check if the key exists in the redirect mapping
        return isset($this->getRedirect[$key]) ? $this->getRedirect[$key] : null;
    }


}
