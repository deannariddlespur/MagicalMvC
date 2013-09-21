<?php

// All data interaction is done in the model.

require_once ('Model.php');

$doctorId = filter_input(INPUT_POST, "doctorId");
$p_id = filter_input(INPUT_POST, "p_id");
$id = filter_input(INPUT_POST, "id");

$p_id = mysql_real_escape_string($p_id);
$id = mysql_real_escape_string($id);
$doctorId = mysql_real_escape_string($doctorId);

$action = '_missing';
$type = '_missing';

if (array_key_exists('_action', $_REQUEST)) {
	$action = $_REQUEST['_action'];
} else {
	$action = 'index';
}

if (array_key_exists('_type', $_REQUEST)) {
	$type = $_REQUEST['_type'];
} else {
	$type = 'missing';
}

switch($action) {

	case "list" :
		if ($type == "patient") {
			$response -> patients = PatientsClass::ListAll();
		} elseif ($type == "doctor") {
			$response -> doctors = DoctorsClass::ListAll();
		} else {
			header("HTTP/1.0 403 Bad Request");
		}

		echo json_encode($response);

		break;

	case "lookup" :
		$response->keyValue = $_REQUEST["_key"];
		$response->typeValue = $_REQUEST["_type"];
		if ($type == "patient") {
			$patient = new PatientClass();
			$patient -> Retrieve($_REQUEST["_key"]);
			
			$allowedDoctors = DoctorsClass::ListForIllness($patient->patientIllness);
			
			$response -> patient = $patient;
			$response->doctors = $allowedDoctors;
			
		} elseif ($type == "doctor") {
			$doctor = new DoctorClass();
			$doctor -> Retrieve($_REQUEST["_key"]);
			$response -> doctor = $doctor;
		} else {
			header("HTTP/1.0 403 Bad Request");
		}

		echo json_encode($response);

		break;

	case "update" :
		// allow Update case to fall through to Index to re-send view after update.
		if ($type == "patient") {
			$patient = new PatientClass();
			$patient -> Retrieve($_REQUEST["p_idField"]);

			$patient -> patientFirstName = $_REQUEST["patientFirstNameField"];
			$patient -> patientLastName = $_REQUEST["patientLastNameField"];
			$patient -> patientIllness = $_REQUEST["patientIllnessField"];
			$patient -> doctorId = $_REQUEST["doctorIdField"];

			$patient -> Update();

		} elseif ($type == "doctor") {
			$doctor = new DoctorClass();
			$doctor -> Retrieve($_REQUEST["doctorIdField"]);

			$doctor -> doctorFirstName = $_REQUEST["doctorFirstNameField"];
			$doctor -> doctorLastName = $_REQUEST["doctorLastNameField"];
			$doctor -> doctorSpecialty = $_REQUEST["doctorSpecialtyField"];

			$doctor -> Update();
		} else {
			header("HTTP/1.0 403 Bad Request");
		}

	case "index" :
		include ("View.php");
		break;

		break;

	default :
		header("HTTP/1.0 404 Not Found");
		break;
}
?>
