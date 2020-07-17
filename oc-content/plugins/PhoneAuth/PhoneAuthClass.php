<?php

/*
Plugin Name: PhoneAuth
Plugin URI: https://www.agros.ru/
Description: PhoneAuth A PHP Library for authentication through phone
Version: mod 0.1 
Author: 
Plugin update URI: phoneauth
*/
class PhoneAuthClass extends DAO{
	

	public $hybridauth = null;
    public $adapter = null;
	public $provider = null;
    private static $instance ;
	
    public static function newInstance() {
        if( !self::$instance instanceof self ) {
            self::$instance = new self ;
        }
        return self::$instance ;
    }
    private function init(){
	  
    }




	public function loginwith($provider){
		try{
			if($provider == 'Phone'){

				$idToken = '{"idToken":"'.$_POST['idToken'].'"}';
				$data_string = $idToken;
				//
				$curl = curl_init('https://www.googleapis.com/identitytoolkit/v3/relyingparty/getAccountInfo?key='.$_POST['key']);
				//print_r($data_string);
				curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
				// Принимаем в виде массива. (false - в виде объекта)
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($curl, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json',
				'Content-Length: ' . strlen($data_string))
				);
				$result = curl_exec($curl);
				curl_close($curl);
				$guser = json_decode ($result, JSON_UNESCAPED_UNICODE);
				//print_r($guser->users[0]);
				 
				if(isset($guser['users'][0]['phoneNumber'])){
					$mobile = $guser['users'][0]['phoneNumber'];
					$user_profile = '';
				$manager = User::newInstance();

				$manager->dao->select();
				$manager->dao->from($manager->getTableName());
				$manager->dao->where('s_phone_mobile', $mobile);
				$result = $manager->dao->get();
	
				if($result->numRows() == 1){
					//потом разобраться с функциями, и перенести куда следует
					//=======================================================
					$user = $result->row();
					$manager->dao->select();
					$manager->dao->from(DB_TABLE_PREFIX.'t_user_description');
					$manager->dao->where('fk_i_user_id', $user['pk_i_id']);
           
					$result = $manager->dao->get();
					$descriptions = $result->result();

					$user['locale'] = array();
					foreach($descriptions as $sub_row) {
						$user['locale'][$sub_row['fk_c_locale_code']] = $sub_row;
					}
					$oscUser = $user;

//=======================================================

					//$oscUser = $manager->extendData($result->row(), NULL);
					$manager->update( array('b_active' => '1'),array('pk_i_id' => $oscUser['pk_i_id']) ) ;
					osc_add_flash_ok_message( __( "Вы успешно авторизовались!", 'PhoneAuth' ) ) ;
					require_once osc_lib_path() . 'osclass/UserActions.php';
					$uActions = new UserActions( false );
					$logged = $uActions->bootstrap_login( $oscUser['pk_i_id'] );
					} 
				//иначе если не нашли ни одной записи в бд
				else  {
					$input['s_name']      = 'Дорогой Гость';
					$input['s_username'] = $mobile;
					$input['s_email']     = $mobile.'@mail.mail';
					$input['s_password']  = sha1( osc_genRandomPassword() ) ;
					$input['dt_reg_date'] = date( 'Y-m-d H:i:s' ) ;
					$input['s_secret']    = osc_genRandomPassword();
					$input['s_phone_mobile']    = $mobile;
					
					$manager->insert( $input ) ;
					$userID = $manager->dao->insertedId() ;

					osc_run_hook( 'user_register_completed', $userID ) ;
					$userDB = $manager->findByPrimaryKey( $userID ) ;
					if( osc_notify_new_user() ) {
						osc_run_hook( 'hook_email_admin_new_user', $userDB ) ;
					}
					$manager->update( array('b_active' => '1'),array('pk_i_id' => $userID) ) ;
					osc_run_hook('hook_email_user_registration', $userDB) ;
					osc_run_hook('validate_user', $userDB) ;
					osc_add_flash_ok_message( sprintf( __('Поздравляем! Ваш профиль создан. Не забудьте уточнить Ваши имя, фамилия и другие данные', 'PhoneAuth' ), osc_page_title() ) ) ;
					require_once osc_lib_path() . 'osclass/UserActions.php';
					$uActions = new UserActions( false );
					$logged = $uActions->bootstrap_login($userID);
					}
					exit('{"redirect":"/"}');
				}

				else {exit('{"status":"errore"}');}
			}
		}
		catch( Exception $e ){
			switch( $e->getCode() ){
				case 0 : 
					osc_add_flash_error_message( __( "Неизвестная ошибка.", 'PhoneAuth' ) ) ;
					break;
				case 1 :
					osc_add_flash_error_message( __( "PhoneAuth ошибка конфигурации.", 'PhoneAuth' ) ) ;
					break;
				case 2 :
					osc_add_flash_error_message( __( "Провайдер не правильно настроен.", 'PhoneAuth' ) ) ;
					break;
				case 3 :
					osc_add_flash_error_message( __( "Неизвестный или отключен провайдером.", 'PhoneAuth' ) ) ;
					break;
				case 4 :
					osc_add_flash_error_message( __( "Отсутствует учетные данные приложения провайдера.", 'PhoneAuth' ) ) ;
					break;
				case 5 : 
					osc_add_flash_error_message( __( "Ошибка аутентификации. Пользователь отменил проверку подлинности или поставщик отклонил соединение.", 'PhoneAuth' ) ) ;
					break;
				case 6 : 
					osc_add_flash_error_message( __( "Запрос Профиля пользователя не удался. Скорее всего, пользователь не подключен к провайдеру и он должен аутентифицироваться снова.", 'PhoneAuth' ) ) ;
				//	$twitter->logout();
					break;
				case 7 : 
					osc_add_flash_error_message( __( "Пользователь не подключен к провайдеру.", 'PhoneAuth' ) ) ;
				//	$twitter->logout();
					break;
				case 8 : 
					osc_add_flash_error_message( __( "Провайдер не поддерживает эту функцию.", 'PhoneAuth' ) ) ;
					break;
			}
		}
		
	 $this->redirect_url();
	    
}

	private function redirect_url(){
		if(osc_get_bool_preference('PhoneAuthRedirect', 'PhoneAuth') == 1) {
			osc_redirect_to(osc_user_dashboard_url());
		}
		else {
			osc_redirect_to(osc_base_url());
		}
	}
	
}
?>