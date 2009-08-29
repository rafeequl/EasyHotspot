<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('header') ?>

<h1><?=$action?></h1>

<?=$this->easyhotspot_validation->error_string;?>

<?php 
	$data=$account->row(); //fetching user information
	echo "BILL BY ".$data->bill_by." DOWNLOAD ".$data->bw_download." END";
?>

<?=form_open('postpaid/edit')?>
<ul>
	<li>
		<label><?=$this->lang->line('name')?></label>
		<?=$data->realname?>
	</li>
	<li>
		<label><?=$this->lang->line('username')?></label>
		<?=$data->username?>
	
	</li>	
	<li>
		<label><?=$this->lang->line('password')?></label>
		<?=form_input('password',$data->password)?>
	</li>
	<li>
		<label><?=$this->lang->line('bill_by')?></label>
		<?php $options=array('time'=>'Time','packet'=>'Packet');?>
		<?=form_dropdown('bill_by',$options,$data->bill_by)?>
	</li>
	<li>
	    <label>Download Rate</label>
	    <?= form_dropdown('bw_download',array(''=>'default','16000' => '16 kbps','32000'=>'32 kbps','48000'=>'48 kbps','64000'=>'64 kbps', '96000' => '96 kbps', '128000' => '128 kbps',  '192000' => '192 kbps','256000'=>'256 kbps', '512000'=>'512 kbps','1024000'=>'1 MBps','2048000'=>'2 MBps'),$data->bw_download)?> <acronym title="The maximum of download rate">?</acronym>
	</li>
	<li>
	    <label>Upload Rate</label>
	    <?= form_dropdown('bw_upload',array(''=>'default','16000' => '16 kbps','32000'=>'32 kbps','48000'=>'48 kbps','64000'=>'64 kbps', '96000' => '96 kbps', '128000' => '128 kbps',  '192000' => '192 kbps','256000'=>'256 kbps', '512000'=>'512 kbps','1024000'=>'1 MBps','2048000'=>'2 MBps'),$data->bw_upload)?> <acronym title="The maximum of upload rate">?</acronym>
	</li>
</ul>
<?=form_hidden('username',$data->username)?>
<input type="submit" value="Edit Account" class="submit"  />
<?=form_close()?>
<? $this->load->view('footer'); ?>
