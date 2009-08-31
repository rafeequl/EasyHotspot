<?=$this->lang->line('FAL_email_halo_message')?> <?=$user_name?>,

<?=$this->lang->line('FAL_forgotten_password_email_body_message')?>

{unwrap}<?=$activation_url?>{/unwrap}


<?=$this->lang->line('FAL_forgotten_password_email_body_message2')?>

--------------------------------------------------------
<?=$this->config->item('FAL_website_name');?> - <?=base_url();?>
