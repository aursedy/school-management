<?php 

require_once('../classes/user.php');

/**
 * 
 */
class teacherSubjectsOptions extends User
{
	
	
	public function printOptions(){
        $select = $this->con->prepare("SELECT Id_predmet FROM Predmety WHERE Id_uzivatel= :Id_uzivatel");
        $select->bindParam(":Id_uzivatel",$this->id);
        $select->execute();

        while($result = $select->fetch()){
            $predmet = new Subject($result['Id_predmet']);
            echo'<option value="'.$predmet->getId().'">';
            echo $predmet->getNazev().'</option>';
        }
	}
}

?>