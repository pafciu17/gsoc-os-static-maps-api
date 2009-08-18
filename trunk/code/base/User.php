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
	
	/**
	 * it recives login and password and try to login user, return true in case of success
	 *
	 * @param string $login
	 * @param string $password
	 * @return bool
	 */
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
		return md5($password);
	}
	
	/**
	 * checks if user user is logged
	 *
	 * @return unknown
	 */
	public function isLogged()
	{
		return !is_null($this->_user);
	}
	
	/**
	 * logout user
	 *
	 */
	public function logout()
	{
		$this->_user = null;
	}
	
	/**
	 * checks if given password is the same as user password
	 *
	 * @param string $pass
	 * @return bool
	 */
	public function checkPassword($pass)
	{
		return (strcmp($this->_encryptPassword($pass), $this->_user->password) == 0);
	}
	
	/**
	 * change password
	 *
	 * @param unknown_type $pass
	 */
	public function changePassword($pass)
	{
		$this->_user->password = $this->_encryptPassword($pass);
		$this->_user->save();
	}
}