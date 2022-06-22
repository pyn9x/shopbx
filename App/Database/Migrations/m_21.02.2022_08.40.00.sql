CREATE TABLE up_type_tag
(
	ID int not null auto_increment,
	NAME varchar(500) not null,
	DATE_CREATE timestamp,
	DATE_UPDATE timestamp,

	PRIMARY KEY (ID)
);
CREATE TABLE up_tag_type_tag
(
	TAG_ID int not null,
	TYPE_ID int not null,
	PRIMARY KEY (TAG_ID, TYPE_ID),
	FOREIGN KEY FK_TT_TAG (TAG_ID)
		REFERENCES up_tag(ID)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	FOREIGN KEY FK_TT_TYPE (TYPE_ID)
		REFERENCES up_type_tag(ID)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
);
INSERT INTO `up_type_tag`(`NAME`, `DATE_CREATE`, `DATE_UPDATE`) VALUES ('Страна','2022-02-21 08:46:00','2022-02-21 08:46:00');
INSERT INTO `up_tag_type_tag`(`TAG_ID`, `TYPE_ID`) VALUES ('1','1');
INSERT INTO `up_tag_type_tag`(`TAG_ID`, `TYPE_ID`) VALUES ('2','1');
INSERT INTO `up_tag_type_tag`(`TAG_ID`, `TYPE_ID`) VALUES ('3','1');
INSERT INTO `up_tag_type_tag`(`TAG_ID`, `TYPE_ID`) VALUES ('4','1');
INSERT INTO `up_tag_type_tag`(`TAG_ID`, `TYPE_ID`) VALUES ('5','1');
INSERT INTO `up_tag_type_tag`(`TAG_ID`, `TYPE_ID`) VALUES ('6','1');
INSERT INTO `up_tag_type_tag`(`TAG_ID`, `TYPE_ID`) VALUES ('7','1');
INSERT INTO `up_tag_type_tag`(`TAG_ID`, `TYPE_ID`) VALUES ('8','1');
INSERT INTO `up_tag_type_tag`(`TAG_ID`, `TYPE_ID`) VALUES ('9','1');
INSERT INTO `up_tag_type_tag`(`TAG_ID`, `TYPE_ID`) VALUES ('10','1');
INSERT INTO `up_tag_type_tag`(`TAG_ID`, `TYPE_ID`) VALUES ('11','1');
INSERT INTO `up_tag_type_tag`(`TAG_ID`, `TYPE_ID`) VALUES ('12','1');
INSERT INTO `up_tag_type_tag`(`TAG_ID`, `TYPE_ID`) VALUES ('13','1');