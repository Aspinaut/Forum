Setup :
- importer dans phpmyadmin forum.sql
- ajouter un .env à la racine avec dedans :
DATABASE_URL="mysql://root:root@localhost/forum?serverVersion=mariadb-10.5.8"
- composer install
- npm install
- php bin/console server:run
