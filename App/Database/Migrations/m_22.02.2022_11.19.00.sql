insert into up_tag
(NAME, DATE_CREATE, DATE_UPDATE)
values
('Не подходит для детей', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
insert into up_tag_type_tag
(TAG_ID, TYPE_ID)
values
(21, 3);
insert into up_product_tag
(PRODUCT_ID, TAG_ID)
values
	(1, 17),
	(2, 14),
	(3, 15),
	(4, 14),
	(5, 14),
	(6, 14),
	(7, 14),
	(8, 15),
	(9, 14),
	(10, 14),
	(11, 14),
	(12, 15),
	(13, 18),
	(14, 15),
	(15, 14),
	(1, 21),
	(2, 20),
	(3, 21),
	(4, 20),
	(5, 20),
	(6, 20),
	(7, 20),
	(8, 21),
	(9, 20),
	(10, 20),
	(11, 20),
	(12, 21),
	(13, 21),
	(14, 20),
	(15, 20);