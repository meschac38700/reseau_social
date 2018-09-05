#!/bin/bash

BLACK='\033[0;30m'
RED='\033[0;31m'
GREEN='\033[0;32m'
BROWN_ORANGE='\033[0;33m'
BLUE='\033[0;34m'
PURPLE='\033[0;35m'
CYAN='\033[0;36m'
LIGHT_GRAY='\033[0;37m'
DARK_GRAY='\033[1;30m'
LIGHT_RED='\033[1;31m'
Light_Green='\033[1;32m'
YELLOW='\033[1;33m'
LIGHT_BLUE='\033[1;34m'
LIGHT_PURPLE='\033[1;35m'
LIGHT_CYAN='\033[1;36m'
WHITE='\033[1;37m'
NC='\033[0m'

table_name=users
user_last_name=ADMIN
user_first_name=Admin
user_password=admin
user_pseudo=admin
user_email=admin@admin.com
user_active='1'
token=$user_email$user_password$user_pseudo

read -p "Enter mysql root's name : " user
read -p "Enter mysql root's password : " password

#ask user if he/she want to define (him/her)self the name of the database, name of the table etc...
read -p "Would you custom database's name ? (o/n): " response

#if user want to define (him/her)sefl the name of the database
if [ -z "${response}" ] && [ $response -eq "o"  ]; then
	#ask him/her to enter a name
 	read -p 'Database name : ' dbName
else 
	dbName=reseauSocial
fi

#connection to mysql db
mysql -hlocalhost -u $user -p${password} -e "

drop database if exists ${dbName};
create database ${dbName};
	use ${dbName};
	create table  ${table_name}(
		id INT PRIMARY KEY AUTO_INCREMENT,
		last_name VARCHAR(255) NOT NULL,
		first_name VARCHAR(255) NOT NULL,
		pseudo VARCHAR(255) UNIQUE NOT NULL,
		password VARCHAR(255) UNIQUE NOT NULL,
		email VARCHAR(255) NOT NULL,
		token VARCHAR(255) UNIQUE NOT NULL,
		active ENUM('1','0') DEFAULT('0'),
		created_at DATETIME NOT NULL DEFAULT(now())
	);
	INSERT INTO users(last_name, first_name, pseudo, password, email, token, active) 
				VALUES ( '${user_last_name}', '${user_first_name}', '${user_pseudo}', sha1('${user_password}'), '${user_email}', sha1('${token}'), '${user_active}' );
"
echo -e "${GREEN}Database ${NC}[${YELLOW}${dbName}${NC}] ${GREEN}created with table users\nAnd inserted the first user with pseudo ${NC}[${YELLOW}${user_pseudo}${NC}]${GREEN} and password ${NC}[${YELLOW}${user_password}${NC}]"

echo -e "${RED}Press enter button to exit ${NC}"
read quit
exit