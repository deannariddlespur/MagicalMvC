$(document).ready(function() {
	LoadPatientTable();
});

function LoadPatientTable() {
	$.ajax({
		url : "Controller.php",
		data : {
			_action : "list",
			_type : "patient"
		},
		dataType : "json",
		type : "POST",
		async : false,
		cache : false
	}).error(function(data) {
		alert(data);
	}).done(function(data) {

		for ( i = 0; i < data.patients.length; i++) {
			$('#patientsTable > tbody:last').append('<tr><td><a href="JavaScript:EditPatient(' + data.patients[i].patientId + ');">select</a></td><td>' + data.patients[i].patientFirstName + '</td><td>' + data.patients[i].patientLastName + '</td><td>' + data.patients[i].patientIllness + '</td><td>' + data.patients[i].doctorId + '</td></tr>');
		}
	});
}

function EditPatient(patientID) {

	$.ajax({
		url : "Controller.php",
		data : {
			_key : patientID,
			_action : "lookup",
			_type : "patient"
		},
		dataType : "json",
		type : "POST",
		async : false,
		cache : false
	}).fail(function(data, status, thrown) {
		alert("ERROR! " + status + ': ' + thrown);
	}).done(function(data) {

		if (data.doctors != null) {
			for ( d = 0; d < data.doctors.length; d++) {
				$('#doctorIdField').html("<option value=''></option>");
				$('#doctorIdField').append("<option value='" + data.doctors[d].doctorId + "'>" + data.doctors[d].doctorLastName +  ", " + data.doctors[d].doctorFirstName  + "</option>");
			}
		}

		$("#p_idField").val(data.patient.p_id);
		$("#patientFirstNameField").val(data.patient.patientFirstName);
		$("#patientLastNameField").val(data.patient.patientLastName);
		$("#patientIllnessField").val(data.patient.patientIllness);
		$("#doctorIdField").val(data.patient.doctorId);

		$("#editFormDiv").dialog({
			title : 'Edit patient',
			modal : true,
			width : 450,
			height : 320,
			draggable : false,
			sizable : false,
			buttons : {
				Cancel : function() {
					$(this).dialog('close');
				},
				Save : function() {
					$("#editForm").submit();
				}
			}
		});
	});

}

function Editdoctor(doctorID) {

	$.ajax({
		url : "Controller.php",
		data : {
			_key : doctorID,
			_action : "lookup",
			_type : "doctor"
		},
		dataType : "json",
		type : "POST",
		async : false,
		cache : false
	}).done(function(data) {

		$("#doctorIdField").val(data.doctor.doctorId);
		$("#doctorFirstName").val(data.doctor.doctorFirstName);
		$("#doctorLastNameField").val(data.doctor.doctorLastName);
		$("#doctorSpecialtyField").val(data.doctor.doctorSpecialty);

		$("#editFormDiv").dialog({
			title : 'Edit doctor',
			modal : true,
			width : 450,
			height : 320,
			draggable : false,
			sizable : false,
			buttons : {
				Cancel : function() {
					$(this).dialog('close');
				},
				Save : function() {
					$("#editForm").submit();
				}
			}
		});
	});

}

