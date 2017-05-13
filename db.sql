CREATE TABLE Professor(
         ssn VARCHAR(9) PRIMARY KEY,
         name VARCHAR(100),
         street VARCHAR(50),
         city VARCHAR(50),
         state VARCHAR(2),
         zip VARCHAR(5),
         area_code VARCHAR(3),
         7_digit VARCHAR(7),
         sex CHAR (1),
         title VARCHAR(50),
         salary FLOAT(10)
     );

CREATE TABLE Department(
    dnum VARCHAR(10) PRIMARY KEY,
    name VARCHAR(50),
    telephone VARCHAR(10),
    location VARCHAR(50),
    chairssn VARCHAR(9),
    FOREIGN KEY (chairssn) REFERENCES Professor (ssn)
);

CREATE TABLE Course(
    cnum VARCHAR(10) PRIMARY KEY,
    title VARCHAR(50),
    textbook VARCHAR(50),
    units INTEGER,
    prereqnum VARCHAR(10),
    FOREIGN KEY (prereqnum) REFERENCES Course(cnum)
);

CREATE TABLE Section(
    snum VARCHAR(10),
    cnum VARCHAR(10),
    room VARCHAR(10),
    meeting VARCHAR(7),
    beg_time TIME,
    end_time TIME,
    num_seats INTEGER,
    pssn VARCHAR(9),
    PRIMARY KEY (snum,cnum),
    FOREIGN KEY (cnum) REFERENCES Course(cnum),
    FOREIGN KEY (pssn) REFERENCES Professor(ssn)
);

CREATE TABLE Student(
    cwid VARCHAR(9) PRIMARY KEY,
    fname VARCHAR(50),
    lname VARCHAR(50),
    address VARCHAR(50),
    telephone VARCHAR(10),
    dnum VARCHAR(10),
    FOREIGN KEY (dnum) REFERENCES Department(dnum)
);

CREATE TABLE Record(
    cwid VARCHAR(9),
    cnum VARCHAR(10),
    snum VARCHAR(10),
    grade VARCHAR(10),
    FOREIGN KEY (cwid) REFERENCES Student(cwid),
    FOREIGN KEY (cnum) REFERENCES Course(cnum),
    FOREIGN KEY (snum) REFERENCES Section(snum)
);
