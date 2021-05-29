<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

  public function index(){

    $this->load->view('layout/header');
    $this->load->view('layout/sidebar');
    $this->load->view('layout/navbar');
    $this->load->view('dashboard');
    $this->load->view('layout/footer');
  }

  public function list_user(){

    $url = base_url('/api/main/users');
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");

    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjEiLCJ1c2VybmFtZSI6ImZhZGhpbDEyMyIsImlhdCI6MTYyMjI3NDI2MSwiZXhwIjoxNjIyMjkyMjYxfQ.uAKX13RiJTo_vpR1ymtENlBCoo-haWjKrrW3ZX_QxJg'
      )
    );
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
    // Send the request
    $result = curl_exec($curl);
    // Free up the resources $curl is using
    curl_close($curl);

    $getUser = json_decode($result,true);
    $user['datauser'] = $getUser['data'];
    
    $this->load->view('layout/header');
    $this->load->view('layout/sidebar');
    $this->load->view('layout/navbar');
    $this->load->view('user',$user);
    $this->load->view('layout/footer');


  }

  public function delete_user($id){
    $url = base_url('/api/main/users/id/'.$id);
           $curl = curl_init($url);
           curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
       
           curl_setopt($curl, CURLOPT_HTTPHEADER, array(
             'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjEwIiwidXNlcm5hbWUiOiJhZG1pbiIsImlhdCI6MTYyMjI3MzI5NiwiZXhwIjoxNjIyMjkxMjk2fQ.4J1Lk8hWVHu02lVfz9ZLAeVDg5JQb3S6mlsKK3u8UCc'
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
             window.location.href='".base_url('dashboard/list_user')."';
             </script>");
           }else{
             echo ("<script LANGUAGE='JavaScript'>
             window.alert('Failed to delete');
             window.location.href='".base_url('dashboard/list_user')."';
             </script>");
           }
   }
  public function list_barang(){

    $url = base_url('/api/main/barang');
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");

    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjEyIiwidXNlcm5hbWUiOiJkaGFubnkxMjMiLCJpYXQiOjE2MjIyNzY4NDAsImV4cCI6MTYyMjI5NDg0MH0.QEjr594tnMPCRn4D7Y15-cdRNzZFwW1By1tGFiSOpW0'
      )
    );
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
    // Send the request
    $result = curl_exec($curl);
    // Free up the resources $curl is using
    curl_close($curl);

    $getUser = json_decode($result,true);
    $user['datauser'] = $getUser['data'];
    

    $this->load->view('layout/header');
    $this->load->view('layout/sidebar');
    $this->load->view('layout/navbar');
    $this->load->view('barang',$user);
    $this->load->view('layout/footer');
  }
}