<?php $this->load->view('admin/header') ?>

<h1><?=$action?></h1>
<div id='div_box'>
		<fieldset><legend>Hotspot Info</legend>
		<ul>
			<li><label>Company Name</label><?=$company_name?></li>
			<li><label>Company Address</label><?=$company_address_line1?></li>
			<li><label>&nbsp;</label><?=$company_address_line2?></li>
			<li><label>&nbsp;</label><?=$company_address_line3?></li>
			<li><label>Phone</label><?=$company_phone?></li>
		</fieldset>
		<fieldset><legend>System Info</legend>
		<ul>
			<li><label>Hostname</label><?=$hostname?></li>
			<li><label>Operating System</label><?=$os?></li>
		</ul>	
		</fieldset>
		<p>You logedin as <?=$user?></p>
		</div>
<?= $content ?>

<? $this->load->view('footer'); ?>
