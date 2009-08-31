<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CONFIGURATION ARRAY FOR THE FreakAuth_light library
 *
 * @package     FreakAuth_light
 * @subpackage  Config
 * @category    Authentication
 * @author      Daniel Vecchiato (danfreak) & Christophe Gragnic (grahack)
 * @copyright   Copyright (c) 2007, 4webby.com
 * @license     http://www.gnu.org/licenses/lgpl.html
 * @link        http://4webby.com/freakauth
 * @version     1.1
 */

/*---------------------+
|  MAIN CONFIGURATION  |
+---------------------*/
 
 /*
 |--------------------------------------------------------------------------
 | Name of the website
 |--------------------------------------------------------------------------
 |
 | It will be displayed in some headers and in the subject of the emails
 |
 */
 $config['FAL_website_name']    = "Easyhotspot";
 
 /*
 |--------------------------------------------------------------------------
 | email address of the administrator
 |--------------------------------------------------------------------------
 |
 | It will be displayed in some headers and in the subject of the emails
 |
 */
 $config['FAL_user_support'] = 'rafeequl@gmail.com';
 
 /*
 |--------------------------------------------------------------------------
 | Enable/Disable FreakAuth light system
 |--------------------------------------------------------------------------
 |
 | the "turned off" template will be displayed if FALSE
 |
 */
 $config['FAL'] = TRUE;
 
 /*
 |--------------------------------------------------------------------------
 | Enable/Disable FreakAuth light extensions
 |--------------------------------------------------------------------------
 |
 | If you need to extend the Core class (libraries/FreakAuth_light.php) or 
 | the FAL_validation.php class build your files according to the following
 | specifications about file-names. You can place them either in 
 | system/libraries or in application/libraries
 |
 | - libraries/MyFAL.php
 | - libraries/MyFALVal.php
 | 
 | Alternatively you can simply rename the built in demo files from 
 | - libraries/MyFAL_demo.php to libraries/MyFAL.php
 | - libraries/MyFALVal_demo.php to libraries/MyFALVal.php
 |
 |Following this convention, if $config['FAL_use_extensions'] = TRUE;
 | the above files will be loaded in FAL_front.php, and also the
 | freakauth_light_helper.php functions will be updated.
 | -----------------
 | MyFAL.php EXAMPLE
 | -----------------
 |<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 |
 |   class MyFAL extends Freakauth_light 
 |   {
 |       // -------------------------------------------------------------------- 
 |       // Class constructor
 |       // not really needed but I wrote it anyway
 |       function MyFAL()
 |       {
 |       	parent::Freakauth_light();
 |       }
 |       
 |       // -------------------------------------------------------------------- 
 |       // Overwrites normal FAL logout
 |       function logout()
 |       {
 |           log_message('debug', 'MyFAL logout working');
 |          
 |           exit('MyFAL logout working');
 |       }
 |     }
 |
 */
 $config['FAL_use_extensions'] = FALSE;
 
 /*
 |------------------------------------------------------------------------------
 | The table prefix for the database tables needed by FreakAuth_light
 |------------------------------------------------------------------------------
 |
 |           !!!!!!!!  WARNING  !!!!!!!
 |
 |   NB: the table name for the db_session library is set in config.php
 |       and won't be affected by this 'FAL_table_prefix' configuration
 |
 */
 $config['FAL_table_prefix'] = 'fa_';


