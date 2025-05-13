show databases;
create database owe_db;
use owe_db;

create table proverb ( id int auto_increment primary key,
proverb_idiom text not null unique,
translation text not null default "Translation not available at the moment",
interpretation text not null default "Interpretation not available at the moment",
background text not null default "Background not available at the moment",
type enum("proverb", "idiom") not null);

create table feedback(id int auto_increment primary key, 
email_hash nvarchar(64) not null,
feedback text not null, 
proverb_id int not null,
foreign key(proverb_id) references proverb(id));

create table suggested_proverb (id int auto_increment primary key ,
 email nvarchar(255) not null,
proverb_idiom text not null unique,
meaning text not null 
 );