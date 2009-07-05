<?php
/**
 * it handles authorization aspect of user
 *
 */
class User
{
	
	/**
	 * user objects which has access to database
	 *
	 * @var DatabaseUser
	 */
	private $_user;
	
	public function login($login, $password)
	{
		$user = DatabaseUser::getUser($login);
		if (is_null($user)) {
			return false;
		}
		if (strcmp($this->_encryptPassword($password), $user->password) == 0) {
			$this->_user = $user;
			return true;
		}
		return false;
	}
	
	private function _encryptPassword($password)
	{
		echo '-p-' . $password . '-';
		return md5($password);
	}
	
	public function isLogged()
	{
		return !is_null($this->_user);
	}
	
	public function logout()
	{
		$this->_user = null;
	}
	
}