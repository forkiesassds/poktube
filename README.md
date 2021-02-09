# PokTube
![Website](https://cdn.discordapp.com/attachments/807438920181743656/808707960086986759/unknown.png)

## How to set up (DEVELOPEMENT PURPOSES)

1. Get XAMPP.
2. Install Apache and MySQL from the XAMPP Control Panel.
3. Get ``poktube.sql`` from here
4. Make a database called ``poktube``
5. Import ``poktube.sql`` to the ``poktube`` database
6. Make a folder called ``preload`` in the content folder if it does not exist.

## The homer
Type this command on your PokTube database on PHPmyAdmin, why? Because the database was updated. A fresh empty database is available.
```sql
ALTER TABLE `users` ADD `ispartner` TINYINT NOT NULL AFTER `registeredon`; 
```

## To do
* Improve the All users page. (only some shitty internal incomplete admin control panel exists)
* Add categories
* Readd ActiveX and Flash players (were removed after 2012 HTML5 was added)
