install:
	cp .env.example .env
	docker run --rm -u "$(shell id -u):$(shell id -g)" \
        -v "$(shell pwd):/var/www/html" \
        -w /var/www/html \
        laravelsail/php82-composer:latest \
        composer install --ignore-platform-req=ext-intl --ignore-platform-req=ext-gd --ignore-platform-req=ext-exif
	./vendor/bin/sail up -d
	./vendor/bin/sail artisan key:generate
	sleep 5
	./vendor/bin/sail artisan migrate:fresh --seed

up:
	./vendor/bin/sail up -d

down:
	./vendor/bin/sail down
