<?php 
require_once("../user.php");

class UserSubjectsTable extends User
{

public drawTable(){
	echo '<table>';
	echo '<thead>
	          <tr>
	              <th>
	                  <td>Předmět</td>
	                  <td>koeficient</td>
                      <td>Třída</td>
	              </th>
	          </tr>
	      </thead>'
	foreach($subjects as $idSubject){
		$select = $this->con->select($idSubject['Id_predmet'],'Id_predmet','Predmety');
		$subject = $select->fecth();

		if($subject){
			echo '<tr><td>'.$subject['Nazev'].'</td><td>'.$subject['Koeficient'].'</td><td>'.$subject['Trida'].'</td></tr>';
		}

	}
	echo '</table>'
}

}
?>