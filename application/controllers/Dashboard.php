<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->library('form_validation');
  }



  
  public function index(){

    if($this->session->userdata('token') == ''){
      return redirect(base_url('dashboard/login'));
    }else{
      if($this->session->userdata('isLoginAdmin') == true){
        $data = [
          'username' => $this->session->userdata('username'),
          'role' => $this->session->userdata('role'),
          'title' => 'Dashboard | Home'
        ];
        if($data['role']=='admin'){
          $this->load->view('layout/header',$data);
          $this->load->view('layout/sidebar');
          $this->load->view('layout/navbar',$data);
          $this->load->view('dashboard');
          $this->load->view('layout/footer');
        }else{
          $this->load->view('layout/header',$data);
          $this->load->view('layout/sidebarUser');
          $this->load->view('layout/navbar',$data);
          $this->load->view('dashboardUser');
          $this->load->view('layout/footer');
        }
        
      }
    }
  }

 

  public function prosesLogin(){
    $url = base_url('/api/auth/login');

		$username = $this->input->post('username');
		$password = $this->input->post('password');

    $data = array(
            'username'      => $username,
            'password' => $password 
    );

    $data_string = json_encode($data);

    $curl = curl_init($url);

    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");

    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
      'Content-Length: ' . strlen($data_string))
    );

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);  // Insert the data

    // Send the request
    $result = curl_exec($curl);

    // Free up the resources $curl is using
    curl_close($curl);

    $cekLogin = json_decode($result,true);

    if(isset($cekLogin['status'])){
      echo ("<script LANGUAGE='JavaScript'>
          window.alert('Invalid Login');
          window.location.href='".base_url('dashboard/login')."';
          </script>");
      return;
    }
    if(isset($cekLogin['token'])){
      if($cekLogin['role'] == 'admin'){
        $this->session->set_userdata('token', $cekLogin['token']);
        $this->session->set_userdata('username', $username);
        $this->session->set_userdata('role', $cekLogin['role']);
        $this->session->set_userdata('isLoginAdmin', true);
        return redirect(base_url('dashboard'));
      }else{
        $this->session->set_userdata('token', $cekLogin['token']);
        $this->session->set_userdata('username', $username);
        $this->session->set_userdata('role', $cekLogin['role']);
        $this->session->set_userdata('id', $cekLogin['id']);
        $this->session->set_userdata('isLoginAdmin', true);
        return redirect(base_url('dashboard'));
      }
    }
   
  }
  public function login(){

    $this->load->view('login');
  }
  ///USER

  public function user(){
    if($this->session->userdata('token') == ''){
      return redirect(base_url('dashboard/login'));
    }else{
      if($this->session->userdata('isLoginAdmin') == true){
        $data = [
          'username' => $this->session->userdata('username'),
          'role' => $this->session->userdata('role'),
          'title' => 'Dashboard | User'
        ];
   

    $url = base_url('/api/main/users');
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");

    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'Authorization: Bearer '.$this->session->userdata('token')
      )
    );
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
    // Send the request
    $result = curl_exec($curl);
    // Free up the resources $curl is using
    curl_close($curl);

    $getUser = json_decode($result,true);
    $user['datauser'] = $getUser['data'];
    

    if($data['role']=='admin'){
      $this->load->view('layout/header');
      $this->load->view('layout/sidebar');
      $this->load->view('layout/navbar');
      $this->load->view('user',$user);
      $this->load->view('layout/footer');
    }else{
      $this->load->view('layout/header');
    $this->load->view('layout/sidebarUser');
    $this->load->view('layout/navbar');
    $this->load->view('user',$user);
    $this->load->view('layout/footer');
    }
    

    }
  } 


  }

  public function logout(){
    if($this->session->userdata('token')){
      session_destroy();
    }
    return redirect(base_url('dashboard/login'));
  }

  ///DELETE USER

  public function delete_user($id){
    if($this->session->userdata('token') == ''){
      return redirect(base_url('dashboard/login'));
    }else{
      if($this->session->userdata('isLoginAdmin') == true){
        $url = base_url('/api/main/user/id/'.$id);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
    
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
          'Authorization: Bearer '.$this->session->userdata('token')
          )
        );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
        // Send the request
        $result = curl_exec($curl);
        // Free up the resources $curl is using
        curl_close($curl);
        $deleteUser = json_decode($result,true);
        if($deleteUser['status'] == 200){
          echo ("<script LANGUAGE='JavaScript'>
          window.alert('User deleted!');
          window.location.href='".base_url('dashboard/user')."';
          </script>");
        }else{
          echo ("<script LANGUAGE='JavaScript'>
          window.alert('Failed to delete');
          window.location.href='".base_url('dashboard/user')."';
          </script>");
        }

      }
    }
  }
  
   ///DATA IKAN

  public function dataikan(){
    if($this->session->userdata('token') == ''){
      return redirect(base_url('dashboard/login'));
    }else{
      if($this->session->userdata('isLoginAdmin') == true){
        $data = [
          'username' => $this->session->userdata('username'),
          'role' => $this->session->userdata('role'),
          'title' => 'Dashboard | User'
        ];

    $url = base_url('/api/main/dataikan');
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");

    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'Authorization: Bearer '.$this->session->userdata('token')
      )
    );
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
    // Send the request
    $result = curl_exec($curl);
    // Free up the resources $curl is using
    curl_close($curl);

    $getUser = json_decode($result,true);
    $user['datauser'] = $getUser['data'];

    if($data['role']=='admin'){
      $this->load->view('layout/header');
    $this->load->view('layout/sidebar');
    $this->load->view('layout/navbar');
    $this->load->view('dataikan',$user);
    $this->load->view('layout/footer');
    }else{
   
      $this->load->view('layout/header');
    $this->load->view('layout/sidebarUser');
    $this->load->view('layout/navbar');
    $this->load->view('dataikanuser',$user);
    $this->load->view('layout/footer');
    }
  }}
  }

  

