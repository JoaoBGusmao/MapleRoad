# MapleRoad: Free MapleStory Database System

MapleRoad is a free MapleStory database system and can be used for all maplestory versions.

## Getting started
MapleRoad works in all operating systems running Apache, PHP 5.x and Mysql.  
To get started, you need to first upload the full code to your FTP.  
Then, you need to create your database:  
> Open db.sql and run the sql code in your database in order to create all tables.  
> The sql file was developed to work with GMS V83. If you want to work in another MapelStory version, you will need to modify your own database.

After setting up the Mysql server, go to inc folder and go to config.php  
Change the settings to create the connection connection to your Mysql server.
* define("DB_ENGINE", "mysql");  /* Does not need to be changed */
* define("DB_HOST", "HOST"); /* Change to the database IP if you're using an external Mysql */
* define("DB_USER", "USER"); /* Your Mysql User */
* define("DB_PASS", "PASSWORD"); /* Your Mysql Password */
* define("DB_DATABASE", "DATABASE"); /* Your database name */

Now, your database should be working fine.

## Populate your database
Since we still don't have the populate tools, you will need to do it by your own.
The following classes and tables was made using .wz structures and names:
* class.equip.php and "equips" table
* class.item.php and "items" table
* class.map.php and "maps", "maps_life" and "maps_portals" table
* class.mob.php and "mobs" table
* class.npc.php and "npcs" table

So, it isn't hard to create your own MapleStory content if you can read all .wz files (Google Harepacker)

## Changing design
MapleRoad was made using bootstrap 3.3.   
To change website colors, see css/style.css
To make changes to the HTML see "/inc/website_includes/" and .php files at "/"

### Version
MR_0.3

### Links

* [HTTP Apache] - Download Open-source HTTP server
* [Mysql] - Download Open-source database
* [PHP] - No words :P
* [Twitter Bootstrap] - Beautifull
* [jQuery] - Yeah!
* [MapleRoad] - Main MapleRoad database link

### Todos

 - Populate Tools
 - A better search tool
 - Documentation
 - Comments

### Who?
* Main developer: Joao Gusmão: <joao@natsce.com>
* You (maybe)

License
----

GPL

### Good habits
If you're going to use MapleRoad System, please leave a "Created Using <a href="https://github.com/JoaoBGusmao/MapleRoad">MapleRoad</a> System" at the end of every page.   
Thanks for respecting

**Free Software, Hell Yeah!**


   [HTTP Apache]: <http://httpd.apache.org/download.cgi>
   [Twitter Bootstrap]: <http://twitter.github.com/bootstrap/>
   [jQuery]: <http://jquery.com>
   [mysql]: <http://www.mysql.com/downloads/>
   [php]: <http://php.net/downloads.php>
   [mapleroad]: <http://mapleroad.com.br>
