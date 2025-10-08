use javacoffee;

create table drinks (
    ID int unsigned not NULL auto_increment primary key,
    name varchar(50) not NULL,
    description varchar(255) not NULL
);

create table categories (
    ID int unsigned not NULL auto_increment primary key,
    name varchar(50) not NULL,
    price float(5,2) not NULL,
    drinksid int unsigned not NULL,
    foreign key (drinksid) references drinks(ID)
);

create table receipts (
    ID int unsigned not NULL auto_increment primary key,
    orderdate datetime not NULL
);

create table orders (
    ID int unsigned not NULL auto_increment primary key,
    categoryid int unsigned not NULL,
    quantity int unsigned not NULL,
    receiptid int unsigned not NULL,
    foreign key (categoryid) references categories(ID),
    foreign key (receiptid) references receipts(ID)
);

