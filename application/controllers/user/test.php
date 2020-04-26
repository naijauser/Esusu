<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
	public function index()
	{
		$this->load->view('user/test');
	}

	public function do_upload(){
		$config = array(
		'upload_path' => "./uploads/",
		'allowed_types' => "gif|jpg|png|jpeg|pdf",
		'overwrite' => TRUE,
		'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
		'max_height' => "768",
		'max_width' => "1024"
		);
		$this->load->library('upload', $config);
        $data = array('upload_data' => $this->upload->data());
		var_dump($this->upload->do_upload());
		die();
		if($this->upload->do_upload())
		{
		$data = array('upload_data' => $this->upload->data());
		$this->load->view('upload_success',$data);
		}
		else
		{
		$error = array('error' => $this->upload->display_errors());
		$this->load->view('custom_view', $error);
		}
	}
}
