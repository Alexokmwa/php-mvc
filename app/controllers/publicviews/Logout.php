<?php 

namespace Controller;

defined('ROOTPATH') OR exit('Access Denied!');
use app\core\Controller;
use app\models\Session;

/**
 * logout class
 */
class Logout extends Controller
{
	

	public function index()
	{
		$ses = new Session;
 		$ses->logout();
 		redirect('login');
	}

}
