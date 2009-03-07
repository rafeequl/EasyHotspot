<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Language file needed by the FreakAuth library
 * @package     FreakAuth_light
 * @subpackage  Languages
 * @category    Authentication
 * @author      Daniel Vecchiato (danfreak)
 * @copyright   Copyright (c) 2007, 4webby.com
 * @license		http://www.gnu.org/licenses/lgpl.html
 * @link 		http://4webby.com/freakauth
 * @version 	1.1
 */

//------------------------------------------------------------------
//WEBSITE STUFF
//------------------------------------------------------------------
$lang['FAL_turned_off_message'] = 'Maaf, Website ini %s sedang dalam perwatan.';
$lang['FAL_welcome'] = 'Watchout it\'s hot';
$lang['FAL_email_halo_message'] = 'Halo';
$lang['FAL_user_name_label'] = 'ID Pengguna';
$lang['FAL_user_password_label'] = 'Sandi';
$lang['FAL_user_password_confirm_label'] = 'Ulangi password';
$lang['FAL_user_email_label'] = 'Email';
$lang['FAL_user_autologin_label'] = 'ingatkan saua';
$lang['FAL_user_country_label'] = 'Negara';

$lang['FAL_login_label'] = 'Login';
$lang['FAL_logout_label'] = 'Logout';

$lang['FAL_cancel_label'] = 'Batal';
$lang['FAL_agree_label'] = 'Saya Setuju';
$lang['FAL_continue_label'] = 'Lanjutkan';
$lang['FAL_donotagree_label'] = 'Saya tidak setuju';
$lang['FAL_forgotten_password_label'] = 'Lupa password';
$lang['FAL_register_label'] = 'Daftar';
$lang['FAL_registration_label'] = 'Pendaftaran';
$lang['FAL_change_password_label'] = 'Ubah Sandi';
$lang['FAL_activation_label'] = 'Aktivasi Pengguna';

$lang['FAL_citation_message'] = 'Terima Kasih!';
$lang['FAL_already_logged_in_msg'] = 'anda sudah login!';

$lang['FAL_unknown_user'] = 'pengguna tidak diketahui';

$lang['FAL_no_credentials_guest'] = 'Maaf, Anda tidak dapat mengakses informasi pada halaman ini, harap login dan mencoba kembali.';
$lang['FAL_no_credentials_user'] = 'Maaf, Anda tidak mempunyai hak akses untuk halaman ini.';

//------------------------------------------------------------------
//CAPTCHA
//------------------------------------------------------------------
$lang['FAL_captcha_label'] = 'Security Code';
$lang['FAL_captcha_message'] = 'Harap ketikan kode yang tertera pada gambar berikut :';

//------------------------------------------------------------------
//REGISTRATION
//------------------------------------------------------------------
$lang['FAL_register_cancel_confirm'] = 'Are you sure you want to decline the Terms of Service?\\n\\nClick Cancel to continue with registration.';

$lang['FAL_register_success_message'] = 'Thank You!<br />Your registration has been successfully completed.<br /><br />You have just been sent an email containing membership activation instructions.<br />';

$lang['FAL_invalid_register_message'] = 'Invalid registration attempt.';

$lang['FAL_terms_of_service_message'] =
'All messages posted at this site express the views of the author, and do not necessarily reflect the views of the owners and administrators of this site.

By registering at this site you agree not to post any messages that are obscene, vulgar, slanderous, hateful, threatening, or that violate any laws.   We will permanently ban all users who do so.

We reserve the right to remove, edit, or move any messages for any reason.
';

//------------------------------------------------------------------
//ACTIVATION
//------------------------------------------------------------------
$lang['FAL_activation_email_subject'] = 'Account activation info';
$lang['FAL_activation_email_body_message'] = 
'Thank you for your new member registration.

To activate your new account, please visit the following URL in the next 24 hours:';

$lang['FAL_activation_login_instruction'] ='After activating your accout you can login as:';
$lang['FAL_activation_keep_data'] ='Keep this e-mail for future reference!';

$lang['FAL_activation_failed_message'] = 'We are sorry, but your activation has failed.  Contact the site administrator for assistance.';
$lang['FAL_activation_success_message'] = 'Your activation has been successfully completed.  Feel free to login.';




