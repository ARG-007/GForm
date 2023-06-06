# Guvi Technical Task - Form With Register, Login, Profile Flow

## Project Description:
    Design Three Forms : Register, Login, Profile to Store User accounts and their profile details

## Project :
- MySQL to store User Credentials
- MongoDB to store User Details
- Redis to Store Session Information with 10Min Invalidation Time
- Bootstrap on form to Support Responsiveness

## Server Environment:
### THESE ARE DEFAULTS! SERVER VARIABLES CAN BE CHANGED IN `assets/serverConfig.php`

### Use TestDB to Check Stored Values of MySQL, MongoDB, Redis
### PHP Server
- version: 8.1.2
- Extensions: `MongoDB`, `Redis`

### MySQL
 - version: Use Latest
 - User: `root`
 - Password: `root`
 - Database Name : `gform_regdb`
 - Table : `register`
 - Table Columns: `pid`,`email`,`password` -> pid : PrimaryKey, AutoIncrement
 - Server IP: localhost(`127.0.0.1`) 
 - Server Port: `3306` 
 <br> Used In Pages :
 - `register.php` (For Credentials Storing) 
 - `login.php` (For Authentication)

### MongoDB
 - version: Use Latest
 - Server IP : localhost (`127.0.0.1`)
 - Server Port: `27017`
 - Full Resolved Name : `mongodb://localhost:27017`
 - DB : `GFormDB`
 - Collection : `UserProfiles` <br>
 Used In Pages: `register.php`, `login.php`, `profile.php`

### Redis
 - version: Use Latest 
 - Server IP : `127.0.0.1`
 - Server Port: `6379`
 - Cache Invalidation : `600 secs` => `10 Mins`
 - Stores Single Session token Derieved from MongoDB ID which Expires after `10` Mins
 <br> Used In Pages: `register.php`, `login.php`, `profile.php` 


### Deviations
 - `testDB.php` : Used for Inspecting Databases
 -  ### Nothing Else !!!

