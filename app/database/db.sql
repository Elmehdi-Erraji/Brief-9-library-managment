create database library ;

create table users(
    
    id int primary key AUTO-INCREMENT,
    fullname varchar(100),
    lastname varchar(100),
    email varchar(255),
    password varchar(255),
    phone varchar(255),
    budget float

);

create table roles(

    id int primary key ,
    name varchar(100)
);

create table roles_users(

    roles_id int,
    users_id int,
    PRIMARY KEY (roles_id,users_id),
    FOREIGN KEY roles_id REFERENCES roles(id),
    FOREIGN KEY users_id REFERENCES users(id)
);


create table book (

    id int primary key AUTO-INCREMENT,
    title varchar(255),
    author varchar(100),
    genre varchar(100),
    description text,
    publication_year date,
    total_copies int ,
    available_copies int
);


create table reservation (

    id int primary key AUTO-INCREMENT,
    description text,
    reservation_date date ,
    return_date date,
    is_returned int,
    book_id int ,
    users_id int,
    FOREIGN KEY (book_id) as book(id),
    FOREIGN KEY (users_id_id) as users_id(id)
);




