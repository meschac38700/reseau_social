-   To prepare the development environment, you have to:
        
        - First of all, you have to configure your email driver ( i use sendmail)
                - How to config Sendmail for Windows:
                        Step 1 :
                                Download sendmail.zip from http://glob.com.au/sendmail/
                                Save to C:\
                        Step 2:
                                Unzip to C:\sendmail
                        Step 3:
                                Edit C:\sendmail\sendmail.ini
                                
                                Set this following options:
                                        - smtp_server=smtp.gmail.com
                                        - smtp_port=587
                                        - auth_username=your_address@gmail.com
                                        - auth_password=your_password
                                        force_sender=your_address@gmail.com
                                        hostname=127.0.0.1 (or localhost)
                                Save the sendmail.ini file
                        Step 4 : 
                                Edit your php.ini file and set this following option:
                                        sendmail_path="C:\sendmail\sendmail.exe"
                                Save the php.ini file
                               
                                Restart your server
        
        -   Launch database.sh file.
            That file going to create a database and a SQL 'users' table.
            The script going to ask you if you want to change the database's name otherwise the default name is 'reseauSocial'

        -   Create a new database.php file in the config folder
        -   take inspiration from the contents of database.example.php to configure your database.

-   To start the server

    -   execute server.sh script file

       
