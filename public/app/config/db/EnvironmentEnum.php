<?php

namespace config\db;

enum EnvironmentVarsEnum: string
{
    case db = 'MYSQL_DATABASE';
    case user = 'MYSQL_USER';
    case pass = 'MYSQL_PASSWORD';
}