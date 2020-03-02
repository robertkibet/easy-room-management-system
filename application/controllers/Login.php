<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Africa/Nairobi");

        $this->load->model('model_login');
        if ($this->session->userdata('client_is_logged_in')) {
            $this->client_is_logged_in = true;
            redirect('welcome');
        }

    }

    public function index()
    {
        $this->load->view('auth/login');
    }

    public function user()
    {
        $check_user = $this->model_login->check_user_exist();

        switch ($check_user) {
            case 'logged_in':
                if ($this->session->has_userdata('redirect')) {
                    echo json_encode($this->session->redirect);
                } else {
                    echo json_encode(site_url('welcome'));
                }

                break;

            case 'incorrect_password':
                echo json_encode(2);
                break;

            case 'email_not_found':
                echo json_encode(3);
                break;

        }
    }
}