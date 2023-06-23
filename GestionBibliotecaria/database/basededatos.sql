drop database if exists biblioteca;
create database biblioteca;
use biblioteca;

create table users(id bigint auto_increment, name varchar(100),email varchar(100) unique,
created_at datetime,updated_at datetime, password varchar(200), token char(200),
primary key(id));

INSERT INTO `users` (`id`, `name`, `email`, `created_at`, `updated_at`, `password`, `token`) VALUES
(1, 'admin', 'wflatley@example.net', '2023-06-22 18:50:33', '2023-06-22 18:50:33', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'rMsxyri7EJ');