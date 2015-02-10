create table users(
	userID int not null auto_increment,
	loginname char(45),
	password char(45),
	displayname char(45),
	active int,
	PRIMARY KEY (userID)
);

create table chatlog(
	idchatlog int not null auto_increment,
	userID int,
	messagetxt char(255),
	PRIMARY KEY (idchatlog)
);