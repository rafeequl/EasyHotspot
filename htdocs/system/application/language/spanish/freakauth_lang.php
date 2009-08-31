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
$lang['FAL_turned_off_message'] = 'El sitio de web %s ahora mismo està de manutención';
$lang['FAL_welcome'] = 'Watchout it\'s hot';
$lang['FAL_email_halo_message'] = 'Querido';
$lang['FAL_user_name_label'] = 'Nombre internauta';
$lang['FAL_user_password_label'] = 'Contraseña';
$lang['FAL_user_password_confirm_label'] = 'Confirmar contraseña';
$lang['FAL_user_email_label'] = 'Correo electrónico';
$lang['FAL_user_autologin_label'] = 'recuerdame';
$lang['FAL_user_country_label'] = 'País';

$lang['FAL_login_label'] = 'Login';
$lang['FAL_logout_label'] = 'Logout';

$lang['FAL_cancel_label'] = 'Borrar';
$lang['FAL_agree_label'] = 'Acepto ';
$lang['FAL_continue_label'] = 'Proseguir';
$lang['FAL_donotagree_label'] = 'No acepto';
$lang['FAL_forgotten_password_label'] = '¿Has olvidado la contraseña?';
$lang['FAL_register_label'] = 'Registrate';
$lang['FAL_registration_label'] = 'Para registrarse';
$lang['FAL_change_password_label'] = 'Sustituir la contraseña';
$lang['FAL_activation_label'] = 'Activación internauta';

$lang['FAL_citation_message'] = 'Gracias!';
$lang['FAL_already_logged_in_msg'] = 'ya has realizado el acceso!';

$lang['FAL_unknown_user'] = 'Internauta desconocido';

$lang['FAL_no_credentials_guest'] = 'No tienes las credenciales para acceder en este sector reservado, se roga de intentar de nuevo el acceso.';
$lang['FAL_no_credentials_user'] = 'No tienes las credenciales para acceder en este sector reservado.';

//------------------------------------------------------------------
//CAPTCHA
//------------------------------------------------------------------
$lang['FAL_captcha_label'] = 'Código de seguridad';
$lang['FAL_captcha_message'] = 'Por favor introduces el código que ves en la imagen de abajo';

//------------------------------------------------------------------
//REGISTRATION
//------------------------------------------------------------------
$lang['FAL_register_cancel_confirm'] = '¿Estás seguro que no quieres aceptar los términos del servicio?\\n\\n Anular para proseguir con la anotación.';

$lang['FAL_register_success_message'] = '¡Gracias!<br /> Tu anotación se ha terminado con éxito.<br /><br /> Te ha sido enviado un correo electrónico con las instrucciones de activación.<br />';

$lang['FAL_invalid_register_message'] = 'Tentativa de anotación no válida.';

$lang['FAL_terms_of_service_message'] =
'Todos los mensajes enviados a este sitio  expresan las consideraciones del autor, y no expresan indispensablemente las consideraciones de los propietarios  y gestores de este sitio.

Con la anotación a este sitio el internauta acepta de no publicar/divulgar mensajes que sean obscenos, groseros, de lindezas, de aversión, amenazadores o que violen las leyes en vigencia. Excluiremos de modo definitivo todos los internautas que hacen esto.

Nos reservamos el derecho de destituir, modificar o desplazar cualquier mensaje por cualquier motivo.
';

//------------------------------------------------------------------
//ACTIVATION
//------------------------------------------------------------------
$lang['FAL_activation_email_subject'] = 'Informaciones activación account';
$lang['FAL_activation_email_body_message'] = 
'Gracias por la anotación como nuevo miembro.

Para activar tu nuevo account, por favor visitas el siguiente URL en las próximas 24 horas:';

$lang['FAL_activation_login_instruction'] ='Después de la activación de tu account será posible acceder como:';
$lang['FAL_activation_keep_data'] ='Tienes presente este correo elecrónico por una futura referencia !';

$lang['FAL_activation_failed_message'] = 'Lo sentimos, pero tu activación no ha tenido éxito. Contactas el gestor del sitio para asistencia.';
$lang['FAL_activation_success_message'] = 'Tu activación ha tenido éxito. Eres libre de efectuar el acceso.';