/*---------------+
|  DENY PROCESS  |
+---------------*/

 /*
 |--------------------------------------------------------------------------
 | Enable/Disable the Flash Message notice system FOR THE DENY SYSTEM ONLY
 |--------------------------------------------------------------------------
 |
 | when a visitor is not allowed to see a particular page, his (her) access
 | is "denied"
 |
 | if TRUE, FAL uses a FLASH message and a "redirect back" to deny the visitor
 | if FALSE, FAL only loads the page you defined in $config['FAL_denied_page']
 |
 */
 $config['FAL_deny_with_flash_message'] = TRUE;
 
 /*
 |------------------------------------------------------------------------------
 | Page where the valid users are taken when access is denied & no local referer
 |------------------------------------------------------------------------------
 |
 | if the denied user comes from another website and is NOT a guest,
 | this is the CI location to take him
 | Guests are taken to the login page (see the FAL_login_uri key).
 |
 */
 $config['FAL_denied_from_ext_location'] = '';
                             
 /*
 |------------------------------------------------------------------------------
 | Page loaded if 'FAL_deny_with_flash_message' set to FALSE
 |------------------------------------------------------------------------------
 |
 | if we don't want to use a flash message,
 | this is the page/view we want to load to display the deny message.
 |
 */
 $config['FAL_denied_page'] = 'FreakAuth_light/template/denied';
 

/*----------------+
|  USER HANDLING  |
+----------------*/

 /*
 |------------------------------------------------------------------------------
 | Whether users are allowed to register by themselves
 |------------------------------------------------------------------------------
 */
 $config['FAL_allow_user_registration'] = FALSE;
 
 /*
 |------------------------------------------------------------------------------
 | Whether the registration/activation process requires e-mail verification
 | 
 | If set to FALSE, the registration process is as follows:
 | 1) the user registers to the website (data stored in user_temp table)
 | 2) the user gets a registration e-mail with an activation link
 | 3) if the user clicks the activation link (data moved to user table)
 |    he get finally registered and can login with his credentials
 |
 | If set to TRUE, the registration process is as follows:
 | 1) the user registers to the website (data stored in user table)
 | 2) the user can immediately login
 | 3) no e-mail is sent to the user to remember him his credentials
 |    i.e. username and password
 |
 |------------------------------------------------------------------------------
 */
 $config['FAL_register_direct'] = FALSE;
 
 
 /*
 |------------------------------------------------------------------------------
 | Usernames and passwords config
 |------------------------------------------------------------------------------
 */
 $config['FAL_user_name_min'] = 4;       //min username length
 $config['FAL_user_name_max'] = 16;      //max username length
 $config['FAL_user_password_min'] = 6;   //min password length
 $config['FAL_user_password_max'] = 16;  //max password length

 /*
 |------------------------------------------------------------------------------
 | Whether to use country listing for registration
 |------------------------------------------------------------------------------
 */
 $config['FAL_use_country'] = FALSE;
 
 /*
 |------------------------------------------------------------------------------
 | Whether to use custom user profile or not
 |------------------------------------------------------------------------------
 */
 $config['FAL_create_user_profile'] = TRUE;
 
 /*
 |------------------------------------------------------------------------------
 | Whether to use CAPTCHA (security code) functionality for those processes
 |------------------------------------------------------------------------------
 */
 $config['FAL_use_captcha_login'] = FALSE;
 $config['FAL_use_captcha_register'] = FALSE;
 $config['FAL_use_captcha_forgot_password'] = FALSE;
 
 /*
 |------------------------------------------------------------------------------
 | The time that a new registered user has for activation (default 1 day)
 |------------------------------------------------------------------------------
 |
 | If you change this setting, remember to change email templates as well.
 |
 */
 $config['FAL_temporary_users_expiration'] = 3600*24;
 

/*-------------------------------------+
|  CUSTOM CONTROLLERS NAMING SETTINGS  |
+-------------------------------------*/

 /*
 | You can name the controllers and relative actions as you like.
 | Namely you can place the login, logout, register, changepassword... actions
 | in a single controller (like we did in the demo application),
 | or in several controllers at your choice.
 | If you want to use this freedom you must set/change the following parameters.
 | For each of the following settings you must provide the controller_name/method_name
 | (or simply the controller_name if you just have a index() method in it.
 | --------
 | NOTE!
 | --------
 | For 
 | - $config['FAL_activation_uri']
 | - $config['FAL_forgottenPasswordReset_uri']
 | it is compulsory to specify both the controller/method even if the
 | method is index()
 */
 $config['FAL_login_uri'] = 'auth/login';
 $config['FAL_logout_uri'] = 'auth/logout';
 $config['FAL_register_uri'] = 'auth/register';
 $config['FAL_activation_uri'] = 'auth/activation';  //read the above note
 $config['FAL_changePassword_uri'] = 'auth/changepassword';
 $config['FAL_forgottenPassword_uri'] = 'auth/forgotten_password';
 $config['FAL_forgottenPasswordReset_uri'] = 'auth/forgotten_password_reset'; //read the above note
 
