# Guvi Technical Task - Form With Register, Login, Profile Flow

## Project Description:
    Design Three Forms : Register, Login, Profile to Store User accounts and their profile details

## Project :
- MySQL to store User Credentials
- MongoDB to store User Details
- Redis to Store Session Information with 10Min Invalidation Time
- Bootstrap on form to Support Responsiveness

## Server Environment:

### PHP Server
>- version: 8.1.2
>- Extensions: MongoDB, Redis

### MySQL
> - version: Use Latest
> - User: `root`
> - Password: `root`
> - Database Name : `gform_regdb`
> - Table : `register`
> - Server IP: localhost(`127.0.0.1`) 
> - Server Port: `6379`
> - Details can be changed in Variables present in top level of each file 
> Used In Pages :
> - `register.php` (For Credentials Storing) 
> - `login.php` (For Authentication)

### MongoDB
> - version: Use Latest
> - Server IP : localhost (`127.0.0.1`)
> - Server Port: `27017`
> - Full Resolved Name : `mongodb://localhost:27017`
> - DB : `GFormDB`
> - Collection : `UserProfiles` <br>
> Used In Pages: `register.php`, `login.php`, `profile.php`

### Redis
> - version: Use Latest 
> - Server IP : `127.0.0.1`
> - Server Port: `6379`
> - Cache Invalidation : `600 secs` => `10 Mins`
> - Stores Single Session token Derieved from MongoDB ID which Expires after `10` Mins
> <br> Used In Pages: `register.php`, `login.php`, `profile.php` 

### THE ABOVE REQUIREMENTS ARE NEEDED FOR EXECUTION OF THE PROJECT

### Deviations
> - `test.php` : Used for Quick Mock of Codes
> -  ### Nothing Else !!!
