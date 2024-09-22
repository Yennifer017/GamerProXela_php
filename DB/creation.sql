--Creation
DROP DATABASE gamer_pro_xela; /*For test proposes only*/
CREATE DATABASE gamer_pro_xela WITH OWNER admin;

--Connect
\c gamer_pro_xela

--schemas
CREATE SCHEMA administrative;
CREATE SCHEMA business;
CREATE SCHEMA storage;
CREATE SCHEMA users;