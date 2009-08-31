<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>
<head>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="shortcut icon" href="<?=other_asset_url('favicon.ico','default','image')?>" />
	<?= css_asset('easyhotspot.css',$this->config->item('EASYHOTSPOT_THEME')); ?>
	<?= css_asset('admin.css',$this->config->item('EASYHOTSPOT_THEME')); ?>
	<?= css_asset('jquery.datepick.css',$this->config->item('EASYHOTSPOT_THEME')); ?>
	<?= js_asset('jquery.js'); ?>
	<?= js_asset('jquery.datepick.min.js'); ?>
	<?= js_asset('flash.js'); ?>
	<title>EasyHotspot : <?=$action?></title>

</head>

<body>
	<div id="container">
<div id="headerback"></div>
<div id="header">
	<div id="logo"><span>EasyHotspot</span></div>
	<div id="version"><?=$this->config->item('EASYHOTSPOT_VERSION');?></div>
</div>

<div id="page">
	<div align="right">
		<?= anchor('home','[ Cashier Menu ]') ?> - <?= anchor('admin','[ Admin Menu ]')?>
	</div>
	<div id="menu">
		<ul>
			<li class="home"><?=anchor('admin/','Home')?></li>
			<li class="chillispot"><?=anchor('admin/chillispot','Chillispot')?></li>
			<!-- <li class="radius"><?=anchor('admin/freeradius','FreeRadius')?></li> -->
			<li class="postplan"><?=anchor('admin/postplan','Account Plan')?></li>
			<li class="billingplan"><?=anchor('admin/billingplan','Billing Plan')?></li>
			<li class="cashier"><?=anchor('admin/cashier','Cashier Management')?></li>
			<li class="admin"><?=anchor('admin/admins','Admins')?></li>
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
