DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS customers CASCADE;
DROP TABLE IF EXISTS orders CASCADE;
DROP TABLE IF EXISTS stores CASCADE;
DROP TABLE IF EXISTS delivery CASCADE;
DROP TABLE IF EXISTS restaurant CASCADE;
DROP TABLE IF EXISTS restaurantFood CASCADE;
DROP TABLE IF EXISTS restaurantStaff CASCADE;
DROP TABLE IF EXISTS fdsManager CASCADE;
DROP TABLE IF EXISTS rider CASCADE;
DROP TABLE IF EXISTS partTimeRider CASCADE;
DROP TABLE IF EXISTS fullTimeRider CASCADE;
DROP TABLE IF EXISTS ftOwns CASCADE;
DROP TABLE IF EXISTS ptOwns CASCADE;
DROP TABLE IF EXISTS monthlyWorkSchedule CASCADE;
DROP TABLE IF EXISTS weeklyWorkSchedule CASCADE;
DROP TABLE IF EXISTS promotion CASCADE;
DROP TABLE IF EXISTS contain CASCADE;
DROP TABLE IF EXISTS completes CASCADE;
DROP TABLE IF EXISTS creditCardDetails CASCADE;
DROP TABLE IF EXISTS pointTransaction CASCADE;
DROP TABLE IF EXISTS payment CASCADE;
DROP TABLE IF EXISTS shift CASCADE;
DROP TABLE IF EXISTS workingDays CASCADE;

CREATE TABLE users (
	userId integer GENERATED ALWAYS AS IDENTITY,
	name varchar(50) NOT NULL,
	username varchar(100) UNIQUE NOT NULL,
	password varchar(100) NOT NULL,
	contactNo varchar(8) NOT NULL,
	PRIMARY KEY (userId) 
);

CREATE TABLE customers (
	customerId integer GENERATED ALWAYS AS IDENTITY,
	accumulatedPoints integer,
	userId integer,
	PRIMARY KEY (customerId), 
	FOREIGN KEY (userId) REFERENCES users ON DELETE CASCADE
);

CREATE TABLE restaurantStaff (
	userId integer PRIMARY KEY REFERENCES users ON DELETE CASCADE
);

CREATE TABLE fdsManager (
	userId integer PRIMARY KEY REFERENCES users ON DELETE CASCADE
);

CREATE TABLE rider (
	riderId integer PRIMARY KEY REFERENCES users ON DELETE CASCADE	 
);

CREATE TABLE partTimeRider (
	riderId integer PRIMARY KEY REFERENCES rider ON DELETE CASCADE,
	weeklyBaseSalary float
);

CREATE TABLE fullTimeRider (
	riderId integer PRIMARY KEY REFERENCES rider ON DELETE CASCADE,
	monthlyBaseSalary float
);

CREATE TABLE weeklyWorkSchedule (
	weeklyWsId integer GENERATED ALWAYS AS IDENTITY,
    operateStartTime TimeStamp,
    operateEndTime TimeStamp,
    breakStartTime TimeStamp,
    breakEndTime TimeStamp,
    day integer,
    month integer,
    year integer,
    duration integer,
	PRIMARY KEY(weeklyWsId)
);


CREATE TABLE shift (
	shiftId integer GENERATED ALWAYS AS IDENTITY,
	PRIMARY KEY (shiftId)
);

CREATE TABLE workingDays (
	workingDayId integer GENERATED ALWAYS AS IDENTITY,
	workingday integer,
	workingdayhours integer,
	PRIMARY KEY (workingDayId)
);


CREATE TABLE ftOwns (
	riderId integer,
	workingDayId integer,
	shiftId integer,
	month integer,
	PRIMARY KEY (riderId, workingDayId, shiftId),
	FOREIGN KEY (riderId) REFERENCES fullTimeRider,
	FOREIGN KEY (workingDayId) REFERENCES workingDays,
	FOREIGN KEY (shiftId) REFERENCES shift
);

CREATE TABLE ptOwns (
	riderId integer,
	weeklyWorkSchedule integer,
	FOREIGN KEY (riderId) REFERENCES partTimeRider,
	FOREIGN KEY (weeklyWorkSchedule) REFERENCES weeklyWorkSchedule
);

