CREATE TABLE CUSTOMER
(
  CustDOB DATE NOT NULL,
  CustTelNumber INT NOT NULL UNIQUE,
  CustFanID INT NOT NULL,
  CustEmail VARCHAR(255) NOT NULL UNIQUE,
  CustNationality VARCHAR(255) NOT NULL,
  CustFname VARCHAR(255) NOT NULL,
  CustLName VARCHAR(255) NOT NULL,
  CustAddress VARCHAR(255) NOT NULL,
  PRIMARY KEY (CustFanID)
)Engine=InnoDB;

CREATE TABLE CCDetails
(
  CCType VARCHAR(255) NOT NULL,
  CCNumber VARCHAR(16) NOT NULL,
  CCV INT NOT NULL,
  CCFname VARCHAR(255) NOT NULL,
  CCLname VARCHAR(255) NOT NULL,
  CCExpiryMonth INT NOT NULL,
  CCExpiryYear INT(4) NOT NULL,
  FanID INT NOT NULL,
  PRIMARY KEY (CCNumber),
  FOREIGN KEY (FanID) REFERENCES CUSTOMER(CustFanID) on update cascade on delete cascade,
  CHECK (CCExpiryMonth > 0 AND CCExpiryMonth < 13), -- Months are from 1 to 12
  CHECK (CCExpiryYear > 2020 AND CCExpiryYear < 9999) -- Card must have valid expiry (> 2020) and it cannot be more than 4 digits (hence < 9999)
)Engine=InnoDB;

CREATE TABLE STADIUM
(
  Category1Capacity INT NOT NULL,
  Category2Capacity INT NOT NULL,
  StadiumName VARCHAR(255) NOT NULL,
  StadiumAddress VARCHAR(255) NOT NULL,
  StadiumCity VARCHAR(255) NOT NULL,
  Category3Capacity INT NOT NULL,
  Category4Capacity INT NOT NULL,
  PRIMARY KEY (StadiumName)
)Engine=InnoDB;

CREATE TABLE TEAM
(
  TeamName VARCHAR(255) NOT NULL,
  PRIMARY KEY (TeamName)
)Engine=InnoDB;

CREATE TABLE GUEST
(
  GuestFanID INT NOT NULL,
  GuestNationalty VARCHAR(255) NOT NULL,
  GuestDOB DATE NOT NULL,
  GuestFname VARCHAR(255) NOT NULL,
  GuestLname VARCHAR(255) NOT NULL,
  CustFanID INT NOT NULL,
  GuestTelNumber INT NOT NULL,
  GuestAddress VARCHAR(255) NOT NULL,
  GuestEmail VARCHAR(255) NOT NULL,
  PRIMARY KEY (GuestFanID),
  FOREIGN KEY (CustFanID) REFERENCES CUSTOMER(CustFanID) on update cascade on delete cascade
)Engine=InnoDB;

CREATE TABLE FOOTBALL_MATCH
(
  KickOffDate DATE NOT NULL, -- Date format is YYYY-MM-DD
  KickOffTime TIME NOT NULL, -- Time format is hh:mm:ss
  MatchNumber INT NOT NULL,
  Team1 VARCHAR(255) NOT NULL,
  Team2 VARCHAR(255) NOT NULL,
  StadiumName VARCHAR(255) NOT NULL,
  PRIMARY KEY (MatchNumber),
  FOREIGN KEY (StadiumName) REFERENCES STADIUM(StadiumName) on update cascade on delete cascade,
  CHECK (MatchNumber >= 1 AND MatchNumber <= 65) -- 64 matches are played in FIFA World Cup, so matchnumber can be between 1 and 65 
)Engine=InnoDB;

CREATE TABLE SEAT
(
  SeatCategory INT NOT NULL,
  SeatPavillion INT NOT NULL,
  SeatLevel INT NOT NULL,
  SeatBlock VARCHAR(255) NOT NULL,
  SeatRow INT NOT NULL,
  SeatNumber INT NOT NULL,
  StadiumName VARCHAR(255) NOT NULL,
  SeatPrice INT NOT NULL,
  PRIMARY KEY (SeatCategory, SeatPavillion, SeatLevel, SeatBlock, SeatRow, SeatNumber, StadiumName, SeatPrice),
  FOREIGN KEY (StadiumName) REFERENCES STADIUM(StadiumName) on update cascade on delete cascade,
  CHECK (SeatCategory >= 1 AND SeatCategory <= 4), -- There are 4 categories only
  CHECK (SeatPavillion > 0 AND SeatLevel > 0 AND SeatRow > 0 AND SeatNumber > 0) -- These columns cannot be negative
)Engine=InnoDB;

