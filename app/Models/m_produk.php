<?php

namespace App\Models;

use CodeIgniter\Model;

class m_produk extends Model
{
    protected $table      = 'tb_produk';
    protected $useTimestamps = true;
    protected $allowedFields = ['id', 'nama_produk', 'keterangan', 'harga', 'jumlah'];

    public function getKeluar($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }
        return $this->where(['id' => $slug])->first();
    }

    public function get_idotomatis()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(id,4)) AS kd_max FROM tb_produk ");
        $kd = "";
        if ($q) {
            foreach ($q->getresult() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return date('dmY') . $kd;
    }

    //searchi
    public function  search($cari)
    {
        return $this->table('tb_produk')->like('nama_produk', $cari)->orLike('id', $cari);
    }
}
