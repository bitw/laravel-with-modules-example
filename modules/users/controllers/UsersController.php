<?php namespace App\Modules\Users\Controllers;

use Sentry, Redirect, View, Input;

class UsersController extends \BaseController {

	public function getSignin()
	{
		if (Sentry::check())
		{
			// Пользователь авторизован
			Redirect::to('/');
		}
		else
		{
			// Пользователь не авторизован

			if (!Input::has('email') || !Input::has('password'))
			{
				// Не переданы email и пароль

				return 'Не передан email и\\или пароль!';
			}

			try
			{
				// Пользовательские данные
				$credentials = array(
					'email'    => Input::get('email'),
					'password' => Input::get('password'),
				);

				// Попытка авторизации
				$user = Sentry::authenticate($credentials, false);
			}
			catch (Cartalyst\Sentry\Users\LoginRequiredException $e){
				echo 'Не указан логин или E-mail.';
			}
			catch (Cartalyst\Sentry\Users\PasswordRequiredException $e){
				echo 'Не указан пароль.';
			}
			catch (Cartalyst\Sentry\Users\WrongPasswordException $e){
				echo 'Не верный пароль, попробуйте еще раз.';
			}
			catch (Cartalyst\Sentry\Users\UserNotFoundException $e){
				echo 'Пользователь не найден.';
			}
			catch (Cartalyst\Sentry\Users\UserNotActivatedException $e){
				echo 'Пользователь не активирован.';
			}

			// The following is only required if throttle is enabled
			catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e){
				echo 'Учетная запись приостановлена.';
			}
			catch (Cartalyst\Sentry\Throttling\UserBannedException $e){
				echo 'Пользователь забанен.';
			}
		}
	}

	public function postSignin()
	{

	}

	public function getSignout()
	{

	}

}