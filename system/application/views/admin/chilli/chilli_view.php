<?php $this->load->view('admin/header') ?>
<!-- Restore to default JS -->
<?= js_asset('chillispot_restore_default.js')?>
<h1><?=$action?></h1>

<?=$this->validation->error_string;?>
<?=form_open('admin/chillispot');?>
<ul>
	
	
	<li><label>Radius Server 1</label>
	<?= form_input(array('name' => 'radiusserver1','value' => $chilli_configuration['radiusserver1'],'id' => 'radiusserver1'))?> <acronym title="Address of primary RADIUS server, default 127.0.0.1">?</acronym></li>
	
	<li><label>Radius Server 2</label>
	<?= form_input(array('name' => 'radiusserver2','value'=>$chilli_configuration['radiusserver2'],'id' => 'radiusserver2'))?> <acronym title="Address of secondary RADIUS server, default 127.0.0.1">?</acronym></li>
	
	<li><label>Radius Secret</label>
	<?= form_input(array('name' => 'radiussecret','value' => $chilli_configuration['radiussecret'], 'id' => 'radiussecret'))?> <acronym title="Secret phrase between RADIUS server and Chillispot">?</acronym></li>
	
	<li><label>DHCP Interface</label>
	<?= form_input(array('name' => 'dhcpif','value' => $chilli_configuration['dhcpif'], 'id' => 'dhcpif'))?> <acronym title="Which interface you want to use as Hotspot Interface">?</acronym></li>
		
	<li><label>UAM Server</label>
	<?= form_input(array('name' => 'uamserver', 'value' => $chilli_configuration['uamserver'], 'id' => 'uamserver'))?> <acronym title="Address of captive portal stored">?</acronym></li>	
	
	<li><label>UAM Secret</label>
	<?= form_input(array('name' => 'uamsecret', 'value' => $chilli_configuration['uamsecret'], 'id' => 'uamsecret'))?> <acronym title="Secret phrase between login page and Chillispot">?</acronym></li>
	
	<li><label>Client's Homepage</label>
	<?= form_input(array('name' => 'uamhomepage', 'value' => $chilli_configuration['uamhomepage'], 'id' => 'uamhomepage'))?> <acronym title="Where do you want to redirect your client for the first time">?</acronym></li>	
	
	<li><label>Allowed URL</label>
	<?= form_input(array('name' => 'uamallowed', 'value' => $chilli_configuration['uamallowed'], 'id' => 'uamallowed'))?> <acronym title="URL that clients could browse without login">?</acronym> Separate by comma</li>	
	
	<li><label>DHCP Range</label>
	<?= form_input(array('name' => 'net', 'value' =>  (isset($chilli_configuration['net'])) ? $chilli_configuration['net']: '' , 'id' => 'net'))?> <acronym title="DHCP IP's for clients - must be in XXX.XXX.XXX.XXX/XX format">?</acronym></li>

	<li><label>COAPort</label>
	<?= form_input(array('name' => 'coaport', 'value' => (isset($chilli_configuration['coaport'])) ? $chilli_configuration['coaport'] : '3779', 'id' => 'coaport'))?> <acronym title="Disconnect message port default of 3799 is in RFC 3576">?</acronym></li>

</ul>
<?php $submit=array('name'=>'submit','value'=>'Save Configuration','class'=>'submit')?>
<?=form_submit($submit);?>
<?=form_button(array('name' => 'restore_default','id' => 'restore_default', 'content' => 'Restore Default'))?>
<?=form_close()?>


<?= $this->config->item('CHILLISPOT_CONFIG_FILE'); ?>
<?php $this->load->view('footer') ?>
