<?php 
require_once("user.php");
class Import 
{

	function __construct()
	{
		
	}

	public function importUsers($file){
		$users = json_decode(file_get_contents($file['tmp_name']), true);

        foreach ($users as $user) {
            User::addUser($user['Jmeno'],$user['Prijmeni'],$user['Login'],$user['Heslo'],$user['Role']);
        }
        return '<div style="background-color: vert; text-align:center;padding: 20px;">Import probehlo v poradku</div>';		
	}
}
?>