///DELETE DATA IKAN

public function delete_dataikan($id){
  if($this->session->userdata('token') == ''){
    return redirect(base_url('dashboard/login'));
  }else{
    if($this->session->userdata('isLoginAdmin') == true){
      $url = base_url('/api/main/dataikan/id/'.$id);
      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
  
      curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer '.$this->session->userdata('token')
        )
      );
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
      // Send the request
      $result = curl_exec($curl);
      // Free up the resources $curl is using
      curl_close($curl);
      $deleteUser = json_decode($result,true);
      if($deleteUser['status'] == 200){
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Data ikan deleted!');
        window.location.href='".base_url('dashboard/dataikan')."';
        </script>");
      }else{
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Failed to delete');
        window.location.href='".base_url('dashboard/dataikan')."';
        </script>");
      }

    }
  }
}


/// DATA PENGIRIMAN

public function datapengiriman(){
  if($this->session->userdata('token') == ''){
    return redirect(base_url('dashboard/login'));
  }else{
    if($this->session->userdata('isLoginAdmin') == true){
      $data = [
        'username' => $this->session->userdata('username'),
        'role' => $this->session->userdata('role'),
        'id' => $this->session->userdata('id'),
        'title' => 'Dashboard | User'
      ];

  $url = base_url('/api/main/datapengiriman');
  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");

  curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer '.$this->session->userdata('token')
    )
  );
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
  // Send the request
  $result = curl_exec($curl);
  // Free up the resources $curl is using
  curl_close($curl);

  $getUser = json_decode($result,true);
  $user['datauser'] = $getUser['data'];
  $user['iduser'] = $data['username'];
  if($data['role']=='admin'){
    $this->load->view('layout/header');
    $this->load->view('layout/sidebar');
    $this->load->view('layout/navbar');
    $this->load->view('datapengiriman',$user);
    $this->load->view('layout/footer');
  }else{
    $this->load->view('layout/header');
    $this->load->view('layout/sidebarUser');
    $this->load->view('layout/navbar');
    $this->load->view('datapengirimanuser',$user);
    $this->load->view('layout/footer');
  }
  
  }
}
}

/// DELETE DATA PENGIRIMAN

