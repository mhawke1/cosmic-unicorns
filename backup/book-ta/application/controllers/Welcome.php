<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$order_id = $this->input->get('order_id', TRUE);
		$this->db->from('wp8o_record_data');
		$this->db->where('order_id', $order_id );
		$query = $this->db->get();
		if($query->num_rows() > 0 ){
			$row = $query->row_array();
			$this->data['childname'] = $row['child_name'];
			$this->data['hair_image'] = $row['hair_image'];
			$this->data['hair_class'] = $row['hair_class'];
			$this->data['eye_image'] = $row['eye_image'];
			$this->data['eye_val'] = $row['eye_val'];
			$this->data['glass_image'] = $row['glass_image'];
			$this->data['body_type'] = $row['body_type'];
			$this->data['body_attribute'] = $row['body_attribute'];
			$this->data['frekles'] = $row['frekles'];
			$this->data['story_1'] = $row['story_1'];
			$this->data['story_2'] = $row['story_2'];
			$this->data['story_3'] = $row['story_3'];
			$this->data['story_4'] = $row['story_4'];
			$this->data['story_5'] = $row['story_5'];
			$this->data['story_6'] = $row['story_6'];
			$this->data['story_7'] = $row['story_7'];
			$this->data['story_8'] = $row['story_8'];
			$this->data['story_9'] = $row['story_9'];
			$this->data['story_10'] = $row['story_10'];
			
		}
		
		$this->load->library('pdf');
		$template=$this->load->view('my-view', $this->data,true);
		$template = preg_replace('/>\s+</', "><", $template);
		$this->pdf->loadHtml($template);
		$this->pdf->set_option('isRemoteEnabled', true);
		$webRoot = base_url();
		$this->pdf->setBasePath($webRoot);
		$this->pdf->setPaper(array(0,0, 1823.996220472,984)); 
		$this->pdf->render(); 
		$order_id =  $order_id;
		$this->pdf->stream("Book_".$order_id.".pdf");
	}
	
	public function download_cover(){
		$params=$this->input->get();
		$this->load->library('pdf');
		$template=$this->load->view('cover_view',$params,true);
		$template = preg_replace('/>\s+</', "><", $template);
		$this->pdf->loadHtml($template);
		$this->pdf->set_option('isRemoteEnabled', true);
		$webRoot = base_url();
		$this->pdf->setBasePath($webRoot);
		$this->pdf->setPaper(array(0,0, 1823.996220472,984)); 
		$this->pdf->render(); 
		$order_id = $this->input->get("orid");
		$this->pdf->stream("cover_".$order_id.".pdf");
	}
	
	public function book_download(){
		$template = preg_replace('/>\s+</', "><", $template);
		$this->pdf->loadHtml($template);
		$this->pdf->set_option('isRemoteEnabled', true);
		$webRoot = base_url();
		$this->pdf->setBasePath($webRoot);
		$this->pdf->setPaper(array(0,0, 1823.996220472,984)); 
		$this->pdf->render(); 
		$order_id = $this->input->get("orid");
		$this->pdf->stream("Book_".$order_id.".pdf");
	}
}
