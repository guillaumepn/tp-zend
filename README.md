# tp-zend
TP Zend ESGI 4IW1

## Préparations 

* Copier et renommer `config/autoload/local.php.dist` en `config/autoload/local.php`  
* Copier et renommer `config/development.config.php.dist` en `config/development.config.php`  


## Base de données

* Se connecter au bash du container `database`  
* Se connecter à Mysql avec `mysql -u demo -p` et password `demo`  
* `use demo;` pour se positionner sur la BDD demo  
* Créer une table `meetup` :  
```sql
CREATE TABLE `meetup` (
`id` varchar(36) PRIMARY KEY,
`title` text NOT NULL,
`description` text NOT NULL,
`date_start` date NOT NULL,
`date_end` date NOT NULL
);
```