public function delete_datapengiriman($id){
  if($this->session->userdata('token') == ''){
    return redirect(base_url('dashboard/login'));
  }else{
    if($this->session->userdata('isLoginAdmin') == true){
      $url = base_url('/api/main/datapengiriman/id/'.$id);
      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
  
      curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer '.$this->session->userdata('token')
        )
      );
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
      // Send the request
      $result = curl_exec($curl);
      // Free up the resources $curl is using
      curl_close($curl);
      $deleteDatapengiriman = json_decode($result,true);
      if($deleteDatapengiriman['status'] == 200){
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Data pengiriman deleted!');
        window.location.href='".base_url('dashboard/datapengiriman')."';
        </script>");
      }else{
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Failed to delete');
        window.location.href='".base_url('dashboard/datapengiriman')."';
        </script>");
      }

    }
  }
}


/// EDIT DATA IKAN

public function create_dataikan(){
  if($this->session->userdata('token') == ''){
    return redirect(base_url('dashboard/login'));
  }else{
    if($this->session->userdata('isLoginAdmin') == true){
      $data = [
        'username' => $this->session->userdata('username'),
        'title' => 'Dashboard | Menu'
      ];
      $targetDir = "uploads/";
      $fileName = basename($_FILES["file"]["name"]);
      $targetFilePath = $targetDir . $fileName;
      $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION); 

        // Allow certain file formats
        $allowTypes = array('jpg','png','jpeg','gif','pdf');
        if(in_array($fileType, $allowTypes)){
            // Upload file to server
            move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);
              
            }
      
      $dataCreate = [
        'namaikan'=> $this->input->post('namaikan'),
        'jenisikan'=> $this->input->post('jenisikan'),
        'harga'=> $this->input->post('harga'),
        'deskripsi'=> $this->input->post('deskripsi'),
        'stock'=> $this->input->post('stock'),
        'img_url' => $fileName
      ];

            $url = base_url('/api/main/dataikan');
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
              'Authorization: Bearer '.$this->session->userdata('token')
              )
            );
    
            /* Set JSON data to POST */
            curl_setopt($curl, CURLOPT_POSTFIELDS, $dataCreate);
    
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
            // Send the request
            $result = curl_exec($curl);
            // Free up the resources $curl is using
            curl_close($curl);
    
            $getNota = json_decode($result,true);
            $nota['datanota'] = $getNota['data'];
            
    
            
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('Berhasil di simpan');
            window.location.href='".base_url('dashboard/dataikan')."';
            </script>");
            

    }
  }
}


public function create_user(){
  if($this->session->userdata('token') == ''){
    return redirect(base_url('dashboard/login'));
  }else{
    if($this->session->userdata('isLoginAdmin') == true){
      $data = [
        'username' => $this->session->userdata('username'),
        'title' => 'Dashboard | Menu'
      ];
      
      $dataCreate = [
        'nama'=> $this->input->post('nama'),
        'username'=> $this->input->post('username'),
        'password'=> $this->input->post('password'),
        'role'=> $this->input->post('role')
      ];

            $url = base_url('/api/auth/register');
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
              'Authorization: Bearer '.$this->session->userdata('token')
              )
            );
    
            /* Set JSON data to POST */
            curl_setopt($curl, CURLOPT_POSTFIELDS, $dataCreate);
    
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
            // Send the request
            $result = curl_exec($curl);
            // Free up the resources $curl is using
            curl_close($curl);
    
            $getUser = json_decode($result,true);
            $nota['datanota'] = $getUser['data'];
            
    
            
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('Berhasil di simpan');
            window.location.href='".base_url('dashboard/user')."';
            </script>");
            

    }
  }
}

public function create_datapengiriman(){
  if($this->session->userdata('token') == ''){
    return redirect(base_url('dashboard/login'));
  }else{
    if($this->session->userdata('isLoginAdmin') == true){
      $data = [
        'username' => $this->session->userdata('username'),
        'title' => 'Dashboard | Menu'
      ];
      $dataCreate = [
        'namapenerima'=> $this->input->post('namapenerima'),
        'namaikan'=> $this->input->post('namaikan'),
        'jasapengiriman'=> $this->input->post('jasapengiriman'),
        'noresi'=> $this->input->post('noresi'),
        'tglpemesanan'=> $this->input->post('tglpemesanan')
      ];


            $url = base_url('/api/main/datapengiriman');
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
              'Authorization: Bearer '.$this->session->userdata('token')
              )
            );
    
            /* Set JSON data to POST */
            curl_setopt($curl, CURLOPT_POSTFIELDS, $dataCreate);
    
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
            // Send the request
            $result = curl_exec($curl);
            // Free up the resources $curl is using
            curl_close($curl);
    
            $getMenu = json_decode($result,true);
    
            
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('Berhasil di simpan');
            window.location.href='".base_url('dashboard/datapengiriman')."';
            </script>");
            return;

        
    }
  }
}

