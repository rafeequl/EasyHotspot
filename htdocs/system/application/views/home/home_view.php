<?php $this->load->view('header')?>

		<h1><?=$h1?></h1>
		
		<div id='div_box'>
		<fieldset><legend><?=$this->lang->line('hotspot_info')?></legend>
		<ul>
			<li><label><?=$this->lang->line('company_name')?></label><?=$company_name?></li>
			<li><label><?=$this->lang->line('company_address')?></label><?=$company_address_line1?></li>
			<li><label>&nbsp;</label><?=$company_address_line2?></li>
			<li><label>&nbsp;</label><?=$company_address_line3?></li>
			<li><label><?=$this->lang->line('phone')?></label><?=$company_phone?></li>
			<li><label>&nbsp;</label><?=$company_tax_code?></li>
		</fieldset>
		<fieldset><legend><?=$this->lang->line('system_info')?></legend>
		<ul>
			<li><label><?=$this->lang->line('hostname')?></label><?=$hostname?></li>
			<li><label><?=$this->lang->line('operating_system')?></label><?=$os?></li>
		</ul>	
		</fieldset>
		<p><?=$this->lang->line('you_logged_in_as')?> <?=$user?></p>
		</div>

<?php $this->load->view('footer')?>
