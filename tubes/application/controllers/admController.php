<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('admModel');
    }

    public function index() {
        $this->load->view('homeAdmin');
    }

    public function pageRegis() {
        $this->load->view('regisAdmin');
    }
    public function listBuku() {
        $this->load->view('daftarBuku');
    }

    public function editAkun() {
        $this->load->view('ekunAdmin');
    }

    public function pageEdit() {
        $this->load->view('akunAdmin');
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('pjmController/login');
    }

    public function regisAdmin() {
        $this->form_validation->set_rules('namaAdm','Nama','required');
        $this->form_validation->set_rules('emailAdm','Alamat','required');
        $this->form_validation->set_rules('alamatAdm','Email','required');
        $this->form_validation->set_rules('passAdm','Password','required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('regisAdmin');
        } else {
            $this->admModel->addAdmin();
            redirect('admController/home');
        }
    }

    public function loginAdmin() {
        $this->form_validation->set_rules('emailAdm','email','required');
        $this->form_validation->set_rules('passAdm','password','required');
        $emailAdm = $this->input->post('emailAdm');

        if ($this->form_validation->run()) {
            $dataAdm = $this->admModel->getAdminByEmail($emailAdm);
            // cari akun sesuai email
            if ($dataAdm) {
                $passAdm = $this->input->post('passAdm');
                // pass benar
                if ($dataAdm['passAdm'] == $passAdm) {
                    $sess_data = array(
                        'namaAdm' => $data['namaAdm'],
                        'emailAdm' => $data['emailAdm'],
                        'alamatAdm' => $data['alamatAdm'],
                        'passAdm' => $data['passAdm']
                    );
                    $this->session->set_userdata('sessAdm',$sess_data);
                    redirect('admController');
                }
                // pass salah
                else {
                    redirect('pjmController/login');
                }
            }
            // email salah
            else {
                redirect('pjmController/login');
            }
        }
        else {
            redirect('pjmController/login');
        }
    }

    public function editAdmin() {
        $dataAkun = $this->session->userdata('sessAdm');

        $this->form_validation->set_rules('namaAdm','Nama','required');
        $this->form_validation->set_rules('emailAdm','Email','required');
        $this->form_validation->set_rules('alamatAdm','Alamat','required');
        $this->form_validation->set_rules('passAdm','Password','required');

        if ($this->form_validation->run()) {
            $new = array(
                "namaAdm" => $this->input->post('namaAdm',true),
                "emailAdm" => $this->input->post('emailAdm',true),
                "alamatAdm" => $this->input->post('alamatAdm',true),
                "passAdm" => $this->input->post('passAdm',true)
            );
            $this->admModel->editAdmin($dataAkun['emailAdm'],$new);
            redirect('AdmController/home');
 
        } else {
            redirect('AdmController/pageEdit');
        }
    }
}
?>