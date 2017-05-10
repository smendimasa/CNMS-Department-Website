<?php
/* 
File:	 editInfo.php
Project: CMSC 331 Project 2
Author:	 Elizabeth Aucott 
Date:	 12/5/16

         This php file retrieves all a student's data from students_basic_info and students_advising_info
         prepopulates an editable form that the student can use to edit their information. 

         It redirects to setInfo.php in order to update the databases.
*/ 

session_start();

// Confirm that the user is a student
if ($_SESSION['type'] != 'student') {
  header('Location: ../index.php');
}

include('../CommonMethods.php');
echo("<title>Update Info</title>");

$debug = false;
$COMMON = new Common($debug);

$id = $_SESSION['studentID'];

// Find student in databases to print out current information
$sql = "SELECT * FROM `students_basic_info` WHERE `id` = '$id'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);

$lname = $row[1];
$fname = $row[2];
$nickname = $row[3];
$umbcID = $row[4];
$email = $row[5];
$password = $row[6];
$major = $row[7];

$sql = "SELECT * FROM `students_advising_info` WHERE `id` = '$id'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);

$plans = $row[1];
$questions = $row[2];

include('../assets/header.html');

// Print out current info
echo("
    <br>
    <form action='setInfo.php' method='post'>
      First Name: <input type='varchar' size='25' maxlength='40' name='fname' value='$fname'><br/><br/>
      Last Name: <input type='varchar' size='25' maxlength='40' name='lname' value='$lname'><br/><br/>
      Preferred Name: <input type='varchar' size='25' maxlength='40' name='nickname' value='$nickname'><br/><br/>
      UMBC ID: <input type='varchar' size='7' maxlength='10' name='umbc_ID' value='$umbcID'><br/><br/>
      UMBC Email: <input type='email'name='email' value='$email'><br/><br/>
      Password: <input type='password' name='password' placeholder='Leave blank if you do not wish to change your password'><br/><br/>
      
      Select Major:<br/>
      <select name='major'>
");

// code to select right major
if ($major == 'bio_ba') {
    echo("<option value='bio_ba' selected>Biological Sciences BA</option>");
}
else {
    echo("<option value='bio_ba'>Biological Sciences BA</option>");
}
if ($major == 'bio_bs') {
    echo("<option value='bio_bs' selected>Biological Sciences BS</option>");
}
else {
    echo("<option value='bio_bs'>Biological Sciences BS</option>");
}
if ($major == 'biochem_bs') {
    echo("<option value='biochem_bs' selected>Biochemistry & Molecular Biology BS</option>");
}
else {
    echo("<option value='biochem_bs'>Biochemistry & Molecular Biology BS</option>");
}
if ($major == 'bioinfo_bs') {
    echo("<option value='bioinfo_bs' selected>Bioinformatics & Computational Biology BS</option>");
}
else {
    echo("<option value='bioinfo_bs'>Bioinformatics & Computational Biology BS</option>");
}
if ($major == 'bioedu_ba') {
    echo("<option value='bioedu_ba' selected>Biological Education BA</option>");
}
else {
    echo("<option value='bioedu_ba'>Biological Education BA</option>");
}
if ($major == 'chem_ba') {
    echo("<option value='chem_ba' selected>Chemistry BA</option>");
}
else {
    echo("<option value='chem_ba'>Chemistry BA</option>");
}
if ($major == 'chem_bs') {
    echo("<option value='chem_bs' selected>Chemistry BS</option>");
}
else {
    echo("<option value='chem_bs'>Chemistry BS</option>");
}
if ($major == 'chemedu_ba') {
    echo("<option value='chemedu_ba' selected>Chemistry Education BA</option>");
}
else {
    echo("<option value='chemedu_ba'>Chemistry Education BA</option>");
}

// rest of current info
echo("
    </select><br/>
    
    What are your current post-UMBC plans? <br>
      <textarea rows='5' cols='60' type='text' name='plans'>$plans</textarea><br>
      
      Do you have any questions or concerns that you would like to discuss during your advising session?<br>
      <textarea rows='5' cols='60' type='text' name='questions'>$questions</textarea><br>

      <input type='submit' value='Make Changes'>
    </form>
    

  
  </body>
</html>
");
?>