# Auction2

Bid for your goods.

/* 16:52:19 MariaDB */ CREATE DATABASE `laravel` DEFAULT CHARACTER SET = `utf8`;


/* 16:53:06 MariaDB laravel */ CREATE USER 'laravel'@'localhost' IDENTIFIED BY 'laravel';
/* 16:53:06 MariaDB laravel */ UPDATE mysql.user SET max_questions = 0, max_updates = 0, max_connections = 0 WHERE User = 'laravel' AND Host = 'localhost';
/* 16:53:06 MariaDB laravel */ REVOKE CREATE ROUTINE, CREATE VIEW, CREATE USER, ALTER, SHOW VIEW, CREATE, ALTER ROUTINE, EVENT, SUPER, INSERT, RELOAD, SELECT, DELETE, FILE, SHOW DATABASES, TRIGGER, SHUTDOWN, REPLICATION CLIENT, GRANT OPTION, PROCESS, REFERENCES, UPDATE, DROP, REPLICATION SLAVE, EXECUTE, LOCK TABLES, CREATE TEMPORARY TABLES, INDEX ON *.* FROM 'laravel'@'localhost';
/* 16:53:06 MariaDB laravel */ FLUSH PRIVILEGES;


/* 16:54:14 MariaDB laravel */
/* 16:54:14 MariaDB laravel */ REVOKE GRANT OPTION ON `laravel`.* FROM 'laravel'@'localhost';
/* 16:54:14 MariaDB laravel */ FLUSH PRIVILEGES;