public function kirim_wa(){
  if($this->session->userdata('token') == ''){
    return redirect(base_url('dashboard/login'));
  }else{
    if($this->session->userdata('isLoginAdmin') == true){
      $data = [
        'username' => $this->session->userdata('username'),
        'title' => 'Dashboard | Menu'
      ];
     
      $this->load->view('layout/header',$data);
      $this->load->view('layout/sidebar');
      $this->load->view('layout/navbar',$data);
      $this->load->view('kirimwa');
      $this->load->view('layout/footer');
    }
  }
}
public function proses_kirim_wa(){
  if($this->session->userdata('token') == ''){
    return redirect(base_url('dashboard/login'));
  }else{
    if($this->session->userdata('isLoginAdmin') == true){
      $data = [
        'username' => $this->session->userdata('username'),
        'title' => 'Dashboard | Menu'
      ];
      
      
    }
  }
}

public function edit_dataikan($id){
  if($this->session->userdata('token') == ''){
    return redirect(base_url('dashboard/login'));
  }else{
    if($this->session->userdata('isLoginAdmin') == true){
      $data = [
        'username' => $this->session->userdata('username'),
        'title' => 'Dashboard | Menu'
      ];
      $url = base_url('/api/main/dataikan/id/'.$id);
      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
  
      curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer '.$this->session->userdata('token')
        )
      );
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
      // Send the request
      $result = curl_exec($curl);
      // Free up the resources $curl is using
      curl_close($curl);

      $getMenu = json_decode($result,true);
      $menu['datamenu'] = $getMenu['data'];



      $this->load->view('layout/header',$data);
      $this->load->view('layout/sidebar');
      $this->load->view('layout/navbar',$data);
      $this->load->view('edit_dataikan',$menu);
      $this->load->view('layout/footer');
    }
  }
}
public function proses_edit_dataikan($id){
  if($this->session->userdata('token') == ''){
    return redirect(base_url('dashboard/login'));
  }else{
    if($this->session->userdata('isLoginAdmin') == true){
      $data = [
        'username' => $this->session->userdata('username'),
        'title' => 'Dashboard | Menu'
      ];
      $dataCreate = [
        'namaikan'=> $this->input->post('namaikan'),
        'jenisikan'=> $this->input->post('jenisikan'),
        'harga'=> $this->input->post('harga'),
        'deskripsi'=> $this->input->post('deskripsi'),
        'stock'=> $this->input->post('stock')
      ];

      $url = base_url('/api/main/dataikan/id/'.$id);
      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
  
      curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer '.$this->session->userdata('token')
        )
      );
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
      // Send the request
      $result = curl_exec($curl);
      // Free up the resources $curl is using
      curl_close($curl);

      $getMenu = json_decode($result,true);
      $datamenu = $getMenu['data'];
     
      $config = array(
        'upload_path' => "./uploads/",             //path for upload
        'allowed_types' => "gif|jpg|png|jpeg",   //restrict extension
        'max_size' => '10000',
        'max_width' => '10242',
        'max_height' => '768323',
        'file_name' => 'menu_'.date('ymdhis')
        );

        $this->load->library('upload',$config);

        if($this->upload->do_upload('image')) 
        {
            $data = array('upload_data' => $this->upload->data());
            $path = $config['upload_path'].'/'.$data['upload_data']['orig_name'];
            $filename = $data['upload_data']['orig_name'];
            $dataCreate['img_url'] = $filename;
            $dataPut= json_encode($dataCreate);


            // var_dump($dataCreate);die();
            $url = base_url('/api/main/dataikan/id/'.$id);
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
              'Authorization: Bearer '.$this->session->userdata('token'),
              'Content-Type:application/json'
              )
            );

            /* Set JSON data to POST */
            curl_setopt($curl, CURLOPT_POSTFIELDS, $dataPut);
    
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
            // Send the request
            $result = curl_exec($curl);
            // Free up the resources $curl is using
            curl_close($curl);
    
            $getMenu = json_decode($result,true);
            $menu['datamenu'] = $getMenu['status'];
    
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('Berhasil di edit');
            window.location.href='".base_url('dashboard/dataikan')."';
            </script>");
            return;

        }else{
          
            $dataCreate['image'] = $datamenu[0]['image'];

            $dataPut= json_encode($dataCreate);
            $url = base_url('/api/main/dataikan/id/'.$id);
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
              'Authorization: Bearer '.$this->session->userdata('token'),
              'Content-Type:application/json'
              )
            );
    
            /* Set JSON data to POST */
            curl_setopt($curl, CURLOPT_POSTFIELDS, $dataPut);
    
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
            // Send the request
            $result = curl_exec($curl);
            // Free up the resources $curl is using
            curl_close($curl);
    
            $getMenu = json_decode($result,true);
            $menu['datamenu'] = $getMenu['status'];

            echo ("<script LANGUAGE='JavaScript'>
            window.alert('Berhasil di edit');
            window.location.href='".base_url('dashboard/dataikan')."';
            </script>");
            return;
        }
    }
  }
}

