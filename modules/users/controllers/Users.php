<?php



class Users extends Trongate {



    private $trackParam = ['track' => 1];



    public function login(): void {



        $data['view_module'] = 'users';

        $data['title'] = 'Login';

        $data['view_file'] = 'login';

        $this->template('public', $data); 



    }



    function login_account() {

        $this->validation->set_rules('email', 'email', 'required|callback_login_check');

        $this->validation->set_rules('password', 'password', 'required');

    

      if (!$this->validation->run()) {

         redirect('users/login');

      } else {

          $email = post('email');

          $this->_logged_in($email);

      }

    }

  // Validates login credentials and redirects to the appropriate page
function _logged_in($email) {
	$user = $this->model->get_one_where('email', $email, 'account');
	$user_id = $user->trongate_user_id;
  
	$this->module('trongate_tokens');
	$token_data['user_id'] = $user_id;
	$this->trongate_tokens->_generate_token($token_data);
  
	$user_type = $this->model->query_bind('SELECT * FROM account WHERE email = :email', 
	['email' => $email], 'object')[0]->user_type;
	 $_SESSION['user_type'] = $user_type;
	 $_SESSION['email'] = $email;


	// Define an array to map access numbers to respective pages
$redirect_pages = [
    1 => 'admin/dashboard',
    2 => 'service_providers/dashboard',
    3 => 'verterinary_service/dashboard',
    4 => 'moderator/panel',
    5 => 'editor/workspace',
    6 => 'users/support',
    7 => 'users/reports',
    8 => 'finance/transactions',
    9 => 'users/analytics',
    10 => 'users/preferences',
    11 => 'admin/tools',
    12 => 'guest/info',
    13 => 'users/general',
];

// Get the last visited page from session or route to the page based on access number
$redirect_url = $_SESSION['last_page'] ?? $redirect_pages[$user_type];


	//unset($_SESSION['last_page']);
  
	redirect($redirect_url);
  }

    function login_check($email) {

        $error = 'Your email does not exist in our database, please register!';

        $password_error = 'Password is not correct!';

        $access_error = 'You do not have access! Contact the administrator.';



        $user = $this->model->get_one_where('email', $email, 'account');

        $access = $this->model->query_bind('SELECT status FROM account WHERE email = :email', ['email' => $email], 'object');



        if ($access[0]->status ==0) {

            return $access_error;

        }



        if (!$user) {

            return $error;

        }



        $password = post('password');

        if ($this->_verify_hash($password, $user->password)) {

            return true;

        } else {

            return $password_error;

        }

    }

    /**

     * Verifies a plain text string against a hashed string.

     *

     * @param string $plain_text_str The plain text string to verify.

     * @param string $hashed_string The hashed string to compare against.

     * @return bool Returns TRUE if the verification is successful, otherwise FALSE.

     */

    function _verify_hash(string $plain_text, string $hashed_string): bool {

        return password_verify($plain_text, $hashed_string);

    }













































    /**

     * Grant access,

     *

     * @return void

     */