//------------------------------------------------------------------
//VALIDATION ERROR MESSAGES
//------------------------------------------------------------------
$lang['FAL_invalid_user_message'] = 'Internauta no válido.';
$lang['FAL_invalid_username_password_message'] = 'nombre internauta o contraseña inválidos';
$lang['FAL_invalid_username_message'] = 'nombre internauta inválido';
$lang['FAL_invalid_password_message'] = 'Contraseña inválida';
$lang['FAL_username_first_password_message'] = 'Por favor introduces primero tu nombre internauta y después tu contraseña';
$lang['FAL_banned_user_message'] = 'Ha tenido éxito el acceso!';
$lang['FAL_login_message'] = 'Ha tenido éxito el acceso.';
$lang['FAL_logout_message'] = 'Ha tenido éxito la desconexión.';
$lang['FAL_length_validation_message'] = 'Tiene que ser incluido entre %s y %s caracteres por largo.';
$lang['FAL_allowed_characters_validation_message'] = 'Son permitidos solo caracteres alfanuméricos, cifras o rayas.';
$lang['FAL_invalid_validation_message'] = 'El %s no está válido: ';
$lang['FAL_in_use_validation_message'] = 'El %s ya está en uso.';
$lang['FAL_country_validation_message'] = 'Please choose the country where you live';
$lang['FAL_user_email_duplicate'] = 'Un internauta con este correo electrónico ya está registrado. Si has olvidado tus datos para acceder, puedes encontrar detalles aquí.';
$lang['FAL_usertemp_email_duplicate'] = 'Un internauta con este correo electrónico ya està registrado y está esperando para ser activado. Si éste es tu correo electrónico por favor verificas tu apartado de correos en entrada y activas tu account.';
 
//------------------------------------------------------------------
//CHANGE PASSWORD
//------------------------------------------------------------------
$lang['FAL_change_password_success'] = 'Tu contraseña ha sido sustituida con éxito';
$lang['FAL_old_password_label'] = 'Vieja contraseña';
$lang['FAL_new_password_label'] = 'Nueva contraseña';
$lang['FAL_retype_new_password_label'] = 'Confirma ';
$lang['FAL_submit'] = 'Envia ';
$lang['FAL_reset'] = 'Reposición';
$lang['FAL_change_password_failed_message'] = 'Informaciones no válidas';

//------------------------------------------------------------------
//FORGOTTEN PASSWORD
//------------------------------------------------------------------
//->email
$lang['FAL_forgotten_password_email_subject'] = 'Has olvidado la contraseña';
$lang['FAL_forgotten_password_email_reset_subject'] = 'Nuevos datos para acceder';
$lang['FAL_forgotten_password_email_header_message'] = 'Para replantear la contraseña, te invitamos a visitar la página:';
$lang['FAL_forgotten_password_email_body_message'] = 
'
Tu o alguien más ha vuelto a pedir de enviar otra vez la contraseña por este acconut.

Si has olvidado la contraseña y quieres sustituirla, por favor haces CLIC sobre el link:';

$lang['FAL_forgotten_password_email_body_message2'] ='If You did not do any request please ignore this e-mail.';

$lang['FAL_forgotten_password_reset_email_body_message'] = 'Aquí están tus nuevas informaciones para acceder:';
$lang['FAL_forgotten_password_reset_email_user_label'] = 'Nombre internauta';
$lang['FAL_forgotten_password_reset_email_password_label'] = 'Contraseña';

$lang['FAL_forgotten_password_email_change_message'] = 'Para sustituir esta contraseña, por favor vas a la página siguiente:';

//->messages
$lang['FAL_forgotten_password_success_message'] = 'Las instrucciones para borrar tu contraseña  han sido enviadas ahora por correo electrónico. ';
$lang['FAL_forgotten_password_user_not_found_message'] = 'Lo sentimos, pero no hemos encontrado internautas con la dirección electrónica exhibida';
$lang['FAL_forgotten_password_reset_failed_message'] = 'Lo sentimos, pero la reposición de la contraseña olvidada no ha tenido éxito. Contactas el gestor del sitio para asistencia.';
$lang['FAL_forgotten_password_reset_success_message'] = 'La contraseña ha sido replanteada y enviada por correo electrónico.';

//------------------------------------------------------------------
//FLASH MESSAGES
//------------------------------------------------------------------
$lang['FAL_user_added'] = ' Nuevo internauta añadido con éxito!';
$lang['FAL_user_edited'] = ' Internauta modificado con éxito!';
$lang['FAL_user_deleted'] = ' Internauta borrado con éxito!';
$lang['FAL_no_permissions'] = 'No tienes las credenciales para acceder en este sector';

//------------------------------------------------------------------
//OTHER MESSAGES
//------------------------------------------------------------------
$lang['FAL_no_DB_data'] = 'Ningún dato en el DB ¡se ruega de añadirlos!';
$lang['FAL_confirm_delete'] = '¿Estás SEGURO que quier borrar el récord?';
?>