<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>
<head>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<?= css_asset('easyhotspot.css',$this->config->item('EASYHOTSPOT_THEME')); ?>
	<?= css_asset('admin.css',$this->config->item('EASYHOTSPOT_THEME')); ?>
	<?= css_asset('billing.css',$this->config->item('EASYHOTSPOT_THEME')); ?>
	<link rel="shortcut icon" href="<?=other_asset_url('favicon.ico','default','image')?>" />
	<?= js_asset('jquery.js'); ?>
	<?= js_asset('flash.js	'); ?>
	<title>EasyHotspot : <?=$title?></title>
</head>

<body>
<div id="container">
<div id="header">
	<div id="logo"><span>EasyHotspot</span></div>
	<div id="version"><?=$this->config->item('EASYHOTSPOT_VERSION');?></div>
	
</div>

<div id="page">
	<?php if(IsAdmin()): ?>
		<div align="right">
		<?= anchor('home','[ Cashier Menu ]') ?> - <?= anchor('admin','[ Admin Menu ]')?>
		</div>
	<? endif; ?>
	<div id="menu">
		
		<ul>
			<li class="home"><?=anchor('home','Home')?></li>
			<li class="account"><?=anchor('postpaid','Postpaid Account Management')?></li>
			<li class="voucher"><?=anchor('voucher','Voucher Management')?></li>
			<li class="invoice"><?=anchor('invoice','Invoice Management')?></li>
			<li class="statistic"><?=anchor('statistic','Statistic')?></li>
			<li class="onlineuser"><?=anchor('onlineuser','Online User')?></li>
			<li class="changepassword"><?=anchor('auth/changepassword','Change Password')?></li>
			<li class="logout"><?=anchor('auth/logout','Logout')?></li>
		</ul>
	</div>
	<div id="date"><?=standard_date('DATE_RFC850',time())?></div>
	<div id="content">
		
		<!--STAR FLASH MESSAGE-->
		<?php 
		$flash=$this->db_session->flashdata('flashMessage');
		if (isset($flash) AND $flash!='')
		{?>
			<div id="flashMessage" style="display:none;">
				<?=$flash?>
			</div>
		<?php }?>
		<!--END FLASH-->
