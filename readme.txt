Install instructions:
1) Unzip sait from condon-johnson-release.zip to sait home on your LAMP hosting
2) Create new Database and load it from Database dump db/condon-johnson-release.sql.gz
3) Configure Database connection in wp-config.php
   In particular you should config next params in wp-config.php:

   /** The name of the database for WordPress */
   define('DB_NAME', 'databasename');

   /** MySQL database username */
   define('DB_USER', 'username');

   /** MySQL database password */
   define('DB_PASSWORD', '');

   /** MySQL hostname */
   define('DB_HOST', 'localhost');

    