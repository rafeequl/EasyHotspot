<?=$this->lang->line('FAL_email_halo_message')?> <?=$user_name?>,

<?=$this->lang->line('FAL_forgotten_password_reset_email_body_message')?>


<?=$this->lang->line('FAL_forgotten_password_reset_email_user_label')?>: <?=$user_name?>

<?=$this->lang->line('FAL_forgotten_password_reset_email_password_label')?>: <?=$password?>


<?=$this->lang->line('FAL_forgotten_password_email_change_message')?>


{unwrap}<?=$change_password_link?>{/unwrap}


<?=$this->lang->line('FAL_citation_message')?>

--------------------------------------------------------
<?=$this->config->item('FAL_website_name');?> - <?=base_url();?>