CREATE TABLE TICKET
(
  TicketID VARCHAR(255) NOT NULL,
  MatchNumber INT NOT NULL,
  SeatCategory INT NOT NULL,
  TicketType VARCHAR(255) NOT NULL,
  Price INT NOT NULL,
  FanID INT NOT NULL,
  TeamName VARCHAR(255), -- NOT NULL if team specific ticket
  SpecificStadiumName VARCHAR(255), -- NOT NULL if venue specific ticket
  SeatPavillion INT NOT NULL,
  SeatLevel INT NOT NULL,
  SeatBlock VARCHAR(255) NOT NULL,
  SeatRow INT NOT NULL,
  SeatNumber INT NOT NULL,
  StadiumName VARCHAR(255) NOT NULL,
  CCNumber VARCHAR(16), -- Can pay in cash
  PRIMARY KEY (TicketID),
  FOREIGN KEY (FanID) REFERENCES CUSTOMER(CustFanID) on update cascade on delete cascade,
  FOREIGN KEY (TeamName) REFERENCES TEAM(TeamName) on update cascade on delete cascade,
  FOREIGN KEY (StadiumName) REFERENCES STADIUM(StadiumName) on update cascade on delete cascade,
  FOREIGN KEY (SeatCategory, SeatPavillion, SeatLevel, SeatBlock, SeatRow, SeatNumber, StadiumName, Price) REFERENCES SEAT(SeatCategory, SeatPavillion, SeatLevel, SeatBlock, SeatRow, SeatNumber, StadiumName, SeatPrice) on update cascade on delete cascade,
  FOREIGN KEY (CCNumber) REFERENCES CCDetails(CCNumber) on update cascade on delete cascade,
  FOREIGN KEY (MatchNumber) REFERENCES FOOTBALL_MATCH(MatchNumber) on update cascade on delete cascade
)Engine=InnoDB;

CREATE TABLE Plays_in
(
  TeamName VARCHAR(255) NOT NULL,
  MatchNumber INT NOT NULL,
  PRIMARY KEY (TeamName, MatchNumber),
  FOREIGN KEY (TeamName) REFERENCES TEAM(TeamName) on update cascade on delete cascade,
  FOREIGN KEY (MatchNumber) REFERENCES FOOTBALL_MATCH(MatchNumber) on update cascade on delete cascade
)Engine=InnoDB;

CREATE TABLE USERS
(
  UserEmail VARCHAR(255) NOT NULL,
  UserPassword VARCHAR(255) NOT NULL,
  UserRole VARCHAR(255) NOT NULL,
  PRIMARY KEY (UserEmail),
  CHECK (UserRole = 'Admin' OR UserRole = 'Customer')
)Engine=InnoDB;

/* populating USERS */
insert into USERS values('admin@andrew.cmu.edu', 'admin', 'Admin'); -- Default admin account, use in login to access admin content
insert into USERS values('customer@andrew.cmu.edu', 'customer', 'Customer'); -- Default customer account, use in login to access customer content or register

/* populating customer */

insert into CUSTOMER values("2000-09-20", 77055835, 1, "aatalla@andrew.cmu.edu", "Egypt", "Andria", "Atalla", "elif");
insert into CUSTOMER values("2000-01-2", 12345678, 2, "a@andrew.cmu.edu", "Cambodia", "Abcd", "Efgh", "elif");
insert into CUSTOMER values("2000-02-3", 87654321, 3, "b@andrew.cmu.edu", "Vietnam", "Ijkl", "Mnop", "elif");
insert into CUSTOMER values("2000-03-4", 22471628, 4, "c@andrew.cmu.edu", "United States", "Qrst", "Uvwx", "elif");
insert into CUSTOMER values("2000-04-5", 13082260, 5, "d@andrew.cmu.edu", "England", "Yzab", "cdef", "elif");
insert into CUSTOMER values("2000-05-6", 24561234, 6, "e@andrew.cmu.edu", "Qatar", "ghij", "klmn", "elif");
insert into CUSTOMER values("2000-06-7", 00112233, 7, "f@andrew.cmu.edu", "Scotland", "opqr", "stuv", "elif");
insert into CUSTOMER values("2000-07-8", 44556677, 8, "g@andrew.cmu.edu", "England", "wxyz", "abcd", "elif");
insert into CUSTOMER values("2000-08-9", 88991010, 9, "h@andrew.cmu.edu", "Wales", "efgh", "ijkl", "elif");
insert into CUSTOMER values("2000-10-10", 11111212, 10, "i@andrew.cmu.edu", "Canada", "mnop", "qrst", "elif");