/*------------------+
|  TEMPLATE SETTINGS|
+------------------*/

 /*
 |------------------------------------------------------
 |  Directory for FreakAuth_light views assets
 |------------------------------------------------------
 |
 | Where we place our css, images, javascript files
 | This is handy if you use other templating systems
 */
 $config['FAL_assets'] = 'public'; //main assets folder
 $config['FAL_css'] = 'css';
 $config['FAL_images'] = 'images';
 $config['FAL_js'] = 'js';
 $config['FAL_assets_shared'] = $config['FAL_assets'].'/shared'; //shared assets
 $config['FAL_assets_front'] = $config['FAL_assets'].'/frontend'; //admin frontend
 $config['FAL_assets_admin'] = $config['FAL_assets'].'/admin'; //admin backend
 

/*-------------------+
|  CAPTCHA SETTINGS  |
+-------------------*/

/*
|-------------------------------------------------------------------------------
| Should the visitor input check be case sensitive or not
|-------------------------------------------------------------------------------
*/
$config['FAL_captcha_case_sensitive'] = TRUE;

/*
|-------------------------------------------------------------------------------
| What to use in the CAPTCHA string
|-------------------------------------------------------------------------------
*/
// upper and lower case (lower case by default)
$config['FAL_captcha_upper_lower_case'] = FALSE;
$config['FAL_captcha_use_numbers'] = FALSE;

// use special characters (if true, use a font that support it)
$config['FAL_captcha_use_specials'] = FALSE;

$config['FAL_captcha_min'] = 5;      //min captcha length
$config['FAL_captcha_max'] = 5;      //max captcha length

/*
|-------------------------------------------------------------------------------
| How to display the CAPTCHA string
|-------------------------------------------------------------------------------
*/
$config['FAL_captcha_image_font_size'] = 20;
$config['FAL_captcha_image_font_color'] = '33CC33';

/*
|-------------------------------------------------------------------------------
| What to use for generation of the CAPTCHA
|-------------------------------------------------------------------------------
*/
$config['FAL_captcha_image_library'] = 'GD';

// Folder of the Base image needed to generate Captcha
$config['FAL_captcha_base_image_path'] = $config['FAL_assets'].'/'.$config['FAL_images'].'/captcha/';

// Base image name for captcha
$config['FAL_captcha_image_base_image'] = 'base_image.jpg';

// captcha font location
$config['FAL_captcha_image_font'] = BASEPATH.'fonts/Jester.ttf';

// Folder to save the captcha background image (relative BASEPATH)
// this folder must be writable by php
$config['FAL_captcha_image_path'] = 'tmp/';

//name of the generate image (leave it blank!!!!!!)
$config['FAL_captcha_image'] = '';

/*
|------------------------------------------------------
|  COOKIE (AUTOLOGIN) SETTINGS (not implemented yet...)
|------------------------------------------------------
|
| Time (in seconds) that the autologin cookie remains valid.
|
| !NOTE: not used so far. It's here for future REMEMBER ME 
|        implementation
|
*/
$config['FAL_auto_login_period'] = 60*60*24*30;


