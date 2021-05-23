<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends BD_Controller {
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->auth();
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






	public function test_post()
	{
       
        $theCredential = $this->user_data;
        $this->response($theCredential, 200); // OK (200) being the HTTP response code
        
	}

    public function users_get()
    {
        // Users from a data store e.g. database
        $users = [
            ['id' => 1, 'name' => 'John', 'email' => 'john@example.com', 'fact' => 'Loves coding'],
            ['id' => 2, 'name' => 'Jim', 'email' => 'jim@example.com', 'fact' => 'Developed on CodeIgniter'],
            ['id' => 3, 'name' => 'Jane', 'email' => 'jane@example.com', 'fact' => 'Lives in the USA', ['hobbies' => ['guitar', 'cycling']]],
        ];

        $id = $this->get('id');

        // If the id parameter doesn't exist return all the users

        if ($id === NULL)
        {
            // Check if the users data store contains users (in case the database result returns NULL)
            if ($users)
            {
                // Set the response and exit
                $this->response($users, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No users were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        // Find and return a single record for a particular user.

        $id = (int) $id;

        // Validate the id.
        if ($id <= 0)
        {
            // Invalid id, set the response and exit.
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // Get the user from the array, using the id as key for retrieval.
        // Usually a model is to be used for this.

        $user = NULL;

        if (!empty($users))
        {
            foreach ($users as $key => $value)
            {
                if (isset($value['id']) && $value['id'] === $id)
                {
                    $user = $value;
                }
            }
        }

        if (!empty($user))
        {
            $this->set_response($user, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            $this->set_response([
                'status' => FALSE,
                'message' => 'User could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function users_delete()
    {
        $id = (int) $this->get('id');

        // Validate the id.
        if ($id <= 0)
        {
            // Set the response and exit
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // $this->some_model->delete_something($id);
        $message = [
            'id' => $id,
            'message' => 'Deleted the resource'
        ];

        $this->set_response($message, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
    }

}