<?php

class Kategori extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('isLogin') == FALSE) {
            redirect('login/process_login');
        } else {
            $this->load->model('kategori_model');
            $this->load->model('authentication_model');
        }
    }

    function index()
    {
        $data['title'] = "Data Kategori Aset";
        $data['subtitle'] = "Data Kategori Aset";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/nav');
        $data['kategori'] = $this->kategori_model->selectAll();
        $this->load->view('nav/kategori', $data);
        $this->load->view('layout/footer');
    }

    function add()
    {
        $data['title'] = "Tambah Kategori";

        $this->load->view('layout/header', $data);
        $this->load->view('layout/nav');
        if ($_POST == NULL) {
            $this->load->view('nav/kategori_add');
            $this->load->view('layout/footer');
        } else {
            $this->kategori_model->insert($_POST);
            redirect('kategori');
        }
    }

    function delete($id)
    {
        $this->kategori_model->delete($id);
        redirect('kategori');
    }

    function edit($id)
    {
        $data['title'] = "Ubah Kategori Aset";
        $data['subtitle'] = "Ubah Kategori Aset";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/nav');
        if ($_POST == NULL) {
            $data['kategori'] = $this->kategori_model->select($id);
            $this->load->view('nav/kategori_edit', $data);
            $this->load->view('layout/footer');
        } else {
            $this->kategori_model->update($id);
            redirect('kategori');
        }
    }
}
