<!DOCTYPE html>
<html lang="en">
	<head>
		<title> Patient Database</title>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<script type="text/javascript" src="Script.js"></script>
		<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/redmond/jquery-ui.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Aldrich:light,regular,bold">
		<link rel="stylesheet" type="text/css" href="Style.css" />
	</head>
	<body>
		<h1>Patient Database</h1>

		<div id="editFormOuter" name="editFormOuter" style="display: none;">
			<div id="editFormDiv" name="editFormDiv">
				<form id="editForm" name="editForm" method="post" action="index.php">
					<input type="hidden" name="_action" id="_action" value="update" />
					<input type="hidden" name="_type" id="_type" value="patient">
					<input type="hidden" name="p_idField" id="p_idField" />

					<span class="formTitleSpan">First Name:</span>
					<input class="formEditField" type="text" maxlength="15" required="required" name="patientFirstNameField" id="patientFirstNameField" />
					<br/>
					<span class="formTitleSpan">Last Name:</span>
					<input class="formEditField" type="text" maxlength="15" required="required" name="patientLastNameField" id="patientLastNameField" />
					<br/>
					<span class="formTitleSpan">Illness:</span>
					<input class="formEditField" type="text" maxlength="30" required="required" name="patientIllnessField" id="patientIllnessField" />
					<br/>
					<span class="formTitleSpan">Doctor ID:</span>
					<select class="formEditField" required="required" name="doctorIdField" id="doctorIdField">
						<option value=''></option>
					</select>
					<br/>

				</form>

			</div>
		</div>

		<table id="patientsTable" class="patientsTable">
			<thead>
				<tr>
					<th>Select DR</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Illness</th>
					<th>doctorId</th>
				</tr>
			</thead>
			<tbody>

			</tbody>
		</table>

		</form>

		<p style="text-align: center; font-size: 10pt;">
			
			<br/>
			Click Select to Select Appropriate Doctor for Illness
			<br/>
			<a href="http://www.ctcsports.org/upload/Fall2013/CIST2352/900104329/Assignment5/showpatient.php" target="_blank">View DR Assignment</a> 

		</p>
		<p id="footer">
			Copyright &copy; 2013 DANDE WEB WONDERS
		</p>
	</body>
</html>

