<div align='center'>

# COVID Vaccine Registration System

</div>


### Packages 
- #### [Artisan View](https://github.com/svenluijten/artisan-view)
- #### [Laravel Pint](https://github.com/laravel/pint)
- #### [PEST Framework](https://pestphp.com)



## How to run this project

### Configuration
- PHP-8.1
- Laravel-10

### Update Your Composer 
```bash
composer update
```

### ENV Setup 
- Please create `.env` file and copy-paste data from the `.env.example` file.
- You have to setup database related credentials properly in .env
- You have to setup mail related credentials properly.
- You have to setup QUEUE_CONNECTION=database to run Queue for sending mail
- Set APP_TIMEZONE=Asia/Dhaka


### Generate APP_KEY
```bash
php artisan key:generate
```

### Queue Table
```bash
php artisan queue:table
```

### Migrate 
<h5>Just run this command</h5>

```bash
php artisan migrate
```

### Seeder

```bash
php artisan db:seed
```

### Run Project 
```bash
php artisan serve
```

### Runnig Queue before send email 
```bash
php artisan queue:work
```

<!-- ### Alternatively, you may run the queue:listen command.
```bash
php artisan queue:listen
``` -->

### To Test CORN JOB 
```bash
php artisan reminder:send
```




## Test Case Result 

