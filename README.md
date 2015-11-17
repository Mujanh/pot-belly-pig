Pot-belly-pig (Allt om hängbukssvin)
====================================

A site built for Questions and Answers, question functionalities are protected by login and the site stores information in mysql database.
Written in PHP and based on Anax-MVC (https://github.com/mosbth/Anax-MVC), a MVC-inspired framework for websites.

About the website
-----------------------------------
This website was created as a student project. On the website you can:

* Signup to become a member
* Ask questions (Members only)
* Answer questions (Members only)
* Comment answers and questions (Members only)
* Read questions, answers and comments (Everyone)
* See user profiles (Everyone)
* Vote on questions, answers and comments (Members only)
* Mark answers as accepted answers (Members only)
* Edit your profile (Members only)
* Accumulate reputation ponts by being an active member (Members only)
* Tag questions as beloning to certain categories (Members only)

The website's topic is pot-belly pigs and all site content is written in Swedish (code and code comments are in English).
Of course, the topic can be changed to something else entirely if you choose to do some changes to the code, such as changing the site title, images and tags.


How to install
------------------
**Step 1**
Clone this repository to your computer.

**Step 2**
####Install CForm and CDatabase
If not already installed, install CForm and CDatabase with Composer and Packagist by adding them to
your `composer.json`.

```
"require": {
    "php": ">=5.4",
    "mos/cform": "2.*@dev",
    "mos/cdatabase": "dev-master"
},
```
**Step 3**
When the packages have been installed, open up `vendor/mos/cform/src/HTMLForm/CForm.php` and add the following
method to the CForm-class:

```
/**
 * Get values of a form element array
 *
 * @param string $element the name of the formelement.
 *
 * @return mixed the value of the element.
 */
public function values($element)
{
    return $this[$element]['checked'];
}
```
**Step 4**
####Database setup
*The website need the database to be setup correctly to work as intended.*

In `webroot/` you will find `sql_tables.sql` with all the tables and views you need.
Import the sql-file into your mysql database of choice. By default all tables and views you import will have the
prefix `project_`, you can may change this prefix if you prefer another one, but they must all have the same prefix. However,
do not change the names of the tables as the classes that communicates with the database will look for tables that have the same names
as the classes (after the prefix), e.g. a class named `Question` will look for a database table named `project_question` if the prefix is `project_`.

**Step 5**
####Database configuration
In `app/config` you will find two config-files for mySQL (`config_mysql.php` and `config_mysql_local.php`). You can
use the latter one for your local environment and the former for live environment. In these files, whichever you chose to use,
you need to change the constants `DB_USER` and `DB_PASSWORD` to your mySQL username and password. You also need to set `dsn` to your
host and databasename so that you can access your mySQL database. If you changed the prefix to the tables and views, you will also need to change
`table_prefix` to the prefix you chose.

**Step 6**
In `webroot/index.php` you will set which of these configuration files you chose to use:
```
$di->setShared('db', function() {
    $db = new \Mos\Database\CDatabaseBasic();
    $db->setOptions(require ANAX_APP_PATH . 'config/config_mysql.php'); //online
    //$db->setOptions(require ANAX_APP_PATH . 'config/config_mysql_local.php'); //offline
    $db->connect();
    return $db;
});
```

**Step 6**
####CSS/Less configuration
Set the permissions on the directory `anax-grid` in `webroot/css` to 777. When you access the website in your browser,
two files will be created `style.css` and `style.less.cache`. You might have to refresh the page twice to see the changes. If you're experiencing
troubles with this, try to remove `style.css` and `style.less.cache` and refresh the page to create then again.


Good To Know
-----------------------------------

In `webroot/.htaccess` you can use Rewrite to rewrite the url base, just un-comment the code and change the base url.

The tables imported will be empty, except for `project_tags` which will have all the tags used on the website.
You can change these if you like, but if you remove or change the tag called `Övrigt` you will also need to change
`src/HTMLForm/CFormAddQuestion.php` since this tag is chosen per default if no tag has been chosen for a new question:

```
//Set Övrigt as default tag if none has been chosen
$tagCategories = !empty($this->Values('tags')) ? $this->Values('tags') : array('Övrigt');
```

Use of external libraries
-----------------------------------

The following external modules are included and subject to its own license.

### Lessphp
* Website: http://leafo.net/lessphp/
* Version: 0.4.0
* License: MIT License
* Path inluded in `webroot/css/anax-grid/lessphp`

### Semantic Grid
* Website: http://tylertate.github.io/semantic.gs/
* Version: 1.2
* License: Apache 2.0
* Path inluded in `webroot/css/anax-grid/semantic.gs`

### Modernizr
* Website: http://modernizr.com/
* Version: 2.6.2
* License: MIT license
* Path: included in `webroot/js/modernizr.js`

### PHP Markdown
* Website: http://michelf.ca/projects/php-markdown/
* Version: 1.4.0, November 29, 2013
* License: PHP Markdown Lib Copyright © 2004-2013 Michel Fortin http://michelf.ca/
* Path: included in `3pp/php-markdown`
