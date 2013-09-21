<?php
require_once('Connect.php');

// the site hosting the database
define('DB_HOST', 'localhost'); // 'cis1110.db.2177912.hostedresource.com');
//the user name to access the database
define('DB_USER', 'cis1110');
//the password to access the database
define('DB_PASS', "Eagles#1");
//the name of the database table you are to use for this session
define('DB_NAME', 'cis1110');

$GLOBALS["dbhost"] = "localhost"; // "cis1110.db.2177912.hostedresource.com";
$GLOBALS["$dbuser"] = "cis1110";
$GLOBALS["$dbpassword"] = "Eagles#1";
$GLOBALS["$dbdatabase"] = "cis1110";
require_once('Connect.php');
$doctorId = filter_input(INPUT_POST, "doctorId");
$p_id = filter_input(INPUT_POST, "p_id");
$id = filter_input(INPUT_POST, "id");


$p_id = mysql_real_escape_string($p_id);
$id = mysql_real_escape_string($id);
$doctorId = mysql_real_escape_string($doctorId);

/*
 $doctorId = filter_input(INPUT_POST, "doctorId");
 $p_id = filter_input(INPUT_POST, "p_id");
 $id = filter_input(INPUT_POST, "id");

 $p_id = mysql_real_escape_string($p_id);
 $id = mysql_real_escape_string($id);
 $doctorId = mysql_real_escape_string($doctorId);
 */

class PatientsClass {

	// returns an array of associative arrays representing each patient record
	//send back to controller
	
	public static function ListAll() {
		$dataLink = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		
		if ($dataLink->connect_error){
			die ("Connect failed: " . $dataLink->connect_error);
		}
		
		$data = array();

		$dataLink -> real_query("SELECT * FROM d_riddlespur_patient_table") or die("Query failed: " . $dataLink -> error);
		if ($dataLink -> field_count) {
			$res = $dataLink -> use_result();
			$i = 0;
			while ($row = $res -> fetch_assoc()) {
				$data[$i] = $row;
				$i++;
			}
			$res -> close();
		} else {
			$data = null;
		}

		$dataLink -> close();
		return $data;
	}

}

class PatientClass {
	private $dataLink;

	public $validpatient;
	public $p_id;
	public $patientFirstName;
	public $patientLastName;
	public $patientIllness;
	public $doctorId;

	public $sql;

	public function PatientClass() {
		$validpatient = false;
		$this -> dataLink = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		
		if ($dataLink->connect_error){
			die ("Connect failed: " . $dataLink->connect_error);
		}
	}

	public function Retrieve($key) {
		$this -> sql = "SELECT * FROM d_riddlespur_patient_table where patientId = " . $key . ";";
		if ($this -> dataLink -> real_query($this -> sql)) {
			if ($this -> dataLink -> field_count) {
				$res = $this -> dataLink -> use_result();
				while ($row = $res -> fetch_assoc()) {
					$this -> p_id = $row["patientId"];
					$this -> patientFirstName = $row["patientFirstName"];
					$this -> patientLastName = $row["patientLastName"];
					$this -> patientIllness = $row["patientIllness"];
					$this -> doctorId = $row["doctorId"];
					$this -> validpatient = true;
				}
				$res -> close();
			}
		} else {
			die($this->dataLink->error);
		}
	}

	public function Update() {
		
		if (empty($this->doctorId)){
			$this->doctorId = "null";
		}
		
		$this -> sql = "UPDATE d_riddlespur_patient_table
            SET
            patientFirstName = '" . $this -> patientFirstName . "',
            patientLastName = '" . $this -> patientLastName . "',
            patientIllness = '" . $this -> patientIllness . "',
            doctorId = " . $this -> doctorId . "
           WHERE patientId = " . $this -> p_id . ";";

		if ($this -> dataLink -> real_query($this -> sql)) {
			$i = 0;
			do {
				$i++;
			} while ($this->dataLink->next_result());
			$this -> validpatient = true;
		} else {
			die ($this->dataLink->error);
		}
	}

}

class DoctorsClass {

	// returns an array of associative arrays representing each patient record
	public static function ListAll() {
		$dataLink = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		$data = array();

		if ($dataLink -> real_query("SELECT * FROM d_riddlespur_DR_table;")) {
			if ($dataLink -> field_count) {
				$res = $dataLink -> use_result();
				$i = 0;
				while ($row = $res -> fetch_assoc()) {
					$data[$i] = $row;
					$i++;
				}
				$res -> close();
			} else {
				$data = null;
			}
		} else {
			$data = null;
		}

		$dataLink -> close();
		return $data;
	}

	public static function ListForIllness($illness){
		$dataLink = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		$data = array();

		if ($dataLink -> real_query("SELECT * FROM d_riddlespur_DR_table where doctorSpecialty like '%" . $illness . "%';")) {
			if ($dataLink -> field_count) {
				$res = $dataLink -> use_result();
				$i = 0;
				while ($row = $res -> fetch_assoc()) {
					$data[$i] = $row;
					$i++;
				}
				$res -> close();
			} else {
				$data = null;
			}
		} else {
			$data = null;
		}

		$dataLink -> close();
		return $data;		
	}

}

class DoctorClass {
	private $dataLink;

	public $validdoctor;
	public $doctorId;
	public $doctorFirstName;
	public $doctorLastName;
	public $doctorSpecialty;

	public $sql;

	public function DoctorClass() {
		$validdoctor = false;
		$this -> dataLink = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	}

	public function Retrieve($key) {
		$this -> sql = "SELECT * FROM d_riddlespur_DR_table where id = " . $key . ";";
		if ($this -> dataLink -> real_query($this -> sql)) {
			if ($this -> dataLink -> field_count) {
				$res = $this -> dataLink -> use_result();
				while ($row = $res -> fetch_assoc()) {
					$this -> doctorId = $row["doctorId"];
					$this -> doctorFirstName = $row["doctorFirstName"];
					$this -> doctorLastName = $row["doctorLastName"];
					$this -> doctorSpecialty = $row["doctorSpecialty"];
					$this -> validoctor = true;
				}
				$res -> close();
			}
		}
	}

	public function Update() {
		$this -> sql = "UPDATE d_riddlespur_DR_table
            SET
            doctorFirstName = '" . $this -> doctorFirstName . "',
            doctorLastName = '" . $this -> doctorLastName . "',
            doctorSpecialty = '" . $this -> doctorSpecialty . "
            WHERE doctorId = " . $this -> doctorId . ";";
		if ($this -> dataLink -> real_query($this -> sql)) {
			$i = 0;
			do {
				$i++;
			} while ($this->dataLink->next_result());
			$this -> validdoctor = true;
		} else {
			$this -> validdoctor = false;
		}
	}

	public function Select() {
		$this -> sql = "SELECT d.* FROM 
			d_riddlespur_DR_table d, d_riddlespur_patient_table p
			WHERE p.patientId = $patientId 
			AND	d.doctorSpecialty LIKE CONCAT('%', p.patientIllness, '%')";
		$results = $this -> DataLink -> real_query($sql, $db) or die("<h3>patient record not found</h3>" . mysql_error());
	}

}
?>