/*populating CCDetails*/
insert into CCDetails values("Visa", "2222222222222222", 123, "abcd", "efgh", "12", "2021", 1);
insert into CCDetails values("Visa", "4444444444444444", 456, "abcd", "efgh", "12", "2021", 2);
insert into CCDetails values("Visa", "6666666666666666", 789, "abcd", "efgh", "12", "2021", 3);
insert into CCDetails values("Master", "8888888888888888", 101, "abcd", "efgh", "12", "2021", 4);
insert into CCDetails values("Visa", "1010101010101010", 505, "abcd", "efgh", "12", "2021", 5);
insert into CCDetails values("Visa", "1133557799113355", 321, "abcd", "efgh", "12", "2021", 6);
insert into CCDetails values("AmericanExpress", "3355779911335577", 654, "abcd", "efgh", "12", "2021", 7);
insert into CCDetails values("Visa", "5577991133557799", 876, "abcd", "efgh", "12", "2021", 8);
insert into CCDetails values("Visa", "7799113355779911", 987, "abcd", "efgh", "12", "2021", 9);
insert into CCDetails values("Visa", "9911335577991133", 098, "abcd", "efgh", "12", "2021", 10);

/* populating stadium */
insert into STADIUM values(2000, 6000, "Lusail Stadium", "street 1", "lusail", 2000, 6000);
insert into STADIUM values(2000, 6000, "Al Bayt Stadium", "street 2", "al khor", 2000, 6000);
insert into STADIUM values(2000, 6000, "Al Janoub Stadium", "street 3", "al wakrah", 2000, 6000);
insert into STADIUM values(2000, 6000, "Al Rayyan Stadium", "street 4", "al rayyan", 2000, 6000);
insert into STADIUM values(2000, 6000, "Khalifa International Stadium", "street 5", "doha", 2000, 6000);
insert into STADIUM values(2000, 6000, "Education City Stadium", "street 6", "doha", 2000, 6000);
insert into STADIUM values(2000, 6000, "Ras Abu Aboud Stadium", "street 7", "ras abu aboud", 2000, 6000);
insert into STADIUM values(2000, 6000, "Al Thumama Stadium", "street 8", "doha", 2000, 6000);

/* populating team */
insert into TEAM values("Qatar");
insert into TEAM values("Egypt");
insert into TEAM values("England");
insert into TEAM values("Scotland");
insert into TEAM values("Italy");
insert into TEAM values("Germany");
insert into TEAM values("Spain");
insert into TEAM values("Argentina");
insert into TEAM values("Brazil");
insert into TEAM values("Tunisia");

/* populating Guest */
insert into GUEST values(11, "Egypt", "2000-09-20", "Abcd", "Efgh", 1, 11111212, "doha Qatar", "ellif@gmail.com");
insert into GUEST values(12, "Qatar", "2000-09-20", "Abcd", "Efgh", 2, 11111212, "doha Qatar", "ellif@gmail.com");
insert into GUEST values(13, "Cambodia", "2000-09-20", "Abcd", "Efgh", 3, 11111212, "doha Qatar", "ellif@gmail.com");
insert into GUEST values(14, "United States", "2000-09-20", "Abcd", "Efgh", 4, 11111212, "doha Qatar", "ellif@gmail.com");
insert into GUEST values(15, "Scotland", "2000-09-20", "Abcd", "Efgh", 5, 11111212, "doha Qatar", "ellif@gmail.com");
insert into GUEST values(16, "England", "2000-09-20", "Abcd", "Efgh", 6, 11111212, "doha Qatar", "ellif@gmail.com");
insert into GUEST values(17, "India", "2000-09-20", "Abcd", "Efgh", 7, 11111212, "doha Qatar", "ellif@gmail.com");
insert into GUEST values(18, "China", "2000-09-20", "Abcd", "Efgh", 8, 11111212, "doha Qatar", "ellif@gmail.com");
insert into GUEST values(19, "Germany", "2000-09-20", "Abcd", "Efgh", 9, 11111212, "doha Qatar", "ellif@gmail.com");
insert into GUEST values(20, "Tunisia", "2000-09-20", "Abcd", "Efgh", 10, 11111212, "doha Qatar", "ellif@gmail.com");

