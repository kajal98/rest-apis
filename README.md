# Rest APIs for User CRUD operation in Laravel v8.75

1. Clone the repo by **git clone https://github.com/kajal98/rest-apis.git**
2. Install the composer by **composer install** command.
3. Set env variables (Must set mail configurations)
4. Start the server by **php artisan serve** command.

## To use postman colletion :

1. Import postman collection file in your postman
2. Set global variables in postman as below
	1. url = SERVER_URL (In my case its http://localhost::8000)
	2. admin_token = ADMIN_TOKEN
	3. user_token = USER_TOKEN
3. Now you are ready to run the APIs

## Packages used in it :

1. tymon/jwt-auth (https://github.com/tymondesigns/jwt-auth)
2. api-ecosystem-for-laravel/dingo-api (https://github.com/api-ecosystem-for-laravel/dingo-api)
3. cviebrock/eloquent-sluggable (https://github.com/cviebrock/eloquent-sluggable)
4. laravel/telescope (https://github.com/laravel/telescope)

## PHPCS standard

To check PHPCS standard first please install **sudo apt install php-codesniffer** and then run the below command in terminal

	phpcs --standard=PSR2 --extensions=php --ignore=bootstrap,config,public/adminer.php,resources,storage,routes,tests,vendor,database/migrations,database/seeds,Envoy.blade.php,public/index.php --exclude=Generic.Files.LineLength .
	
## Email templates used in this repo
1. For verify email


![Verify email - kjlkajal98@gmail com - Gmail](https://user-images.githubusercontent.com/18494848/161420133-7266b896-2ba8-4089-8102-cf9197c6e6b6.png)
	
2. For welcome


![Welcome - kjlkajal98@gmail com - Gmail](https://user-images.githubusercontent.com/18494848/161420159-dc2fdd15-3402-46b9-a873-b7f5742b5e3b.png)

3. For forgot password


![Reset your password - kjlkajal98@gmail com - Gmail](https://user-images.githubusercontent.com/18494848/161420170-0cf2fd6d-b6bf-4950-a391-188a9b144e50.png)

4. For reset password


![Password reset successfully - kjlkajal98@gmail com - Gmail](https://user-images.githubusercontent.com/18494848/161420185-c756c0af-c22a-4754-95af-5937634767f1.png)

