#  LOGIN SYSTEM IN PHP AND MYSQL: User Authentication system.

###### hackathon - OFPPT

User authentication in web developemen is used to authorized and 
restrict users to certain pages in a web appplication.

## REGISTERATION SYSTEM

### DATABASE TABLE IN MYSQL
The database used is MySQL, so you'll need a MySQL database to run create the users table.
Run the `hackathon.sql` file in MySQL database to create users table.


### CONFIGURATION FILE
The PHP script to connect to the database is in `config.php` directory.
Replace credentials to in `config.php` to match your server credentials.

### REGISTERATION FORM AND SCRIPT
The `register.php` creates a web form that allows users to register themselves.
The script generates error if form input is empty and username is has been taking already by another user.

<p align="center"> 
   <img src='img/registration-page.jpg'> 
</p>
## LOGIN SYSTEM

### LOGIN FORM AND SCRIPT
`login.php` is the login script.
When a user submit a form with the input of username and password, these inputs will be verified against the credentials data stored in the database, if there is a match then the user will be authorized and granted access to site or page.

<p align="center"> 
   <img src='img/login-state.jpg'>
   <img src='img/login-error.jpg'>
</p>

### DASHBOARD PAGE
User is redirected to `dashboard.php` if login is successful.
<p align="center"> 
   <img src='img/dashboard-page.jpg'> 
</p>

### LOGIN OUT
`logout.php` log out the user and destroy all his sessions.
<hr />