/* populating FOOTBALL_MATCH */
insert into FOOTBALL_MATCH values("2022-09-21", "16:00:00", 1, "Qatar", "Egypt", "Lusail Stadium");
insert into FOOTBALL_MATCH values("2022-09-22", "16:00:00", 2, "Egypt", "Scotland", "Lusail Stadium");
insert into FOOTBALL_MATCH values("2022-09-23", "16:00:00", 3, "England", "Egypt", "Lusail Stadium");
insert into FOOTBALL_MATCH values("2022-09-24", "16:00:00", 4, "Scotland", "England", "Lusail Stadium");
insert into FOOTBALL_MATCH values("2022-09-25", "16:00:00", 5, "Italy", "Scotland", "Lusail Stadium");
insert into FOOTBALL_MATCH values("2022-09-26", "16:00:00", 6, "Germany", "Italy", "Lusail Stadium");
insert into FOOTBALL_MATCH values("2022-09-27", "16:00:00", 7, "Spain", "Germany", "Lusail Stadium");
insert into FOOTBALL_MATCH values("2022-09-28", "16:00:00", 8, "Argentina", "Spain", "Lusail Stadium");
insert into FOOTBALL_MATCH values("2022-09-29", "16:00:00", 9, "Brazil", "Argentina", "Lusail Stadium");
insert into FOOTBALL_MATCH values("2022-09-30", "16:00:00", 10, "Tunisia", "Brazil", "Lusail Stadium");

/* populating seat */
insert into SEAT values(4, 4, 2, "A112", 1, 123, "Lusail Stadium", 100);
insert into SEAT values(4, 4, 2, "A113", 2, 456, "Lusail Stadium", 100);
insert into SEAT values(2, 4, 2, "A114", 3, 758, "Lusail Stadium", 300);
insert into SEAT values(3, 4, 2, "A115", 4, 534, "Lusail Stadium", 200);
insert into SEAT values(2, 4, 2, "A116", 5, 657, "Lusail Stadium", 300);
insert into SEAT values(2, 4, 2, "A117", 6, 345, "Lusail Stadium", 300);
insert into SEAT values(4, 4, 2, "A118", 7, 912, "Lusail Stadium", 100);
insert into SEAT values(1, 4, 2, "A119", 8, 432, "Lusail Stadium", 400);
insert into SEAT values(3, 4, 2, "A120", 9, 654, "Lusail Stadium", 200);
insert into SEAT values(1, 4, 2, "A121", 10, 918, "Lusail Stadium", 400);

/* populating ticket */
insert into TICKET values("G111111", 1, 4, "individual", 100, 1, NULL, NULL, 4, 2, "A112", 1, 123, "Lusail Stadium", "2222222222222222");
insert into TICKET values("G222222", 2, 4, "individual", 100, 2, NULL, NULL, 4, 2, "A113", 2, 456, "Lusail Stadium", "4444444444444444");
insert into TICKET values("G333333", 3, 2, "individual", 300, 1, NULL, NULL, 4, 2, "A114", 3, 758, "Lusail Stadium", "6666666666666666");
insert into TICKET values("G444444", 4, 3, "individual", 200, 1, NULL, NULL, 4, 2, "A115", 4, 534, "Lusail Stadium", "8888888888888888");
insert into TICKET values("G555555", 5, 2, "individual", 300, 1, NULL, NULL, 4, 2, "A116", 5, 657, "Lusail Stadium", "1010101010101010");
insert into TICKET values("G666666", 6, 2, "individual", 300, 1, NULL, NULL, 4, 2, "A117", 6, 345, "Lusail Stadium", "1133557799113355");
insert into TICKET values("G777777", 7, 4, "individual", 100, 1, NULL, NULL, 4, 2, "A118", 7, 912, "Lusail Stadium", "3355779911335577");
insert into TICKET values("G888888", 8, 1, "individual", 400, 1, NULL, NULL, 4, 2, "A119", 8, 432, "Lusail Stadium", "5577991133557799");
insert into TICKET values("G999999", 9, 3, "individual", 200, 1, NULL, NULL, 4, 2, "A120", 9, 654, "Lusail Stadium", "7799113355779911");
insert into TICKET values("G123456", 10, 1, "individual", 400, 1, NULL, NULL, 4, 2, "A121", 10, 918, "Lusail Stadium", "9911335577991133");

/* populating plays_in */
insert into Plays_in values("Qatar", 1);
insert into Plays_in values("Egypt", 1);
insert into Plays_in values("Egypt", 2);
insert into Plays_in values("Scotland", 2);
insert into Plays_in values("England", 3);
insert into Plays_in values("Egypt", 3);
insert into Plays_in values("Scotland", 4);
insert into Plays_in values("England", 4);
insert into Plays_in values("Italy", 5);
insert into Plays_in values("Scotland", 5);
insert into Plays_in values("Germany", 6);
insert into Plays_in values("Italy", 6);
insert into Plays_in values("Spain", 7);
insert into Plays_in values("Germany", 7);
insert into Plays_in values("Argentina", 8);
insert into Plays_in values("Spain", 8);
insert into Plays_in values("Brazil", 9);
insert into Plays_in values("Argentina", 9);
insert into Plays_in values("Tunisia", 10);
insert into Plays_in values("Brazil", 10);