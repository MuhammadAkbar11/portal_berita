<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Modeluser extends CI_Model
{
    public function cekData($where = null)
    {
        return $this->db->get_where('tbl_user', $where);
    }
}
