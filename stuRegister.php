<?php
session_start();

include("assets/header.html")

?>

<title>Student Registration</title>
</head>
  <body>
    <h1>Student Registration</h1>
    <form action='stuSet.php' method='post'>
      First Name: <input type='varchar' size='25' maxlength='40' name='fname' required><br/><br/>
      Last Name: <input type='varchar' size='25' maxlength='40' name='lname' required><br/><br/>
      Preferred Name: <input type='varchar' size='25' maxlength='40' name='nickname'><br/><br/>
      UMBC ID: <input type='varchar' size='7' maxlength='10' name='umbc_ID' required><br/><br/>
      UMBC Email: <input type='email'name='email' required><br/><br/>
      Password: <input type='password' name='password' required><br/><br/>
      Re-enter Password: <input type='password' name='confirmPass' required><br/><br/> 

      Select Major:<br/>
      <select name='major'>
        <option value='bio_ba'>Biological Sciences BA</option>
        <option value='bio_bs'>Biological Sciences BS</option>
        <option value='biochem_bs'>Biochemistry & Molecular Biology BS</option>
        <option value='bioinfo_bs'>Bioinformatics & Computational Biology BS</option>
        <option value='bioedu_ba'>Biological Education BA</option>
        <option value='chem_ba'>Chemistry BA</option>
        <option value='chem_bs'>Chemistry BS</option>
        <option value='chemedu_ba'>Chemistry Education BA</option>
        <option value='other'>Other</option>
      </select><br/><br/>

      <input type='submit' value='Register'>
    </form>

</body>
</html>

?>