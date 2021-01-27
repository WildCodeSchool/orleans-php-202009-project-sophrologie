README Project 3 - Sophrology

Environment PHP 7.4 - Symfony 5.1.10 - Composer

Install :

Run git clone https://github.com/WildCodeSchool/orleans-php-202009-project-sophrologie

Run composer install

Run php bin/console ckeditor:install

Run php bin/console assets:install public

Run yarn install

Run yarn encore dev to build assets

Create .env.local from .env and uncomment line DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name

MAILER_DSN=smtp://localhost

localhost = value

Run symfony console doctrine:database:create

Run symfony console doctrine:migration:migrate

Run symfony console doctrine:fixtures:load

Working :

Run symfony server:start to launch your local php web server

Run yarn encore dev --watch to launch your local server for assets
 

