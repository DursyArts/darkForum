create table comments
(
    ID        int auto_increment
        primary key,
    thread_id int          null,
    owner     varchar(255) null,
    date      varchar(255) null,
    content   text         null
);

create table threads
(
    ID      int auto_increment
        primary key,
    owner   varchar(255) null,
    date    varchar(255) null,
    content text         not null,
    title   varchar(255) null
);

create table user
(
    ID           int auto_increment
        primary key,
    username     varchar(255) null,
    password     varchar(255) null,
    ip           varchar(255) null,
    email        varchar(255) null,
    role         varchar(255) null,
    post_count   int          null,
    thread_count int          null,
    avatar       varchar(255) null
)
    comment 'user table';

