php2html
========

Write HTML using only php

About the project
=================

One advantage of the dynamic pages and client server languages, is the ability to create multiple contents using the same code. In combination with databases, the possibilities for creating content, grow and can facilitate or complicate the existence of a programmer. The main idea of this project, is precisely to facilitate the generation of these contents when the origin of these come from different sources.

This project was done in my spare time. Not intended to replace the good programming practices, and serve as a example for stable development. The project is the result of a question "what if...?"

Features
========

The PHP2HTML class, integrates engine access to MySQL, SQL Server and Oracle. Allowing the automation of building several web pages, using the same code. It allows to integrate in a same page from different sources. 
For example, the menu can be in a text file, get the main page from a MySQL database and other items are stored at Oracle database

  - Import CSS/JS/Text/Php Files
  - Use the same methods to access different RDBMS
  - Common methods to build most used tags
  - Object-oriented
  - Automate events

Requirements
============
  - PHP 5.2 or higher
  - MySQL 4.1 or higher
  - Oracle 9 or higher
  - Microsoft SQL Server 2000 or higher

The use of Oracle is not limited to full versions. XE versions are supported.  
To use the mysqli extension, you must have installed mysql 4.1 or higher. 

Example
========
```php
  include_once 'html.class.php';
  $p = new PHP2HTML();
  $p->CSS('css/styles.css');
  $p->Body('<div>Hello World</div>');
  $p->Comment("Begin of imported file");
  $p->HTML('contents/table.html');
  $p->Comment("End of imported file");
  $p->Body($p->Link(PAGEF, "http://www.google.com","Google","_blank"'));
  $p->HTMLbr();
  $p->Body(
          $p->Btn(
            "button", "Click Me", "myClass", "myID", "myName",
            actions::onClick(
              "alert('Hello'); return false;"
            )
          )
);
$p->Create();
```
Contact
=======
Constructive critics, comments and suggestions are welcome.

phptohtml@gmail.com

Homepage
====

[php2html - http://www.php2html.comyr.com](http://www.php2html.comyr.com)