CREATE TABLE restaurant (
	restaurantId integer PRIMARY KEY GENERATED ALWAYS AS IDENTITY,
	name varchar(100) NOT NULL,
	contactNo varchar(100) NOT NULL,
	address varchar (200) NOT NULL,
	area varchar (100) NOT NULL,
	minMonetaryAmount integer
);

CREATE TABLE promotion (
	promotionId integer PRIMARY KEY GENERATED ALWAYS AS IDENTITY,
	information varchar (500),
	promoStartDate date NOT NULL,
	promoEndDate date NOT NULL,
	discountAmount float NOT NULL,
	restaurantId integer,
	FOREIGN KEY (restaurantId) REFERENCES restaurant ON DELETE CASCADE
);

CREATE TABLE restaurantFood (
	price FLOAT NOT NULL,
	name varchar(100),
	category varchar(100) NOT NULL,
	information varchar(500),
	availabilityStatus BOOLEAN DEFAULT FALSE,
	restaurantId integer,
	dailyLimit integer,
	PRIMARY KEY (name, restaurantId),
	FOREIGN KEY (restaurantId) REFERENCES restaurant ON DELETE CASCADE
);

CREATE TABLE orders (
	orderId integer GENERATED ALWAYS AS IDENTITY,
	totalOrderCost float NOT NULL,
	orderDateTime timestamp NOT NULL,
	deliveryLocation varchar(100) NOT NULL,
	deliveryFee float NOT NULL,
	promotionId integer,
	PRIMARY KEY (orderId),
	FOREIGN KEY (promotionId) REFERENCES promotion
);

CREATE TABLE contain (
	containId integer,
	quantity integer NOT NULL,
	orderId integer,
	name varchar(100),
	restaurantId integer,
	PRIMARY KEY (containId, orderId, name), 
	FOREIGN KEY (name, restaurantId) REFERENCES restaurantFood(name, restaurantId),
	FOREIGN KEY	(orderId) REFERENCES orders
);

CREATE TABLE payment (
	paymentId integer PRIMARY KEY GENERATED ALWAYS AS IDENTITY,
	paymentType varchar(20) NOT NULL,
	paymentAmount float NOT NULL,
	orderId integer,
	FOREIGN KEY (orderId) REFERENCES orders 
);

CREATE TABLE completes (
	completeId integer,
    completedDateTime TimeStamp,
	restaurantId integer,
	riderId integer,
	customerId integer,
	ratingScale integer,
	reviewDetails varchar(500),
	paymentId integer,
	PRIMARY KEY (completeId, restaurantId, riderId),
	FOREIGN KEY (customerId) REFERENCES customers,
	FOREIGN KEY (paymentId) REFERENCES payment,
	FOREIGN KEY (riderId) REFERENCES rider,
	FOREIGN KEY (restaurantId) REFERENCES restaurant
);

CREATE TABLE stores (
	customerId integer,
	deliveryId integer,
	PRIMARY KEY (customerId, deliveryId)
);

CREATE TABLE creditCardDetails (
	cardNumber integer NOT NULL,
	cardHolderName varchar (100),
	cvvNumber integer NOT NULL,
	expiryDate date NOT NULL,
	customerId integer,
	PRIMARY KEY (customerId, cardNumber),
	FOREIGN KEY (customerId) REFERENCES customers ON DELETE CASCADE	
);

CREATE TABLE delivery (
	deliveryId integer PRIMARY KEY GENERATED ALWAYS AS IDENTITY,
	deliveryLocation varchar(500) NOT NULL,
	customerId integer,
	orderedTimestamp timestamp,
    riderId integer,
    ordersId integer,
    FOREIGN KEY (ordersId) REFERENCES orders,
    FOREIGN KEY (riderId) REFERENCES rider,
	FOREIGN KEY (customerId) REFERENCES customers
);

CREATE TABLE pointTransaction (
	pointsId integer PRIMARY KEY GENERATED ALWAYS AS IDENTITY,
	points integer NOT NULL,
	pointsTransactedDate date NOT NULL,
	customerId integer,
	FOREIGN KEY (customerId) REFERENCES customers 
);

