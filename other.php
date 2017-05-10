<?php
/* 
File:	 other.php
Project: CMSC 331 Project 2
Author:	 Elizabeth Aucott 
Date:	 12/5/16

         HTML blurb about using a different website if student is not a CNMS major. 
         
         Redirects back to the stuRegister.php
*/ 

session_start();

include('../assets/header.html');
?>
<title>Other Majors</title>

  <body>
  <form action='../stuRegister.php' method='post'>
    <p>You have indicated that you plan to pursue a major other than one of the following, beginning next semester: 
      <ul>
        <li>Biological Sciences B.A.</li>
        <li>Biological Sciences B.S.</li>
        <li>Biochemistry & Molecular Biology B.S.</li>
        <li>Bioinformatics & Computational Biology B.S.</li>
        <li>Biology Education B.A. </li>
        <li>Chemistry B.A.</li>
        <li>Chemistry B.S.</li>
        <li>Chemistry Education B.A. </li>
      </ul></p>
    <p>In order to obtain the BEST advice about course selection, degree progress, and academic policy, 
       please meet with a representative of the department that administers your NEW major.</p>
    <p>You can find advising contact information for your new major on the Office for Academic and
       Pre-Professional Advising Office’s <a href="http://advising.umbc.edu/departmental-advising/">Departmental Advising</a> page. 
	That contact person/office will be able to give you instructions on how to schedule an advising appointment with someone in that area.</p>
    <p>Good luck with your new major!</p>
    <p>If you selected 'Other' in error, click the button to return to the previous screen.</p>
    
    <input type='submit' value='Back to Registration'></form>

  </body>
</html>

