<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function index()
	{
		$data['title'] = "Legalitas Surat";
		$data['login'] = isset($_SESSION['logged_in']); // Assuming 'logged_in' session variable indicates login status
		$this->load->view('index', $data);
	}
}