/// EDIT USER

public function edituser($id){
  if($this->session->userdata('token') == ''){
    return redirect(base_url('dashboard/login'));
  }else{
    if($this->session->userdata('isLoginAdmin') == true){
      $data = [
        'username' => $this->session->userdata('username'),
        'title' => 'Dashboard | Menu'
      ];
      $url = base_url('/api/main/user/id/'.$id);
      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
  
      curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer '.$this->session->userdata('token')
        )
      );
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
      // Send the request
      $result = curl_exec($curl);
      // Free up the resources $curl is using
      curl_close($curl);

      $getMenu = json_decode($result,true);
      $menu['datamenu'] = $getMenu['data'];


      $this->load->view('layout/header');
      $this->load->view('layout/sidebar');
      $this->load->view('layout/navbar',$data);
      $this->load->view('edituser',$menu);
      $this->load->view('layout/footer');
    }
  }
}
public function proses_edit_user($id){
  if($this->session->userdata('token') == ''){
    return redirect(base_url('dashboard/login'));
  }else{
    if($this->session->userdata('isLoginAdmin') == true){
      $data = [
        'username' => $this->session->userdata('username'),
        'title' => 'Dashboard | Menu'
      ];
      $dataCreate = [
        'nama'=> $this->input->post('nama'),
        'username'=> $this->input->post('username'),
        'password'=> $this->input->post('password'),
        'nohp'=> $this->input->post('nohp'),
        'role'=> $this->input->post('role'),
      ];

      $url = base_url('/api/main/users/id/'.$id);
      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
  
      curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer '.$this->session->userdata('token')
        )
      );
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
      // Send the request
      $result = curl_exec($curl);
      // Free up the resources $curl is using
      curl_close($curl);

      $getMenu = json_decode($result,true);
      $datamenu = $getMenu['data'];


            $dataPut= json_encode($dataCreate);


            // var_dump($dataCreate);die();
            $url = base_url('/api/main/users/id/'.$id);
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
              'Authorization: Bearer '.$this->session->userdata('token'),
              'Content-Type:application/json'
              )
            );

            /* Set JSON data to POST */
            curl_setopt($curl, CURLOPT_POSTFIELDS, $dataPut);
    
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
            // Send the request
            $result = curl_exec($curl);
            // Free up the resources $curl is using
            curl_close($curl);
    
            $getMenu = json_decode($result,true);
            $menu['datamenu'] = $getMenu['status'];
    
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('Berhasil ');
            window.location.href='".base_url('dashboard/user')."';
            </script>");
            return;

    }
  }
}
  
/// EDIT Pengiriman

