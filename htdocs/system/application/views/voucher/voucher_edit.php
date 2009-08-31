<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('header') ?>

<h1><?=$action?></h1>

<?=$this->validation->error_string;?>

<?php 
	$data=$account->row(); //fetching user information
?>

<?=form_open('voucher/edit')?>
<ul>
	<li>
		<label><?=$this->lang->line('username')?></label>
		<?=$data->username?>
	</li>	
	<li>
		<label><?=$this->lang->line('password')?></label>
		<?=form_input('password',$data->password)?>
	</li>
	<li>
		<label><?=$this->lang->line('billing_plan')?></label>
		<select name="billingplan">
		<?php foreach($billingplans->result_array() as $option):?>
		<option value="<?=$option['name']?>"><?=$option['name']?></option>
		<?php endforeach;?>
		</select>
	</li>
</ul>
<?=form_hidden('username',$data->username)?>
<input type="submit" value="Edit Account" class="submit"  />
<?=form_close()?>
<? $this->load->view('footer'); ?>
