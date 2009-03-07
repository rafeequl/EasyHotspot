<fieldset>
<legend><?=$heading?></legend>
<?=form_open($this->uri->uri_string(), array('id' => 'forgotten_password_form'))?>
	<p><label for="email"><?=$this->lang->line('FAL_user_email_label')?>:</label>
	<?=form_input(array('name'=>'email', 
	                       'id'=>'email',
	                       'maxlength'=>'100', 
	                       'size'=>'60',
	                       'value'=>(isset($this->fal_validation) ? $this->fal_validation->{'email'} : '')))?>
    <?=(isset($this->fal_validation) ? $this->fal_validation->{'email'.'_error'} : '')?></p>
    <!--CAPTCHA (security image)-->
	<?php
	if ($this->config->item('FAL_use_captcha_forgot_password'))
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
	<p><?=form_submit(array('name'=>'submit', 
	                     'value'=>$this->lang->line('FAL_submit')))?>
 </p>
<?=form_close()?>
</fieldset>