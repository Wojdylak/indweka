setfacl:
	setfacl -dR -m u:www-data:rwX -m u:`whoami`:rwX var; \
	setfacl -R -m u:www-data:rwX -m u:`whoami`:rwX var;

up:
	docker compose up -d

down:
	docker compose down

bash:
	docker compose exec php bash

xdbon:
	docker compose exec -u root php xdbon

xdboff:
	docker compose exec -u root php xdboff
