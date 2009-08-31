<fieldset><legend accesskey="D" tabindex="1"><?=$heading?></legend>
<?=isset($this->fal_validation->login_error_message) ? $this->fal_validation->login_error_message : ''?>
<?=form_open($this->uri->uri_string(), array('id' => 'login_form'))?>
<!--changed from <p> into <ul> style -->
<ul class="form">
<!--USERNAME-->
	<li><label for="user_name"><?=$this->lang->line('FAL_user_name_label')?>:</label>
	<?=form_input(array('name'=>'user_name', 
	                       'id'=>'user_name',
	                       'value'=>''))?>
    <?=(isset($this->fal_validation) ? $this->fal_validation->{'user_name'.'_error'} : '')?>
   </li>
    <!--PASSWORD-->
	<li><label for="password"><?=$this->lang->line('FAL_user_password_label')?>:</label>
	<?=form_password(array('name'=>'password', 
	                       'id'=>'password',
	                       'value'=>''))?>
    
    <?=(isset($this->fal_validation) ? $this->fal_validation->{'password'.'_error'} : '')?>
   </li>	
    <!--CAPTCHA (security image)-->
	<?php
	if ($this->config->item('FAL_use_captcha_login'))
	{?>
	<li><label for="security"><?=$this->lang->line('FAL_captcha_label')?>:</label>
	<?=form_input(array('name'=>'security', 
	                       'id'=>'security',
	                       'value'=>''))?>
    <?=(isset($this->fal_validation) ? $this->fal_validation->{'security'.'_error'} : '')?>
    </li>
    </li><label></label>
    <?=$this->load->view($this->config->item('FAL_captcha_img_tag_view'), null, true)?></li>
    <?php }?>
    <!-- END CAPTCHA (security image)-->
    
	<li class="submit"><label>
	<?=form_submit(array('name'=>'login', 
	                     'id'=>'login',
	                     'class'=>'login', 
	                     'value'=>$this->lang->line('FAL_login_label')))?>
	</label></li>
    <?php
    if ($this->config->item('FAL_allow_user_registration'))
	{?>
	<li><?=anchor($this->config->item('FAL_register_uri'), $this->lang->line('FAL_register_label'))?></li>
	<?php }?>
</ul>

<?=form_close()?>
</fieldset>