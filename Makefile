chmod:
	sudo chown $$UID:$$UID -R src/app src/database
	sudo chmod 777 -R src/storage/logs
	sudo chmod 777 -R src/storage/framework
docker-build: docker-kill
	docker-compose -p laravel8 build
docker-logs:
	docker-compose -p laravel8 logs -f
docker-up: chmod
	docker-compose -p laravel8 up -d
docker-kill:
	docker-compose -p laravel8 kill
docker-restart: docker-kill docker-up
docker-rm:
	docker-compose -p laravel8 stop
	docker-compose -p laravel8 rm -f
docker-log-del:
	./docker/script/logs-delete.sh
exec-php:
	docker-compose -p laravel8 exec php sh
exec-node:
	docker-compose -p laravel8 exec node sh
exec-mysql:
	docker-compose -p laravel8 exec db mysql -u docker -p
hot:
	docker-compose -p laravel8 exec node yarn hot
migrate:
	docker-compose -p laravel8 exec php ./artisan migrate
	docker-compose -p laravel8 exec php ./artisan migrate --database=mysql_testing
artisan-server:
	docker-compose -p laravel8 exec ./artisan 
exec-localstack:
	docker-compose -p laravel8 exec localstack sh