//------------------------------------------------------------------
//VALIDATION ERROR MESSAGES
//------------------------------------------------------------------
$lang['FAL_invalid_user_message'] = 'Invalid user.';
$lang['FAL_invalid_username_password_message'] = 'Username atau password salah';
$lang['FAL_invalid_username_message'] = 'Username salah';
$lang['FAL_invalid_password_message'] = 'Password salah';
$lang['FAL_username_first_password_message'] = 'Harap masukan username anda terlebih dahulu kemudian password';
$lang['FAL_banned_user_message'] = 'Anda telah di ban!';
$lang['FAL_login_message'] = 'Anda berhasil masuk.';
$lang['FAL_logout_message'] = 'Anda telah berhasil keluar.';
$lang['FAL_length_validation_message'] = 'panjang karakter harus diantara %s dan %s.';
$lang['FAL_allowed_characters_validation_message'] = 'Hanya karakter alpa numerik, digit, underline atau dash yang dibolehkan.';
$lang['FAL_invalid_validation_message'] = '%s salah: ';
$lang['FAL_in_use_validation_message'] = '%s sudah terpakai.';
$lang['FAL_country_validation_message'] = 'Pilih negara tempat anda berada';
$lang['FAL_user_email_duplicate'] = 'Seseorang dengan e-mail ini sudah terdaftar. Jika anda lupa informasi detail mengenai akun anda, anda dapat mendapatkannya disini.';
$lang['FAL_usertemp_email_duplicate'] = 'Seseorang dengan e-mail ini sudah terdaftar dan sedang dalam proses aktifasi. Bila anda pemilik e-mail tersebut, harap memeriksa kotak masuk anda untuk melakukan aktifasi.';
 
//------------------------------------------------------------------
//CHANGE PASSWORD
//------------------------------------------------------------------
$lang['FAL_change_password_success'] = 'Sandi anda telah berhasil dirubah';
$lang['FAL_old_password_label'] = 'Sandi lama';
$lang['FAL_new_password_label'] = 'Sandi baru';
$lang['FAL_retype_new_password_label'] = 'Konfirmasi';
$lang['FAL_submit'] = 'submit';
$lang['FAL_reset'] = 'reset';
$lang['FAL_change_password_failed_message'] = 'Informasi salah';

//------------------------------------------------------------------
//FORGOTTEN PASSWORD
//------------------------------------------------------------------
//->email
$lang['FAL_forgotten_password_email_subject'] = 'Forgotten password reminder';
$lang['FAL_forgotten_password_email_reset_subject'] = 'New login information';
$lang['FAL_forgotten_password_email_header_message'] = 'To reset your password, please go to the following page:';
$lang['FAL_forgotten_password_email_body_message'] = 
'
You or somebody else requested a password remind about your account.

If You do not remember your password and want to change it, please click on the following link:';

$lang['FAL_forgotten_password_email_body_message2'] ='If You did not do any request please ignore this e-mail.';

$lang['FAL_forgotten_password_reset_email_body_message'] = 'Here is your new login information:';
$lang['FAL_forgotten_password_reset_email_user_label'] = 'Username';
$lang['FAL_forgotten_password_reset_email_password_label'] = 'Password';

$lang['FAL_forgotten_password_email_change_message'] = 'To change this ugly password, please go to the following page:';

//->messages
$lang['FAL_forgotten_password_success_message'] = 'Instructions for resetting your password have just been emailed to you. ';
$lang['FAL_forgotten_password_user_not_found_message'] = 'We are sorry, but no user was found with the email address you provided';
$lang['FAL_forgotten_password_reset_failed_message'] = 'We are sorry, but your forgotten password reset has failed.  Contact the site administrator for assistance.';
$lang['FAL_forgotten_password_reset_success_message'] = 'Your password has been reset and emailed to you.';

//------------------------------------------------------------------
//FLASH MESSAGES
//------------------------------------------------------------------
$lang['FAL_user_added'] = ' new user successfully added!';
$lang['FAL_user_edited'] = ' user edited successfully!';
$lang['FAL_user_deleted'] = ' user successfully deleted!';
$lang['FAL_no_permissions'] = 'You don\'t have the credentials to access this area';

//------------------------------------------------------------------
//OTHER MESSAGES
//------------------------------------------------------------------
$lang['FAL_no_DB_data'] = 'No data in DB: please add them!';
$lang['FAL_confirm_delete'] = 'Are you SURE you want to delete this record?';
?>
