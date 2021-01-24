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
