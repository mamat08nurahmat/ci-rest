<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Contact extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak

    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $kontak = $this->db->get('contact')->result();
        } else {
            $this->db->where('id', $id);
            $kontak = $this->db->get('contact')->result();
        }
        $this->response($kontak, 200);
    }

//Mengirim atau menambah data kontak baru
function index_post() {
    $data = array(
                'id'       => $this->post('id'),
                'name'     => $this->pos('name'),
                'email'    => $this->post('email'),
                'subject'  => $this->post('subject'),
                'message'  => $this->post('message')
                );
                $insert = $this->db->insert('contact', $data);
    if ($insert) {
        $this->response($data, 200);
    } else {
        $this->response(array('status' => 'fail', 502));
    }
}


// //Memperbarui data kontak yang telah ada
// function index_put() {
//     $id = $this->put('id');
//     $data = array(
//                 'id'       => $this->put('id'),
//                 'nama'          => $this->put('nama'),
//                 'nomor'    => $this->put('nomor'));
//     $this->db->where('id', $id);
//     $update = $this->db->update('telepon', $data);
//     if ($update) {
//         $this->response($data, 200);
//     } else {
//         $this->response(array('status' => 'fail', 502));
//     }
// }

// //Menghapus salah satu data kontak
// function index_delete() {
//     $id = $this->delete('id');
//     $this->db->where('id', $id);
//     $delete = $this->db->delete('telepon');
//     if ($delete) {
//         $this->response(array('status' => 'success'), 201);
//     } else {
//         $this->response(array('status' => 'fail', 502));
//     }
// }

    //Masukan function selanjutnya disini

}
?>