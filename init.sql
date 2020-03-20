DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS customers CASCADE;
DROP TABLE IF EXISTS orders CASCADE;
DROP TABLE IF EXISTS stores CASCADE;
DROP TABLE IF EXISTS delivery CASCADE;
DROP TABLE IF EXISTS restaurant CASCADE;

DROP TABLE IF EXISTS restaurantFood CASCADE;

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

CREATE TABLE admin (
	admin_id integer GENERATED ALWAYS AS IDENTITY,
	aName varchar(50) NOT NULL,
	aUsername varchar(100) NOT NULL,
	aPassword varchar(100) NOT NULL,
	aContactNo varchar(8) NOT NULL,
    aRole integer NOT NULL,
	PRIMARY KEY (admin_id)
);

CREATE TABLE orders (
	order_id integer,
	totalOrderCost decimal,
	orderDateTime timestamp,
	deliveryLocation varchar(100),
	deliveryFee decimal,
	PRIMARY KEY (order_id)
);

CREATE TABLE stores (
	customer_id integer,
	delivery_id integer,
	PRIMARY KEY (customer_id, delivery_id)
);

CREATE TABLE delivery (
	delivery_id integer,
	deliveryLocations varchar(500),
	orderedTimestamp timestamp, 
	/* This is for doing the order by desc to get recent locations. 
	Assuming when an Order is made, at the same time we have to add into Delivery at this point in time.
	So no need reference order's date time and get that date & order by based on that.*/
	PRIMARY KEY (delivery_id)
);

CREATE TABLE restaurant (
	restaurant_id integer,
	name varchar(100),
	contactNo varchar(100),
	address varchar (200),
	area varchar (100),
	minMonetaryAmount integer,
	PRIMARY KEY (restaurant_id)
);

CREATE TABLE restaurantFood (
	food_id integer,
	price FLOAT,
	name varchar(100),
	category varchar(100),
	information varchar(500),
	availabilityStatus BOOLEAN DEFAULT FALSE,
	restaurant_id integer,
	PRIMARY KEY (food_id, restaurant_id),
	FOREIGN KEY (restaurant_id) REFERENCES restaurant ON DELETE CASCADE
);

INSERT INTO restaurant(restaurant_id, name, contactNo, address, area, minMonetaryAmount) values(10, 'Rochor Beancurd', '63723101', '787 Geylang Road S389660', 'East', 8);
INSERT INTO restaurantFood(food_id, price, name, category, information, availabilityStatus, restaurant_id) values(10, 2.5, 'Soya Beancurd', 'Dessert', 'Homemade soya beancurd, freshly made daily', true, 10);
INSERT INTO restaurantFood(food_id, price, name, category, information, availabilityStatus, restaurant_id) values(11, 3.5, 'Soya Beancurd with Pearls', 'Dessert', 'Homemade soya beancurd, freshly made daily with pearls', true, 10);

INSERT INTO restaurant(restaurant_id, name, contactNo, address, area, minMonetaryAmount) values(11, 'Popeyes', '63723102', '23 Kallang Wave Road S298102', 'East', 15);
INSERT INTO restaurantFood(food_id, price, name, category, information, availabilityStatus, restaurant_id) values(12, 5.0, '2 Pcs Chicken Set', 'Fast Food', 'Fried upon order, with Popeyes secret batter', true, 11);

INSERT INTO restaurant(restaurant_id, name, contactNo, address, area, minMonetaryAmount) values(12, 'Texas', '63723103', '45 Kallang Wave Road S298119', 'East', 15);
INSERT INTO restaurantFood(food_id, price, name, category, information, availabilityStatus, restaurant_id) values(13, 5.5, '2 Pcs Chicken Set', 'Fast Food', 'Fried upon order, with Texas secret batter', true, 12);

INSERT INTO restaurant(restaurant_id, name, contactNo, address, area, minMonetaryAmount) values(13, 'Playmade', '63723104', '22 Upper Paya Lebar Road S380290', 'East', 5);
INSERT INTO restaurantFood(food_id, price, name, category, information, availabilityStatus, restaurant_id) values(14, 3.5, 'Chrysanthemum Tea', 'Bubble Tea', 'Freshly brewed chrysanthemum tea', true, 13);

INSERT INTO users(user_id, name, username, password, contactNo) values(1, 'Lee Xiao Long', 'leexl', 'password', '81110111');
INSERT INTO users(user_id, name, username, password, contactNo) values(2, 'Lee Xiao Bin', 'leexb', 'password', '81110112');
INSERT INTO users(user_id, name, username, password, contactNo) values(3, 'Lee Xiao Kun', 'leexk', 'password', '81110113');

