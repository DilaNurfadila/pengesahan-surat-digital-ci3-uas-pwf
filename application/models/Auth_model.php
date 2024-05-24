<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    public function getuser($email)
    {
        $this->db->where('email', $email);
        return $this->db->get('user')->row();
    }

    public function changepass()
    {
        $this->db->set('password', password_hash($this->input->post('newpassword'), PASSWORD_DEFAULT));
        $this->db->where('email', $this->session->userdata('email'));
        return $this->db->update('user');
    }

    public function changephoto($photo)
    {
        if($this->session->userdata('photo') !== 'default.png')
            unlink('./uploads/users/'. $this->session->userdata('photo')); //hapus foto lama

        $this->db->set('photo_', $photo);    
        $this->db->where('email',$this->session->userdata('email'));
        return $this->db->update('user');
    }
}
