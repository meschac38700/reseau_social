#!/bin/bash

table_name=users
user_last_name=ADMIN
user_first_name=Admin
user_password=admin
user_pseudo=admin
user_email=admin@admin.com
user_active='1'

BLACK='\033[0;30'
RED='\033[0;31'
GREEN='\033[0;32'
BROWN_ORANGE='\033[0;33'
BLUE='\033[0;34'
PURPLE='\033[0;35'
CYAN='\033[0;36'
LIGHT_GRAY='\033[0;37'
DARK_GRAY='\033[1;30'
LIGHT_RED='\033[1;31'
Light_Green='\033[1;32'
YELLOW='\033[1;33'
LIGHT_BLUE='\033[1;34'
LIGHT_PURPLE='\033[1;35'
LIGHT_CYAN='\033[1;36'
WHITE='\033[1;37'
NC='\033[0m'
echo -e " ${GREEN} Database ${NC} ${YELLOW} ${dbName} ${NC} ${GREEN} created with table users \nAnd inserted the first user with pseudo ${NC} ${YELLOW} ${user_pseudo} ${NC} ${GREEN} and password ${NC} ${YELLOW} ${user_password} ${NC} "

read -p "Enter mysql root's name : " user
read -p "Enter mysql root's password : " password

#ask user if he/she want to define (him/her)self the name of the database, name of the table etc...
read -p "Would you custom database's name ? (o/n): " response

#if user want to define (him/her)sefl the name of the database
if [ $response = "o" ]; then
	#ask him/her to enter a name
 	read -p 'Database name : ' dbName
else 
	dbName=reseauSocial
fi
echo -e "$YELLOW Creation of database $NC $RED ${dbName} $NC $YELLOW and $NC $RED ${table_name} $NC $YELLOW table $NC"
#connection to mysql
mysql -hlocalhost -u $user -p${password} -e "

create database IF NOT EXISTS ${dbName};
	use ${dbName};
	create table IF NOT EXISTS ${table_name}(
		id INT PRIMARY KEY AUTO_INCREMENT,
		last_name VARCHAR(255) NOT NULL,
		first_name VARCHAR(255) NOT NULL,
		pseudo VARCHAR(255) UNIQUE NOT NULL,
		password VARCHAR(255) UNIQUE NOT NULL,
		email VARCHAR(255) NOT NULL,
		active ENUM('1','0') DEFAULT('0')
	);
	TRUNCATE TABLE ${table_name};
	INSERT INTO users(last_name, first_name, pseudo, password, email, active) 
				VALUES ( '${user_last_name}', '${user_first_name}', '${user_pseudo}', sha1('${user_password}'), '${user_email}', '${user_active}' );
"
echo -e " ${GREEN} Database ${NC} ${YELLOW} ${dbName} ${NC} ${GREEN} created with table users \nAnd inserted the first user with pseudo ${NC} ${YELLOW} ${user_pseudo} ${NC} ${GREEN} and password ${NC} ${YELLOW} ${user_password} ${NC} "

read -p "${RED} Enter to exit ${NC}"
exit