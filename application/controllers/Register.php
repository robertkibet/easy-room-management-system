<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Kibet
 * Date: 2/9/2019
 * Time: 12:33 PM
 */
class Register extends CI_Controller{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('register_model');
        if ($this->session->userdata('client_is_logged_in')) {
            $this->client_is_logged_in = true;
            redirect('welcome','refresh');

        }

    }
    public function index(){
        $this->load->view('auth/register');
    }
    public function user(){
        $this->load->model('register_model');
        $this->register_model->register_user();

    }

}