INSERT INTO restaurant(name, contactNo, address, area, minMonetaryAmount) values('Rochor Beancurd', '63723101', '787 Geylang Road S389660', 'East', 8);
INSERT INTO restaurantFood(price, name, category, information, availabilityStatus, restaurantId, dailyLimit) values(2.5, 'Soya Beancurd', 'Dessert', 'Homemade soya beancurd, freshly made daily', true, 1, 100);
INSERT INTO restaurantFood(price, name, category, information, availabilityStatus, restaurantId, dailyLimit) values(3.5, 'Soya Beancurd with Pearls', 'Dessert', 'Homemade soya beancurd, freshly made daily with pearls', true, 1, 150);

INSERT INTO restaurant(name, contactNo, address, area, minMonetaryAmount) values('Popeyes', '63723102', '23 Kallang Wave Road S298102', 'East', 15);
INSERT INTO restaurantFood(price, name, category, information, availabilityStatus, restaurantId, dailyLimit) values(5.0, '2 Pcs Chicken Set', 'Fast Food', 'Fried upon order, with Popeyes secret batter', true, 2, 130);

INSERT INTO restaurant(name, contactNo, address, area, minMonetaryAmount) values('Texas', '63723103', '45 Kallang Wave Road S298119', 'East', 15);
INSERT INTO restaurantFood(price, name, category, information, availabilityStatus, restaurantId, dailyLimit) values(5.5, '2 Pcs Chicken Set', 'Fast Food', 'Fried upon order, with Texas secret batter', true, 3, 90);

INSERT INTO restaurant(name, contactNo, address, area, minMonetaryAmount) values('Playmade', '63723104', '22 Upper Paya Lebar Road S380290', 'East', 5);
INSERT INTO restaurantFood(price, name, category, information, availabilityStatus, restaurantId, dailyLimit) values(3.5, 'Chrysanthemum Tea', 'Bubble Tea', 'Freshly brewed chrysanthemum tea', true, 4, 200);

INSERT INTO users(name, username, password, contactNo) values('Lee Xiao Long', 'leexl', 'password', '81110111');
INSERT INTO users(name, username, password, contactNo) values('Lee Xiao Bin', 'leexb', 'password', '81110112');
INSERT INTO users(name, username, password, contactNo) values('Lee Xiao Kun', 'leexk', 'password', '81110113');

INSERT INTO customers(accumulatedPoints, userId) values(100, 1);
INSERT INTO customers(accumulatedPoints, userId) values(200, 2);
INSERT INTO customers(accumulatedPoints, userId) values(300, 3);

INSERT INTO orders(totalOrderCost, orderDateTime, deliveryLocation, deliveryFee) 
values(70, '2019-6-20 14:23:54', '234 Seng Keng Avenue 3 #21-14 S201010', 10);
INSERT INTO delivery(deliveryLocation, orderedTimestamp) values('234 Seng Keng Avenue 3 #21-14 S201010', current_timestamp);
INSERT INTO stores(customerId, deliveryId) values (2, 3);

INSERT INTO orders(totalOrderCost, orderDateTime, deliveryLocation, deliveryFee) 
values(50, '2019-5-19 10:23:54', '123 Barney Road #01-04 S101010', 5);
INSERT INTO delivery(deliveryLocation, orderedTimestamp) values('123 Barney Road #01-04 S101010', current_timestamp);
INSERT INTO stores(customerId, deliveryId) values (1, 1);

INSERT INTO orders(totalOrderCost, orderDateTime, deliveryLocation, deliveryFee) 
values(60, '2019-5-20 12:23:54', '123 Barney Road #01-04 S101010', 5);
INSERT INTO delivery(deliveryLocation, orderedTimestamp) values('123 Barney Road #01-04 S101010', current_timestamp);
INSERT INTO stores(customerId, deliveryId) values (1, 2);