/*-------------------+
|  VALIDATION RULES  |
+-------------------*/

 // GENERAL RULES
  $config['FAL_country_validation'] = 'trim|required|numeric|xss_clean|country_check';

 // PASSWORD
  $config['FAL_password_required_validation'] = 'trim|required|xss_clean|password_check';
  $config['FAL_password_required_confirm_validation'] = 'trim|required|xss_clean|matches[password]';

 // USERNAME
  //username validation (required): checks if min-max characters settings are respected
  //and if username is not already present in DB
  $config['FAL_user_name_duplicate_validation'] = 'trim|required|xss_clean|username_check|username_duplicate_check';

 // LOGIN
  $config['FAL_user_name_field_validation_login'] = 'trim|required|xss_clean';
  $config['FAL_user_password_field_validation_login'] = 'trim|required|xss_clean';

 // REGISTRATION
  $config['FAL_user_name_field_validation_register'] = $config['FAL_user_name_duplicate_validation'];
  $config['FAL_user_password_field_validation_register'] = $config['FAL_password_required_validation'];
  $config['FAL_user_email_field_validation_register'] = 'trim|required|valid_email|xss_clean|email_duplicate_check';
  $config['FAL_user_country_field_validation_register'] = $config['FAL_country_validation'];

 // SECURITY CODE
  $config['FAL_user_captcha_field_validation'] = 'trim|required|xss_clean|securitycode_check';

 // FORGOTTEN PASSWORD
  $config['FAL_user_email_field_validation_forgotten'] = 'trim|required|valid_email|xss_clean|email_exists_check';

/*----------------+
|  VIEW SETTINGS  |
+----------------*/
 
 /*
 |------------------------------------------------------
 |  Directory of your FreakAuth_light templates
 |------------------------------------------------------
 |
 | Relative to the application/view folder.
 | Please add a trailing slash.
 |
 */
 $config['FAL_template_dir'] = 'FreakAuth_light/';

 // LOGIN
  // The view to display the login form
  $config['FAL_login_view'] = $config['FAL_template_dir'].'content/forms/login';

 // REGISTRATION
  // view to display the user registration form
  $config['FAL_register_view'] = $config['FAL_template_dir'].'content/forms/register';
  
  // view to display the successful registration information
  $config['FAL_register_success_view'] = $config['FAL_template_dir'].'content/register_success';
  
  // view to display the successful activation information
  $config['FAL_register_activation_success_view'] = $config['FAL_template_dir'].'content/activation_success';
  
  // view to display the failed activation information
  $config['FAL_register_activation_failed_view'] = $config['FAL_template_dir'].'content/activation_failed';

 // FORGOTTEN PASSWORD
  // view to display the forgotten password form
  $config['FAL_forgotten_password_view'] = $config['FAL_template_dir'].'content/forms/forgotten_password';
  
  // view to display the successful forgotten password request
  $config['FAL_forgotten_password_success_view'] = $config['FAL_template_dir'].'content/forgotten_password_success';
  
  // view to display the successful forgotten password reset
  $config['FAL_forgotten_password_reset_success_view'] = $config['FAL_template_dir'].'content/forgotten_password_reset_success';
  
  // view to display the failed forgotten password reset
  $config['FAL_forgotten_password_reset_failed_view'] = $config['FAL_template_dir'].'content/forgotten_password_reset_failed';

 // CHANGE PASSWORD
  // view to display the forgotten password form
  $config['FAL_change_password_view'] = $config['FAL_template_dir'].'content/forms/change_password';
  
 // CAPTCHA VIEW
  $config['FAL_captcha_img_tag_view'] = $config['FAL_template_dir'].'content/forms/html_for_captcha';
  
 // ERROR DELIMITERS
  //Opening tag for the validation error messages
  $config['FAL_error_delimiter_open'] = '<div class="error">';
  
  //closing tag for the validation error messages
  $config['FAL_error_delimiter_close'] = '</div>';


