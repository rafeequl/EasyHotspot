<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('header') ?>

<h1><?=$action?></h1>

<?=$this->easyhotspot_validation->error_string;?>

<?php 
	$data=$account->row(); //fetching user information

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

</ul>
<?=form_hidden('username',$data->username)?>
<input type="submit" value="Edit Account" class="submit"  />
<?=form_close()?>
<? $this->load->view('footer'); ?>
