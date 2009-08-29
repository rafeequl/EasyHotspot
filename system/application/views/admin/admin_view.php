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
			<li><label>Tax Code</label><?=$company_tax_code?></li>
		</fieldset>
		<fieldset><legend>System Info</legend>
		<ul>
			<li><label>Hostname</label><?=$hostname?></li>
			<li><label>Operating System</label><?=$os?></li>
		</ul>
		<ul>
			<li><label>MySQL ?</label><?=$mysql?></li>
			<li><label>Chillspot ?</label><?=$chilli?></li>
			<li><label>Chillspot COAPORT ?</label><?=$coaport?></li>
			<li><label>Radius 1812 ?</label><?=$radius1?></li>
			<li><label>Radius 1813 ?</label><?=$radius2?></li>
			<li><label>Radius 1814 ?</label><?=$radius3?></li>
		</ul>
		</fieldset>
		<p>You are logged in as <?=$user?></p>
		</div>
<?= $content ?>

<? $this->load->view('footer'); ?>
