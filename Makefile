build:
	docker compose up --build -d
stop:
	docker compose down
start:
	docker compose up -d
destroy:
	docker compose down --volumes --rmi all
shell:
	docker compose exec kata-app sh
