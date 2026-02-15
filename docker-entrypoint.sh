#!/bin/bash
set -e

# Use envsubst to replace env vars in init.sql and execute via psql (for Postgres)
# For MySQL you would use 'mysql' client instead of 'psql'
envsubst < /docker-entrypoint-initdb.d/init.sql | psql -v ON_ERROR_STOP=1 --username "$DB_USER" --dbname "$DB_NAME" --pass "$DB_PASS"

# Call the original entrypoint script to start the database server
exec docker-entrypoint.sh "$@"