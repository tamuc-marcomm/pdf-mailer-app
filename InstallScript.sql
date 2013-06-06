CREATE TABLE users(
    u_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    username varchar(10) NOT NULL,
    first_name varchar((SELECT c_id FROM colleges WHERE name="College of Education and Human Services")55) NOT NULL,
    last_name varchar((SELECT c_id FROM colleges WHERE name="College of Education and Human Services")55) NOT NULL,
    is_admin bool NOT NULL DEFAULT 0,
    
    PRIMARY KEY (u_id)
)Engine = InnoDB;

CREATE TABLE colleges(
    c_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR((SELECT c_id FROM colleges WHERE name="College of Sciences, Engineering, and Agriculture")00) NOT NULL UNIQUE,
    
    PRIMARY KEY (c_id)
)Engine = InnoDB;

CREATE TABLE departments(
    d_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    parent INT UNSIGNED NOT NULL,
    name VARCHAR((SELECT c_id FROM colleges WHERE name="College of Sciences, Engineering, and Agriculture")00) NOT NULL UNIQUE,
    
    PRIMARY KEY (d_id)
)Engine = InnoDB;

CREATE TABLE emailtemplates(
    et_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    sender_email VARCHAR(255) NOT NULL default "",
    sender_name VARCHAR(255) NOT NULL default "",
    subject VARCHAR(80) NOT NULL default "",
    body LONGTEXT NOT NULL default "",
    
    
    PRIMARY KEY (et_id)
)Engine = InnoDB;

CREATE TABLE department_emailtemplates(
	det_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	d_id INT UNSIGNED NOT NULL,
	et_id INT UNSIGNED NOT NULL,
	
	PRIMARY KEY (det_id)
)Engine = InnoDB;

/*[BEGIN] Apply Constraints*/
	ALTER TABLE departments ADD FOREIGN KEY (parent) REFERENCES colleges(c_id);
	ALTER TABLE department_emailtemplates ADD FOREIGN KEY (d_id) REFERENCES departments(d_id);
	ALTER TABLE department_emailtemplates ADD FOREIGN KEY (et_id) REFERENCES emailtemplates(et_id);
/*[END] Apply Constraints*/


/*[BEGIN] Inserts*/
	INSERT INTO users
	    (null,"50053859","Nicholas","Roge",1);
	
	INSERT INTO colleges VALUES
		(null,"College of Business"),
		(null,"College of Education and Human Services"),
		(null,"College of Humanities, Social Sciences, and Arts"),
		(null,"College of Sciences, Engineering, and Agriculture");
		
	INSERT INTO departments VALUES
		(null,(SELECT c_id FROM colleges WHERE name="College of Business"),"Accounting"),
		(null,(SELECT c_id FROM colleges WHERE name="College of Business"),"Applied Sciences"),
		(null,(SELECT c_id FROM colleges WHERE name="College of Business"),"Business Administration and MIS"),
		(null,(SELECT c_id FROM colleges WHERE name="College of Business"),"Economics and Finance"),
		(null,(SELECT c_id FROM colleges WHERE name="College of Business"),"Marketing and Management"),
		(null,(SELECT c_id FROM colleges WHERE name="College of Business"),"China Exchange Program"),
        (null,(SELECT c_id FROM colleges WHERE name="College of Education and Human Services"),"Counseling"),
        (null,(SELECT c_id FROM colleges WHERE name="College of Education and Human Services"),"Curriculum and Instruction"),
        (null,(SELECT c_id FROM colleges WHERE name="College of Education and Human Services"),"Educational Leadership"),
        (null,(SELECT c_id FROM colleges WHERE name="College of Education and Human Services"),"Health and Human Performance"),
        (null,(SELECT c_id FROM colleges WHERE name="College of Education and Human Services"),"Psychology and Special Education"),
        (null,(SELECT c_id FROM colleges WHERE name="College of Education and Human Services"),"Social Work"),  
        (null,(SELECT c_id FROM colleges WHERE name="College of Humanities, Social Sciences, and Arts"),"Art"),
        (null,(SELECT c_id FROM colleges WHERE name="College of Humanities, Social Sciences, and Arts"),"History"),
        (null,(SELECT c_id FROM colleges WHERE name="College of Humanities, Social Sciences, and Arts"),"Liberal Studies"),
        (null,(SELECT c_id FROM colleges WHERE name="College of Humanities, Social Sciences, and Arts"),"Literature & Languages"),
        (null,(SELECT c_id FROM colleges WHERE name="College of Humanities, Social Sciences, and Arts"),"Mass Media, Communication & Theatre"),
        (null,(SELECT c_id FROM colleges WHERE name="College of Humanities, Social Sciences, and Arts"),"Music"),
        (null,(SELECT c_id FROM colleges WHERE name="College of Humanities, Social Sciences, and Arts"),"Political Science"),
        (null,(SELECT c_id FROM colleges WHERE name="College of Humanities, Social Sciences, and Arts"),"Sociology & Criminal Justice"),
        (null,(SELECT c_id FROM colleges WHERE name="College of Sciences, Engineering, and Agriculture"),"Agriculture"),
        (null,(SELECT c_id FROM colleges WHERE name="College of Sciences, Engineering, and Agriculture"),"Biological & Environmental Science"),
        (null,(SELECT c_id FROM colleges WHERE name="College of Sciences, Engineering, and Agriculture"),"Chemistry"),
        (null,(SELECT c_id FROM colleges WHERE name="College of Sciences, Engineering, and Agriculture"),"Computer Science & Information Systems"),
        (null,(SELECT c_id FROM colleges WHERE name="College of Sciences, Engineering, and Agriculture"),"Engineering & Technology"),
        (null,(SELECT c_id FROM colleges WHERE name="College of Sciences, Engineering, and Agriculture"),"Mathematics"),
        (null,(SELECT c_id FROM colleges WHERE name="College of Sciences, Engineering, and Agriculture"),"Physics & Astronomy");
/*[END] Inserts*/