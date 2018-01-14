# tp-zend
TP Zend ESGI 4IW1

## Base de données

* Se connecter au bash du container `database`  
* Se connecter à Mysql avec `mysql -u demo -p` et password `demo`  
* `use demo;` pour se positionner sur la BDD demo  
* Créer une table `meetup` :  
```sql
CREATE TABLE `meetup` (
`id` text PRIMARY KEY,
`title` text NOT NULL,
`description` text NOT NULL,
`date_start` date NOT NULL,
`date_end` date NOT NULL
);
```
