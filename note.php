<!-- this note file, only for my note (.htaccess) files,
 not for others works -->
<!-- .  -->
<!-- .  -->
<!-- .  -->
<!-- .  -->
<!-- .  -->
<!-- if (.htaccess) file do not work, then i will use this -->
.htaccess -file,,,,, if this file is working,


then i will use this file
👇👇
RewriteEngine On
RewriteBase /PHP/PHP_Project/PHP_project-01/
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^.*$ index.php [L]