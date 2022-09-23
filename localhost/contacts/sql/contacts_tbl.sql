-- auto-generated definition
create table contacts
(
    id           int auto_increment
        primary key,
    name         varchar(40)                         not null,
    surname      varchar(40)                         null,
    phone_number varchar(40)                         not null,
    company      varchar(40)                         null,
    role         varchar(40)                         null,
    picture      varchar(100)                        null,
    email        varchar(40)                         not null,
    created_at   timestamp default CURRENT_TIMESTAMP not null
);

