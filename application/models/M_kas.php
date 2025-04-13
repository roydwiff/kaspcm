<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_kas extends CI_Model
{
	public function getKasGabungan()
	{
		$kas1 = $this->db->get('data_kas')->result();   // dari bendahara / unit 1
		$kas2 = $this->db->get('data_kas1')->result();  // dari unit 2

		// Normalisasi kolom dari kas2 (ubah idKas1 jadi idKas biar seragam)
		foreach ($kas2 as &$row) {
			$row->idKas = $row->idKas1;
			unset($row->idKas1); // opsional, bersihin
		}

		$gabung = array_merge($kas1, $kas2);

		// Urutkan berdasarkan tanggal
		usort($gabung, function ($a, $b) {
			return strtotime($a->tanggal) - strtotime($b->tanggal);
		});

		return $gabung;
	}
	public function getGabunganKasMasuk()
	{
		$kas1 = $this->db->select('*, "data_kas" as sumber_tabel')
			->from('data_kas')
			->where('jenis', 'masuk')
			->get()
			->result();

		$kas2 = $this->db->select('*, "data_kas1" as sumber_tabel')
			->from('data_kas1')
			->where('jenis', 'masuk')
			->get()
			->result();

		// Gabungkan hasil
		$gabungan = array_merge($kas1, $kas2);

		// Urutkan berdasarkan tanggal (jika diperlukan)
		usort($gabungan, function ($a, $b) {
			return strtotime($a->tanggal) - strtotime($b->tanggal);
		});

		return $gabungan;
	}
	public function getGabunganKasKeluar()
	{
		$kas1 = $this->db->select('*, "data_kas" as sumber_tabel')
			->from('data_kas')
			->where('jenis', 'keluar')
			->get()
			->result();

		$kas2 = $this->db->select('*, "data_kas1" as sumber_tabel')
			->from('data_kas1')
			->where('jenis', 'keluar')
			->get()
			->result();

		$gabungan = array_merge($kas1, $kas2);

		usort($gabungan, function ($a, $b) {
			return strtotime($a->tanggal) - strtotime($b->tanggal);
		});

		return $gabungan;
	}
	public function TotalGabunganKeluar()
	{
		return $this->TotalKeluar() + $this->TotalKeluar2();
	}

	public function TotalGabunganMasuk()
	{
		return $this->TotalMasuk() + $this->TotalMasuk2();
	}



	public function getKas($idKas = '')
	{
		if ($idKas) {
			return $this->db->get('data_kas', ['idKas' => $idKas])->row_array();
		} else {
			return $this->db->get('data_kas')->result();
		}
	}

	public function cekNomor()
	{
		$idKas = $this->db->query('SELECT MAX(idKas) AS id_kas FROM data_kas')->row();
		return $idKas->id_kas;
	}

	public function saveKas($data)
	{
		return $this->db->insert('data_kas', $data);
	}

	public function updateKas($data, $idKas)
	{
		return $this->db->update('data_kas', $data, ['idKas' => $idKas]);
	}

	public function delKas($idKas)
	{
		return $this->db->delete('data_kas', ['idKas' => $idKas]);
	}

	public function getKasMasuk()
	{
		return $this->db->get_where('data_kas', ['jenis' => 'masuk'])->result();
	}

	public function TotalMasuk()
	{
		$result = $this->db->query('SELECT SUM(jumlah) as total FROM data_kas WHERE jenis="masuk"')->row();
		return $result->total ?? 0;
	}

	public function getKasKeluar()
	{
		return $this->db->get_where('data_kas', ['jenis' => 'keluar'])->result();
	}

	public function TotalKeluar()
	{
		$result = $this->db->query('SELECT SUM(jumlah) as total from data_kas where jenis="keluar"')->row();
		return $result->total ?? 0;
	}

	public function getKas2($idKas1 = '')
	{
		if ($idKas1) {
			return $this->db->get('data_kas1', ['idKas1' => $idKas1])->row_array();
		} else {
			return $this->db->get('data_kas1')->result();
		}
	}

	public function cekNomor2()
	{
		$idKas1 = $this->db->query('SELECT MAX(idKas1) AS id_kas1 FROM data_kas1')->row();
		return $idKas1->id_kas1;
	}

	public function saveKas2($data)
	{
		return $this->db->insert('data_kas1', $data);
	}

	public function updateKas2($data, $idKas1)
	{
		return $this->db->update('data_kas1', $data, ['idKas1' => $idKas1]);
	}

	public function delKas2($idKas1)
	{
		return $this->db->delete('data_kas1', ['idKas1' => $idKas1]);
	}

	public function getKasMasuk2()
	{
		return $this->db->get_where('data_kas1', ['jenis' => 'masuk'])->result();
	}

	public function TotalMasuk2()
	{
		$result = $this->db->query('SELECT SUM(jumlah) as total FROM data_kas1 WHERE jenis="masuk"')->row();
		return $result->total ?? 0;
	}

	public function getKasKeluar2()
	{
		return $this->db->get_where('data_kas1', ['jenis' => 'keluar'])->result();
	}

	public function TotalKeluar2()
	{
		$result = $this->db->query('SELECT SUM(jumlah) as total from data_kas1 where jenis="keluar"')->row();
		return $result->total ?? 0;
	}



	public function getWarga($idWarga = '')
	{
		if ($idWarga) {
			return $this->db->get('data_warga', ['idWarga' => $idWarga])->row_array();
		} else {
			return $this->db->get('data_warga')->result();
		}
	}

	public function saveWarga($data)
	{
		return $this->db->insert('data_warga', $data);
	}

	public function updateWarga($data, $idWarga)
	{
		return $this->db->update('data_warga', $data, ['idWarga' => $idWarga]);
	}

	public function delWarga($idWarga)
	{
		return $this->db->delete('data_warga', ['idWarga' => $idWarga]);
	}

	public function kredit()
	{
		// Logika untuk mengakses atau memanipulasi data terkait kredit
		// Contoh:
		$this->db->select('*');
		$this->db->from('tabel_kredit');
		$query = $this->db->get();
		return $query->result();
	}
}

/* End of file M_kas.php */
