## Getting Started

After clone first, go to your project path folder

    cd to/your/project/path/ 

Install all the dependencies using composer

    npm install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env


Update the database configuration from your .env file

    APP_NAME="YOUR_APP_NAME"
    API_URL=http://localhost:8000/api/
    API_BASE_URL=http://localhost:8000
    WEBSOCKET_KEY="YOUR_PUSHER_KEY"

Start the development Server with this command

    npm run dev

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
