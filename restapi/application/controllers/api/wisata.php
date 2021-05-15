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
                    'nama' => $nama,
                    'massage' => 'Deleted'
                ], REST_Controller::HTTP_NO_CONTENT); 
            } else {
                $this->response([
                    'status' => FALSE,
                    'data' => 'Item not found'
                ], REST_Controller::HTTP_NOT_FOUND);  
            }        
        }
    }
}