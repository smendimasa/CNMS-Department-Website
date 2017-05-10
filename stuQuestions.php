<?php
/* 
File:	 questions.php
Project: CMSC 331 Project 2
Author:	 Elizabeth Aucott 
Date:	 12/5/16

         HTML form to input answers to 2 advising questions.
         
         Redirects to setQuestions.php
*/ 

session_start();

include("assets/header.html")
?>

<title>Advising Questions</title>

  <body>
    <form action='stuSetQuestions.php' method='post'>
      What are your current post-UMBC plans? <br>
      For example: Medical School, Teach middle school science, Research career, Master's/PhD, etc.<br>
      <textarea rows='5' cols='60' type='text' name='plans' required></textarea><br><br>
    
      Do you have any questions or concerns that you would like to discuss during your advising session? <br>
      For example: Withdrawing from a course, adding a second major, etc.<br>
      <textarea rows='5' cols='60' type='text' name='questions'></textarea><br><br>

      Note: Certain questions and concerns may require more time for discussion than a student's<br>
      Registration Advising appointment will allow. If your question or concern is complex, or is<br>
      sensitive in nature, you may be asked to schedule a follow-up appointment with an advisor to address it fully.<br><br>

      <input type='submit' value='Submit'>
    </form>

  </body>
</html>

