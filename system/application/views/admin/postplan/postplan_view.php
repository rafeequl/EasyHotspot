<?php $this->load->view('admin/header.php');?>

<h1><?=$action?></h1>
<?=$this->validation->error_string;?>
<?=form_open('admin/postplan') ?>

<?php $time=$time->row(); ?>
<?php $packet=$packet->row(); ?>
<?php $idletimeout=$idletimeout->row(); ?>
<?php $bw_download=$bw_download->row(); ?>
<?php $bw_upload=$bw_upload->row(); ?>
<?php echo $notice  ?>
<ul>
	<li>
		<label>Price /MB </label>
		<?=form_input('packet',$packet->price)?>
		<acronym title="The price for each Mega Byte">?</acronym>
	</li>
	<li>
		<label>Price /minute </label>
		<?=form_input('time',$time->price)?>
		<acronym title="The price for each minute">?</acronym>
	</li>
	<li>
		<label>IdleTime Out </label>
		<?=form_input('idletimeout',$idletimeout->price)?>
		<acronym title="Idle Timeout">?</acronym>
	</li>
	<li>
		<label>Download Rate</label>
		<?= form_dropdown('bw_download',array(''=>'default','32'=>'32 kbps','64'=>'64 kbps', '128' => '128 kbps', '256'=>'256 kbps', '512'=>'512 kbps','1024'=>'1 MBps','2048'=>'2 MBps'),$bw_download->price)?> <acronym title="The maximum of download rate">?</acronym>
	</li>
	<li>
		<label>Upload Rate</label>
		<?= form_dropdown('bw_upload',array(''=>'default','32'=>'32 kbps','640'=>'64 kbps', '128' => '128 kbps', '256'=>'256 kbps', '512'=>'512 kbps','1024'=>'1 MBps','2048'=>'2 MBps'),$bw_upload->price)?> <acronym title="The maximum of upload rate">?</acronym>
	</li>
</ul>
<input type="submit" value="Save changes" class="submit"  />
<?=form_close()?>

<?php $this->load->view('footer.php');?>