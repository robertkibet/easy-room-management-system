<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Kibet
 * Date: 2/9/2019
 * Time: 12:41 PM
 */
class Register_model extends CI_Model
{
    public function register_user()
    {
        $firstname = strtolower($this->input->post('firstname', true));
        $lastname = strtolower($this->input->post('lastname', true));
        $phone = strtolower($this->input->post('phone', true));
        $password = sha1($this->input->post('password', true));
        $email = sha1(strtolower($this->input->post('email', true)));

        $email_exists = $this->check_if_email_exists($email);
        if ($email_exists == false) {
            $userdata = array(
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email,
                'ipaddress' => $this->input->ip_address(),
                'password' => $password,
                'phone' => '0'.$phone,
                'user_type'=>'manager'
            );
            $this->db->insert('system_users', $userdata);
            if ($this->db->affected_rows() == 1) {
                $sql = "select id, lastsession,user_type, activeemail from system_users where email= '$email' limit 1";
                $result = $this->db->query($sql);
                $row = $result->row();
                if ($result->num_rows() === 1) {
                    print_r($result->num_rows());
                    $session_data = array(
                        'id' => $row->id,
                        'lastsession' => $row->lastsession,
                        'user_type' => $row->user_type,
                        'activeemail' => $row->activeemail

                    );
                    $this->set_session($session_data);
//                    echo 1; //success
                    if ($this->session->has_userdata('redirect')) {
                        echo $this->session->redirect;
                    } else {
                        site_url('welcome');
                    }
                }else{
                    echo 2; //failed_retrieve_create_account
                }
            } else {
                echo 3; //failed_to_save_details
            }

        } else {
            echo 4; //account_exists
        }
    }

    private function set_session($session_data)
    {
        $sess_data = array(

            'id' => $session_data['id'],
            'lastsession' => $session_data['lastsession'],
            'activeemail' => $session_data['activeemail'],
            'user_type' => $session_data['user_type'],
            'client_is_logged_in' => 1
        );
        $this->session->set_userdata($sess_data);

    }

    private function check_if_email_exists($email)
    {

        $sql = "select email from system_users where email= '$email' limit 1";
        $result = $this->db->query($sql);
        if ($result->num_rows() === 1) {
            return true;
        } else {
            return false;
        }
    }

}