    function grant_access(): void {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$this->module('trongate_administrators');



			$user = $_POST['user'];

			$access= $_POST['access'];

            $user_type =  strtolower($_POST['user_type']);



			if($user==''){

				$response = ['user' => 'failure', 'error_message'=>'User is required.'];			

			}elseif($access==''){

				$response = ['user_type' => 'failure', 'error_message'=>'Access type is required.'];			

			}else{

				$data['id'] = $user;

				$data['access'] = $access;

				$data['user_type'] = $user_type ;

				$sql= "UPDATE account SET access = :access, user_type = :user_type WHERE id =:id";

				$review_result = $this->model->query_bind($sql, $data);

				$response = ['status' => 'success', 'message'=>'User access type '.$user_type.' granted.'];



			}



			// Return response as JSON

			echo json_encode($response);

                

        

        }

    }







  // Fetch user data based on token

  private function _get_user_data($token) {



      $params = ['token' => $token];

      $sql = 'SELECT a.id, t.user_id, a.firstname, a.lastname, a.user_type, a.access, a.email, a.picture, t.token

              FROM trongate_tokens t

              INNER JOIN account a ON a.trongate_user_id = t.user_id

              WHERE t.token = :token';

      return $this->model->query_bind($sql, $params, 'object');

    

  }





  



    





    // Loads the overview page and fetches all the necessary data to be displayed

    public function dashboard(): void {

        $this->module('trongate_security');

        $token = $this->trongate_security->_make_sure_allowed('member area');

        $_SESSION['last_page'] = 'users/dashboard';



        // Fetch user and token data

        // $tokenObj = $this->trongate_tokens->_fetch_token_obj($token);

        // $data['user_data'] = $this->_get_user_data($token);





        $data['title'] = 'Dashboard';

        // Set view for the dashboard

        $data['view_module'] = 'users';

        $data['view_file'] = '_index';

        $this->template('admin', $data);

    }



    // Loads the registration page

    public function register(): void {

        $data['view_module'] = 'users';

        $data['view_file'] = 'register';

        $data['title'] = 'Register';

        $this->template('login', $data);

    }



    // Handles password recovery email

    public function recover_email(): void {

        $data['email'] = post('email', true);

        $this->validation->set_rules('email', 'email', 'required');

        

        if ($this->validation->run()) {

            $params = ['email' => post('email', true)];

            $rows = $this->model->query_bind('SELECT * FROM account WHERE email = :email', $params, 'object');



            if (!empty($rows)) {

                $this->processPasswordRecovery($rows[0]);

            } else {

                $this->setFlashAndRedirect('This email is not registered with us, create a new account', 'register');

            }

        } else {

            $this->recover_password();

        }

    }



    // Processes account creation

    public function create_account(): void {

        $data = $this->_get_new_user_data();

        $trongateUserData = [

            'code' => make_rand_str(32),

            'user_level_id' =>  2

        ];





        // json($data,true) ;

        $trongateUserId = $this->model->insert($trongateUserData, 'trongate_users');

        $data['trongate_user_id'] = $trongateUserId;





        if ($this->validateAccountCreation()) {



            json($data,true);

            $params = ['email' => $data['email']];

            $rows = $this->model->query_bind('SELECT * FROM account WHERE email = :email', $params, 'object');



            if (!empty($rows)) {

                $this->setFlashAndRedirect('This email has already been used to create an account', 'register');

            } else {

                $data['password'] = $this->_hash_string($data['password']);

                $this->sendRegistrationEmailAndInsert($data);

                redirect('users/login');

            }

        } else {

            $this->register();

        }

    }



    // Hashes a string using bcrypt

    private function hashString(string $str): string {

        return password_hash($str, PASSWORD_BCRYPT, ['cost' => 11]);

    }





    function _send_registration_confirm_email($user_obj, $target_url){ 

        $data['subject'] = 'NLDPI Registration';

        $data['target_name'] = $user_obj['firstname'].' '. $user_obj['lastname'];

        $data['user_obj'] = $user_obj;

        $data['target_url'] = $target_url;

        $data['target_email'] = $user_obj['email'];  

        $data['msg_html'] = $this->view('_msg_registration_confirm_email',$data,true);

        $msg_plain = str_replace('</p>', '\\n\\n', $data['msg_html']);

        $data['msg_plain'] = strip_tags($msg_plain);

        $this->module('mailman');

        $this->mailman->_send_my_email($data);

    }



    private function setFlashAndRedirect(string $message, string $redirectMethod): void {

        set_flashdata($message);

        $this->$redirectMethod();

    }



    private function processPasswordRecovery($user): void {

        $data = [

            'update_id' => $user->id,

            'full_name' =>  $user->firstname.' '.$user->lastname,

            'email' => $user->email,

            'pw_token' => make_rand_str(32),

            'expires_at' => strtotime('+10 minutes', time())

        ];



        $targetUrl = BASE_URL . 'users/password_reset/' . $data['pw_token'];

        $this->model->update($data['update_id'], $data, 'account');

        $this->_send_password_recovery_email($data, $targetUrl);



        $this->setFlashAndRedirect('An email has been sent to you, follow the guide', 'recover_password');

    }



    private function validateAccountCreation(): bool {

        $this->validation->set_rules('firstname', 'firstname', 'required');

        $this->validation->set_rules('lastname', 'lastname', 'required');

        $this->validation->set_rules('password', 'password', 'required|min_length[6]|max_length[55]');

        $this->validation->set_rules('confirm', 'confirm', 'required|matches[password]');

        return $this->validation->run();

    }



    private function sendRegistrationEmailAndInsert(array $data): void {

        //$targetUrl = 'https://meat247.com/user/';

        $targetUrl = 'http://localhost/nldpi/user/';

        $this->_send_registration_confirm_email($data, $targetUrl);

        $this->model->insert($data, 'account');

    }







