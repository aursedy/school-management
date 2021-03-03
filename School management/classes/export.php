<?php 
require_once("user.php");
class Export 
{

	function __construct()
	{
		
	}

	public function exportUsers(){
		$users = User::getAllUsers();
		$datas = [];
		foreach ($users as $user) {
			$data['Id_zivatel'] = $user['Id_uzivatel'];
			$data['Jmeno'] = $user['Jmeno'];
			$data['Prijmeni'] = $user['Prijmeni'];
			$data['Login'] = $user['Login'];
			$data['Heslo'] = $user['Heslo'];
			$data['Role'] = $user['Role'];
			array_push($datas, $data);
		}
		header('Content-Disposition: attachment; filename="users.json"');
		header('Content-type: text/javascript');
		$jsonDatas= json_encode($datas, JSON_PRETTY_PRINT);
		echo $jsonDatas;
	}
}
?>