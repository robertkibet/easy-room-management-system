<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: KBITE SOFTWARES
 * Date: 12/27/2017
 * Time: 8:53 PM
 */
class Model_login extends Ci_Model
{
    public function check_user_exist()
    {
        $user = $this->input->post('phone', true);

        $sql = "select * from system_users where phone= '$user' limit 1";

        $result = $this->db->query($sql);
        $row = $result->row();

        if ($result->num_rows() === 1) {


            $getpass = $row->password;
            $password = sha1($this->input->post('password', true));

            if ($getpass === $password) {

                $session_data = array(
                    'id' => $row->id,
                    'lastsession' => $row->lastsession,
                    'firstname' => $row->firstname,
                    'phone' => $row->phone,
                    'lastname' => $row->lastname,
                    'activeemail' => $row->activeemail,
                    'role' => $row->role,


                );

                $this->set_session($session_data);
                return 'logged_in';

            } else {
                return 'incorrect_password';
            }

        } else {

            //email address is not in the database, they should register for an account
            return 'email_not_found';
        }

    }

    private function set_session($session_data)
    {
        $sess_data = array(

            'id' => $session_data['id'],
            'lastsession' => $session_data['lastsession'],
            'activeemail' => $session_data['activeemail'],
            'phone' => $session_data['phone'],
            'firstname' => $session_data['firstname'],
            'lastname' => $session_data['lastname'],
            'role' => $session_data['role'],
            'client_is_logged_in' => 1
        );
        $this->session->set_userdata($sess_data);

    }

    public function email_exists($email)
    {
        $sql = "select id from system_users where email = '$email' limit 1";

        $result = $this->db->query($sql);

        $row = $result->row();

        return ($result->num_rows() === 1 && $row->email) ? $row->id : false;
    }

}