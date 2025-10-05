# 🍊 institue-management-system 



## 🥏 Technolgies Used 
  1. PHP (8.1) 
  2. MySQL database  
  3. Bootstrap 5
  4. JQuery, JavaScript
  5. HTML, CSS

## 💡 FEATURES 
1. User Registration: Allows users to create a new account by filling in required fields such as name, email, phone number, password, and course selection.
2. User Login: Enables users to access the system securely using their email and password with proper validation.
3. Course Enrollment: Allows users to select a course and enroll while preventing duplicate registrations.
4. Front Page: Displays a welcome message and provides links to courses and tests.
5. Admin Dashboard: Allows administrators to view all students and courses, manage learning cards, send notifications, and monitor statistics.
6. User Dashboard: Provides users with their progress, enrolled courses, test results, and access to educational materials.
7. Change Password: Enables users to update their current password while ensuring password strength.
8. User Logout: Allows users to securely log out and clears session data.
9. Placement Test: Allows users to take a placement test and store their results.
10. Take Test: Provides functionality for students to complete tests, save their answers, and calculate results.
11. Admin Settings: Enables administrators to modify platform settings and save changes.
12. Card Management: Allows CRUD operations on learning cards, including creating, reading, updating, and deleting cards.
13. Notifications: Enable sending and receiving alerts between the admin and users.
14. Add Student: Allows the admin to manually add new students to the system.
15. View Students: Provides administrators with a complete view of all student records.
16. Delete Student: Allows the admin to remove any student from the system.
17. Edit Student: Enables updating student details efficiently.
    


## ✅ HOW TO USE?

  <b>Pre-requirement</b> : Make sure you have both php and MySQL installed on your PC. You can also use XAMPP which provide BOTH (php + MySQL).<br><br>

 <b>Step-1 :</b> Start XAMPP <br>
   Open XAMPP Control panel and start the Apache And MySQL Server  <br>

 <b>Step-2 :</b> Create Database <br>
   <b>The schema file of the database setup is available at database/_sms.sql </b>
   <br><br>
   From you xampp open phpmyadmin by clicking on admin button in front of MySQL -> create a database with the name '_sms' -> import the  database/_sms.sql file to complete the database setup.<br>

<b>Step-3 :</b> Placement <br>
   <b> If you have xampp installed on your PC you need to place the downloaded folder on 'htdocs directory' </b>
   <br><br>
   Copy the downloaded folder and place it into htdocs folder. Located at <i>C:\xampp\htdocs</i>
   <br><br>
   make sure your directory setup is like : <i>C:\xampp\htdocs\Student--management\ </i> : and index.php file is available on the that location

<b>Step-4 :</b> Run the application <br>
   <b> visit on the url : <i>http://localhost/Student--management</i> </b>
   <br> Visit to the given URL to see the running website

## 🔐 Emails and Passwords

The project comes with default user on each panel you can remove and update them also.<br>
The **Credentials** for default logins are

| Panel   |  Email             | Password |
| ----:   |  :---------------- | :------: |
| Admin   | admin@gmail.com    | 123      |
| Teacher | teacher@gmail.com  | 123      |
| Student | student@gmail.com  | 123      |
| Owner   | owner@gmail.com    | 123      |

- Note : **Password for New Teachers and Students:**  
   The default password for newly created teacher and student accounts is set to their **date of birth**.  
   - Example: If the date of birth is **12 July 2000**, the password would be **12072000**.

## ❤️ Contributing

Pull requests are welcome. For major changes, please open an issue first
to discuss what you would like to change.

Please make sure to update tests as appropriate.



