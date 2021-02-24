API для простой Биржи в сфере услуг.  
Пользователь может быть как исполнителем так и посредником.

API реализованные в этом примере:

- авторизация (логин, пароль)
- создание (название, описание, дата когда выполнить, % посредника) - статус автоматом “В поиске исполнителя”
- отметить как “Выполнен” (номер заказа) - в этом случае заказ и заявка отмечаются как “Выполнен”
- создание (номер заказа - вызывает исполнитель) - нельзя разместить две заявки на 1 заказ, создатель заказа не может разместить заявку к своему заказу
- принять заявку (вызывает Посредник) - помечает эту заявку как “В работе”, помечает заказ как “В работе”



INSTALL

cd service-exchange

composer install

cp .env.example .env

php artisan key:generate

chmod 777 -R ../service-exchange

php artisan vendor:publish --provider="Vessel\VesselServiceProvider"

bash vessel init

./vessel start

./vessel artisan migrate

./vessel artisan db:seed

./vessel artisan passport:install