public function edit_pengiriman($id){
  if($this->session->userdata('token') == ''){
    return redirect(base_url('dashboard/login'));
  }else{
    if($this->session->userdata('isLoginAdmin') == true){
      $data = [
        'username' => $this->session->userdata('username'),
        'title' => 'Dashboard | Menu'
      ];
      $url = base_url('/api/main/datapengiriman/id/'.$id);
      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
  
      curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer '.$this->session->userdata('token')
        )
      );
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
      // Send the request
      $result = curl_exec($curl);
      // Free up the resources $curl is using
      curl_close($curl);

      $getMenu = json_decode($result,true);
      $menu['datamenu'] = $getMenu['data'];



      $this->load->view('layout/header',$data);
      $this->load->view('layout/sidebar');
      $this->load->view('layout/navbar',$data);
      $this->load->view('edit_pengiriman',$menu);
      $this->load->view('layout/footer');
    }
  }
}

public function proses_check_datapengiriman($id){
  if($this->session->userdata('token') == ''){
    return redirect(base_url('dashboard/login'));
  }else{
    if($this->session->userdata('isLoginAdmin') == true){
      $data = [
        'username' => $this->session->userdata('username'),
        'title' => 'Dashboard | Menu'
      ];
      $dataCreate = [
        'status'=> $this->input->post('status')
      ];

      $url = base_url('/api/main/datapengiriman/id/'.$id);
      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
  
      curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer '.$this->session->userdata('token')
        )
      );
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
      // Send the request
      $result = curl_exec($curl);
      // Free up the resources $curl is using
      curl_close($curl);

      $getMenu = json_decode($result,true);
      $datamenu = $getMenu['data'];


            $dataPut= json_encode($dataCreate);


            // var_dump($dataCreate);die();
            $url = base_url('/api/main/checkpengiriman/id/'.$id);
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
              'Authorization: Bearer '.$this->session->userdata('token'),
              'Content-Type:application/json'
              )
            );

            /* Set JSON data to POST */
            curl_setopt($curl, CURLOPT_POSTFIELDS, $dataPut);
    
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
            // Send the request
            $result = curl_exec($curl);
            // Free up the resources $curl is using
            curl_close($curl);
    
            $getMenu = json_decode($result,true);
            $menu['datamenu'] = $getMenu['status'];
    
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('Berhasil di edit');
            window.location.href='".base_url('dashboard/datapengiriman')."';
            </script>");
            return;

    }
  }
}
public function proses_check_datapengirimanuser($id){
  if($this->session->userdata('token') == ''){
    return redirect(base_url('dashboard/login'));
  }else{
    if($this->session->userdata('isLoginAdmin') == true){
      $data = [
        'username' => $this->session->userdata('username'),
        'title' => 'Dashboard | Menu'
      ];
      $dataCreate = [
        'status'=> $this->input->post('status')
      ];

      $url = base_url('/api/main/datapengiriman/id/'.$id);
      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
  
      curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer '.$this->session->userdata('token')
        )
      );
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
      // Send the request
      $result = curl_exec($curl);
      // Free up the resources $curl is using
      curl_close($curl);

      $getMenu = json_decode($result,true);
      $datamenu = $getMenu['data'];


            $dataPut= json_encode($dataCreate);


            // var_dump($dataCreate);die();
            $url = base_url('/api/main/checkpengirimanuser/id/'.$id);
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
              'Authorization: Bearer '.$this->session->userdata('token'),
              'Content-Type:application/json'
              )
            );

            /* Set JSON data to POST */
            curl_setopt($curl, CURLOPT_POSTFIELDS, $dataPut);
    
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
            // Send the request
            $result = curl_exec($curl);
            // Free up the resources $curl is using
            curl_close($curl);
    
            $getMenu = json_decode($result,true);
            $menu['datamenu'] = $getMenu['status'];
    
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('Berhasil di edit');
            window.location.href='".base_url('dashboard/datapengiriman')."';
            </script>");
            return;

    }
  }
}
public function proses_edit_datapengiriman($id){
  if($this->session->userdata('token') == ''){
    return redirect(base_url('dashboard/login'));
  }else{
    if($this->session->userdata('isLoginAdmin') == true){
      $data = [
        'username' => $this->session->userdata('username'),
        'title' => 'Dashboard | Menu'
      ];
      $dataCreate = [
        'tglpemesanan'=> $this->input->post('tglpemesanan'),
        'tglpengiriman'=> $this->input->post('tglpengiriman'),
        'noresi'=> $this->input->post('noresi'),
        'jasapengiriman'=> $this->input->post('jasapengiriman'),
        'namapenerima'=> $this->input->post('namapenerima')
      ];

      $url = base_url('/api/main/datapengiriman/id/'.$id);
      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
  
      curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer '.$this->session->userdata('token')
        )
      );
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
      // Send the request
      $result = curl_exec($curl);
      // Free up the resources $curl is using
      curl_close($curl);

      $getMenu = json_decode($result,true);
      $datamenu = $getMenu['data'];


            $dataPut= json_encode($dataCreate);


            // var_dump($dataCreate);die();
            $url = base_url('/api/main/datapengiriman/id/'.$id);
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
              'Authorization: Bearer '.$this->session->userdata('token'),
              'Content-Type:application/json'
              )
            );

            /* Set JSON data to POST */
            curl_setopt($curl, CURLOPT_POSTFIELDS, $dataPut);
    
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
            // Send the request
            $result = curl_exec($curl);
            // Free up the resources $curl is using
            curl_close($curl);
    
            $getMenu = json_decode($result,true);
            $menu['datamenu'] = $getMenu['status'];
    
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('Berhasil di edit');
            window.location.href='".base_url('dashboard/datapengiriman')."';
            </script>");
            return;

    }
  }
}

