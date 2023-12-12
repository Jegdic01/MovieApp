<?php
    class Users extends Controller {
        public function __construct() {
            $this->userModel = $this->model('User', $GLOBALS['db']);
        }

        // ----- Register function -----
        public function register() {
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'name' => rtrim($_POST['name']),
                    'email' => rtrim($_POST['email']),
                    'password' => rtrim($_POST['password']),
                    'confirmPassword' => rtrim($_POST['confirm_password']),
                    'isValid' => true,
                    'messages' => [
                        'name_err' => '',
                        'email_err' => '',
                        'password_err' => '',
                        'confirm_password_err' => '',
                        'registration_success' => ''
                    ]
                ];

                // Validate username
                if(empty($data['name'])) {
                    $data['isValid'] = false;
                    $data['messages']['name_err'] = 'Username cannot be empty';
                } else if($this->userModel->getUserByName($data['name'])) {
                    $data['isValid'] = false;
                    $data['messages']['name_err'] = 'Username is already taken.';
                }
                
                // Validate email
                if(empty($data['email'])) {
                    $data['isValid'] = false;
                    $data['messages']['email_err'] = 'Email cannot be empty';
                } else if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                    $data['isValid'] = false;
                    $data['messages']['email_err'] = 'Please enter a valid email.';
                } else if($this->userModel->getUserByEmail($data['email'])) {
                    $data['isValid'] = false;
                    $data['messages']['email_err'] = 'This email is already taken.';
                }

                // Validate password
                if(empty($data['password'])) {
                    $data['isValid'] = false;
                    $data['messages']['password_err'] = 'Password cannot be empty';
                }
                else if(!preg_match('/[A-Z]/', $data['password']) && strlen($data['password']) <= 5) {
                    $data['isValid'] = false;
                    $data['messages']['password_err'] = 'Your password should contain at least 5 characters.';
                }
                else if(!preg_match('/[0-9]/', $data['password'])) {
                    $data['isValid'] = false;
                    $data['messages']['password_err'] = 'Your password should contain numbers.';
                }
                

                // Validate confirm password
                if(empty($data['confirmPassword'])) {
                    $data['isValid'] = false;
                    $data['messages']['confirm_password_err'] = 'Confirm password field cannot be empty';
                }

                if($data['password'] != $data['confirmPassword']) {
                    $data['isValid'] = false;
                    $data['messages']['confirm_password_err'] = 'Passwords do not match.';
                }

                // If isValid = true, message will be registration successful.
                if($data['isValid']) {
                    $data['isValid'] = true;
                    $data['messages']['registration_success'] = 'Registration successful. You can now log in.';
                }

                // If isValid = false, data will be sent to the browser bit unsuccessfull messages.
                if(!($data['isValid'])) {
                    print json_encode(
                        array(
                            'isValid' => $data['isValid'],
                            'messages' => $data['messages']
                        )
                    );
                }
                // If isValid = true, data will be sent to the browser bit successfull messages.
                else if(($data['isValid'])) {
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                    if($this->userModel->register($data)) {
                        print json_encode(
                            array(
                                'isValid' => $data['isValid'],
                                'messages' => $data['messages']
                            )
                        );
                    }
                }
            }
            else {
                $this->view('users/register');
            }
        }

        // ----- Login function -----
        public function login() {
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $_SERVER = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'email' => rtrim($_POST['email']),
                    'password' => rtrim($_POST['password']),
                    'isValid' => true,
                    'messages' => [
                        'email_err' => '',
                        'password_err' => '',
                        'login_success' => ''
                    ]
                ];

                // Validate email
                if(empty($data['email'])) {
                    $data['isValid'] = false;
                    $data['messages']['email_err'] = 'Email cannot be empty.';
                } else if(!($this->userModel->getUserByEmail($data['email']))) {
                    $data['isValid'] = false;
                    $data['messages']['email_err'] = 'User is not found.';
                } else if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                    $data['isValid'] = false;
                    $data['messages']['email_err'] = 'Please enter a valid email.';
                }

                // Validate password
                if(empty($data['password'])) {
                    $data['isValid'] = false;
                    $data['messages']['password_err'] = 'Password cannot be empty';
                }

                if($data['isValid']) {
                    $data['isValid'] = true;
                    $data['messages']['login_success'] = 'Login successful.';
                }

                // If isValid = false, data will be sent to the browser bit unsuccessfull messages.
                if(!($data['isValid'])) {
                    print json_encode(
                        array(
                            'isValid' => $data['isValid'],
                            'messages' => $data['messages']
                        )
                    );
                }
                else if($data['isValid']) {
                    // Pass the user data to login function in user model
                    $loggedUser = $this->userModel->login($data['email'], $data['password']);
                    if($loggedUser) {
                        print json_encode(
                            array(
                                'userId' => $loggedUser->id,
                                'userName' => $loggedUser->name,
                                'isValid' => $data['isValid'],
                                'messages' => $data['messages']
                            )
                        );
                    }
                    else {
                        $data['isValid'] = false;
                        $data['messages']['password_err'] = 'Password is incorrect';
                        print json_encode(
                            array(
                                'isValid' => $data['isValid'],
                                'messages' => $data['messages']
                            )
                        );
                    }
                }
            }
            else {
                $this->view('users/login');
            }
        }
    } 