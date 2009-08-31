<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Postpaid extends Controller {
	
	function Postpaid(){
		parent::Controller();
		
		$this->load->model('postpaidmodel');
		$this->load->model('invoicemodel');
	}
	
	function index(){
		//Security check please		
		$this->freakauth_light->check('user');
		
		//Load models and libraries
		$this->load->library('pagination');
		$this->load->library('validation');
		$this->load->library('easyhotspot_validation','Easyhotspot_validation');
		
		//paginate our pages
		$pagination['base_url']=base_url().$this->config->item('index_page').'/'.'postpaid';
		$pagination['per_page'] = '10';
		$pagination['uri_segment'] = '2';
		$total_rows = $this->db->count_all('postpaid_account_list');
		$pagination['total_rows'] = $total_rows;
		$this->pagination->initialize($pagination);
		
		//limit our result
		$page = $this->uri->segment(2, 0);
		$limit =array('start'=>$pagination['per_page'],'end'=>$page);
		$data['account']=$this->postpaidmodel->getAccountList();
		
		//configure the required fields
		$rules['realname']='required';
		$rules['username']='required|check_duplicate_username';
		$rules['password']='required';
		$rules['bill_by']='required';
		$rules['created_by']='required';
		$rules['valid_until']='required|numeric';
		$this->easyhotspot_validation->set_rules($rules);
		
		//get accouts
		
		$data['title']=$this->lang->line('postpaid_account_management');
		$data['action']=$this->lang->line('postpaid_account_management');
		
		if($this->easyhotspot_validation->run() == FALSE){
			// $this->output->enable_profiler(TRUE);
			$this->load->view('postpaid/postpaid_view',$data);
		}else{
			$this->postpaidmodel->addAccount();
			redirect('postpaid');
			
		}
		
		

	}
	
	function delete(){
		$this->freakauth_light->check('user');
		
		$this->postpaidmodel->deleteAccount();
		
		redirect('postpaid','location');
	}
	
	function edit(){
		//security check
		$this->freakauth_light->check('user');
		
		//load validation library
		$this->load->library('validation');
		$this->load->library('easyhotspot_validation','Easyhotspot_validation');
		
		//set rules for the fields
		$rules['password']='required';
		$rules['bill_by']='required';
		$this->easyhotspot_validation->set_rules($rules);
		
		//get current data
		$where = array('username'=>$this->uri->segment(3));
		$data['account'] = $this->postpaidmodel->getAccount('',$where,'');
		
		$data['title']=$this->lang->line('postpaid_account_management');
		$data['action']=$this->lang->line('edit_account');
		
		if($this->easyhotspot_validation->run() == FALSE){
			$this->load->view('postpaid/postpaid_edit', $data);
		}else{
			$this->postpaidmodel->editAccount();
			//$this->output->enable_profiler(TRUE);
			redirect('postpaid');
		}
		
		$this->output->enable_profiler(TRUE);
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
		$pagination['base_url']=base_url().$this->config->item('index_page').'/'.'postpaid/search';
		$pagination['per_page'] = '10';
		$pagination['uri_segment'] = '3';
		$total_rows = $this->postpaidmodel->searchAccount();
		$pagination['total_rows'] = $total_rows->num_rows();
		$this->pagination->initialize($pagination);
		
		//limit our result
		$page = $this->uri->segment(3, 0);
		$limit =array('start'=>$pagination['per_page'],'end'=>$page);
		
		$data['account']=$this->postpaidmodel->searchAccount($limit);
		
		
		$data['title']= $this->lang->line('postpaid_account_search_result');
		$data['action']= $this->lang->line('postpaid_account_search_result');

		$this->load->view('postpaid/postpaid_search',$data);

	}
	
	function bill(){
		//Security check please
		$this->freakauth_light->check('user');
		
		//get user detail information
		$data['account'] = $this->postpaidmodel->getAccountList(null,array('username'=>$this->uri->segment(3)));
		
		//get user detail usage, get by username
		$data['usage'] = $this->postpaidmodel->getAccountUsage('',array('username'=>$this->uri->segment(3))); 
		
			
		$data['title'] = $this->lang->line('billing_invoice');
		$data['action'] = $this->lang->line('billing_invoice');
		
		$this->load->view('postpaid/postpaid_bill',$data);
		
	}
	
	function print_bill(){
		//Security check please
		$this->freakauth_light->check('user');
		
		//load dompdf plugin
		$this->load->plugin('to_pdf');
		
		//get user detail information
		$data['account'] = $this->postpaidmodel->getAccountList(null,array('username'=>$this->uri->segment(3)));
		
		//get user detail usage, get by username
		$data['usage'] = $this->postpaidmodel->getAccountUsage(null,array('username'=>$this->uri->segment(3))); 
		
		//$this->invoicemodel->insert($this->uri->segment(3));
		
		$html = $this->load->view('postpaid/postpaid_print_bill', $data, true);
		
		

		pdf_create($html,'report');
	
	}
	
	function print_voucher(){
		//Security check please
		$this->freakauth_light->check('user');
		
		//load dompdf plugin
		$this->load->plugin('to_pdf');
		
		//get user detail information
		$data['account'] = $this->postpaidmodel->getAccountList(null,array('username'=>$this->uri->segment(3)));
		
		$html = $this->load->view('postpaid/postpaid_print_voucher',$data,true);
		
		pdf_create($html , 'voucher');
	}
}

?>
