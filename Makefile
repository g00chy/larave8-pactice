chmod:
	sudo chmod 777 -R src/storage/logs
	sudo chmod 777 -R src/storage/framework
docker-up: chmod
	docker-compose -p laravel8 up -d
docker-kill:
	docker-compose -p laravel8 kill
docker-rm:
	docker-compose -p laravel8 stop
	docker-compose -p laravel8 rm -f
exec-php:
	docker-compose -p laravel8 exec php bash
exec-node:
	docker-compose -p laravel8 exec node sh
migrate:
	docker-compose -p laravel8 exec php ./artisan migrate
artisan-server:
	docker-compose -p laravel8 exec ./artisan 
