<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


Class Statistic extends Controller {
	
	function Statistic(){
		parent::Controller();
		//$this->freakauth_light->check('user');
		
		//load the models
		$this->load->model('vouchermodel');
		$this->load->model('postpaidmodel');
		$this->load->model('billingplanmodel');
		$this->load->model('statisticmodel');
		
		//load radius helpers
		$this->load->helper('radius');
	}
	
	function index(){
		//security check
		$this->freakauth_light->check('user');
		
		$this->load->library('graph');
		
		//get billingplan 
		$bp_qty = array();
		$bp_label = array();
		$data['billingplans'] = $this->billingplanmodel->getBillingPlanStat();
		foreach ($data['billingplans']->result() as $billingplan) {
			$bp_qty[] = $billingplan->qty;
			$bp_label[] = $billingplan->billingplan;
		}
		
		//PIE chart, 60% alpha
		//
		$this->graph->pie(80,'#505050','{font-size: 12px; color: #404040;');
		//
		// pass in two arrays, one of data, the other data labels
		//
		$this->graph->pie_values( $bp_qty, $bp_label );
		//
		// Colours for each slice, in this case some of the colours
		// will be re-used (3 colurs for 5 slices means the last two
		// slices will have colours colour[0] and colour[1]):
		//
		$this->graph->pie_slice_colours( array('#d9db35','#487daf','#d00000','#4ae331') );

		$this->graph->set_tool_tip( '#val# Vouchers' );
		$this->graph->bg_colour = '#040404';
		$this->graph->title( $this->lang->line('voucher_created'), '{font-size:14px; color: #7F7772}' );
		$this->graph->set_output_type('js');
		
				
		//get the vouchers data
		$data['voucher'] = $this->vouchermodel->getVoucherStatistics();
		
		//get the postpaid account data
		$data['postpaid'] =  $this->postpaidmodel->getAccountStatistic();
		
		//get the who's online list
		$data['onlineuser'] = radius_get_online_users();
		
		$data['title'] = $this->lang->line('hotspot_statistics');
		$data['h1'] = $this->lang->line('hotspot_statistics');
		
		$data['online_user'] = $this->statisticmodel->getOnlineUser();
		
		//$this->output->enacble_profiler();
		
		$this->load->view('statistic/statistic_view',$data);
	}
	
}

?>
