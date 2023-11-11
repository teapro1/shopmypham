<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Producer extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('backend/Mproducer');
        $this->load->model('backend/Muser');
        $this->load->model('backend/Morders');
		if(!$this->session->userdata('sessionadmin')){
			redirect('admin/user/login','refresh');
		}
		$this->data['user']=$this->session->userdata('sessionadmin');
		$this->data['com']='producer';
	}

	public function index(){
		$this->load->library('phantrang');
		$limit=10;
		$current=$this->phantrang->PageCurrent();
		$first=$this->phantrang->PageFirst($limit, $current);
		$total=$this->Mproducer->producer_count();
		$this->data['strphantrang']=$this->phantrang->PagePer($total, $current, $limit, $url='admin/producer');
		$this->data['list']=$this->Mproducer->producer_all($limit,$first);
		$this->data['view']='index';
		$this->data['title']='Danh Sách Nhà Cung Cấp ';
		$this->load->view('backend/layout', $this->data);
	}

	public function insert(){
		$user_role=$this->session->userdata('sessionadmin');
		if($user_role['role']==2){
			redirect('admin/E403/index','refresh');
		}
		$d=getdate();
		$today=$d['year']."/".$d['mon']."/".$d['mday']." ".$d['hours'].":".$d['minutes'].":".$d['seconds'];
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('alias');
		$this->form_validation->set_rules('name', 'Tên Nhà Cung Cấp', 'required|is_unique[db_producer.name]');
		$this->form_validation->set_rules('code', 'Mã Nhà Cung Cấp', 'required|is_unique[db_producer.code]');
		$this->form_validation->set_rules('keyword', 'Sản Phẩm Cung Cấp', 'required');
		if ($this->form_validation->run() == TRUE){
			$mydata= array(
				'name' =>$_POST['name'], 
				'code'=>$_POST['code'], 
				'keyword'=>$_POST['keyword'], 
				'created_at'=>$today,
				'created_by'=>$this->session->userdata('id'),
				'modified'=>$today,
				'modified_by'=>$this->session->userdata('id'),
				'trash'=>1,
				'status'=>$_POST['status']
			);
			$this->Mproducer->producer_insert($mydata);
			$this->session->set_flashdata('success', 'Thêm Nhà Cung Cấp Thành Công');
			redirect('admin/producer','refresh');
		}else{
			$this->data['view']='insert';
			$this->data['title']='Thêm Nhà Cung Cấp';
        	$this->load->view('backend/layout', $this->data);
		}
	}

	public function update($id){
		$user_role=$this->session->userdata('sessionadmin');
		if($user_role['role']==2){
			redirect('admin/E403/index','refresh');
		}
		$this->data['row']=$this->Mproducer->producer_detail($id);
		$d=getdate();
		$today=$d['year']."/".$d['mon']."/".$d['mday']." ".$d['hours'].":".$d['minutes'].":".$d['seconds'];
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('alias');
		$this->form_validation->set_rules('name', 'Tên Nhà Cung Cấp', 'required');
		$this->form_validation->set_rules('keyword', 'Sản Phẩm Cung Cấp', 'required');
		if ($this->form_validation->run() == TRUE) {
			$mydata= array(
				'name' =>$_POST['name'], 
				'modified'=>$today,
				'keyword'=>$_POST['keyword'], 
				'modified_by'=>$this->session->userdata('id'),
				'trash'=>1,
				'status'=>$_POST['status']
			);
			$this->Mproducer->producer_update($mydata, $id);
			$this->session->set_flashdata('success', 'Cập Nhật Nhà Cung Cấp Thành Công');
			redirect('admin/producer/','refresh');
		} 
		$this->data['view']='update';
		$this->data['title']='Cập Nhật Nhà Cung Cấp';
		$this->load->view('backend/layout', $this->data);
	}

	public function status($id){
		$row=$this->Mproducer->producer_detail($id);
		$status=($row['status']==1)?0:1;
		$mydata= array('status' => $status);
		$this->Mproducer->producer_update($mydata, $id);
		$this->session->set_flashdata('success', 'Cập Nhật Nhà Cung Cấp Thành Công');
		redirect('admin/producer/','refresh');
	}

	public function recyclebin(){
		$this->load->library('phantrang');
		$limit=10;
		$current=$this->phantrang->PageCurrent();
		$first=$this->phantrang->PageFirst($limit, $current);
		$total=$this->Mproducer->producer_trash_count();
		$this->data['strphantrang']=$this->phantrang->PagePer($total, $current, $limit, $url='admin/producernt/recyclebin');
		$this->data['list']=$this->Mproducer->producer_trash($limit, $first);
		$this->data['view']='recyclebin';
		$this->data['title']='Thùng Rác Nhà Cung Cấp';
		$this->load->view('backend/layout', $this->data);
	}

	public function trash($id){
		if($id == 5){
			$this->session->set_flashdata('success', 'Không Được Phép Xóa Nhà Cung Cấp Này!');
			redirect('admin/producer','refresh');
		}else{
			$mydata= array('trash' => 0);
			$this->Mproducer->producer_update($mydata, $id);
			$this->session->set_flashdata('success', 'Xóa Nhà Cung Cấp Vào Thùng Rác Thành Công');
			redirect('admin/producer','refresh');
		}
	}

	public function restore($id)
	{
		$this->Mproducer->producer_restore($id);
		$this->session->set_flashdata('success', 'Khôi Phục Nhà Cung Cấp Thành Công');
		redirect('admin/producer/recyclebin','refresh');
	}
	public function delete($id)
	{
		if($id == 5){
			$this->session->set_flashdata('success', 'Không Được Phép Xóa Nhà Cung Cấp Này!');
			redirect('admin/producer/recyclebin','refresh');
		}else{
			$this->Mproducer->producer_delete($id);
			$this->session->set_flashdata('success', 'Xóa Nhà Cung Cấp Thành Công');
			redirect('admin/producer/recyclebin','refresh');
		}
		
	}

}
