
CREATE TABLE  if not EXISTS  account(
accID BIGINT NOT NULL AUTO_INCREMENT,
accDisplayName VARCHAR(255),
accName VARCHAR(255),
accImageAvata VARCHAR(255),
accPassword VARCHAR(255),
accEmail VARCHAR(255),
accBirthday DATE,
accGender TINYINT(1) DEFAULT 0,
accPhone VARCHAR(255),

PRIMARY KEY (accID)
);

/*DROP TABLE IF EXISTS relationship;*/

CREATE TABLE if not EXISTS relationship(
rsID BIGINT NOT NULL AUTO_INCREMENT,
rsSourceID BIGINT REFERENCES account(accID),
rsFriendID BIGINT REFERENCES account(accID),
rsStatus TINYINT NOT NULL DEFAULT 1 ,

PRIMARY KEY (rsID)
);

CREATE TABLE if not EXISTS special_days(
sdID INT NOT NULL AUTO_INCREMENT,
sdTitle VARCHAR(255),
sdDay DATE,
sdRelationship BIGINT REFERENCES relationship(rsID),
PRIMARY KEY(sdID)
);

CREATE TABLE if not EXISTS messages_box(
mbID BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
mbRecieverID BIGINT REFERENCES account(accID),
mbSenderID BIGINT REFERENCES account(accID)
);

CREATE TABLE if not EXISTS message(
msID BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
msMessage VARCHAR(1000),
msMarkRead TINYINT,
msBoxID BIGINT REFERENCES messages_box(mbID)
);

CREATE TABLE if not EXISTS group_message(
gmID BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
gmName VARCHAR(255)
);

CREATE TABLE if not EXISTS group_people(
gpGroup BIGINT NOT NULL REFERENCES group_message(gmID),
gpMember BIGINT NOT NULL REFERENCES account(accID),

PRIMARY KEY (gpGroup, gpMember)
);

CREATE TABLE if not EXISTS message_group(
mgID BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
mgSenderID BIGINT,
mgMessage VARCHAR(1000),
mgGroup BIGINT REFERENCES group_message(gmID)
);

CREATE TABLE if not EXISTS gifts_box(
gbID BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
gbRecieverID BIGINT REFERENCES account(accID),
gbSenderID BIGINT REFERENCES account(accID)
);

CREATE TABLE if not EXISTS gift(
gfID BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
gfTitle VARCHAR(255),
gfResourcesLink VARCHAR(255),
gfDateSent DATE, 
gfMarkOpened TINYINT,
gfGiftBox BIGINT REFERENCES gifts_box(gbID)
);

CREATE TABLE if not EXISTS template_type(
ttID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
ttName VARCHAR(255)
);

CREATE TABLE if not EXISTS template(
tID BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
tTitle VARCHAR(255),
tResourcesLink VARCHAR(255),
tType INT REFERENCES template_type(ttID)
);