INSERT INTO customers(customer_id, accumulatedPoints, user_id) values(1, 100, 1);
INSERT INTO customers(customer_id, accumulatedPoints, user_id) values(2, 200, 2);
INSERT INTO customers(customer_id, accumulatedPoints, user_id) values(3, 300, 3);

-- INSERT INTO completes(customer_id, order_id, payment_id) values(1, 1, 1);
-- INSERT INTO completes(customer_id, order_id, payment_id) values(1, 2, 2);
-- INSERT INTO completes(customer_id, order_id, payment_id) values(3, 3, 3);

/* Customer 2 - leexb */
INSERT INTO orders(order_id, totalOrderCost, orderDateTime, deliveryLocation, deliveryFee) 
values(3, 70, '2019-6-20 14:23:54', '234 Seng Keng Avenue 3 #21-14 S201010', 10);
INSERT INTO delivery(delivery_id, deliveryLocations, orderedTimestamp) values(3, '234 Seng Keng Avenue 3 #21-14 S201010', current_timestamp);
INSERT INTO stores(customer_id, delivery_id) values (2, 3);

/* Customer 1 - leexl ; Take 5 most recent 5 delivery locations. TEST - Here got 7 now, with 2 same locations*/
/* Should retrieve out 1 Computing Drive, 1 Clementi, Kim Cheng, Boon Tiong, Geylang.
	NOT Barney because Barney those above 5 are the latest 5 via ORDER BY DESC. 
	Or... if don't order by orderDateTime also can, just get from last 5 because every earlier tuple = earlier order.*/
	
/* If 2 Barney is latest recent 2, then should retrieve 1 of them and assume as 2 recent locations or?*/
/* CHECK ^^^^^^^*/
INSERT INTO orders(order_id, totalOrderCost, orderDateTime, deliveryLocation, deliveryFee) 
values(1, 50, '2019-5-19 10:23:54', '123 Barney Road #01-04 S101010', 5);
INSERT INTO delivery(delivery_id, deliveryLocations, orderedTimestamp) values(1, '123 Barney Road #01-04 S101010', current_timestamp);
INSERT INTO stores(customer_id, delivery_id) values (1, 1);

INSERT INTO orders(order_id, totalOrderCost, orderDateTime, deliveryLocation, deliveryFee) 
values(2, 60, '2019-5-20 12:23:54', '123 Barney Road #01-04 S101010', 5);
INSERT INTO delivery(delivery_id, deliveryLocations, orderedTimestamp) values(2, '123 Barney Road #01-04 S101010', current_timestamp);
INSERT INTO stores(customer_id, delivery_id) values (1, 2);

INSERT INTO orders(order_id, totalOrderCost, orderDateTime, deliveryLocation, deliveryFee) 
values(4, 100, '2019-5-24 12:23:54', '34 Computing Drive #4-21 S301010', 8);
INSERT INTO delivery(delivery_id, deliveryLocations, orderedTimestamp) values(4, '34 Computing Drive #4-21 S301010', current_timestamp);
INSERT INTO stores(customer_id, delivery_id) values (1, 4);

INSERT INTO orders(order_id, totalOrderCost, orderDateTime, deliveryLocation, deliveryFee) 
values(5, 80, '2019-5-26 12:23:54', '42 Clementi Road S103391', 8);
INSERT INTO delivery(delivery_id, deliveryLocations, orderedTimestamp) values(5, '42 Clementi Road S103391', current_timestamp);
INSERT INTO stores(customer_id, delivery_id) values (1, 5);

INSERT INTO orders(order_id, totalOrderCost, orderDateTime, deliveryLocation, deliveryFee) 
values(6, 20, '2019-6-10 12:23:54', '34 Kim Cheng Street #01-21 S160110', 4);
INSERT INTO delivery(delivery_id, deliveryLocations, orderedTimestamp) values(6, '34 Kim Cheng Street #01-21 S160110', current_timestamp);
INSERT INTO stores(customer_id, delivery_id) values (1, 6);

INSERT INTO orders(order_id, totalOrderCost, orderDateTime, deliveryLocation, deliveryFee) 
values(7, 50, '2019-10-10 20:23:54', '139 Boon Tiong Road S169920', 4);
INSERT INTO delivery(delivery_id, deliveryLocations, orderedTimestamp) values(7, '139 Boon Tiong Road S169920', current_timestamp);
INSERT INTO stores(customer_id, delivery_id) values (1, 7);

INSERT INTO orders(order_id, totalOrderCost, orderDateTime, deliveryLocation, deliveryFee) 
values(8, 100, '2019-10-21 15:23:54', '795 Geylang Road #01-01 S389678', 7);
INSERT INTO delivery(delivery_id, deliveryLocations, orderedTimestamp) values(8, '795 Geylang Road #01-01 S389678', current_timestamp);
INSERT INTO stores(customer_id, delivery_id) values (1, 8);