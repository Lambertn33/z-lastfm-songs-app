# Songs App
============

Project for managing the Songs API from https://last.fm/api

After cloning the project:
1. run composer install
2. cp .env.example .env

- in .env add the following keys:

- GOOGLE_CLIENT_ID= your google client id
- GOOGLE_CLIENT_SECRET= your google client secret

- LASTFM_API_KEY=your lastfm API key

LASTFM_API_URL=https://ws.audioscrobbler.com/2.0/

and update the DB keys:

DB_CONNECTION=your connection
DB_HOST=your host
DB_PORT=your port
DB_DATABASE=your DB name
DB_USERNAME=your username
DB_PASSWORD=your password

3. php artisan key:generate
4. php artisan migrate
5. php artisan serve
6. npm run dev

the project is ready on http://localhost:8000/

for testing run:
- php artisan test