// Verifies if a plain text string matches a hashed string





// Handles account login





// Validates login credentials and redirects to the appropriate page





// Validates login details and returns appropriate errors





// Access control for trongate admin

function _make_sure_allow_admin() {

    $this->module('trongate_tokens');

    $token = $this->trongate_tokens->_attempt_get_valid_token(1);

    if (!$token) {

        redirect('users/login');

    }

    return $token;

}

  



// Access control for member user logged

function _make_sure_allow_member() {

  $this->module('trongate_tokens');

  $token = $this->trongate_tokens->_attempt_get_valid_token(2);



  if (!$token && $_SESSION['user_type'] != "member") {

      redirect('users/login');

  }

  return $token;

}



// Logs out the user

function logout() {

  session_start();

  $this->module('trongate_tokens');

  $this->trongate_tokens->_destroy();

  unset($_SESSION['last_page']);

  unset( $_SESSION['full_name']);

  unset($_SESSION['user_type']);

  redirect('users/login');

}









// Loads the change password page

function password_reset() {

 $token = segment(3);

 $user = $this->model->get_one_where('pw_token', $token, 'account');

  if ($user) {

      $data = [

          'form_location' => BASE_URL . 'users/submit_new_password/' . $token,

          'view_module' => 'users',

          'view_file' => 'change_password_page',

      ];

      $this->template('login', $data);

  } else {

      set_flashdata('Invalid token, try again!');

      $this->recover_password();

  }

}



// Submits a new password

function submit_new_password() {

  $this->validation->set_rules('password', 'password', 'required|min_length[6]|max_length[55]');

  $this->validation->set_rules('confirm', 'confirm', 'required|matches[password]');



  if ($this->validation->run()) {

      $token = segment(3);

      $row = $this->model->query_bind('SELECT * FROM account WHERE pw_token = :pw_token', ['pw_token' => $token], 'object')[0] ?? null;



      if ($row && time() < $row->expires_at) {

          $this->model->update($row->id, [

              'password' => $this->_hash_string(post('confirm')),

              'pw_token' => null,

              'expires_at' => null,

          ], 'account');



          set_flashdata('The Password has been successfully changed, please login');

          $this->login();

      } else {

          set_flashdata('Your password change token has expired, try another');

          $this->recover_password();

      }

  } else {

      $this->password_reset();

  }

}



// Updates the user's password

function update_password() {

  $update_id = segment(3);

  $old_password = post('old_password');

  $user = $this->model->get_one_where('id', $update_id, 'account');



  if ($this->_verify_hash($old_password, $user->password)) {

      if (post('password') === post('confirm')) {

          $this->model->update($update_id, ['password' => $this->_hash_string(post('password'))], 'account');

          set_flashdata('Password changed successfully!');

      } else {

          set_flashdata('Password does not match!');

      }

  } else {

      set_flashdata('The old password you entered does not match what we have in our database');

  }



  redirect('users/settings');

}



// Retrieves new user data from the form

function _get_new_user_data(): array {

  return [

      'firstname' => post('firstname', true),

      'lastname' => post('lastname', true),

      'user_type' => post('user_type', true),

      'password' => post('password'),

      'confirm' => post('confirm'),

      'email' => post('email', true),

  ];

}





 function _hash_string(string $str): string{

    $hashed_string =password_hash($str, PASSWORD_BCRYPT,array('cost'=> 11));

    return $hashed_string;



 }



// Saves the user profile

function save_profile() {

  $update_id = segment(3);

  $data = [

      'firstname' => post('firstname', true),

      'lastname' => post('lastname', true),

      'email' => post('email', true),

  ];



  if ($this->model->update($update_id, $data, 'account')) {

      set_flashdata('The record was successfully updated');

  } else {

      set_flashdata('The record was not submitted');

  }



  redirect('users/settings');

}





function privilege() 

