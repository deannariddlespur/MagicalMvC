CREATE DATABASE IF NOT EXISTS cis1110;
USE cis1110;
-- building  tables
DROP TABLE IF EXISTS d_riddlespur_DR_table;
CREATE TABLE  d_riddlespur_DR_table (
					doctorId INT PRIMARY KEY,
					doctorFirstName VARCHAR(15),
					doctorLastName VARCHAR(15),
					doctorSpecialty VARCHAR(50)
);
DROP TABLE IF EXISTS d_riddlespur_patient_table;
CREATE TABLE  d_riddlespur_patient_table (
					patientId INT PRIMARY KEY,
					patientFirstName VARCHAR(15),
					patientLastName VARCHAR(15),
					patientIllness VARCHAR(25),
					doctorId INT
);
-- building records
INSERT INTO  d_riddlespur_DR_table 
VALUES (1001, 'Aubrey', 'Claire', 'eyes-OptometrySpecialist'),
				 (1002, 'Sandy', 'Plains', 'migraine headaches-Brain Specialist'),
				 (1003, 'Heavy', 'Heart', 'chest pains-Cardiology Specialist'),
				 (1004, 'Crunchy', 'Bone', 'bone and joint- rheumatologist Specialist'),
				 (1005, 'Big', 'Bone', 'bone and joint- rheumatologist Specialist'),
 				 (1006, 'Randy', 'Raines', 'migraine headaches-Brain Specialist');				 
INSERT INTO  d_riddlespur_patient_table 
VALUES (001, 'Ray', 'Charles', 'eyes', NULL),
				 (002, 'Holly', 'Tree', 'chest pains', NULL),
				 (003, 'Winnie', 'DaPhooh', 'chest pains', NULL),
				 (004, 'Forrest', 'Gump', 'headaches', NULL),
				 (005, 'Mary', 'Jane', 'bone and joint', NULL);				 
-- displaying all records	
SELECT * FROM d_riddlespur_DR_table;			 
SELECT * FROM d_riddlespur_patient_table;
