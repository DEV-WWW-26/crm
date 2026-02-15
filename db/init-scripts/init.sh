#!/bin/bash
set -e

sed -i "s/\${DB_USER}/$DB_USER/g" /docker-entrypoint-initdb.d/init.sql
sed -i "s/\${DB_NAME}/$DB_NAME/g" /docker-entrypoint-initdb.d/init.sql
sed -i "s/\${DB_PASS}/$DB_PASS/g" /docker-entrypoint-initdb.d/init.sql
