# Rest APIs for User CRUD operation

1. Clone the repo by ** git clone https://github.com/kajal98/rest-apis.git**.
2. Install the composer by **composer install** command.
3. Set env variables
4. Start the server by **php artisan serve** command.

## Packages used in it :

1. tymon/jwt-auth (https://github.com/tymondesigns/jwt-auth)
2. api-ecosystem-for-laravel/dingo-api (https://github.com/api-ecosystem-for-laravel/dingo-api)
3. cviebrock/eloquent-sluggable (https://github.com/cviebrock/eloquent-sluggable)
4. laravel/telescope (https://github.com/laravel/telescope)

## To use postman colletion :

1. Import postman collection file in your postman
2. Set global variables in postman as below
	1. url = SERVER_URL (In my case its http://localhost::8000)
	2. admin_token = ADMIN_TOKEN
	3. user_token = USER_TOKEN
3. Now you are ready to run the APIs