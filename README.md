1: Introduction of Team
a.	Names: Elizabeth Aucott, Matthew Hearn, Sam Mendimasa, Eunice Fe Simon, Nicholas Sorauf
b.	Emails: eaucott1@umbc.edu, hearn1@umbc.edu,  sam34@umbc.edu, esimon1@umbc.edu, nsorauf1@umbc.edu
c.	Roles: 	Elizabeth - debugger, programmer, smiles
	Matt - database management, auxiliary documentation
	Sam - programmer
	Eunice - Project Design, programmer
Nick -  programmer, documentation
2: Location of Project
	https://swe.umbc.edu/~hearn1/CMSC331/proj2/

3: Project Description
	Our goal with this project was to create a working advising website for the CNMS department. This was to handle both individual as well as group advising for students still within the gateway portion of their academic career. 

4/5:  What was added and Improved given old code:

In terms of the website we kept the login and homepages similar to they were given. A majority of the other pages required excessive debugging of syntax and logic issues. Lots of other pages were added for functionality. A full list of all modifications would be excessively long so instead we found it easier to say what we left unmodified above. 
The following are the design modifications that we did:

-we scratched the advisor_majors, adviosr_appts, student_appts  tables
-we combines these into a single meetings table(see above for format)
-the student_advising_info was modified to not use boolean logic and instead
 just used 2 text types.
-student_basic_info now has a meetingID which keeps track of what meeting a 
student was attending
-student_basic_info now had a single major instead of boolean logic for what
 major the student was
-advisor_info was not modified

The following are a list of pages added or modified(modifications described). All pages had debugging/ syntax issues which will not be described for lack of space.

Home
-advProcessLogin.php modified for new database setup, session variables changed
-stuCreate.php modified for new database setup
-stuProcessLogin.php modified for new database setup, session variables changed
-stuLogin.php modified for new database setup
-advLogin.php modified for new database setup
-general.css completely revamped( images were also added throughout project)
-index.php we used original homepages for student and advisor side, but redid the general homepage
-stuRegister.php modified for database setup, and changed to be a drop down list- set inputs to be required
-stuSet.php modified for database setup, minor changes for input validation
Student Side:
	-setAppointments.php modified for database setup, sql needed major changes for logic
	-confirmDelete.php added to confirm that a student wanted to delete their appointment
		- sends notification for advisor
	-processStuHome.php modified for additional buttons
	-other.php completely new- handles if a student clicks other and are on wrong advising     website
	-questions.php completely new- handles the advising questions
	-setQuestions.php completely new- handles the advising questions (sends to database)
	-viewAppointment.php major changes for functionality
	-editinfo.php - completely new, used for a student to change their info
	-setinfo.php - completely new, used for setting student info
	-searchAppointments.php - major changes for functionality
	-canDeleteAppointments - modified for databases major changes for functionality 
-index.php - minor changes
-general.css - added

Advisor Side:
	-processAppts.php - completely new
	-updateAdvisorInfo.php -  modified for new database structure
	-processNotifications.php -  completely new
-processAdvisorHome.php -  modified for new links 
	-viewAppts.php -  completely new
	-viewAllStudents.php - completely new
	-viewAllApps.php - completely new
	-advisorCreated.php -  completely new
	-apptCreated.php -  completely new
	- createAdvisor.php - completely new
	- processCreateAdvisor.php - completely new
	- eduitAdvisorInfo.php -  modified for database
	-index.php -  modified for new links
	-infoEdited.php -  completely new
	-notifications.php -  completely new
	-turnOn.php - completely new
	-turnOff.php - completely new
	-turnOffConfirm.php - completely new
	-searchAppts.php - completely new
	
6: Database Setup
 
Database eaucott1
Table structure for table students_basic_info
Column	Type	Null	Default
id	int(10)	No	 
lname	varchar(40)	No	 
fname	varchar(40)	No	 
nickname	varchar(40)	No	 
umbc_ID	varchar(10)	No	 
email	varchar(40)	No	 
password	varchar(40)	No	 
major	varchar(10)	No	 
meeting_id	int(10)	No	 


 
Database eaucott1
Table structure for table students_advising_info
Column	Type	Null	Default
id	int(10)	No	 
post_plans	text	No	 
adv_questions	text	No	 

 
Database eaucott1
Table structure for table notifications
Column	Type	Null	Default
index	int(11)	No	 
studentID	int(11)	No	 
meetingID	int(11)	No	 

 
Database eaucott1
Table structure for table meetings
Column	Type	Null	Default
index	smallint(11)	No	 
start_time	time	No	 
date	date	No	 
room	varchar(20)	No	 
advisor_last_name	text	No	 
current_number_students	tinyint(4)	No	 
max_number_students	tinyint(4)	No	 
active	tinyint(1)	No	1

 
Database eaucott1
Table structure for table advisor_info
Column	Type	Null	Default
id	int(11)	No	 
username	varchar(40)	No	 
password	varchar(40)	No	 
lname	varchar(40)	No	 
fname	varchar(40)	No	 
office	varchar(40)	No	 
email	varchar(40)	No	 
Explanation of Databases:
All four of the databases store informations for their particular situation. The student_basic_info table is used for storing student data. Meetings is used for storing data on the meeting time, location, and personal. Notifications is used for storing what students have left meeting and have an advisor who needs to be notified. Advisor_info is used for storing data regarding the advisor.

7: Languages
	We used a little bit of Javascript for popups, and mostly php.

8: SlickSheet

 

9: Videos
https://www.youtube.com/playlist?list=PLWOUQhIziXA1X-O_7VD_07tJc_tq5Y3gz
