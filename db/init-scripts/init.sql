-- DDL for database
create database if not exists db01;

drop user if exists db01_user;
CREATE USER 'db01_user'@'%' IDENTIFIED BY 'irP267H1'; -- todo this is should be replaced by env var, need more time
GRANT SELECT, INSERT, UPDATE, DELETE ON db01.* TO 'db01_user'@'%';

use db01;

create table if not exists users (
    id INT not null AUTO_INCREMENT PRIMARY KEY COMMENT 'Unique row ID',
    first_name VARCHAR(255) NOT NULL COMMENT 'User first name',
    last_name VARCHAR(255) NOT NULL COMMENT 'User last name',
    email VARCHAR(255) NOT NULL COMMENT 'User email',
    password VARCHAR(255) NOT NULL COMMENT 'User password',
    created TIMESTAMP not null DEFAULT CURRENT_TIMESTAMP COMMENT 'When row is added',
    Unique INDEX idx_email(email)
);

create table if not exists cities(
    id INT not null AUTO_INCREMENT PRIMARY KEY COMMENT 'Unique row ID',
    city VARCHAR(255) NOT NULL COMMENT 'City',
    created TIMESTAMP not null DEFAULT CURRENT_TIMESTAMP COMMENT 'When row is added',
    Unique INDEX idx_name(city)
);

create table if not exists address (
    id INT not null AUTO_INCREMENT PRIMARY KEY COMMENT 'Unique row ID',
    city_id int not null COMMENT 'City ID',
    street VARCHAR(255) NOT NULL COMMENT 'Street',
    building VARCHAR(255) NOT NULL COMMENT 'Building',
    created TIMESTAMP not null DEFAULT CURRENT_TIMESTAMP COMMENT 'When row is added',
    FOREIGN KEY (city_id) REFERENCES cities(id)
);

create table if not exists categories (
    id INT not null AUTO_INCREMENT PRIMARY KEY COMMENT 'Unique row ID',
    category VARCHAR(255) NOT NULL COMMENT 'Category',
    created TIMESTAMP not null DEFAULT CURRENT_TIMESTAMP COMMENT 'When row is added'
);

create table if not exists companies (
    id INT not null AUTO_INCREMENT PRIMARY KEY COMMENT 'Unique row ID',
    address_id INT NOT NULL COMMENT 'Foreign key for address ID',
    category_id INT NOT NULL COMMENT 'Foreign key for category ID',
    title VARCHAR(255) NOT NULL COMMENT 'Company title',
    email VARCHAR(255) NULL COMMENT 'Company email',
    phone VARCHAR(255) NULL COMMENT 'Company phone',
    created TIMESTAMP not null DEFAULT CURRENT_TIMESTAMP COMMENT 'When row is added',
    FOREIGN KEY (address_id) REFERENCES address(id),
    FOREIGN KEY (category_id) REFERENCES categories(id),
    Unique INDEX idx_company(title, email)
);

create table if not exists meeting_status (
    id INT not null AUTO_INCREMENT PRIMARY KEY COMMENT 'Unique row ID',
    name VARCHAR(255) NOT NULL COMMENT 'Meeting status name',
    created TIMESTAMP not null DEFAULT CURRENT_TIMESTAMP COMMENT 'When row is added'
);

DELIMITER //

drop procedure if exists fill_meeting_status_table;

CREATE PROCEDURE fill_meeting_status_table()
BEGIN
	declare k int default 0;
SELECT COUNT(*) into k FROM INFORMATION_SCHEMA.TABLES t
WHERE
    t.TABLE_SCHEMA = 'db01' AND t.TABLE_NAME = 'meeting_status';
    if k = 1 then
        insert into meeting_status (name) values ('Пройдено');
        insert into meeting_status (name) values ('В процессе');
        insert into meeting_status (name) values ('Отменено');
    end if;
END //
DELIMITER ;

call fill_meeting_status_table();

create table if not exists meeting_types  (
    id INT not null AUTO_INCREMENT PRIMARY KEY COMMENT 'Unique row ID',
    name VARCHAR(255) NOT NULL COMMENT 'Meeting type name',
    created TIMESTAMP not null DEFAULT CURRENT_TIMESTAMP COMMENT 'When row is added'
);

DELIMITER //

drop procedure if exists fill_meeting_types_table;

CREATE PROCEDURE fill_meeting_types_table ()
BEGIN
	declare k int default 0;
    SELECT COUNT(*) into k FROM INFORMATION_SCHEMA.TABLES
    WHERE
        TABLE_SCHEMA = 'db01' AND TABLE_NAME = 'meeting_types';
    if k = 1 then
        insert into meeting_types (name) values ('Звонок');
        insert into meeting_types (name) values ('Встреча');
    end if;
END //
DELIMITER ;

call fill_meeting_types_table();

create table if not exists meeting_reports (
    id INT not null AUTO_INCREMENT PRIMARY KEY COMMENT 'Unique row ID',
    status_id int not null COMMENT 'Foreign key for status ID',
    type_id int not null COMMENT 'Foreign key for type ID',
    user_id int not null COMMENT 'Foreign key for user ID',
    title VARCHAR(255) NOT NULL COMMENT 'Meeting title',
    description VARCHAR(1000) NULL COMMENT 'Meeting description',
    scheduled TIMESTAMP null COMMENT 'Meeting scheduled date and time',
    created TIMESTAMP not null DEFAULT CURRENT_TIMESTAMP COMMENT 'When row is added',
    FOREIGN KEY (status_id) REFERENCES meeting_status(id),
    FOREIGN KEY (type_id) REFERENCES meeting_types(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);