/// EDIT PENJUALAN

public function edit_penjualan($id){
  if($this->session->userdata('token') == ''){
    return redirect(base_url('dashboard/login'));
  }else{
    if($this->session->userdata('isLoginAdmin') == true){
      $data = [
        'username' => $this->session->userdata('username'),
        'title' => 'Dashboard | Menu'
      ];
      $url = base_url('/api/main/datapenjualan/id/'.$id);
      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
  
      curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer '.$this->session->userdata('token')
        )
      );
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
      // Send the request
      $result = curl_exec($curl);
      // Free up the resources $curl is using
      curl_close($curl);

      $getMenu = json_decode($result,true);
      $menu['datamenu'] = $getMenu['data'];



      $this->load->view('layout/header',$data);
      $this->load->view('layout/sidebar');
      $this->load->view('layout/navbar',$data);
      $this->load->view('edit_penjualan',$menu);
      $this->load->view('layout/footer');
    }
  }
}

/// EDIT DATA PENJUALAN

public function proses_edit_datapenjualan($id){
  if($this->session->userdata('token') == ''){
    return redirect(base_url('dashboard/login'));
  }else{
    if($this->session->userdata('isLoginAdmin') == true){
      $data = [
        'username' => $this->session->userdata('username'),
        'title' => 'Dashboard | Menu'
      ];
      $dataCreate = [
        'namapenerima'=> $this->input->post('namapenerima'),
        'namaikan'=> $this->input->post('namaikan'),
        'harga'=> $this->input->post('harga'),
        'tglpengiriman'=> $this->input->post('tglpengiriman'),
        'jasapengiriman'=> $this->input->post('jasapengiriman'),
        'keterangan'=> $this->input->post('keterangan')
      ];

      $url = base_url('/api/main/datapenjualan/id/'.$id);
      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
  
      curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer '.$this->session->userdata('token')
        )
      );
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
      // Send the request
      $result = curl_exec($curl);
      // Free up the resources $curl is using
      curl_close($curl);

      $getMenu = json_decode($result,true);
      $datamenu = $getMenu['data'];


            $dataPut= json_encode($dataCreate);


            // var_dump($dataCreate);die();
            $url = base_url('/api/main/datapenjualan/id/'.$id);
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
              'Authorization: Bearer '.$this->session->userdata('token'),
              'Content-Type:application/json'
              )
            );

            /* Set JSON data to POST */
            curl_setopt($curl, CURLOPT_POSTFIELDS, $dataPut);
    
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
            // Send the request
            $result = curl_exec($curl);
            // Free up the resources $curl is using
            curl_close($curl);
    
            $getMenu = json_decode($result,true);
            $menu['datamenu'] = $getMenu['status'];
    
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('Berhasil di simpan');
             window.location.href='".base_url('dashboard/datapenjualan')."';
             </script>");
               return;

    }
  }
}



