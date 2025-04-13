<?php

defined('BASEPATH') or exit('No direct script access allowed');

class KasP extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// Load model M_kas di dalam konstruktor
		$this->load->model('M_kas');
	}

	public function index($akses = null)
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();

		if ($username == '') {
			redirect('auth');
		}

		// Default role berdasarkan user
		$target_role = $user['role_id'];

		// Jika admin ingin melihat tampilan role lain (3 atau 5)
		if ($user['role_id'] == 1 && in_array($akses, [3, 5])) {
			$target_role = $akses;
		}

		// Cek nomor ID berdasarkan role target
		if ($target_role == 5) {
			$cekId = $this->m_kas->cekNomor2();
			$getId = substr($cekId, 5, 4);
			$data = ['idKas1' => (int)$getId + 1];
		} else {
			$cekId = $this->m_kas->cekNomor();
			$getId = substr($cekId, 4, 4);
			$data = ['idKas' => (int)$getId + 1];
		}

		$data['menu']  = 'Kas Masuk';
		$data['judul'] = 'Kas Masuk';
		$data['user']  = $user;

		// Selalu pakai header milik role asli user (misal admin pakai header admin)
		if ($user['role_id'] == 1) {
			$this->load->view('include/header', $data);
		} else {
			$this->load->view('include/header_1', $data);
		}

		// Konten sesuai role yang ditarget
		if ($target_role == 1) {
			$data['ttl']    = $this->m_kas->TotalMasuk() + $this->m_kas->TotalMasuk2();
			$data['masuk'] = $this->m_kas->getGabunganKasMasuk();
			$this->load->view('admin/kasMasuk', $data);
		} else if ($target_role == 3) {
			$data['ttl']    = $this->m_kas->TotalMasuk();
			$data['masuk'] = $this->m_kas->getKasMasuk();
			$this->load->view('unit1/kasMasuk', $data);
		} else if ($target_role == 5) {
			$data['ttl']    = $this->m_kas->TotalMasuk2();
			$data['masuk'] = $this->m_kas->getKasMasuk2();
			$this->load->view('unit2/kasMasuk', $data);
		}

		$this->load->view('include/footer');
	}

	public function delKas($idKas)
	{
		$this->m_kas->delKas($idKas);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
		redirect('kasp');
	}

	public function delKas2($idKas1)
	{
		$this->m_kas->delKas2($idKas1);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
		redirect('kasp');
	}


	public function kasKeluar($akses = null)
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();

		if ($username == '') {
			redirect('auth');
		}

		// Default role berdasarkan user
		$target_role = $user['role_id'];

		// Jika admin ingin melihat tampilan role lain (3 atau 5)
		if ($user['role_id'] == 1 && in_array($akses, [3, 5])) {
			$target_role = $akses;
		}

		// Cek nomor ID berdasarkan role target
		if ($target_role == 5) {
			$cekId = $this->m_kas->cekNomor2();
			$getId = substr($cekId, 5, 4);
			$data = ['idKas1' => (int)$getId + 1];
		} else {
			$cekId = $this->m_kas->cekNomor();
			$getId = substr($cekId, 4, 4);
			$data = ['idKas' => (int)$getId + 1];
		}

		$data['menu']  = 'Kas Keluar';
		$data['judul'] = 'Kas Keluar';
		$data['user']  = $user;

		// Selalu pakai header milik role asli user (misal admin pakai header admin)
		if ($user['role_id'] == 1) {
			$this->load->view('include/header', $data);
		} else {
			$this->load->view('include/header_1', $data);
		}

		// Konten sesuai role yang ditarget
		if ($target_role == 1) {
			$data['ttl'] = $this->m_kas->TotalGabunganKeluar();
			$data['keluar'] = $this->m_kas->getGabunganKasKeluar();                      // data gabungan
			$this->load->view('admin/kasKeluar', $data);
		} else if ($target_role == 3) {
			$data['ttl']    = $this->m_kas->TotalKeluar();
			$data['keluar'] = $this->m_kas->getKasKeluar();
			$this->load->view('unit1/kasKeluar', $data);
		} else if ($target_role == 5) {
			$data['ttl']    = $this->m_kas->TotalKeluar2();
			$data['keluar'] = $this->m_kas->getKasKeluar2();
			$this->load->view('unit2/kasKeluar', $data);
		} else {
			$data['ttl']    = $this->m_kas->TotalKeluar();
			$data['keluar'] = $this->m_kas->getKasKeluar();
			$this->load->view('rt/kasKeluar', $data);
		}

		$this->load->view('include/footer');
	}




	public function addKas()
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();

		if (!$username) {
			redirect('auth');
		}

		// Siapkan variabel
		$role = $user['role_id'];
		$jenis = $this->input->post('jenis');

		// Kondisi role
		if ($role == 5) {
			$this->m_kas->ceknomor2();
			$data = [
				'idKas1' => $this->input->post('id_kas1'),
				'keterangan' => $this->input->post('keterangan'),
				'tanggal' => $this->input->post('tanggal'),
				'jumlah' => $this->input->post('jumlah'),
				'jenis' => $jenis,
			];
			$this->m_kas->saveKas2($data);
		} else {
			$this->m_kas->cekNomor();
			$data = [
				'idKas' => $this->input->post('id_kas'),
				'keterangan' => $this->input->post('keterangan'),
				'tanggal' => $this->input->post('tanggal'),
				'jumlah' => $this->input->post('jumlah'),
				'jenis' => $jenis,
			];
			$this->m_kas->saveKas($data);
		}

		// Flash message dan redirect
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan!</div>');
		if ($jenis == 'masuk') {
			redirect('kasP');
		} else {
			redirect('kasP/kasKeluar');
		}
	}

	public function editKas()
	{
		$idKas = $this->input->post('idKas');
		$data = [
			'keterangan' => $this->input->post('keterangan'),
			'tanggal' => $this->input->post('tanggal'),
			'jumlah' => $this->input->post('jumlah'),
			'jenis' => $this->input->post('jenis'),
		];
		$this->m_kas->updateKas($data, $idKas);
		if ('jenis' == 'masuk') {
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
			redirect('kasp');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
			redirect('kasp/kasKeluar');
		}
	}

	public function editKas2()
	{
		$idKas1 = $this->input->post('idKas1');
		$data = [
			'keterangan' => $this->input->post('keterangan'),
			'tanggal' => $this->input->post('tanggal'),
			'jumlah' => $this->input->post('jumlah'),
			'jenis' => $this->input->post('jenis'),
		];
		$this->m_kas->updateKas2($data, $idKas1);
		if ('jenis' == 'masuk') {
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
			redirect('kasp');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
			redirect('kasp/kasKeluar');
		}
	}

	public function laporan($role_id = null)
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();

		if ($username == '') {
			redirect('auth');
		} else {
			$target_role = $role_id ?? $user['role_id'];
			$data['menu'] = 'Laporan';
			$data['judul'] = 'Laporan Kas ';
			$data['user'] = $user;

			if ($user['role_id'] == 1 && $role_id != null && $role_id != 1) {
				// Admin ingin melihat tampilan role lain
				if ($role_id == 3) {
					$data['kas'] = $this->m_kas->getKas();
					$data['masuk'] = $this->m_kas->TotalMasuk();
					$data['keluar'] = $this->m_kas->TotalKeluar();
					$this->load->view('include/header', $data);
					$this->load->view('unit1/laporan', $data);
					$this->load->view('include/footer');
				} else if ($role_id == 5) {
					$data['kas'] = $this->m_kas->getKas2();
					$data['masuk'] = $this->m_kas->TotalMasuk2();
					$data['keluar'] = $this->m_kas->TotalKeluar2();
					$this->load->view('include/header', $data);
					$this->load->view('unit2/laporan', $data);
					$this->load->view('include/footer');
				} else if ($role_id == 35) {
					// Laporan gabungan pengeluaran Unit 1 & 2
					$kas_unit1 = $this->m_kas->getKasKeluar();   // Unit 1
					$kas_unit2 = $this->m_kas->getKasKeluar2();      // Unit 2

					$data['kas'] = array_merge($kas_unit1, $kas_unit2);

					usort($data['kas'], function ($a, $b) {
						return strtotime($a->tanggal) - strtotime($b->tanggal);
					});

					$this->load->view('include/header', $data);
					$this->load->view('admin/laporan', $data);
					$this->load->view('include/footer');
				} else {
					redirect('kasp/laporan'); // default ke admin jika tidak dikenal
				}
			} else {
				// Tampilan sesuai role pengguna
				switch ($target_role) {
					case 1: // Admin
						$data['kas'] = $this->m_kas->getKasGabungan(); // ✅ ambil data gabungan dari dua unit


						$data['masuk'] = $data['masuk'] = $this->m_kas->TotalGabunganMasuk();

						// Ganti ini:
						// $data['keluar'] = $this->m_kas->TotalKeluar(); // ❌ hanya unit1

						// Dengan ini:
						$data['keluar'] = $this->m_kas->TotalGabunganKeluar(); // ✅ unit1 + unit2

						$this->load->view('include/header', $data);
						$this->load->view('admin/laporan', $data);
						$this->load->view('include/footer');
						break;

					case 3: // unit1
						$data['kas'] = $this->m_kas->getKas();
						$data['masuk'] = $this->m_kas->TotalMasuk();
						$data['keluar'] = $this->m_kas->TotalKeluar();
						$this->load->view('include/header_1', $data);
						$this->load->view('unit1/laporan', $data);
						$this->load->view('include/footer');
						break;
					case 5: // Unit2
						$data['kas'] = $this->m_kas->getKas2();
						$data['masuk'] = $this->m_kas->TotalMasuk2();
						$data['keluar'] = $this->m_kas->TotalKeluar2();
						$this->load->view('include/header_1', $data);
						$this->load->view('unit2/laporan', $data);
						$this->load->view('include/footer');
						break;
				}
			}
		}
	}


	public function lapKas()
	{
		$data['judul'] = 'Laporan Data ';

		// Ambil data kas gabungan dari kedua unit
		$data['kas'] = $this->M_kas->getKasGabungan();

		// Ambil total gabungan masuk dan keluar
		$data['masuk'] = $this->M_kas->TotalGabunganMasuk();
		$data['keluar'] = $this->M_kas->TotalGabunganKeluar();

		// Set konten untuk tampilan laporan
		$data['konten'] = 'lap_kas';

		// Load view untuk menampilkan laporan kas
		$this->load->view('laporan/lap_kas', $data);
	}

	public function lapKas2()
	{
		$data['judul'] = 'Laporan Data Kas ';

		$role_id = $this->session->userdata('role_id');

		if ($role_id == 5) {

			$data['kas'] = $this->M_kas->getKas2();
			$data['masuk'] = $this->M_kas->TotalMasuk2();
			$data['keluar'] = $this->M_kas->TotalKeluar2();
		} elseif ($role_id == 3) {
			// Untuk role admin atau PCM
			$data['kas'] = $this->M_kas->getKas();
			$data['masuk'] = $this->M_kas->TotalMasuk();
			$data['keluar'] = $this->M_kas->TotalKeluar();
		} else {
			// Untuk role lain (jika ada)
			$data['kas'] = [];
			$data['masuk'] = 0;
			$data['keluar'] = 0;
		}

		$data['kredit'] = $this->M_kas->kredit(); // Jika ini dipakai semua role
		$data['konten'] = 'lap_kas';

		$this->load->view('laporan/lap_kas2', $data);
	}
}

/* End of file Controllername.php */
