<!--Codeignitor_3/application/helpers/validation_helper.php-->
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


// Sets custom validation rules based on whether it's for adding or editing data.
function set_custom_validation_rules($is_add) {

    // Get the CodeIgniter instance
    $CI =& get_instance();

    // Set custom validation error delimiters
    $CI->form_validation->set_error_delimiters('<div class="text-danger mt-1 mb-3">', '</div>');

    // Username is required, trimmed, must not contain any spaces (using a regular expression),
    // and must be available (using a custom callback function).
    $CI->form_validation->set_rules(
        'username',
        'Username',
        'required|trim|regex_match[/^\S+$/]|check_username_available'
    );

    // Full name is required and trimmed
    $CI->form_validation->set_rules(
        'name',
        'Full name',
        'required|trim'
    );
    
    // Email is required, trimmed, and must be a valid email format
    $CI->form_validation->set_rules(
        'email',
        'Email',
        'required|trim|valid_email'
    );

    // Phone number is required and trimmed
    $CI->form_validation->set_rules(
        'phone',
        'Phone',
        'required|trim'
    );

    // Language is required and trimmed
    $CI->form_validation->set_rules(
        'language',
        'Language',
        'required|trim'
    );

    // Gender is required
    $CI->form_validation->set_rules(
        'gender', 
        'Gender', 
        'required'
    );

    // Qualification is required (array of qualifications)
    $CI->form_validation->set_rules(
        'qualification[]', 
        'Qualification',
        'required'
    );

    // Set validation rule for the image only if no file is uploaded during add operation
    if($is_add && empty($_FILES['image']['name'])){
        
        // Password is required, trimmed, minimum length of 3 characters, 
        // maximum length of 25 characters, must contain at least one number and one uppercase letter
        $CI->form_validation->set_rules(
            'password',
            'Password',
            'required|trim|min_length[3]|max_length[25]|regex_match[/^(?=.*[A-Z])(?=.*\d).+$/]',
            array(
                'regex_match' => 'The {field} must be 3-25 chars, with 1 uppercase and 1 number.'
            )
        );

        $CI->form_validation->set_rules('image','image/document','required|trim');

    }  

}

/**
 * Custom callback function to check if the username is available.
 *
 * This function checks if the provided username already exists in the database.
 * It is used in form validation to ensure that the username is unique.
 *
 * @param string $username The username to check.
 * @return bool True if the username is available, false otherwise.
 */
function check_username_available($username) {
    
    $CI =& get_instance();
    $user_id = $CI->session->userdata('user_id');

    // If user_id is set, it means we are updating an existing user
    if ($user_id) {
        $currentUser = $CI->crudrepository->get_data($user_id);
        // If the username is unchanged, validation passes
        if ($currentUser && $currentUser->username === $username) {
            return true;
        }
    }

    // Check if the username already exists in the database
    $existingUser = $CI->crudrepository->get_user_by_username($username);

    // If the username already exists and it does not belong to the current user, return false
    if ($existingUser && (!$user_id || $existingUser->id != $user_id)) {
        $CI->form_validation->set_message('check_username_available', 'The username is already taken.');
        return false;
    }

    // Username is available, return true to indicate validation success
    return true;
}

?>