public function pemesanan(){
  if($this->session->userdata('token') == ''){
    return redirect(base_url('dashboard/login'));
  }else{
    if($this->session->userdata('isLoginAdmin') == true){
      $data = [
        'username' => $this->session->userdata('username'),
        'role' => $this->session->userdata('role'),
        'title' => 'Dashboard | User'
      ];
 

  $url = base_url('/api/main/keranjang');
  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");

  curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer '.$this->session->userdata('token')
    )
  );
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
  // Send the request
  $result = curl_exec($curl);
  // Free up the resources $curl is using
  curl_close($curl);

  $getUser = json_decode($result,true);


  $user['datauser'] = $getUser['data'];
  $user['user'] = $data['username'];
  if(isset($getUser['total'])){
    $user['datatotal'] = $getUser['total'];
    $this->session->set_userdata('total', $user['datatotal']);
  }else{
    $user['datatotal'] = 0;
  }

  if($data['role']=='admin'){
    $this->load->view('layout/header');
    $this->load->view('layout/sidebar');
    $this->load->view('layout/navbar');
    $this->load->view('keranjangAdmin',$user);
    $this->load->view('layout/footer');
  }else{
    $this->load->view('layout/header');
  $this->load->view('layout/sidebarUser');
  $this->load->view('layout/navbar');
  $this->load->view('keranjang',$user);
  $this->load->view('layout/footer');
  }
}

  }
}


//TAMBAH KERANJANG

public function create_keranjang($id){
  if($this->session->userdata('token') == ''){
    return redirect(base_url('dashboard/login'));
  }else{
    if($this->session->userdata('isLoginAdmin') == true){
      $data = [
        'username' => $this->session->userdata('username'),
        'title' => 'Dashboard | Cart'
      ];

      $url = base_url('/api/main/dataikan/id/'.$id);
      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
  
      curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer '.$this->session->userdata('token')
        )
      );
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
      // Send the request
      $result = curl_exec($curl);
      // Free up the resources $curl is using
      curl_close($curl);

      $getMenu = json_decode($result,true);
      $menu = $getMenu['data'];

      $dataCreate = [
        'namaikan'=> $menu[0]['namaikan'],
        'jenisikan'=> $menu[0]['jenisikan'],
        'harga'=> $menu[0]['harga'],
        'deskripsi'=> $menu[0]['deskripsi'],
        'stock'=> $menu[0]['stock'],
        'img_url'=> $menu[0]['img_url'],
        'status' => 'false',
        'namapemesanan'=> $this->session->userdata('username')
      ];


      $url = base_url('/api/main/keranjang');
      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
  
      curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer '.$this->session->userdata('token')
        )
      );

      /* Set JSON data to POST */
      curl_setopt($curl, CURLOPT_POSTFIELDS, $dataCreate);

      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
      // Send the request
      $result = curl_exec($curl);
      // Free up the resources $curl is using
      curl_close($curl);

      $getMenu = json_decode($result,true);
      $cart['datamenu'] = $getMenu['data'];

      
      echo ("<script LANGUAGE='JavaScript'>
      window.alert('Berhasil di tambahkan');
      window.location.href='".base_url('dashboard/pemesanan')."';
      </script>");
      return;

    } 
  }
}

///DELETE KERANJANG
public function delete_keranjang($id){
  if($this->session->userdata('token') == ''){
    return redirect(base_url('dashboard/login'));
  }else{
    if($this->session->userdata('isLoginAdmin') == true){
      $url = base_url('/api/main/keranjang/id/'.$id);
      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
  
      curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer '.$this->session->userdata('token')
        )
      );
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
      // Send the request
      $result = curl_exec($curl);
      // Free up the resources $curl is using
      curl_close($curl);
      $deleteUser = json_decode($result,true);
      if($deleteUser['status'] == 200){
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Pemesanan deleted!');
        window.location.href='".base_url('dashboard/pemesanan')."';
        </script>");
      }else{
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Failed to delete');
        window.location.href='".base_url('dashboard/pemesanan')."';
        </script>");
      }

    }
  }
}

}


 
