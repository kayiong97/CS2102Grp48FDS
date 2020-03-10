DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS customers CASCADE;

CREATE TABLE users (
	user_id integer,
	name varchar(50) NOT NULL,
	username varchar(100) NOT NULL,
	password varchar(100) NOT NULL,
	contactNo varchar(8) NOT NULL,
	PRIMARY KEY (user_id)
);

CREATE TABLE customers (
	customer_id integer,
	accumulatedPoints integer,
	user_id integer,
	PRIMARY KEY (customer_id),
	FOREIGN KEY (user_id) REFERENCES users
);

INSERT INTO users(user_id, name, username, password, contactNo) values(1, 'Lee Xiao Long', 'leexl', 'password', '81110111');
INSERT INTO users(user_id, name, username, password, contactNo) values(2, 'Lee Xiao Bin', 'leexb', 'password', '81110112');
INSERT INTO users(user_id, name, username, password, contactNo) values(3, 'Lee Xiao Kun', 'leexk', 'password', '81110113');

INSERT INTO customers(customer_id, accumulatedPoints, user_id) values(1, 100, 1);
INSERT INTO customers(customer_id, accumulatedPoints, user_id) values(2, 200, 2);
INSERT INTO customers(customer_id, accumulatedPoints, user_id) values(3, 300, 1);