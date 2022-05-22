### Getting Started

First, clone the repository:

```bash
git clone https://github.com/MdMostaFizurRahaman/ecommerce.git
```

There are two part of this application.

##### Backend

To run the backend api server, you need to install the dependencies first.

```bash
cd backend && composer install
```

Then copy the `.env.example` file and rename it to `.env` file.

```bash
cp .env.example .env
```

Now, you have to update the `.env` file with your credentials.

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce
DB_USERNAME=root
DB_PASSWORD=
```

Then, you need to migrate the database. For that, you can run the following command:

```bash
php artisan migrate
```

If your want to populate the database with some dummy data, you can run the following command:

```bash
php artisan db:seed
```

To create a `super-admin` user, you can run the following command:

```bash
php artisan generate-super-admin
```

For the notification service, you need to update these `.env` values too.

```

BROADCAST_DRIVER=pusher

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

```

Run this following commands to generate the `APP_KEY` & `JWT_SECRET` key:

```bash
php artisan key:generate
php artisan jwt:secret
```

Now you can run the server.

```bash
php artisan serve
```

For running the queue worker, you need to run

```bash
php artisan queue:work
```

##### Frontend

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
