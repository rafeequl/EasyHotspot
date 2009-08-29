<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

Class Invoice extends Controller {

	function Invoice(){
		parent::Controller();
		
		$this->load->model('invoicemodel');
		$this->load->helper('freakauth_light');
		
	}
	
	function Index(){
		//Security check please		
		$this->freakauth_light->check('user');
		
		$this->load->library('pagination');

		//paginate our pages
		$pagination['base_url']=base_url().$this->config->item('index_page').'/'.'invoice';
		$pagination['per_page'] = '20';
		$pagination['uri_segment'] = '2';
		$total_rows = $this->invoicemodel->get();
		$pagination['total_rows'] = $total_rows->num_rows();
		$this->pagination->initialize($pagination);
		
		//limit our result
		$page = $this->uri->segment(2, 0);
		$limit =array('start'=>$pagination['per_page'],'end'=>$page);
		$data['invoice']=$this->invoicemodel->get(null,null,$limit);
		
		$data['title']= $this->lang->line('invoice_management');
		$data['action']= $this->lang->line('invoice_management');

		$this->load->view('invoice/invoice_view.php',$data);
	}
	
	function detail(){
		//Security check please		
		$this->freakauth_light->check('user');
		
		$data['invoice'] = $this->invoicemodel->get(null,array('username'=>$this->uri->segment(3)));
		$data['invoice_detail'] = $this->invoicemodel->getDetail(null,array('username'=>$this->uri->segment(3)));
		
		$data['title']= $this->lang->line('invoice');
		$data['action']= $this->lang->line('invoice');
		
		$this->load->view('invoice/invoice_detail',$data);
	
	}
	
	function search(){
		//Security check please		
		$this->freakauth_light->check('user');
		
		//store the keyword to session
		$this->load->library('Db_session');
		if(isset($_POST['search']))
			$this->db_session->set_userdata('search',$_POST['search']);
		
		//paginate our pages
		$this->load->library('pagination');
		$pagination['base_url']=base_url().$this->config->item('index_page').'/'.'invoice/search';
		$pagination['per_page'] = '20';
		$pagination['uri_segment'] = '3';
		$total_rows = $this->invoicemodel->search();
		$pagination['total_rows'] = $total_rows->num_rows();
		$this->pagination->initialize($pagination);
		
		//limit our result
		$page = $this->uri->segment(3, 0);
		$limit =array('start'=>$pagination['per_page'],'end'=>$page);
		
		$data['invoice']=$this->invoicemodel->search($limit);
		
		
		$data['title']= $this->lang->line('invoice_search_result');
		$data['action']= $this->lang->line('invoice_search_result');

		$this->load->view('invoice/invoice_view.php',$data);
	}
	
	function create(){
		$this->freakauth_light->check('user');
		
		if($this->invoicemodel->insert($this->uri->segment(3))){
			$this->print_invoice();
			flashMsg('Invoice Created');
			$this->load->view('invoice/invoice_view.php');
		}else{
			flashMsg('Cannot Create Invoice, this account has never been used');
			redirect('postpaid','location');
		}
		
	}
	
	function delete(){
		$this->freakauth_light->check('admin');
		
		$this->invoicemodel->delete();
		redirect('invoice','location');
	}
	
	function print_invoice(){
		$this->freakauth_light->check('user');
		
		$this->load->plugin('to_pdf');
		
		$data['invoice'] = $this->invoicemodel->get(null,array('username'=>$this->uri->segment(3)));
		$data['invoice_detail'] = $this->invoicemodel->getDetail(null,array('username'=>$this->uri->segment(3)));
				
		#$html = $this->load->view('invoice/invoice_print',$data);
		$html = $this->load->view('invoice/invoice_print',$data, true);

		pdf_create($html,'report');
		
	}
	
		
	


}
