## Getting started

After clone first, go to you project path folder

    cd to/your/project/path/  

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Generate jwt secret key

    php artisan jwt:secret

Update the database configuration from your .env file

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=middlewise
    DB_USERNAME=root
    DB_PASSWORD=


Run the database migrations & seed with some initial data (**Set the database connection in .env before migrating**)

    php artisan migrate --seed

Start the development Server with this command

    php artisan serve

Your api is now hosted at http://localhost:8000

For broadcasting realtime notification you need to add broadcasting configuration on your .env file

    BROADCAST_DRIVER=pusher

    PUSHER_APP_ID="YOUR_APP_ID"
    PUSHER_APP_KEY="YOUR_APP_KEY"
    PUSHER_APP_SECRET="YOUR_APP_SECRET"
    PUSHER_APP_CLUSTER="YOUR_APP_CLUSTER"

For queuing notifications you have to change .env to:

    QUEUE_CONNECTION=database

Then, generate the queue table, by running this command:

    php artisan queue:table

Then, run the migration again:

    php artisan migrate

Now, listen for queues by running this command 

    php artisan queue:work

Moving oders to delivery table, you should run this command:

    php artisan move:delivered

This commad will run automatically every day at `12:00 AM` (for this server corn set up is required)

#### API Docs


* Admin: 

    https://documenter.getpostman.com/view/9967497/UVBzm94s

* Customer:

    https://documenter.getpostman.com/view/9967497/UVBzm94u

* Public:

    https://documenter.getpostman.com/view/9967497/UVBzm94v