INSERT INTO orders(totalOrderCost, orderDateTime, deliveryLocation, deliveryFee) 
values(100, '2019-5-24 12:23:54', '34 Computing Drive #4-21 S301010', 8);
INSERT INTO delivery(deliveryLocation, orderedTimestamp) values('34 Computing Drive #4-21 S301010', current_timestamp);
INSERT INTO stores(customerId, deliveryId) values (1, 4);

INSERT INTO orders(totalOrderCost, orderDateTime, deliveryLocation, deliveryFee) 
values(80, '2019-5-26 12:23:54', '42 Clementi Road S103391', 8);
INSERT INTO delivery(deliveryLocation, orderedTimestamp) values('42 Clementi Road S103391', current_timestamp);
INSERT INTO stores(customerId, deliveryId) values (1, 5);

INSERT INTO orders(totalOrderCost, orderDateTime, deliveryLocation, deliveryFee) 
values(20, '2019-6-10 12:23:54', '34 Kim Cheng Street #01-21 S160110', 4);
INSERT INTO delivery(deliveryLocation, orderedTimestamp) values('34 Kim Cheng Street #01-21 S160110', current_timestamp);
INSERT INTO stores(customerId, deliveryId) values (1, 6);

INSERT INTO orders(totalOrderCost, orderDateTime, deliveryLocation, deliveryFee) 
values(50, '2019-10-10 20:23:54', '139 Boon Tiong Road S169920', 4);
INSERT INTO delivery(deliveryLocation, orderedTimestamp) values('139 Boon Tiong Road S169920', current_timestamp);
INSERT INTO stores(customerId, deliveryId) values (1, 7);

INSERT INTO orders(totalOrderCost, orderDateTime, deliveryLocation, deliveryFee) 
values(100, '2019-10-21 15:23:54', '795 Geylang Road #01-01 S389678', 7);
INSERT INTO delivery(deliveryLocation, orderedTimestamp) values('795 Geylang Road #01-01 S389678', current_timestamp);
INSERT INTO stores(customerId, deliveryId) values (1, 8);