{  

    if(isset($_SESSION['user_type']) && $_SESSION['user_type'] !="admin"){

        redirect('users/dashboard');

    }

    $this->module('trongate_security');

    $this->trongate_security->_make_sure_allowed('sales area');



    $sql= "SELECT id, firstname, lastname, email, user_type, access FROM account ORDER BY id DESC";

    $users = $this->model->query($sql, 'object');

    $data = [

        'user_data' =>  $this->_get_user_data($this->trongate_security->_make_sure_allowed('sales area')),

        'users' =>  $users,

        'title' => 'Privilege',

        'view_file' => '_privilege',

        'view_module' => 'users'

    ];



    $this->template('admin_nldpi', $data);

}









function submit_profile_picture($update_id) 

{

    if (post('submit_pic') !== 'Upload') {

        return;

    }

    $this->module('trongate_security');

    $this->trongate_security->_make_sure_allowed('sales area');



    if ($_FILES['picture']['name'] == '') {

        redirect($_SERVER['HTTP_REFERER']);

    }



    $this->module('product_details');



    $picture_settings = $this->_init_profile_picture_settings();



    

    extract($picture_settings);

    $validation_str = 'allowed_types[gif,jpg,jpeg,png]|max_size['.$max_file_size.']|max_width['.$max_width.']|max_height['.$max_height.']';

    $this->validation->set_rules('picture', 'item picture', $validation_str);



    $result = $this->validation->run();



    if ($result == true) {



        $config['destination'] = $destination.'/'.$update_id;

        $config['max_width'] = $resized_max_width;

        $config['max_height'] = $resized_max_height;



        if ($thumbnail_dir !== '') {

            $config['thumbnail_dir'] = $thumbnail_dir.'/'.$update_id;

            $config['thumbnail_max_width'] = $thumbnail_max_width;

            $config['thumbnail_max_height'] = $thumbnail_max_height;

        }



        //upload the picture

        $config['upload_to_module'] = (!isset($picture_settings['upload_to_module']) ? false :

            $picture_settings['upload_to_module']);

        $config['make_rand_name'] = $picture_settings['make_rand_name'] ?? false;



        $file_info = $this->upload_picture($config);

        

        //update the database with the name of the uploaded file

        $data[$target_column_name] = $file_info['file_name'];

        $this->model->update($update_id, $data, 'account');





        set_flashdata('The picture was successfully uploaded');

        redirect('users/settings');



    } else {

        set_flashdata('The picture upload failed');

        redirect('users/settings');

    }





















}



function _init_profile_picture_settings() 

{

    return [

        'max_file_size' => 10000,

        'max_width' => 5000,

        'max_height' => 5000,

        'resized_max_width' => 450,

        'resized_max_height' => 450,

        'destination' => 'profile_pics',

        'target_column_name' => 'picture',

        'thumbnail_dir' => 'profile_pics_thumbnails',

        'thumbnail_max_width' => 120,

        'thumbnail_max_height' => 120,

        'upload_to_module' => false,

        'make_rand_name' => false

    ];

}



function _ensure_destination_folders($update_id, $picture_settings) 

{

    $destination = $picture_settings['destination'];

    $target_dir = $picture_settings['upload_to_module'] ? 

        APPPATH . 'modules/' . segment(1) . '/assets/' . $destination . '/' . $update_id :

        APPPATH . 'public/' . $destination . '/' . $update_id;



    if (!file_exists($target_dir)) {

        mkdir($target_dir, 0777, true);

    }



    if (!empty($picture_settings['thumbnail_dir'])) {

        $thumbnail_dir = str_replace(

            $destination . '/' . $update_id,

            $picture_settings['thumbnail_dir'] . '/' . $update_id,

            $target_dir

        );

        

        if (!file_exists($thumbnail_dir)) {

            mkdir($thumbnail_dir, 0777, true);

        }

    }

}









function recover_password() 

{ 

    $data = [

        'view_module' => 'users',

        'view_file' => 'recover_page'

    ];



    $this->template('login', $data);

}







function animal_registration_list() 

{

    $this->module('trongate_security');

    $this->trongate_security->_make_sure_allowed('member area');

    $sql= "SELECT * FROM animal_registrations  WHERE status IS NULL";

    $animal_registrations = $this->model->query($sql, 'object');

    $_SESSION['last_page'] = 'users/list_animal_registration';



    $data = [

        // 'user_data' => $this->_get_user_data($this->trongate_security->_make_sure_allowed('member area')),

        'animal_registration_list' =>  $animal_registrations,

        'title' => 'Animal Registration',

        'view_file' => '_animal_registration',

        'view_module' => 'users'

    ];



    $this->template('admin', $data);

}













}