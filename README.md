### Getting Started

First, clone the repository:

```bash
git clone https://github.com/MdMostaFizurRahaman/ecommerce.git
```

There are two part of this application.

#### Backend

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
    DB_DATABASE=ecommerce_api
    DB_USERNAME=root
    DB_PASSWORD=

Run the database migrations
(**Set the database connection in .env before migrating**)

    php artisan migrate

Start the development Server with this command

    php artisan serve

Your api is now hosted at http://localhost:8000

To get some initial data, you can run this command

```bash
php artisan db:seed
```

For broadcasting realtime notification you need to add broadcasting configuration on your .env file

    BROADCAST_DRIVER=pusher

    PUSHER_APP_ID="YOUR_APP_ID"
    PUSHER_APP_KEY="YOUR_APP_KEY"
    PUSHER_APP_SECRET="YOUR_APP_SECRET"
    PUSHER_APP_CLUSTER="YOUR_APP_CLUSTER"

For queuing notifications you have to change .env to:

    QUEUE_CONNECTION=database

Now, listen for queues by running this command

    php artisan queue:work

Moving oders to delivery table, you should run this command:

    php artisan move:delivered

This commad will run automatically every day at `12:00 AM` (for this server corn set up is required)

To create a `super-admin` user, you can run the following command:

```bash
php artisan generate:super-admin
```

Your admin login URL will be

```
http://localhost:3000/admin/login
```

You can access this url after completing the frontend setup.

##### API Docs

- Admin:

  https://documenter.getpostman.com/view/9967497/UVBzm94s

- Customer:

  https://documenter.getpostman.com/view/9967497/UVBzm94u

- Public:

  https://documenter.getpostman.com/view/9967497/UVBzm94v

#### Frontend

For the frontend, cd into the `frontend` directory and run the following command.

```bash
npm install
```

Then copy the `.env.example` file and rename it to `.env` file.

```bash
cp .env.example .env
```

Update the `.env` file with your credentials.

```bash
APP_NAME=Wecommerce
API_URL=http://localhost:8000/api/
API_BASE_URL=http://localhost:8000
WEBSOCKET_KEY="YOUR_PUSHER_KEY"
```

Now, you can run the frontend applicaton with the following command.

```bash
npm run dev
```

or

```bash
npm run start
```

Now your frontend application will be running on http://localhost:3000/

![](https://raw.githubusercontent.com/MdMostaFizurRahaman/ecommerce/main/screenshot.png)

##### Build Setup

```bash
# install dependencies
$ npm install

# serve with hot reload at localhost:3000
$ npm run dev

# build for production and launch server
$ npm run build
$ npm run start

# generate static project
$ npm run generate
```

For detailed explanation on how things work, check out the [documentation](https://nuxtjs.org).
