<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class wisata extends REST_Controller  
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('wisata_model');
    }
    public function index_get()
    {
        $nama = $this->get('nama');
        if($nama === null){
        $wisata = $this->wisata_model->getwisata();
        }else{
        $wisata = $this->wisata_model->getwisata($nama);
        }
        
        if($wisata){
            $this->response([
                'status' => TRUE,
                'data' => $wisata
            ], REST_Controller::HTTP_OK); 
        } else {
            $this->response([
                'status' => FALSE,
                'data' => 'not found'
            ], REST_Controller::HTTP_NOT_FOUND);  
        }
    } 

    public function index_delete()
    {
        $nama = $this->delete('nama');

        if($nama === null){
            $this->response([
                'status' => FALSE,
                'data' => 'Provide Name'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        } else {
            if($this->wisata_model->deleteWisata($nama) > 0 ){
                $this->response([
                    'status' => TRUE,
                    'data' => $nama,
                    'massage' => 'Telah Dihapus dari Database'
                ], REST_Controller::HTTP_NO_CONTENT); 
            } else {
                $this->response([
                    'status' => FALSE,
                    'data' => 'Item not found'
                ], REST_Controller::HTTP_NOT_FOUND);  
            }        
        }
    }

    public function index_post()
    {
        $data = [
           'nama' => $this->post('nama'), 
           'alamat' => $this->post('alamat'), 
           'lokasi' => $this->post('lokasi'), 
           'gambar' => $this->post('gambar'),
           'telepon' => $this->post('telepon'),
           'operasional' => $this->post('operasional'),
           'website' => $this->post('website'),
           'keterangan' => $this->post('keterangan')
        ];

        if($this->wisata_model->createWisata($data) > 0){
            $this->response([
                'status' => TRUE,
                'massage' => 'Wisata telah ditambahkan'
            ], REST_Controller::HTTP_CREATED);  
        } else {
            $this->response([
                'status' => FALSE,
                'data' => 'Gagal membuat data baru'
            ], REST_Controller::HTTP_BAD_REQUEST);  
        } 
    }

    public function index_put()
    {
        $id_wisata = $this->put('id_wisata');
        $data = [
            'nama' => $this->put('nama'), 
            'alamat' => $this->put('alamat'), 
            'lokasi' => $this->put('lokasi'), 
            'gambar' => $this->put('gambar'),
            'telepon' => $this->put('telepon'),
            'operasional' => $this->put('operasional'),
            'website' => $this->put('website'),
            'keterangan' => $this->put('keterangan')
         ];
         if($this->wisata_model->updateWisata($data, $id_wisata) > 0){
            $this->response([
                'status' => TRUE,
                'massage' => 'Wisata telah diupdate'
            ], REST_Controller::HTTP_OK);  
        } else {
            $this->response([
                'status' => FALSE,
                'data' => 'Gagal update data'
            ], REST_Controller::HTTP_BAD_REQUEST);  
        } 
    }
    
}