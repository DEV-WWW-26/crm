<?php

namespace config\db;

enum EnvironmentVarsEnum: string
{
    case host = 'DB_HOST';
    case db = 'DB_NAME';
    case user = 'DB_USER';
    case pass = 'DB_PASS';
}