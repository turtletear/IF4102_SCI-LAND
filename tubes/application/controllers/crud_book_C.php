<?php

  class crud_book_C extends CI_Controller  {
    public function __construct() {
      parent::__construct();
      $this->load->model('M_Buku');
      $this->load->library('form_validation');
    }

    public function index(){
      //$data['detail_buku']=$this->Buku_M->get_all();
      echo "ini index  crud";
      
    }

    public function addBookV(){
      $data['title'] = "Tambah Data Buku";
      $this->load->view('crudAdm/header', $data);  
      $this->load->view('crudAdm/addBook_V');
    }


    public function addBook(){
      
      $this->form_validation->set_rules('vidbook','id','required', [
        'required' => 'id harus diisi!'
      ]);
      $this->form_validation->set_rules('vjudul','judul','required', [
        'required' => 'judul harus diisi!'
      ]);
      $this->form_validation->set_rules('vpenulis','penulis','required', [
        'required' => 'penulis harus diisi!'
      ]);
      $this->form_validation->set_rules('vpenerbit','penerbit','required', [
        'required' => 'penerbit harus diisi!'
      ]);
      $this->form_validation->set_rules('vjhal','jhal','required', [
        'required' => 'jumlah halaman harus diisi!'
      ]);
      $this->form_validation->set_rules('vstock','stock','required', [
        'required' => 'jumlah stock harus diisi harus diisi!'
      ]);

      if ($this->form_validation->run() == false){
        $data['title'] = "Tambah Data Buku";
        $this->load->view('crudAdm/header', $data);  
        $this->load->view('crudAdm/addBook_V');
      }

      else {
        
        $upload = $_FILES['vcover']['name'];

        if ($upload){
          $config['upload_path'] = './images/';
          $config['allowed_types'] = 'gif|jpg|png|jpeg';
          $config['file_name'] = $this->input->post('vidbook',true);
          $config['max_size'] = '5000';
          $config['overwrite'] = true;
    
          $this->load->library('upload', $config);

          if ($this->upload->do_upload('vcover')){
            $fname = $this->upload->data('file_name');
          }
          else {
            echo $this->upload->display_errors();
          }

        }

        if(!$fname){
          $fname = "default.jpeg";
        }
        
        $data = [
          "id_buku" => $this->input->post('vidbook',true),
          "judul" => $this->input->post('vjudul',true),
          "penulis" => $this->input->post('vpenulis',true),
          "penerbit" => $this->input->post('vpenerbit',true),
          "jhal" => $this->input->post('vjhal',true),
          "stock" => $this->input->post('vstock',true),
          "sinopsis" => $this->input->post('vsinopsis',true),
          "imgpath" => $fname
        ];
  
        $this->M_Buku->addBuku($data);
        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert" style="width=30px;">
        <b>Tambah buku sukses!</b>
        </div>');
        
        redirect("crud_book_C/addBookV");
      }
      

    }



    public function viewbookV(){
      $bdata['books'] = $this->M_Buku->get_all();

      $data['title'] = "List Data Buku";
      $this->load->view('crudAdm/header', $data);  
      $this->load->view('crudAdm/viewBook_V',$bdata);
    }

    public function editbookV(){

        $id = $this->input->post('eid',true);
        $result['book'] = $this->M_Buku->get_buku($id);
        if($result){
          $dataaa = [
            "id" => $id
          ];
          $this->session->set_userdata($dataaa);
          $data['title'] = "Ubah Data Buku";
          $this->load->view('crudAdm/header', $data);  
          $this->load->view('crudAdm/editBook_V',$result);      
      }
    }


    public function editbook(){
      $this->form_validation->set_rules('ejudul','judul','required', [
        'required' => 'judul harus diisi!'
      ]);
      $this->form_validation->set_rules('epenulis','penulis','required', [
        'required' => 'penulis harus diisi!'
      ]);
      $this->form_validation->set_rules('epenerbit','penerbit','required', [
        'required' => 'penerbit harus diisi!'
      ]);
      $this->form_validation->set_rules('ejhal','jhal','required', [
        'required' => 'jumlah halaman harus diisi!'
      ]);
      $this->form_validation->set_rules('estock','stock','required', [
        'required' => 'jumlah stock harus diisi harus diisi!'
      ]);

      if ($this->form_validation->run() == false){
        $id = $this->session->userdata('id');
        $result['book'] = $this->M_Buku->get_buku($id);
          if($result){
            $data['title'] = "Ubah Data Buku";
            $this->load->view('crudAdm/header', $data);  
            $this->load->view('crudAdm/editBook_V',$result);
          }

      }
      else{
        $id = $this->session->userdata('id');
        $data = [
          "judul" => $this->input->post('ejudul',true),
          "penulis" => $this->input->post('epenulis',true),
          "penerbit" => $this->input->post('epenerbit',true),
          "jhal" => $this->input->post('ejhal',true),
          "stock" => $this->input->post('estock',true),
          "sinopsis" => $this->input->post('esinopsis',true)
        ];
  
        $this->M_Buku->updateBuku($id,$data);
        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert" style="width=30px;">
        <b>Ubah data buku sukses!</b>
        </div>');
        $this->editbookV();


      }
  }

    public function search(){
      // $keyword = $this->input->post('keyword');
      $data=$this->M_Buku->get_buku_keyword();
      $this->load->view('lapPencarian',$data);

    }

  }

  ?>
