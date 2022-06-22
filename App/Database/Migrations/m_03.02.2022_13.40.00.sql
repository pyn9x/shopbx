CREATE TABLE up_product
(
	ID int not null auto_increment,
	NAME_CITY varchar(500) not null,
	NAME_COUNTRY varchar(500) not null,
	DATE_TRAVEL datetime,
	PRICE double,
	SHORT_DESCRIPTION varchar(500) not null,
	FULL_DESCRIPTION varchar(500) not null,
	INTERNET_RATING double,
	ENTERTAINMENT_RATING double,
	SERVICE_RATING double,
	RATING double,
	ACTIVE bool,
	DATE_CREATE timestamp,
	DATE_UPDATE timestamp,

	PRIMARY KEY (ID)
);

CREATE TABLE up_image
(
	ID int not null auto_increment,
	PATH varchar(500) not null,
	MAIN bool,
	DATE_CREATE timestamp,
	DATE_UPDATE timestamp,

	PRIMARY KEY (ID)
);

CREATE TABLE up_product_image
(
	PRODUCT_ID int not null,
	IMAGE_ID int not null,
	PRIMARY KEY (PRODUCT_ID, IMAGE_ID),
	FOREIGN KEY FK_PI_PRODUCT (PRODUCT_ID)
		REFERENCES up_product(ID)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	FOREIGN KEY FK_PI_IMAGE (IMAGE_ID)
		REFERENCES up_image(ID)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
);

CREATE TABLE up_tag
(
	ID int not null auto_increment,
	NAME varchar(500) not null,
	DATE_CREATE timestamp,
	DATE_UPDATE timestamp,

	PRIMARY KEY (ID)
);

CREATE TABLE up_product_tag
(
	PRODUCT_ID int not null,
	TAG_ID int not null,
	PRIMARY KEY (PRODUCT_ID, TAG_ID),
	FOREIGN KEY FK_PT_PRODUCT (PRODUCT_ID)
		REFERENCES up_product(ID)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	FOREIGN KEY FK_PT_TAG (TAG_ID)
		REFERENCES up_tag(ID)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
);

CREATE TABLE up_user
(
	ID int not null auto_increment,
	LOGIN varchar(500) not null,
	PASSWORD varchar(500) not null,
	ISADMIN bool,
	DATE_CREATE timestamp,
	DATE_UPDATE timestamp,

	PRIMARY KEY (ID)
);

CREATE TABLE up_status_order
(
	ID int not null auto_increment,
	NAME varchar(500) not null,

	PRIMARY KEY (ID)
);

CREATE TABLE up_order
(
	ID int not null auto_increment,
	EMAIL varchar(500) not null,
	PHONE varchar(500) not null,
	DATE_ORDER datetime,
	COMMENT varchar(500) not null,
	STATUS_ID  int not null,
	PRODUCT_ID int not null,
	DATE_CREATE timestamp,
	DATE_UPDATE timestamp,

	FOREIGN KEY FK_ORDER_PRODUCT (PRODUCT_ID)
		REFERENCES up_product(ID)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,

	FOREIGN KEY FK_ORDER_STATUS (STATUS_ID)
		REFERENCES up_status_order(ID)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,

	PRIMARY KEY (ID)
);