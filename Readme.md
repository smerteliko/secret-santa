
Secret santa

В .env изменить \
DATABASE_URL="postgresql://main:main@**setDockerPTGRSIp**:5432/main?serverVersion=16&charset=utf8"

MAILER_DSN=""

EMAIL_TO_SEND_FROM=""


1) make build
2) make up
3) make db_diff
4) make db_migrate

Не смог проверить через сервер вроде gmail но отправку можно отследить в БД