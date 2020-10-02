<?php

namespace App\Controllers;

use  App\Models\m_produk;
use CodeIgniter\Validation\Rules;

class c_produk extends BaseController
{
    protected $m_produk;

    public function __construct()
    {
        $this->m_produk = new m_produk();
    }

    public function index()
    {
        //ambil halaman url utuk hitungan halaman
        $currentPage = $this->request->getVar('page_komik') ? $this->request->getVar('page_komik') : 1;
        //$komik = $this->komikModel->findAll();
        // sercing data
        $cari = $this->request->getVar('cari');
        if ($cari) {
            $komik_cari =  $this->m_produk->search($cari);
        } else {
            //cari tidak ada
            $komik_cari = $this->m_produk; //menampilkan dengan kondisi
        }
        $data = [
            'title' => 'ARKADEMY | PRODUK',
            //'komik' => $this->m_keluar->getKeluar(),
            //membuat pagination
            'produk' => $komik_cari->paginate(10, 'komik'),
            'pager' => $this->m_produk->pager,
            'currentPage' => $currentPage
        ];

        return view('Produk/index', $data);
    }
    public function create()
    {

        $data = [
            'title' => 'ARKADEMY | PRODUK',
            'kode_otomatis' => $this->m_produk->get_idotomatis(),
            'validation' => \Config\Services::validation() //membuat validasi
        ];
        return view('Produk/create', $data);
    }
    public function save()
    {
        //validasi input
        if (!$this->validate([
            'nama_produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'rincian harus diisi'
                    // 'is_unique' => '{field} komik sudah terdaftar'
                ]
            ],
            'jumlah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'jumlah harus diisi'
                    // 'is_unique' => '{field} komik sudah terdaftar'
                ]
            ],
            'harga' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'jumlah harus diisi'
                    // 'is_unique' => '{field} komik sudah terdaftar'
                ]
            ],
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'jumlah harus diisi'
                    // 'is_unique' => '{field} komik sudah terdaftar'
                ]
            ]

        ])) {
            return redirect()->to('/c_produk/create')->withInput();
        }
        $this->m_produk->insert([
            'id' => $this->m_produk->get_idotomatis(),
            'nama_produk' => $this->request->getVar('nama_produk'),
            'keterangan' => $this->request->getVar('keterangan'),
            'jumlah' => $this->request->getVar('jumlah'),
            'harga' => $this->request->getVar('harga'),
        ]);
        //dd($this->request->getVar());
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to('/c_produk');
    }
    public function edit($slug)
    {
        $data = [
            'title' => 'ARKADEMY | PRODUK',
            'validation' => \Config\Services::validation(),
            'komik' =>  $this->m_produk->getKeluar($slug)
        ];
        return view('Produk/edit', $data);
    }
    public function update($id)
    {
        $this->m_produk->update(['id' => $id], [
            'nama_produk' => $this->request->getVar('nama_produk'),
            'keterangan' => $this->request->getVar('keterangan'),
            'jumlah' => $this->request->getVar('jumlah'),
            'harga' => $this->request->getVar('harga'),
        ]);
        //dd($this->request->getVar());
        session()->setFlashdata('pesan', 'Data Berhasil Diubah');
        return redirect()->to('/c_produk');
    }
    public function delete($id = null)
    {
        $this->m_produk->where('id', $id)->delete();
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus');
        return redirect()->to('/c_produk');
    }
    public function detail($slug)
    {
        $komik = $this->m_produk->getKeluar($slug);
        $data = [
            'title' => 'ARKADEMY | PRODUK',
            'komik' => $komik
        ];

        //jika komik tidak ada di lebel
        if (empty($data['komik'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Kode Produk' . $slug . 'tidak ditemukan');
        };
        return view('Produk/detail', $data);
    }
}
