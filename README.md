run composer install
docker-compose up -d
docker-compose up
for get into container use command below
    docker exec -it habr_laravel.test_1 sh
run cp .env.example .env

have to install heidisql or similar.Create db with the .env creds.
php artisan migrate

----- Postman Documentations------
https://documenter.getpostman.com/view/16271706/Uz5FJbtM
https://documenter.getpostman.com/view/16271706/Uz5FJbtP
https://documenter.getpostman.com/view/16271706/Uz5FJbtQ
https://documenter.getpostman.com/view/16271706/Uz5FJbtS

------Heroku app------
https://habr-app.herokuapp.com/

