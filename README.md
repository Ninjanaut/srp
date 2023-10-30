SRP
=================

This is a sample demo application to demonstrate Nette PHP Framework with Materialize CSS framework and MySQL database.

## Requirements

- Git
- PHP installation >= 8.1
- Composer
- MySQL database (or Docker engine)

## Installation

- Install [Git](https://git-scm.com/) or any git related client
- Clone the project to your local developer machine workspace using [Git clone](https://github.com/git-guides/git-clone) command
- Install [PHP](https://www.php.net/downloads)
  - Enable [pdo_mysql](https://www.php.net/manual/en/ref.pdo-mysql.php) extension
  - On Windows, only uncomment the following line in `php.ini`


    extension=pdo_mysql

- Install [Composer](https://getcomposer.org/download/)
- Install [MySQL](https://www.mysql.com/downloads/)
  - Or (recommended) use Docker engine and run MySQL server as Docker container. 
  - Run the following command (more information [here](https://hub.docker.com/_/mysql))
  

    docker run --name mysql -e MYSQL_ROOT_PASSWORD=root -p 3306:3306 -d mysql


* Check `app\config\local.neon` file configuration to match your database connection credentials.
* Run `seed.sql` file against the database. 
  * You can use any MySQL database client, for example the official one [MySQL Workbench](https://www.mysql.com/products/workbench/)
  * There is also an [adminer](https://www.adminer.org/) web client attached in the project
    * You can access it via `/adminer.php` url address when the web server will be running
* Update dependencies with the following command in the project root directory 


    compose install

* Run web server with the following command in the project root directory


	php -S localhost:8000 -t www

Then visit `http://localhost:8000` in your browser to see the home page.

## Unit Tests

You can run unit tests with the following command

    vendor\bin\tester .

## Static Code Analysis

You can check the code for errors using the following command
* Ensure that web server is running


    vendor\bin\phpstan analyse app