/*--------------------------+
|  E-MAIL CONTENT SETTINGS  |
+--------------------------*/

 $config['FAL_email_from'] = 'webmaster';
 
 // The location of the activation email
 $config['FAL_activation_email'] = $config['FAL_template_dir'].'email/activation_email';
 
 // The location of the forgotten password email
 $config['FAL_forgotten_password_email'] = $config['FAL_template_dir'].'email/forgotten_password_email';
 
 // The location of the forgotten password reset email
 $config['FAL_forgotten_password_reset_email'] = $config['FAL_template_dir'].'email/forgotten_password_reset_email';
 
 // View to send by email for the change password informations
 $config['FAL_change_password_email'] = $config['FAL_template_dir'].'email/change_password_email';


/*-------------------+
|  ACTIONS SETTINGS  |
+-------------------*/

 // The action to execute after successful login
 $config['FAL_login_success_action'] = 'home';
 
 // The action to execute after successful logout
 $config['FAL_logout_success_action'] = 'auth/login';
 
 // The action to execute after REGISTRATION ('continue' link)
 $config['FAL_register_continue_action'] = '';
 
 // The action to execute after ACTIVATION, ('continue' link)
  // wether it failed or it was successful
 $config['FAL_activation_continue_action'] = 'auth';
 
 // The action to execute after requesting FORGOTTEN PASSWORD
 $config['FAL_forgotten_password_continue_action'] = '';
 
/*-----------------+
|  ADMIN SETTINGS  |
+-----------------*/

// The action to execute after successful ADMIN login
$config['FAL_admin_login_success_action'] = 'admin';

// The action to execute after successful ADMIN logout
$config['FAL_admin_logout_success_action'] = '';

// The number or recors per page for the admin user listing (pagination)
$config['FAL_admin_console_records_per_page'] = 5;



/*
|-------------------------------------------------------------------------------
| ACL ROLES SETTINGS (don't change them)
|-------------------------------------------------------------------------------
| 
| FreakAuth_light  roles work by inheritance.
| This means that the lower the value of the role, the higher it is in the
| hierarchy:
| i.e superadmin (value 1) has more rights than admin (value 2)
| i.e editor (value 3) has more rights than user (value 100)
| 
| you can also set usergroups with the same hierarchy
| i.e. 
| 'editor' => 4,
| 'gallery_manager' => 4
|  !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
|  WARNING do not set custom groups with value 1 or 2
|  !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
*/
$config['FAL_roles'] =
    array(
        //don't change the two following lines//
         'superadmin' => 1,
         'admin' => 2,
         //end don't change
         
         //add your custom roles here
         //'editor' => 3,
         //'gallery_manager' => 4
         //--------------------------
         
         //don't change the following line
         'user' => 100,
    );

/*
|-------------------------------------------------------------------------------
| CUSTOM USER FIELDS SETTINGS (fa_user_profile table)
|-------------------------------------------------------------------------------
|
|
| You can set how many custom validation fields as you want.
| In the DB table they can be of any type (varchar, text, int etc.).
| WARNING-> The system will automatically bring the fields from DB.
|           If you set less rules/fields here in config, the system will use
|           the table field name as field for the missing ones,
|           and won't set any rule for them.
| You can call your fields in DB as you like.
| The array keys in this config refer to the name of the fields in DB tables.
| The array value will be displayed.
|
*/
$config['FAL_user_profile_fields_names'] =
    array('field_1' => 'Name',
          'field_2' => 'Surname',
          'call_me_nicely' => 'Employee ID',
         //'4'=>'whatyouwant',
         //'5'=>'whatyouwant',
    );

/*
|-------------------------------------------------------------------------------
| RULES FOR YOUR CUSTOM USER_PROFILE FIELDS
|-------------------------------------------------------------------------------
|
| if you need callback validation functions,
| remember to include them in your controllers
|
*/
$config['FAL_user_profile_fields_validation_rules'] =
    array('field_1' => 'trim|required',
          'field_2' => 'trim|required|max_length[50]',
          'call_me_nicely' => 'trim|required|max_length[3]',
          //'field_4' => 'whatyouwant',
          //'field_5' => 'whatyouwant',
    );
?>
