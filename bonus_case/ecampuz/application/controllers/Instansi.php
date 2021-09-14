<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Instansi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->plugins_path_css = array();
		$this->plugins_path_js = array();
		$this->css_path = array();
		$this->js_path = array();

		$this->session_data = $this->session->userdata('logged_in');
		if (!$this->session->userdata('logged_in')) {
			redirect('auth/login');
		}
        // Model
        $this->load->model('instansi_model', 'instansi');
	}

	public function index()
	{
        $this->plugins_path_css = array(
            'datatables-bs4/css/dataTables.bootstrap4.min.css',
            'datatables-responsive/css/responsive.bootstrap4.min.css',
            'sweetalert2-theme-bootstrap-4/bootstrap-4.min.css',
            'datepicker/css/bootstrap-datepicker.min.css',
            'select2/css/select2.min.css',
            'select2-bootstrap4-theme/select2-bootstrap4.min.css',
        );
        $this->plugins_path_js = array(
            'datatables/jquery.dataTables.min.js',
            'datatables-bs4/js/dataTables.bootstrap4.min.js',
            'datatables-responsive/js/dataTables.responsive.min.js',
            'datatables-responsive/js/responsive.bootstrap4.min.js',
            'sweetalert2/sweetalert2.min.js',
            'jquery-validation/jquery.validate.min.js',
            'jquery-validation/additional-methods.min.js',
            'moment/moment.min.js',
            'datepicker/js/bootstrap-datepicker.min.js',
            'select2/js/select2.full.min.js',
        );
        $this->js_path = array(
            'pages/instansi.js?x='.time(),
            'helper/date.js',
        );
        $data = array(
            'header_title' => "Data Instansi",
            'plugins_path_css' => $this->plugins_path_css,
            'plugins_path_js' => $this->plugins_path_js,
            'css_path' => $this->css_path,
            'js_path' => $this->js_path,
        );
		$this->template->load('default', 'instansi/index', $data);
	}

	
    public function getList()
    {
		$cond = null;
        $list = $this->instansi->getList($cond);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            // $no++;
            $row = array();
            $btnEdit = "";
            $btnDelete = "";
            $btnView = "";

			$btnEdit = '<span><button type="button" class="btn btn-outline-info btn-sm" onclick="edit(\'' . ($field->instansi_id) . '\')"><i class="fa fa-edit"></i> Edit</button></span>';
			$btnDelete = '<span><button type="button" class="btn btn-outline-danger btn-sm" onclick="deleteData(\'' . ($field->instansi_id) . '\')"><i class="fa fa-trash"></i> Delete</button></span>';
            $btnView = '<span><button type="button" class="btn btn-outline-success btn-sm" onclick="view(\'' . ($field->instansi_id) . '\')"><i class="fa fa-eye"></i> View</button></span>';
            $btn = " <div class='d-none d-sm-block d-sm-none d-md-block'>$btnEdit $btnView $btnDelete</div>";
            $btn .= "   <div class='input-group-prepend d-md-none d-lg-none d-xl-none '>
                          <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                          </button>
                          <div class='dropdown-menu'>
                            <div class='dropdown-item' href='javasctipy:;'>$btnEdit $btnView $btnDelete</div>
                          </div>
                        </div>";
            $row[] = $btn;
            $row[] = $field->instansi_id;
            $row[] = $field->instansi_name;
            $row[] = $field->instansi_description;
            $data[] = $row;
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->instansi->count_new($cond),
            "recordsFiltered" => $this->instansi->count_filtered_new($cond),
            "data"            => $data,
        );
        //output dalam format JSON

        echo json_encode($output);
    }

	function save()
    {
        $instansi_id = $this->input->post('instansi_id');
        $nama = $this->input->post('nama');
        $deskripsi = $this->input->post('deskripsi');
        $data['instansi'] = array(
            "instansi_name" => $nama,
            "instansi_description" => $deskripsi,
        );
        $cond = array(
            'instansi_id' => $instansi_id
        );
        $this->db->trans_begin();
        if ($instansi_id) {
			$this->instansi->update($data['instansi'], $cond);
        } else {
			$data['instansi']['user_create_by'] = $this->session_data['user_id'];
			$this->instansi->insert($data['instansi']);
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $err = $this->db->error();
            $msg = $err["code"] . "-" . $err["message"];
            $res = array(
                'is_success' => false,
                'message' =>  $msg
            );
        } else {
            $this->db->trans_commit();
            if ($instansi_id) {
                $res = array(
                    'is_success' => true,
                    'message' => "Berhasil Update Data",
                );
            } else {
                $res = array(
                    'is_success' => true,
                    'message' => "Berhasil Menambahkan Data",
                );
            }
        }
        echo json_encode($res);
    }

	public function getOne()
    {
        $instansi_id = $this->input->post('id');
		$cond = array(
			'instansi_id' => $instansi_id
		);
        $data = $this->instansi->getOne($cond);
        echo json_encode($data);
    }

	function delete()
    {


        $instansi_id = $this->input->post('uid');

        $cond = array(
            "instansi_id" => $instansi_id,
        );

        if ($this->instansi->delete($cond)) {
            $res = array(
                'is_success' => true,
                'message' => "Berhasil Menghapus Data Instansi",
            );
        } else {
            $err = $this->db->error();
            $msg = $err["code"] . "-" . $err["message"];
            $res = array(
                'is_success' => false,
                'message' =>  $err
            );
        }
        echo json_encode($res);
    }
}
