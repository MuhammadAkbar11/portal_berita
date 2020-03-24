<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_User extends CI_Model
{
    public function getUserData($where = null)
    {
        return $this->db->get_where('tbl_user', $where);
    }
}
