## Install and install wapserver

## Download wordpress and put it in www directory under wampserver
- Go to `https://wordpress.org/download/`
- Download the last version of ZIP archive of wordpress
- Extract the contents of the ZIP archive in the www directory (normally `C:\wamp64\www`)

## Create a databse
- Open your web browser and go to http://localhost/phpmyadmin to access the phpMyAdmin interface
- Click on "Databases" and create a new database called `wp_pi` (for your WordPress installation)

## Configure wordpress
- Go to `http://localhost/wordpress`
- Specify the following informations :
  - Database Name : `wp_pi`
  - Username : `root`
  - Password : `root`
  - Database host : `localhost/3306`
  - Table Prefix : `wp_`

- Site Title : aima
- Username : xxxxxxxxxx
- Password : xxxxxxxxxx
- Your email :xxxxxxxxxxxx

## Connect to Wordpress
Go to `http://localhost/wordpress/wp-login.php` and authenticate

## Clone the customized theme
- Go to `C:\wamp64\www\wordpress\wp-content\themes`
- Clone the repo of customized theme:
- Rum :
`git clone https://github.com/MarouaneAyech/arbitrage.git`