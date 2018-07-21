-- *************************************************************
-- This script only creates the stanley14_sandyfeetrental database
-- *************************************************************

-- create the database
-- DROP DATABASE IF EXISTS stanley14_sandyfeetrental;
-- CREATE DATABASE stanle14_sandyfeetrental;

-- select the database
-- USE stanley14_sandyfeetrental;

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS cleaning_rates;
DROP TABLE IF EXISTS user_payment_type;
DROP TABLE IF EXISTS building;
DROP TABLE IF EXISTS property_type;
DROP TABLE IF EXISTS property;
DROP TABLE IF EXISTS property_rate;
DROP TABLE IF EXISTS building_pics;
DROP TABLE IF EXISTS prop_pics;
DROP TABLE IF EXISTS transactions;


CREATE TABLE user
(
  user_id      		INT				PRIMARY KEY	AUTO_INCREMENT,
  user_fName   		VARCHAR(50)	  	NOT NULL,
  user_lName   		VARCHAR(50)	  	NOT NULL,
  user_street  		VARCHAR(50)	  	NOT NULL,
  user_city    		VARCHAR(50)	  	NOT NULL,
  user_state   		CHAR(2)		  	NOT NULL,
  user_zip     		VARCHAR(10)	  	NOT NULL,
  user_phone	 	VARCHAR(13)	  	NOT NULL,
  user_email	 	VARCHAR(100)	NOT NULL,
  user_pass			VARCHAR(200)	NOT NULL,
  user_type			VARCHAR(15)		NOT NULL,
  joining_date		DATETIME		NOT NULL 	DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE cleaning_rates
(
  cleaning_id       INT       		PRIMARY KEY   	AUTO_INCREMENT,
  cleaning_rooms    INT(1)    		NOT NULL 		UNIQUE,
  cleaning_rates	DECIMAL(9,2)	NOT NULL
);

CREATE TABLE user_payment_type
(
  user_pay_id       INT       		PRIMARY KEY   	AUTO_INCREMENT,
  user_pay_type     VARCHAR(25)    	NOT NULL 		UNIQUE
);

CREATE TABLE building
(
  building_id       	INT       		PRIMARY KEY   	AUTO_INCREMENT,
  building_name     	VARCHAR(50)    	NOT NULL 		UNIQUE,
  building_desc			TEXT			NOT NULL
);

CREATE TABLE property_type
(
  prop_type_id           	INT           	PRIMARY KEY   	AUTO_INCREMENT,
  prop_type           		VARCHAR(15)     NOT NULL 		UNIQUE,
  building_id    		   	INT				NOT NULL,
  prop_type_view   			VARCHAR(10),
  prop_type_bedroom			INT(1)			NOT NULL,
  CONSTRAINT prop_type_fk_building
    FOREIGN KEY (building_id)
    REFERENCES building (building_id)
);

CREATE TABLE property
(
  prop_id                     	INT            						PRIMARY KEY   	AUTO_INCREMENT,
  prop_num                   	VARCHAR(5)    						NOT NULL      	UNIQUE,
  prop_type_id             		INT									NOT NULL,
  prop_pet               		SET('Yes','No') 					NOT NULL,
  prop_network             		SET('Yes','No') 					NOT NULL,
  building_id		            INT   		 						NOT NULL,
  user_id						INT									NOT NULL,
  CONSTRAINT property_fk_building
    FOREIGN KEY (building_id)
    REFERENCES building (building_id),
  CONSTRAINT property_fk_user
    FOREIGN KEY (user_id)
    REFERENCES user (user_id),
  CONSTRAINT property_fk_type
    FOREIGN KEY (prop_type_id)
    REFERENCES property_type (prop_type_id)
);

CREATE TABLE property_rate
(
  prop_rate_id            		INT           	PRIMARY KEY   AUTO_INCREMENT,
  prop_type_id            		INT     		NOT NULL,
  prop_rate        				DECIMAL(9,2)   	NOT NULL,
  prop_rate_start         		DATE   			NOT NULL,
  prop_rate_end         		DATE   			NOT NULL,
CONSTRAINT prop_type_fk_type
    FOREIGN KEY (prop_type_id)
    REFERENCES property_type (prop_type_id)
);

CREATE TABLE building_pics
(
  building_pic_id           	INT           	PRIMARY KEY   AUTO_INCREMENT,
  building_id            		INT            	NOT NULL,
  building_pic_desc        		TEXT,
  building_pic         			BLOB   			NOT NULL,
  CONSTRAINT building_pic_fk_building
    FOREIGN KEY (building_id)
    REFERENCES building (building_id)
);

CREATE TABLE prop_pics
(
  prop_pic_id           	INT           	PRIMARY KEY   AUTO_INCREMENT,
  prop_id            		INT            	NOT NULL,
  prop_pic_desc        		TEXT,
  prop_pic         			BLOB   			NOT NULL,
  CONSTRAINT prop_pic_fk_property
    FOREIGN KEY (prop_id)
    REFERENCES property (prop_id)
);

CREATE TABLE transactions
(
  trans_id            	 	INT            	PRIMARY KEY 	AUTO_INCREMENT,
  prop_id		          	INT            	NOT NULL,
  user_id			     	INT				NOT NULL,
  trans_arrive_dt			DATE			NOT NULL,
  trans_depart_dt			DATE			NOT NULL,
  trans_rnt_deposit			DECIMAL(9,2)	NOT NULL,
  trans_pet_deposit			DECIMAL(9,2),
  trans_pet_type			ENUM('Cat','Dog','Cat,Dog'),
  trans_cleaning_fee		DECIMAL(9,2)	NOT NULL,
  trans_rate				DECIMAL(9,2)	NOT NULL,
  user_pay_id				INT				NOT NULL,
  CONSTRAINT trans_fk_user
    FOREIGN KEY (user_id)
    REFERENCES user (user_id)
	ON DELETE CASCADE
	ON UPDATE CASCADE,
  CONSTRAINT trans_fk_prop
    FOREIGN KEY (prop_id)
    REFERENCES property (prop_id)
	ON DELETE CASCADE
	ON UPDATE CASCADE,
  CONSTRAINT trans_fk_payment
    FOREIGN KEY (user_pay_id)
    REFERENCES user_payment_type (user_pay_id)
	ON DELETE CASCADE
	ON UPDATE CASCADE
);

INSERT INTO `user` (`user_id`, `user_fName`, `user_lName`, `user_street`, `user_city`, `user_state`, `user_zip`, `user_phone`, `user_email`, `user_pass`, `user_type`, `joining_date`) VALUES
(1, 'Sandy', 'Claus', '123 North Pole Dr.', 'Snowshoe', 'PA', '23987', '(404)678-0909', 'sandyclaus@com.net', '$2y$10$kbrE1OB0WZnWiraN0iAJluIuImTRcRVjRk5cuNAJ1AkRocP6dDGh6', 'owner', '2018-06-30 21:04:35'),
(2, 'Richard ', 'Compote', '645 Snowpass Road  ', 'Plymouth', 'MD', '48170', '(413)555-9876', 'richc@com.net', '$2y$10$kbrE1OB0WZnWiraN0iAJluIuImTRcRVjRk5cuNAJ1AkRocP6dDGh6', 'owner', '2018-06-30 21:04:35'),
(3, 'Lucille ', 'Livingood', '63 Park Avenue  ', 'New York', 'NY', '12340', '(007)555-3636', 'livingood@com.net', '$2y$10$kbrE1OB0WZnWiraN0iAJluIuImTRcRVjRk5cuNAJ1AkRocP6dDGh6', 'owner', '2018-06-30 21:04:35'),
(4, 'Charles ', 'Brown', '8706 Main Street  ', 'Snowshoe', 'CO', '48000', '(303)555-1236', 'charlie@com.net', '$2y$10$kbrE1OB0WZnWiraN0iAJluIuImTRcRVjRk5cuNAJ1AkRocP6dDGh6', 'owner', '2018-06-30 21:04:35'),
(5, 'Jack ', 'Bauer', '469 Carriage Hill Dr  ', 'Washington', 'DC', '20001', '(713)555-3872', 'jackbauer@com.net', '$2y$10$kbrE1OB0WZnWiraN0iAJluIuImTRcRVjRk5cuNAJ1AkRocP6dDGh6', 'owner', '2018-06-30 21:04:35'),
(6, 'Barbie ', 'Beckwith', '9010 Upper Crust Way  ', 'Littleton', 'NY', '20127', '(007)555-9999', 'babs@com.net', '$2y$10$kbrE1OB0WZnWiraN0iAJluIuImTRcRVjRk5cuNAJ1AkRocP6dDGh6', 'owner', '2018-06-30 21:04:35'),
(7, 'Barney ', 'Rubble', '1616 Stonehenge  ', 'Granite', 'CO', '80234', '(720)555-1456', 'rockhead@com.net', '$2y$10$kbrE1OB0WZnWiraN0iAJluIuImTRcRVjRk5cuNAJ1AkRocP6dDGh6', 'owner', '2018-06-30 21:04:35'),
(8, 'Fred ', 'Flintstone', '26 Quarry Drive  ', 'Granite', 'CO', '80234', '(720)555-7676', 'freddie@com.net', '$2y$10$kbrE1OB0WZnWiraN0iAJluIuImTRcRVjRk5cuNAJ1AkRocP6dDGh6', 'owner', '2018-06-30 21:04:35'),
(9, 'Larry ', 'Lizard', '908 Green Mtn Rd.  ', 'Green Mountain', 'UT', '23987', '(765)555-4392', 'lizard@com.net', '$2y$10$kbrE1OB0WZnWiraN0iAJluIuImTRcRVjRk5cuNAJ1AkRocP6dDGh6', 'owner', '2018-06-30 21:04:35'),
(10, 'Gwen ', 'Grizzlie', '56231 Bear Lane  ', 'Bear Lake', 'MD', '23123', '(413)678-9808', 'griz@com.net', '$2y$10$kbrE1OB0WZnWiraN0iAJluIuImTRcRVjRk5cuNAJ1AkRocP6dDGh6', 'owner', '2018-06-30 21:04:35'),
(11, 'Olivia ', 'Pope', '878 Fort Road  ', 'Washington', 'DC', '20001', '(404)555-8877', 'opa@com.net', '$2y$10$kbrE1OB0WZnWiraN0iAJluIuImTRcRVjRk5cuNAJ1AkRocP6dDGh6', 'owner', '2018-06-30 21:04:35'),
(12, 'Robert ', 'Smith', '5223 Mountain Lane  ', 'Ft. Morgan', 'WV', '34665', '(505)555-1456', 'bobbys@com.net', '$2y$10$kbrE1OB0WZnWiraN0iAJluIuImTRcRVjRk5cuNAJ1AkRocP6dDGh6', 'owner', '2018-06-30 21:04:35'),
(13, 'Luke ', 'Taylors', '375 Windward Way', 'Asheville', 'NC', '28801', '(828)445-9776', 'luket@com.net', '$2y$10$kbrE1OB0WZnWiraN0iAJluIuImTRcRVjRk5cuNAJ1AkRocP6dDGh6', 'owner', '2018-06-30 21:04:35'),
(15, 'John ', 'Grainger', '2256 N Santa Fe Dr.  ', 'Iliase', 'MD', '23456', '(303)444-4475', 'johnny@com.net', '$2y$10$kbrE1OB0WZnWiraN0iAJluIuImTRcRVjRk5cuNAJ1AkRocP6dDGh6', 'renter', '2018-06-30 21:04:35'),
(16, 'Steve ', 'Snider', '39430 Big Rock Road  ', 'Flame Throw', 'TN', '59012', '(717)420-1212', 'snidley@com.net', '$2y$10$kbrE1OB0WZnWiraN0iAJluIuImTRcRVjRk5cuNAJ1AkRocP6dDGh6', 'renter', '2018-06-30 21:04:35'),
(19, 'Brittany', 'Fox', '297-B Gorgonzola  ', 'Cleo', 'KS', '81029', '(616)410-2942', 'bfoxy@com.net', '$2y$10$kbrE1OB0WZnWiraN0iAJluIuImTRcRVjRk5cuNAJ1AkRocP6dDGh6', 'renter', '2018-06-30 21:04:35'),
(20, 'Fran', 'McCoy', '1440 Manchester Way  ', 'Mountain View', 'CO', '87757', '(303)477-8787', 'franm@com.net', '$2y$10$kbrE1OB0WZnWiraN0iAJluIuImTRcRVjRk5cuNAJ1AkRocP6dDGh6', 'renter', '2018-06-30 21:04:35'),
(21, 'Joan', 'Thomaston', '667438 E. 91st St.  ', 'Baseboard', 'PA', '56987', '(616)684-9385', 'joanie@com.net', '$2y$10$kbrE1OB0WZnWiraN0iAJluIuImTRcRVjRk5cuNAJ1AkRocP6dDGh6', 'renter', '2018-06-30 21:04:35'),
(22, 'Ted', 'Stiggle', '12920 Industrial Workers  ', 'Scraggy View', 'CO', '82191', '(303)421-1410', 'thestig@com.et', '$2y$10$kbrE1OB0WZnWiraN0iAJluIuImTRcRVjRk5cuNAJ1AkRocP6dDGh6', 'renter', '2018-06-30 21:04:35'),
(23, 'Dean', 'Farrell', '121 Highway 80  ', 'Excelsior', 'MD', '23498', '(717)483-3111', 'farrelld@com.net', '$2y$10$kbrE1OB0WZnWiraN0iAJluIuImTRcRVjRk5cuNAJ1AkRocP6dDGh6', 'renter', '2018-06-30 21:04:35'),
(24, 'Maureen', 'Waltz', '1900 Industrial Way  ', 'Fargone', 'NC', '41923', '(215)419-2349', 'waltzer@com.net', '$2y$10$kbrE1OB0WZnWiraN0iAJluIuImTRcRVjRk5cuNAJ1AkRocP6dDGh6', 'renter', '2018-06-30 21:04:35'),
(25, 'Janet', 'Logan', '860 Charleston St.  ', 'Oxalys', 'NY', '54133', '(303)441-1321', 'janetlogan@com.net', '$2y$10$kbrE1OB0WZnWiraN0iAJluIuImTRcRVjRk5cuNAJ1AkRocP6dDGh6', 'renter', '2018-06-30 21:04:35'),
(26, 'Linda', 'Paloma', '1928 Highway 12  ', 'Portugal', 'NC', '82394', '(317)423-9417', 'palomafam@com.net', '$2y$10$kbrE1OB0WZnWiraN0iAJluIuImTRcRVjRk5cuNAJ1AkRocP6dDGh6', 'renter', '2018-06-30 21:04:35'),
(27, 'Gregg', 'Hansen', '6065 Rainbow Falls Rd  ', 'Roselle', 'PA', '57203', '(505)472-0398', 'gregghansen@com.net', '$2y$10$kbrE1OB0WZnWiraN0iAJluIuImTRcRVjRk5cuNAJ1AkRocP6dDGh6', 'renter', '2018-06-30 21:04:35'),
(28, 'Pat', 'Carroll', '4018 Landers Lane ', 'Lafayette', 'OH', '34548', '(303)476-2718', 'pcarroll@com.net', '$2y$10$kbrE1OB0WZnWiraN0iAJluIuImTRcRVjRk5cuNAJ1AkRocP6dDGh6', 'renter', '2018-06-30 21:04:35'),
(29, 'Bee', 'Wolf', '1775 Bear Trail  ', 'Outcroppin', 'WY', '74345', '(404)443-4863', 'beew@com.net', '$2y$10$kbrE1OB0WZnWiraN0iAJluIuImTRcRVjRk5cuNAJ1AkRocP6dDGh6', 'renter', '2018-06-30 21:04:35'),
(30, 'Scott', 'Krumple', '580 E Main St.  ', 'La Garita', 'CO', '88413', '(303)444-1324', 'scottk@com.net', '$2y$10$kbrE1OB0WZnWiraN0iAJluIuImTRcRVjRk5cuNAJ1AkRocP6dDGh6', 'renter', '2018-06-30 21:04:35'),
(31, 'Elliot', 'Harvey', '34 Kerry Drive  ', 'El Mano', 'MD', '23646', '(505)406-4647', 'ellioth@com.net', '$2y$10$kbrE1OB0WZnWiraN0iAJluIuImTRcRVjRk5cuNAJ1AkRocP6dDGh6', 'renter', '2018-06-30 21:04:35'),
(32, 'Carrie', 'Zygote', '8607 Ferndale ', 'St  Montgomery', 'AL', '60631', '(303)406-3104', 'carriez@com.net', '$2y$10$kbrE1OB0WZnWiraN0iAJluIuImTRcRVjRk5cuNAJ1AkRocP6dDGh6', 'renter', '2018-06-30 21:04:35'),
(36, 'Kenneth', 'Stanley', '123 Superman Ave.', 'Krypton', 'NC', '28787', '(828)777-7777', 'kennethlstanley@students.abtech.edu', '$2y$10$kbrE1OB0WZnWiraN0iAJluIuImTRcRVjRk5cuNAJ1AkRocP6dDGh6', 'super_admin', '2018-06-30 21:04:35'),
(40, 'Test', 'Tester', '123 Testing', '', 'NC', '28787', '8283374359', 'test@stanleysoft.org', '$2y$10$IKaKP1YlU6lpkNGa95K6eueMM3wxCMwB.tqa0cp0OzOp.RSZH.TsK', 'admin', '2018-07-01 10:49:42');


INSERT INTO user_payment_type VALUES
    (NULL,'AMEX'),
    (NULL,'Mastercard'),
    (NULL,'PayPal'),
    (NULL,'Cash'),
    (NULL,'Visa'),
    (NULL,'Check');
	
INSERT INTO building VALUES
    (NULL,'Sands','Oceanfront complex with large two bedroom two bath and three bedroom three bathroom luxury condos, with generous private balcony, most master baths feature a Jacuzzi tub. The complex is situated to take advantage of the beautiful natural settings including panoramic views of the Atlantic Ocean, Tubbs Inlet, Marshlands, and the Intercoastal Waterway. Amenities include an oceanfront pool, whirlpool'),
    (NULL,'Tides','Located in the community of Ocean Isle West, this exclusive oceanfront complex features two and three bedroom condominiums with two baths. Each condo has an individual balcony, fully-equipped kitchen and access to the oceanfront pool. Located beside the Isles Restaurant. Quiet, family friendly location on the desirable west end of the island. Great for afternoon relaxing and entertainment');
	
INSERT INTO property_type VALUES
    (NULL,'SandsOF2BR',1,'oceanfront','2'),
    (NULL,'SandsOF3BR',1,'oceanfront','3'),
    (NULL,'SandsOV2BR',1,'oceanview','2'),
    (NULL,'SandsOV3BR',1,'oceanview','3'),
    (NULL,'Tides2BR',2,NULL,'2'),
    (NULL,'Tides3BR',2,NULL,'3');

INSERT INTO property VALUES
    (NULL,'301S',2,'Yes','Yes',1,1),
    (NULL,'207S',4,'Yes','Yes',1,2),
    (NULL,'1100T',6,'No','No',2,3),
    (NULL,'1201T',6,'No','Yes',2,4),
    (NULL,'317S',1,'No','Yes',1,5),
    (NULL,'110T',5,'No','Yes',2,6),
    (NULL,'1010S',3,'No','No',1,7),
    (NULL,'409S',1,'Yes','Yes',1,8),
    (NULL,'505T',5,'Yes','No',2,9),
    (NULL,'1005T',6,'Yes','Yes',2,10),
    (NULL,'656S',3,'Yes','No',1,11),
    (NULL,'942S',2,'No','No',1,12),
    (NULL,'517T',6,'Yes','Yes',2,13);
	
	
INSERT INTO cleaning_rates VALUES
    (NULL,2,50),
    (NULL,3,60);

INSERT INTO property_rate VALUES
    (NULL,1,400,'2018-01-01','2018-03-31'),
    (NULL,1,475,'2018-04-01','2018-05-31'),
    (NULL,1,600,'2018-06-01','2018-08-31'),
    (NULL,1,475,'2018-09-01','2018-10-31'),
    (NULL,1,400,'2018-11-01','2018-12-31'),
    (NULL,2,450,'2018-01-01','2018-03-31'),
    (NULL,2,525,'2018-04-01','2018-05-31'),
    (NULL,2,650,'2018-06-01','2018-08-31'),
    (NULL,2,525,'2018-09-01','2018-10-31'),
    (NULL,2,450,'2018-11-01','2018-12-31'),
    (NULL,3,375,'2018-01-01','2018-03-31'),
    (NULL,3,425,'2018-04-01','2018-05-31'),
    (NULL,3,575,'2018-06-01','2018-08-31'),
    (NULL,3,425,'2018-09-01','2018-10-31'),
    (NULL,3,375,'2018-11-01','2018-12-31'),
    (NULL,4,425,'2018-01-01','2018-03-31'),
    (NULL,4,475,'2018-04-01','2018-05-31'),
    (NULL,4,625,'2018-06-01','2018-08-31'),
    (NULL,4,475,'2018-09-01','2018-10-31'),
    (NULL,4,425,'2018-11-01','2018-12-31'),
    (NULL,5,350,'2018-01-01','2018-03-31'),
    (NULL,5,375,'2018-04-01','2018-05-31'),
    (NULL,5,450,'2018-06-01','2018-08-31'),
    (NULL,5,375,'2018-09-01','2018-10-31'),
    (NULL,5,350,'2018-11-01','2018-12-31'),
    (NULL,6,375,'2018-01-01','2018-03-31'),
    (NULL,6,400,'2018-04-01','2018-05-31'),
    (NULL,6,500,'2018-06-01','2018-08-31'),
    (NULL,6,400,'2018-09-01','2018-10-31'),
    (NULL,6,375,'2018-11-01','2018-12-31');

-- INSERT INTO transactions VALUES
--     (NULL,10,9,'2016-01-07','2016-01-21',100.00,NULL,NULL,60.00,800.00,6),
--     (NULL,9,6,'2016-02-07','2016-02-14',100.00,150.00,'Cat',60.00,350,6);
INSERT INTO transactions VALUES
    (NULL,8,21,'2016-05-07','2016-05-21',100,150,'Cat',50,950,1),
    (NULL,3,20,'2016-05-07','2016-05-14',100,0,NULL,60,400,2),
    (NULL,5,17,'2016-05-07','2016-05-21',100,0,NULL,50,950,3),
    (NULL,12,19,'2016-05-07','2016-05-14',100,0,NULL,60,525,4),
    (NULL,4,26,'2016-05-14','2016-05-21',100,0,NULL,60,400,2),
    (NULL,10,22,'2016-05-14','2016-05-21',100,0,NULL,60,400,5),
    (NULL,11,15,'2016-05-21','2016-05-28',100,150,'Dog',50,425,5),
    (NULL,5,16,'2016-06-04','2016-06-18',100,0,NULL,50,1200,3),
    (NULL,12,20,'2016-06-04','2016-06-25',100,0,NULL,60,1950,3),
    (NULL,10,14,'2016-06-11','2016-06-18',100,150,'Dog',60,500,6),
    (NULL,4,26,'2016-06-18','2016-06-25',100,0,NULL,60,500,2),
    (NULL,10,22,'2017-01-07','2017-01-14',100,0,NULL,60,375,6),
    (NULL,12,20,'2017-01-21','2017-02-04',100,0,NULL,60,900,2),
    (NULL,6,17,'2017-02-04','2017-02-11',100,0,NULL,50,350,3),
    (NULL,10,14,'2017-02-11','2017-02-18',100,150,'Dog',60,375,6),
    (NULL,8,21,'2017-03-04','2017-03-25',100,150,'Dog',50,1200,1),
    (NULL,3,32,'2017-06-03','2017-06-10',100,0,NULL,60,375,4),
    (NULL,5,21,'2017-06-10','2017-06-24',100,0,NULL,50,800,1),
    (NULL,10,22,'2017-06-17','2017-07-01',100,0,NULL,60,750,6),
    (NULL,9,19,'2017-07-08','2017-07-29',100,150,'Cat',50,1050,6),
    (NULL,2,32,'2017-07-15','2017-07-22',100,150,'Dog',60,375,5),
    (NULL,12,20,'2017-07-15','2017-07-29',100,0,NULL,60,900,1),
    (NULL,6,17,'2017-07-29','2017-08-05',100,0,NULL,50,350,3),
    (NULL,10,27,'2017-08-05','2017-08-12',100,0,NULL,60,375,5),
    (NULL,12,20,'2017-08-19','2017-08-26',100,0,NULL,60,450,2),
    (NULL,12,20,'2017-09-02','2017-09-09',100,0,NULL,60,525,2),
    (NULL,10,14,'2017-09-09','2017-09-16',100,150,'Dog',60,400,6),
    (NULL,4,26,'2017-09-16','2017-09-23',100,0,NULL,60,400,2);

create or replace view View1_AverageRate AS
select distinct(prop_type) as "Prop_Type", round(avg(prop_rate) ,2) as "Avg_Prop_Rate"
from property_rate
left join property_type on property_rate.prop_type_id = property_type.prop_type_id
group by prop_type;

create or replace view View2_non_user AS
select 
a.user_fName as "First_Name", 
a.user_lName as "Last_Name", 
a.user_street as "Street",
a.user_city as "City",
a.user_state as "State",
a.user_zip as "Zip",
a.user_phone as "Phone",
a.user_email as "Email"
from user a
left join transactions b on b.user_id = a.user_id
where b.user_id is null and a.user_type = 'renter'
order by user_lName;

create or replace view View3_most_frequent_users AS
select
b.user_fName as "First Name",
b.user_lName as "Last Name",
count(a.user_id) as "Times Rented"
from user b
left join transactions a on a.user_id = b.user_id
group by a.user_id, b.user_fName, b.user_lName
having count(a.user_id) > 0
order by count(a.user_id) desc;

create or replace view View4_2017_users AS
select
a.user_fName as "First Name", 
a.user_lName as "Last Name", 
a.user_street as "Street",
a.user_city as "City",
a.user_state as "State",
a.user_zip as "Zip",
a.user_phone as "Phone",
a.user_email as "Email"
from user a
left join transactions b on a.user_id = b.user_id
where year(trans_arrive_dt) = 2017 or year(trans_depart_dt) = 2017
group by
a.user_fName, 
a.user_lName, 
a.user_street,
a.user_city,
a.user_state,
a.user_zip,
a.user_phone,
a.user_email;

create or replace view View5_ov_rate_increase AS
select 
b.prop_type as "Property Type", 
a.prop_rate as "Current Rate",
round(a.prop_rate*1.06 ,2) as "New Rate"
from property_rate a 
left join property_type b on b.prop_type_id = a.prop_type_id 
where b.prop_type_view = 'oceanview' and prop_rate_start <= curdate() and prop_rate_end >= curdate();

create or replace view View6_yearly_earning AS
select
a.prop_num as "Property ID",
year(b.trans_depart_dt) as "Year",
sum(b.trans_rate) as "Total Rent",
sum(b.trans_cleaning_fee) as "Cleaning",
sum(b.trans_pet_deposit) as "Pet",
sum(b.trans_rate)+sum(b.trans_cleaning_fee)+sum(b.trans_pet_deposit) as "Property Total Collected",
round((sum(b.trans_rate)* .25)+sum(b.trans_pet_deposit) ,2) as "SFRC Earning",
round((sum(b.trans_rate)* .75) ,2) as "user Earning"
from property a 
left join transactions b on b.prop_id = a.prop_id
group by a.prop_num, year(b.trans_depart_dt)
order by a.prop_num ,year(b.trans_depart_dt);

create or replace view View7_SFRC_pay_type AS
select
a.user_pay_type as "Payment Type",
sum(b.trans_rate)+sum(b.trans_cleaning_fee)+sum(b.trans_pet_deposit) as "Total Collected"
from user_payment_type a 
left join transactions b on b.user_pay_id = a.user_pay_id
group by a.user_pay_type;

-- The users love pets. They would like to send a treat to the pets of the users.
-- Display all the users who have pets and what type of pet. Display mailing address.

create or replace view View8_user_pet AS
select
a.user_fName as "First Name",
a.user_lName as "Last Name",
a.user_street as "Street Address",
a.user_city as "City",
a.user_state as "State",
a.user_zip as "Zip",
b.trans_pet_type as "Pet"
from user a
left join transactions b on b.user_id = a.user_id
where b.trans_pet_type is not null
group by 
a.user_fName,
a.user_lName,
a.user_street,
a.user_city,
a.user_state,
a.user_zip;

-- The users want induvidual reports of how their properties are doing. 
-- This is an opprotunity for the users to improve advertisements, property design, etc.
-- Build a report that shows the user, property, how many rentals have occured in 2017
create or replace view View9_2017_times_rented AS
(select
a.user_fName as "First Name",
a.user_lName as "Last Name",
b.prop_num as "Property ID",
d.building_name as "Building",
count(c.prop_id) as "Times Rented"
from property b 
left join user a on b.user_id = a.user_id
left join transactions c on c.prop_id = b.prop_id
left join building d on d.building_id = b.building_id
where year(c.trans_arrive_dt) = 2017
group by 
b.prop_num,
a.user_fName,
a.user_lName,
d.building_name)

union

(select
a.user_fName as "First Name",
a.user_lName as "Last Name",
b.prop_num as "Property ID",
d.building_name as "Building",
count(c.prop_id) as "Times Rented"
from property b 
left join user a on b.user_id = a.user_id
left join transactions c on c.prop_id = b.prop_id
left join building d on d.building_id = b.building_id
group by 
b.prop_num,
a.user_fName,
a.user_lName,
d.building_name
having count(c.prop_id) < 1);

SET FOREIGN_KEY_CHECKS = 1;