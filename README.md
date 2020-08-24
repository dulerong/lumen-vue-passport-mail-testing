# 新北市2019年生育資料
我用了台灣政府開放平台 DATA.GOV.TW 的民國108年新北市生育數據API 做了以新北市12行政區，生育年齡，胎數及性別的數據統計SPA

[政府資料開放平台](https://data.gov.tw/)

## Getting Started

### Install dependencies
```
composer install
npm install
```

### Configure env file
Make an env file and insert the following

* APP_NAME=Your app name
* APP_ENV=local
* APP_KEY=please insert a 32 character random key here
* APP_DEBUG=true
* APP_URL=http://localhost:8000

### Configure database in env file
Insert the following in env

* DB_CONNECTION=mysql
* DB_HOST=127.0.0.1
* DB_PORT=3306
* DB_DATABASE=yourDatabaseName
* DB_USERNAME=yourDatabaseUserName
* DB_PASSWORD=yourDatabasePassword

### Run migration, install passport
```
php artisan migrate
php artisan passport:install
```

### Configure passport in env file
After installing passport, two oauth client secrets will be generated, **personal access** and **password grant**

* PASSPORT_LOGIN_ENDPOINT="http://localhost:8000/oauth/token"
* PASSPORT_CLIENT_ID=2
* PASSPORT_CLIENT_SECRET= password grant client secret

### Configure mailer in env file
In order to use mailgun, you have to sign up for a free account at [mailgun](https://www.mailgun.com/)

After signing up, insert the following in env file.

* MAIL_MAILER=smtp
* MAIL_HOST=smtp.mailgun.org
* MAIL_PORT=587
* MAIL_USERNAME=your mailgun username
* MAIL_PASSWORD=your mailgun password
* MAIL_ENCRYPTION=tls
* MAIL_FROM_ADDRESS=your mail gun address
* MAIL_FROM_NAME="Your app"
* MAILGUN_DOMAIN=your mailgun domain
* MAILGUN_SECRET=your mailgun secret

### Start localhost server
```php -S localhost:8000 -t public```

### Run NPM watch
```npm run watch```

### Check website in browser
enter localhost:8000 in address, press enter

## Testing:
* Front-end: ```npm run test``` 
* Back-end: ```php vendor/phpunit/phpunit/phpunit```

test file: tests/unit/test.spec.js

## Built With
* Front-end: Vue, Bootstrap-Vue, Vue-Router, Vuex, axios
* Back-end: Lumen, passport, mailgun
* Data storage: MySQL
* Testing: JEST, phpunit

## Authors

**Codey Du**