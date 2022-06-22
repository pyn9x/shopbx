insert into up_image
(PATH, MAIN, DATE_CREATE, DATE_UPDATE)
values
	('/Upload/Images/Products/8.PNG','1',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
	('/Upload/Images/Products/9.PNG','1',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
	('/Upload/Images/Products/10.PNG','1',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
	('/Upload/Images/Products/11.PNG','1',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
	('/Upload/Images/Products/12.PNG','1',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
	('/Upload/Images/Products/13.PNG','1',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
	('/Upload/Images/Products/14.PNG','1',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
	('/Upload/Images/Products/15.PNG','1',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
	('/Upload/Images/Products/d-9.jpg','0',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
	('/Upload/Images/Products/d-10.jpg','0',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
	('/Upload/Images/Products/d-11.jpg','0',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
	('/Upload/Images/Products/d-12.jpg','0',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
	('/Upload/Images/Products/d-13.jpg','0',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
	('/Upload/Images/Products/d-14.jpg','0',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
	('/Upload/Images/Products/d-15.jpg','0',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);
insert into up_product_image
(PRODUCT_ID, IMAGE_ID)
values
    (8, 24),
    (9, 25),
    (9, 32),
    (10, 26),
    (10, 33),
    (11, 27),
    (11, 34),
    (12, 28),
    (12, 35),
    (13, 29),
    (13, 36),
    (14, 30),
    (14, 37),
    (15, 31),
    (15, 38);
delete from up_product_image
where PRODUCT_ID>7 and IMAGE_ID<10;