/*
INSERT INTO restaurant(restaurantId, name, contactNo, address, area, minMonetaryAmount) values(10, 'Rochor Beancurd', '63723101', '787 Geylang Road S389660', 'East', 8);
INSERT INTO restaurantFood(foodId, price, name, category, information, availabilityStatus, restaurantId) values(10, 2.5, 'Soya Beancurd', 'Dessert', 'Homemade soya beancurd, freshly made daily', true, 10);
INSERT INTO restaurantFood(foodId, price, name, category, information, availabilityStatus, restaurantId) values(11, 3.5, 'Soya Beancurd with Pearls', 'Dessert', 'Homemade soya beancurd, freshly made daily with pearls', true, 10);

INSERT INTO restaurant(restaurantId, name, contactNo, address, area, minMonetaryAmount) values(11, 'Popeyes', '63723102', '23 Kallang Wave Road S298102', 'East', 15);
INSERT INTO restaurantFood(foodId, price, name, category, information, availabilityStatus, restaurantId) values(12, 5.0, '2 Pcs Chicken Set', 'Fast Food', 'Fried upon order, with Popeyes secret batter', true, 11);

INSERT INTO restaurant(restaurantId, name, contactNo, address, area, minMonetaryAmount) values(12, 'Texas', '63723103', '45 Kallang Wave Road S298119', 'East', 15);
INSERT INTO restaurantFood(foodId, price, name, category, information, availabilityStatus, restaurantId) values(13, 5.5, '2 Pcs Chicken Set', 'Fast Food', 'Fried upon order, with Texas secret batter', true, 12);

INSERT INTO restaurant(restaurantId, name, contactNo, address, area, minMonetaryAmount) values(13, 'Playmade', '63723104', '22 Upper Paya Lebar Road S380290', 'East', 5);
INSERT INTO restaurantFood(foodId, price, name, category, information, availabilityStatus, restaurantId) values(14, 3.5, 'Chrysanthemum Tea', 'Bubble Tea', 'Freshly brewed chrysanthemum tea', true, 13);

INSERT INTO users(userId, name, username, password, contactNo) values(1, 'Lee Xiao Long', 'leexl', 'password', '81110111');
INSERT INTO users(userId, name, username, password, contactNo) values(2, 'Lee Xiao Bin', 'leexb', 'password', '81110112');
INSERT INTO users(userId, name, username, password, contactNo) values(3, 'Lee Xiao Kun', 'leexk', 'password', '81110113');

INSERT INTO customers(customerId, accumulatedPoints, userId) values(1, 100, 1);
INSERT INTO customers(customerId, accumulatedPoints, userId) values(2, 200, 2);
INSERT INTO customers(customerId, accumulatedPoints, userId) values(3, 300, 3);

INSERT INTO orders(orderId, totalOrderCost, orderDateTime, deliveryLocation, deliveryFee) 
values(3, 70, '2019-6-20 14:23:54', '234 Seng Keng Avenue 3 #21-14 S201010', 10);
INSERT INTO delivery(deliveryId, deliveryLocation, orderedTimestamp) values(3, '234 Seng Keng Avenue 3 #21-14 S201010', current_timestamp);
INSERT INTO stores(customerId, deliveryId) values (2, 3);

INSERT INTO orders(orderId, totalOrderCost, orderDateTime, deliveryLocation, deliveryFee) 
values(1, 50, '2019-5-19 10:23:54', '123 Barney Road #01-04 S101010', 5);
INSERT INTO delivery(deliveryId, deliveryLocation, orderedTimestamp) values(1, '123 Barney Road #01-04 S101010', current_timestamp);
INSERT INTO stores(customerId, deliveryId) values (1, 1);

INSERT INTO orders(orderId, totalOrderCost, orderDateTime, deliveryLocation, deliveryFee) 
values(2, 60, '2019-5-20 12:23:54', '123 Barney Road #01-04 S101010', 5);
INSERT INTO delivery(deliveryId, deliveryLocation, orderedTimestamp) values(2, '123 Barney Road #01-04 S101010', current_timestamp);
INSERT INTO stores(customerId, deliveryId) values (1, 2);

INSERT INTO orders(orderId, totalOrderCost, orderDateTime, deliveryLocation, deliveryFee) 
values(4, 100, '2019-5-24 12:23:54', '34 Computing Drive #4-21 S301010', 8);
INSERT INTO delivery(deliveryId, deliveryLocation, orderedTimestamp) values(4, '34 Computing Drive #4-21 S301010', current_timestamp);
INSERT INTO stores(customerId, deliveryId) values (1, 4);

INSERT INTO orders(orderId, totalOrderCost, orderDateTime, deliveryLocation, deliveryFee) 
values(5, 80, '2019-5-26 12:23:54', '42 Clementi Road S103391', 8);
INSERT INTO delivery(deliveryId, deliveryLocation, orderedTimestamp) values(5, '42 Clementi Road S103391', current_timestamp);
INSERT INTO stores(customerId, deliveryId) values (1, 5);

INSERT INTO orders(orderId, totalOrderCost, orderDateTime, deliveryLocation, deliveryFee) 
values(6, 20, '2019-6-10 12:23:54', '34 Kim Cheng Street #01-21 S160110', 4);
INSERT INTO delivery(deliveryId, deliveryLocation, orderedTimestamp) values(6, '34 Kim Cheng Street #01-21 S160110', current_timestamp);
INSERT INTO stores(customerId, deliveryId) values (1, 6);

INSERT INTO orders(orderId, totalOrderCost, orderDateTime, deliveryLocation, deliveryFee) 
values(7, 50, '2019-10-10 20:23:54', '139 Boon Tiong Road S169920', 4);
INSERT INTO delivery(deliveryId, deliveryLocation, orderedTimestamp) values(7, '139 Boon Tiong Road S169920', current_timestamp);
INSERT INTO stores(customerId, deliveryId) values (1, 7);

INSERT INTO orders(orderId, totalOrderCost, orderDateTime, deliveryLocation, deliveryFee) 
values(8, 100, '2019-10-21 15:23:54', '795 Geylang Road #01-01 S389678', 7);
INSERT INTO delivery(deliveryId, deliveryLocation, orderedTimestamp) values(8, '795 Geylang Road #01-01 S389678', current_timestamp);
INSERT INTO stores(customerId, deliveryId) values (1, 8);
*/