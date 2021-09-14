<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Login_model extends CI_Model
{
    function login($username, $password)
    {

        $this->db->select('user_id, username, password, role_id');
        $this->db->from('users');
        $this->db->where("(username = '$username' AND password = '" . md5($password) . "') OR 
        (username = '$username' AND password = '" . md5($password) . "')", null, false);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
}
