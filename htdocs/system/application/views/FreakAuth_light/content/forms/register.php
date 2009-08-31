<div id="register">
<fieldset><legend accesskey="D" tabindex="1"><?=$heading?></legend>
<?=form_open($this->uri->uri_string(), array('id' => 'register_form'))?>
	<!--USERNAME-->
	<p><label for="user_name"><?=$this->lang->line('FAL_user_name_label')?>:</label>
	<?=form_input(array('name'=>'user_name', 
	                       'id'=>'user_name',
	                       'maxlength'=>'45', 
	                       'size'=>'45',
	                       'value'=>(isset($this->fal_validation) ? $this->fal_validation->{'user_name'} : '')))?>
    <?=(isset($this->fal_validation) ? $this->fal_validation->{'user_name'.'_error'} : '')?></p>
	 
    <!--PASSWORD-->
    <p><label for="password"><?=$this->lang->line('FAL_user_password_label')?>:</label>
	<?=form_password(array('name'=>'password', 
	                       'id'=>'password',
	                       'maxlength'=>'16', 
	                       'size'=>'16',
	                       'value'=>''))?>
    <?=(isset($this->fal_validation) ? $this->fal_validation->{'password'.'_error'} : '')?></p>
    
     <!--CONFIRM PASSWORD-->
     <p><label for="password_confirm"><?=$this->lang->line('FAL_user_password_confirm_label')?>:</label>
	<?=form_password(array('name'=>'password_confirm', 
	                       'id'=>'password_confirm',
	                       'maxlength'=>'16', 
	                       'size'=>'16',
	                       'value'=>''))?>
    <?=(isset($this->fal_validation) ? $this->fal_validation->{'password_confirm'.'_error'} : '')?></p>
    
    
    <!--EMAIL-->
    <p><label for="email"><?=$this->lang->line('FAL_user_email_label')?>:</label>
	<?=form_input(array('name'=>'email', 
	                       'id'=>'email',
	                       'maxlength'=>'120', 
	                       'size'=>'45',
	                       'value'=>(isset($this->fal_validation) ? $this->fal_validation->{'email'} : '')))?>
    <?=(isset($this->fal_validation) ? $this->fal_validation->{'email'.'_error'} : '')?></p>
    
    <!--CAPTCHA (security image)-->
	<?php
	if ($this->config->item('FAL_use_captcha_register'))
	{?>
	<p><label for="security"><?=$this->lang->line('FAL_captcha_label')?>:</label>
	<?=form_input(array('name'=>'security', 
	                       'id'=>'security',
	                       'maxlength'=>'45', 
	                       'size'=>'45',
	                       'value'=>''))?>
    <?=(isset($this->fal_validation) ? $this->fal_validation->{'security'.'_error'} : '')?>
    <?=$this->load->view($this->config->item('FAL_captcha_img_tag_view'), null, true)?></p>
    <?php }?>
    <!-- END CAPTCHA (security image)-->
<?php
if ($this->config->item('FAL_use_country'))
{?>    
    <p><label><?=$this->lang->line('FAL_user_country_label')?>:</label>
	<?=form_dropdown('country_id',
	                 $countries,
	                 (isset($this->fal_validation) ? $this->fal_validation->country_id : 0))?>
    <?=(isset($this->fal_validation) ? $this->fal_validation->{'country_id'.'_error'} : '')?></p>
<?php
}
$buttonSubmit = $this->lang->line('FAL_register_label');
$buttonCancel = $this->lang->line('FAL_cancel_label');
$callConfirm = '';
if ($this->lang->line('FAL_terms_of_service_message') != '')
{
    $buttonSubmit = $this->lang->line('FAL_agree_label');
    $buttonCancel = $this->lang->line('FAL_donotagree_label');
    $callConfirm = 'confirmDecline();';
?>
<p><textarea name="rules" class="textarea" rows="8" cols="50" readonly="readonly">
<?=$this->lang->line('FAL_terms_of_service_message')?>
</textarea>
</p>
<?php    
}?>
    <p><label>
	<?=form_submit(array('name'=>'register',
						'class'=>'submit',  
	                     'value'=>$buttonSubmit))?>
    </label></p>
	<p><label>
	<?=form_submit(array('type'=>'button',
	                     'name'=>'cancel',
	                     'class'=>'button',
	                     'value'=>$buttonCancel,
	                     'onclick'=>$callConfirm))?>
    </label></p>
<?=form_close()?>
<script language="JavaScript" type="text/javascript">
<!--
function confirmDecline() 
{
    if (confirm('<?=$this->lang->line('FAL_register_cancel_confirm')?>')) 
		location = '<?=site_url()?>';
} 
//-->
</script>
</fieldset>
</div><!--END REGISTER DIV-->