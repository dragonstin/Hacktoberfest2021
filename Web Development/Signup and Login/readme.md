# Signup and Login page with email verification

This is a web development project has a signup page and a login page with email verification. In this project, after you have signed up, you will receive an email with a verification link to verify the account, after verification then only login is allowed. Passwords of the user are stored in the database in the encrypted format *(Blowfish)*.
<br/><br/>

# Deployment

To use this project 

```
Download the project file and local server application.
Extract the project file to htdocs folder inside the local server application folder.
Create a local database and import the SQL file provided in the project.
```
To Download XAMPP [Click Here](https://www.apachefriends.org/download.html)
<br/><br/>
Make the following changes in connection.php
```
$servername = "[replace with servername]:[Port Number]";
$username = "[database username]";
$password = "[database password]";
$conn = mysqli_connect($servername, $username, $password,'[Replace with database name you have created]');
``` 


  In signup.php file at line 33 and 34 make the following changes
```
$mail->Username = '<Replace with sender email>';
$mail->Password = '<Replace with password>';
  
*In case of gmail account you have to generate a APP password and use that password.

```

  In signup.php file at line 45 make the following change

```
$mail->Body = 'Your registration is sucessfull. Please click the link to verify your email http://localhost/[Replace with folder name under htdocs folder]/activate.php?email=' . $email . '&token=' . $token;
```
<br/>
Open a browser and search

```  
http://localhost/[Folder name where the project is located under htdocs]/index.php
```

  
<br/><br/>
# 🛠 Skills Used
Javascript, HTML, CSS, PHP, MYSQL 
<br/><br/>
# Screenshot
## Login Page
![home](https://user-images.githubusercontent.com/61456837/137170550-d800c394-4976-4da9-9a42-6822eec1ff9a.png)

<br/><br/>
## Sign Up Page
![signup](https://user-images.githubusercontent.com/61456837/137170594-f18bac8d-ce7e-4f8b-8a40-c06fbc72d236.png)
<br/><br/>
# Author 
**DEEPAK AGARWAL** <br/><br/>
![Logo](https://github.com/deepaksanwaria/Swarastra/blob/7377029fa0a064e39c19538f6c22cf89b44c1a03/Readme-Image/Deepak-Agarwal.png?raw=true)
<br/><br/>
[![portfolio](https://img.shields.io/badge/portfolio-000?style=for-the-badge&logo=ko-fi&logoColor=white)](https://github.com/deepaksanwaria/)
[![linkedin](https://img.shields.io/badge/linkedin-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/deepak-agarwal-2460831a9/)
