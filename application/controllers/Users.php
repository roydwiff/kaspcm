<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{



	public function unit1()
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();

		$data['menu'] = 'Akses';
		$data['judul'] = 'UNIT 1 Panel';
		$data['user'] = $user;
		$data['masuk'] = $this->m_kas->TotalMasuk();
		$data['keluar'] = $this->m_kas->TotalKeluar();
		$this->load->view('include/header_1', $data);
		$this->load->view('index', $data);
		$this->load->view('include/footer');
	}

	public function unit2()
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();

		$data['menu'] = 'Akses';
		$data['judul'] = 'UNIT 2';
		$data['user'] = $user;
		$data['masuk'] = $this->m_kas->TotalMasuk2();
		$data['keluar'] = $this->m_kas->TotalKeluar2();
		$this->load->view('include/header_1', $data);
		$this->load->view('index', $data);
		$this->load->view('include/footer');
	}
}
/* End of file Controllername.php */
