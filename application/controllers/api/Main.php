<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends BD_Controller {
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->auth();
        $this->load->model('Crud');
    }
	
	public function test_post()
	{
       
        $theCredential = $this->user_data;
        $this->response($theCredential, 200); // OK (200) being the HTTP response code
        
	}

    public function users_get()
    {

        $id = $this->get('id');


        if ($id === NULL)
        {
            $getUser = $this->Crud->readData('id,nama,password,role,username','user')->result();
            if ($getUser)
            {
                // Set the response and exit
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success get user',
                    'data'=> $getUser
                ];
                $this->response($output, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'No users were found',
                    'data'=> []
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        if($id){
            $where = [
                'id'=> $id
            ];
            $getUserById = $this->Crud->readData('id,nama,password,role,username','user',$where)->result();

            if($getUserById){
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success get user',
                    'data'=> $getUserById
                ];
                $this->response($output, REST_Controller::HTTP_OK);
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed get User or id Not found',
                    'data'=> []
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
            }
        }

    }


    ////USER

    public function user_post(){
        $id = $this->post('id');
        $nama = $this->post('nama');
        $password = $this->post('password');
        $role = $this->post('role');
        $username = $this->post('username');
        $data = [
            "id" =>$id,
            "nama" =>$nama,
            "password" =>$password,
            "role" =>$role,
            "username" =>$username,
        ];

        $createDatauser = $this->Crud->createData('datauser',$data);

    if($createDatauser){
        $output = [
            'status' => 200,
            'error' => false,
            'message' => 'success create data user',
            'data' => $data
        ];
            $this->set_response($output,REST_Controller::HTTP_OK);
        
    }else{
        $output = [
            'status'=> 400,
            'error'=> false,
            'message'=> 'failed create data user',
            'data'=>[]
        ];
        $this->set_response($output,REST_Controller::HTTP_BAD_REQUEST);
    }
    }

    public function user_get()
    {

        $id = $this->get('id');


        if ($id === NULL)
        {
            $getDatauser = $this->Crud->readData('id,nama,password,role,username,','user')->result();
            if ($getDatauser)
            {
                // Set the response and exit
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success get data user',
                    'data'=> $getDatauser
                ];
                $this->response($output, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'No data user were found',
                    'data'=> []
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        if($id){
            $where = [
                'id'=> $id
            ];
            $getDatauserById = $this->Crud->readData('id,nama,password,role,username,','user',$where)->result();

            if($getDatauserById){
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success get data user',
                    'data'=> $getDatauserById
                ];
                $this->response($output, REST_Controller::HTTP_OK);
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed get data user or id Not found',
                    'data'=> []
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
            }
        }

    }
    public function users_put(){

        $id = (int) $this->get('id');
        if($id){
            $where = [
                'id'=> $id
            ];
            $cekId = $this->Crud->readData('id','user',$where)->num_rows();

            if($cekId > 0){
                $data = [
                    "nama"      => $this->put('nama'),
                    "password"  => sha1($this->put('password')),
                    "nohp"   => $this->put('nohp'),
                    "role"   => $this->put('role'),
                    "username"   => $this->put('username')
                ];

                $updateData = $this->Crud->updateData('user',$data,$where);
                if($updateData){
                    $output = [
                        'status' => 200,
                        'error' => false,
                        'message' => 'Success edit data user',
                    ];
                    $this->response($output, REST_Controller::HTTP_OK);
                }else{
                    $output = [
                        'status' => 400,
                        'error' => false,
                        'message' => 'Failed edit data user',
                    ];
                    $this->response($output, REST_Controller::HTTP_BAD_REQUEST); 
                }
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed delete data user or id not found',
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
            }
        }

    }

    public function user_delete()
    {

        $id = (int) $this->get('id');

        if($id){
            $where = [
                'id'=> $id
            ];
            $cekId = $this->Crud->readData('id','user',$where)->num_rows();

            if($cekId > 0){
                
                $this->Crud->deleteData('user',$where);
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success delete data user',
                ];
                $this->response($output, REST_Controller::HTTP_OK);
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed delete data user or id not found',
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
            }
        }
    }
   
    ////DATA IKAN

    public function dataikan_post(){
        $id = $this->post('id');
        $namaikan = $this->post('namaikan');
        $jenisikan = $this->post('jenisikan');
        $harga = $this->post('harga');
        $deskripsi = $this->post('deskripsi');
        $stock = $this->post('stock');
        $img_url = $this->post('img_url');

        $data = [
            "id" =>$id,
            "namaikan" =>$namaikan,
            "jenisikan" =>$jenisikan,
            "harga" =>$harga,
            "deskripsi" =>$deskripsi,
            "stock" =>$stock,
            "img_url" => $img_url
        ];

        $createUser = $this->Crud->createData('dataikan',$data);

    if($createUser){
        $output = [
            'status' => 200,
            'error' => false,
            'message' => 'success create ikan',
            'data' => $data
        ];
            $this->set_response($output,REST_Controller::HTTP_OK);
        
    }else{
        $output = [
            'status'=> 400,
            'error'=> false,
            'message'=> 'failed create user',
            'data'=>[]
        ];
        $this->set_response($output,REST_Controller::HTTP_BAD_REQUEST);
    }
    }

    public function dataikan_get()
    {

        $id = $this->get('id');


        if ($id === NULL)
        {
            $getDataikan = $this->Crud->readData('id,namaikan,jenisikan,harga,deskripsi,stock,img_url','dataikan')->result();
            if ($getDataikan)
            {
                // Set the response and exit
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success get data ikan',
                    'data'=> $getDataikan
                ];
                $this->response($output, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'No data ikan were found',
                    'data'=> []
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        if($id){
            $where = [
                'id'=> $id
            ];
            $getDataikanById = $this->Crud->readData('id,namaikan,jenisikan,harga,deskripsi,stock,img_url,','dataikan',$where)->result();

            if($getDataikanById){
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success get data ikan',
                    'data'=> $getDataikanById
                ];
                $this->response($output, REST_Controller::HTTP_OK);
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed get data ikan or id Not found',
                    'data'=> []
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
            }
        }

    }
    public function dataikan_put(){

        $id = (int) $this->get('id');
        if($id){
            $where = [
                'id'=> $id
            ];
            $cekId = $this->Crud->readData('id','dataikan',$where)->num_rows();

            if($cekId > 0){
                $data = [
                    "namaikan"      => $this->put('namaikan'),
                    "jenisikan"  => $this->put('jenisikan'),
                    "harga"  => $this->put('harga'),
                    "deskripsi"    => $this->put('deskripsi'),
                    "stock"   => $this->put('stock'),
                    "img_url"   => $this->put('img_url'),

                ];

                $updateData = $this->Crud->updateData('dataikan',$data,$where);
                if($updateData){
                    $output = [
                        'status' => 200,
                        'error' => false,
                        'message' => 'Success edit data ikan',
                    ];
                    $this->response($output, REST_Controller::HTTP_OK);
                }else{
                    $output = [
                        'status' => 400,
                        'error' => false,
                        'message' => 'Failed edit data ikan',
                    ];
                    $this->response($output, REST_Controller::HTTP_BAD_REQUEST); 
                }
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed delete data ikan or id not found',
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
            }
        }

    }

    public function dataikan_delete()
    {

        $id = (int) $this->get('id');

        if($id){
            $where = [
                'id'=> $id
            ];
            $cekId = $this->Crud->readData('id','dataikan',$where)->num_rows();

            if($cekId > 0){
                
                $this->Crud->deleteData('dataikan',$where);
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success delete data ikan',
                ];
                $this->response($output, REST_Controller::HTTP_OK);
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed delete data ikan or id not found',
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
            }
        }
    }

    ////DATA PENGIRIMAN

    public function datapengiriman_post(){
        $id = $this->post('id');
        $tglpemesanan = $this->post('tglpemesanan');
        $noresi = $this->post('noresi');
        $namaikan = $this->post('namaikan');
        $jasapengiriman = $this->post('jasapengiriman');
        $namapenerima = $this->post('namapenerima');

        $data = [
            "id" =>$id,
            "tglpemesanan" =>$tglpemesanan,
            "noresi" =>$noresi,
            "namaikan" => $namaikan,
            "jasapengiriman" =>$jasapengiriman,
            "namapenerima" =>$namapenerima,
        ];

        $createDatapengiriman = $this->Crud->createData('datapengiriman',$data);

    if($createDatapengiriman){
        $output = [
            'status' => 200,
            'error' => false,
            'message' => 'success create data pengiriman',
            'data' => $data
        ];
            $this->set_response($output,REST_Controller::HTTP_OK);
        
    }else{
        $output = [
            'status'=> 400,
            'error'=> false,
            'message'=> 'failed create data pengiriman',
            'data'=>[]
        ];
        $this->set_response($output,REST_Controller::HTTP_BAD_REQUEST);
    }
    }
    public function datapenjualan_post(){
        $id = $this->post('id');
        $namapenerima = $this->post('namapenerima');
        $namaikan = $this->post('namaikan');
        $harga = $this->post('harga');
        $noresi = $this->post('noresi');
        $jasapengiriman = $this->post('jasapengiriman');
        $keterangan = $this->post('keterangan');

        $data = [
            "id" =>$id,
            "namapenerima" =>$namapenerima,
            "namaikan" =>$namaikan,
            "harga" => $harga,
            "noresi" =>$noresi,
            "jasapengiriman" =>$jasapengiriman,
            "keterangan" =>$keterangan,
        ];

        $createDatapengiriman = $this->Crud->createData('datapenjualan',$data);

    if($createDatapengiriman){
        $output = [
            'status' => 200,
            'error' => false,
            'message' => 'success create data pengiriman',
            'data' => $data
        ];
            $this->set_response($output,REST_Controller::HTTP_OK);
        
    }else{
        $output = [
            'status'=> 400,
            'error'=> false,
            'message'=> 'failed create data pengiriman',
            'data'=>[]
        ];
        $this->set_response($output,REST_Controller::HTTP_BAD_REQUEST);
    }
    }

    public function datapengiriman_get()
    {

        $id = $this->get('id');


        if ($id === NULL)
        {
            $getDatapengiriman = $this->Crud->readData('id,tglpemesanan,noresi,namaikan,jasapengiriman,namapenerima,status','datapengiriman')->result();
            if ($getDatapengiriman)
            {
                // Set the response and exit
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success get data pengiriman',
                    'data'=> $getDatapengiriman
                ];
                $this->response($output, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'No data pengiriman were found',
                    'data'=> []
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        if($id){
            $where = [
                'id'=> $id
            ];
            $getDatapengirimanById = $this->Crud->readData('id,tglpemesanan,noresi,namaikan,jasapengiriman,namapenerima,status','datapengiriman',$where)->result();

            if($getDatapengirimanById){
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success get data pengiriman',
                    'data'=> $getDatapengirimanById
                ];
                $this->response($output, REST_Controller::HTTP_OK);
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed get data pengiriman or id Not found',
                    'data'=> []
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
            }
        }

    }
   
    public function datapengiriman_put(){

        $id = (int) $this->get('id');
        if($id){
            $where = [
                'id'=> $id
            ];
            $cekId = $this->Crud->readData('id','datapengiriman',$where)->num_rows();

            if($cekId > 0){
                $data = [
                    "tglpemesanan"      => $this->put('tglpemesanan'),
                    "noresi"  => $this->put('noresi'),
                    "namaikan" => $this->put('namaikan'),
                    "jasapengiriman"  => $this->put('jasapengiriman'),
                    "namapenerima"    => $this->put('namapenerima'),
                ];

                $updateData = $this->Crud->updateData('datapengiriman',$data,$where);
                if($updateData){
                    $output = [
                        'status' => 200,
                        'error' => false,
                        'message' => 'Success edit data pengiriman',
                    ];
                    $this->response($output, REST_Controller::HTTP_OK);
                }else{
                    $output = [
                        'status' => 400,
                        'error' => false,
                        'message' => 'Failed edit data pengiriman',
                    ];
                    $this->response($output, REST_Controller::HTTP_BAD_REQUEST); 
                }
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed delete data pengiriman ikan or id not found',
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
            }
        }

    }
    public function checkpengiriman_put(){

        $id = (int) $this->get('id');
        if($id){
            $where = [
                'id'=> $id
            ];
            $cekId = $this->Crud->readData('id','datapengiriman',$where)->num_rows();

            if($cekId > 0){
                $data = [
                    "status"      => 'pengiriman',
                   
                ];

                $updateData = $this->Crud->updateData('datapengiriman',$data,$where);
                if($updateData){
                    $output = [
                        'status' => 200,
                        'error' => false,
                        'message' => 'Success edit data pengiriman',
                    ];
                    $this->response($output, REST_Controller::HTTP_OK);
                }else{
                    $output = [
                        'status' => 400,
                        'error' => false,
                        'message' => 'Failed edit data pengiriman',
                    ];
                    $this->response($output, REST_Controller::HTTP_BAD_REQUEST); 
                }
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed delete data pengiriman ikan or id not found',
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
            }
        }

    }
    public function checkpengirimanuser_put(){

        $id = (int) $this->get('id');
        if($id){
            $where = [
                'id'=> $id
            ];
            $cekId = $this->Crud->readData('id','datapengiriman',$where)->num_rows();

            if($cekId > 0){
                $data = [
                    "status"      => 'selesai',
                   
                ];

                $updateData = $this->Crud->updateData('datapengiriman',$data,$where);
                if($updateData){
                    $output = [
                        'status' => 200,
                        'error' => false,
                        'message' => 'Success edit data pengiriman',
                    ];
                    $this->response($output, REST_Controller::HTTP_OK);
                }else{
                    $output = [
                        'status' => 400,
                        'error' => false,
                        'message' => 'Failed edit data pengiriman',
                    ];
                    $this->response($output, REST_Controller::HTTP_BAD_REQUEST); 
                }
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed delete data pengiriman ikan or id not found',
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
            }
        }

    }
    public function datapengiriman_delete()
    {

        $id = (int) $this->get('id');

        if($id){
            $where = [
                'id'=> $id
            ];
            $cekId = $this->Crud->readData('id','datapengiriman',$where)->num_rows();

            if($cekId > 0){
                
                $this->Crud->deleteData('datapengiriman',$where);
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success delete data pengiriman ikan',
                ];
                $this->response($output, REST_Controller::HTTP_OK);
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed delete data pengiriman ikan or id not found',
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
            }
        }
    }

   

    ////KERANJANG

    public function keranjang_post(){
        $id = $this->post('id');
        $namaikan = $this->post('namaikan');
        $jenisikan = $this->post('jenisikan');
        $harga = $this->post('harga');
        $deskripsi = $this->post('deskripsi');
        $img_url = $this->post('img_url');
        $namapemesanan = $this->post('namapemesanan');

        $data = [
            "id" =>$id,
            "namaikan" =>$namaikan,
            "harga" =>$harga,
            "deskripsi" =>$deskripsi,
            "jenisikan" =>$jenisikan,
            "img_url" =>$img_url,
            "namapemesanan" =>$namapemesanan,
        ];

        $createKeranjang = $this->Crud->createData('keranjang',$data);

    if($createKeranjang){
        $output = [
            'status' => 200,
            'error' => false,
            'message' => 'success create Keranjang',
            'data' => $data
        ];
            $this->set_response($output,REST_Controller::HTTP_OK);
        
    }else{
        $output = [
            'status'=> 400,
            'error'=> false,
            'message'=> 'failed create Keranjang',
            'data'=>[]
        ];
        $this->set_response($output,REST_Controller::HTTP_BAD_REQUEST);
    }
}

    public function keranjang_get()
    {

        $id = $this->get('id');


        if ($id === NULL)
        {
            
            $getKeranjang = $this->Crud->readData('*','keranjang')->result();
            if ($getKeranjang)
            {
                $total = $this->db->query("select SUM(harga) as total from keranjang")->result();
                // Set the response and exit
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success get Keranjang',
                    'data'=> $getKeranjang,
                    'total'=>$total
                ];
                $this->response($output, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'No Keranjang were found',
                    'data'=> []
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        if($id){
            $where = [
                'namapemesanan'=> $id
            ];
            $getDatapenjualanById = $this->Crud->readData('*','keranjang',$where)->result();

            if($getDatapenjualanById){
                $total = $this->db->query("select SUM(harga) as total from keranjang")->result();
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success get Keranjang',
                    'data'=> $getKeranjangById
                ];
                $this->response($output, REST_Controller::HTTP_OK);
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed get Keranjang or id Not found',
                    'data'=> []
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
            }
        }

    }
    public function keranjang_put(){

        $id = (int) $this->get('id');
        if($id){
            $where = [
                'id'=> $id
            ];
            $cekId = $this->Crud->readData('id','keranjang',$where)->num_rows();

            if($cekId > 0){
                $data = [
                    "namaikan"      => $this->put('namaikan'),
                    "jenisikan"  => $this->put('jenisikan'),
                    "harga"   => $this->put('harga'),
                    "deskripsi"   => $this->put('deskripsi'),
                    "stock"   => $this->put('stock'),
                    "img_url"   => $this->put('img_url'),
                    "total"   => $this->put('total'),
                    "namapemesanan"   => $this->put('namapemesanan'),
                ];

                $updateData = $this->Crud->updateData('keranjang',$data,$where);
                if($updateData){
                    $output = [
                        'status' => 200,
                        'error' => false,
                        'message' => 'Success edit data keranjang',
                    ];
                    $this->response($output, REST_Controller::HTTP_OK);
                }else{
                    $output = [
                        'status' => 400,
                        'error' => false,
                        'message' => 'Failed edit keranjang',
                    ];
                    $this->response($output, REST_Controller::HTTP_BAD_REQUEST); 
                }
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed delete keranjang or id not found',
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
            }
        }

    }

    public function keranjang_delete()
    {

        $id = (int) $this->get('id');

        if($id){
            $where = [
                'id'=> $id
            ];
            $cekId = $this->Crud->readData('id','keranjang',$where)->num_rows();

            if($cekId > 0){
                
                $this->Crud->deleteData('keranjang',$where);
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success delete data Keterangan',
                ];
                $this->response($output, REST_Controller::HTTP_OK);
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed delete Keterangan or id not found',
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
            }
        }
    }
}
