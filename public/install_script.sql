CREATE TABLE IF NOT EXISTS users(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    username VARCHAR(8) NOT NULL,
    first_name VARCHAR(200) NOT NULL,
    last_name VARCHAR(200) NOT NULL,
    is_admin BOOL NOT NULL DEFAULT 0,
    
    PRIMARY KEY (id)
)Engine = InnoDB;

CREATE TABLE IF NOT EXISTS colleges(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name TEXT NOT NULL,
    
    PRIMARY KEY (id)
)Engine = InnoDB;

CREATE TABLE IF NOT EXISTS departments(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    parent INT UNSIGNED NOT NULL,
    name TEXT NOT NULL,
    
    PRIMARY KEY (id)
)Engine = InnoDB;

CREATE TABLE IF NOT EXISTS content(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    parent INT UNSIGNED NOT NULL,
    name TEXT NOT NULL,

    email_subject VARCHAR(255) NOT NULL default "",
    email_body TEXT NOT NULL default "",
    pdf_link TEXT default NULL,

    PRIMARY KEY (id)
)Engine = InnoDB;

/*[BEGIN] Apply Constraints*/
    ALTER TABLE departments ADD FOREIGN KEY (parent) REFERENCES colleges(id);
    ALTER TABLE content ADD FOREIGN KEY (parent) REFERENCES departments(id);
/*[END] Apply Constraints*/


/*[BEGIN] Inserts*/
    INSERT INTO users VALUES
        (null,"50053859","Nicholas","Roge",1);
    
    INSERT INTO colleges VALUES
        (null,"College of Business"),
        (null,"College of Education and Human Services"),
        (null,"College of Humanities, Social Sciences, and Arts"),
        (null,"College of Sciences, Engineering, and Agriculture");
        
    INSERT INTO departments VALUES
        (null,(SELECT id FROM colleges WHERE name="College of Business"),"Accounting"),
        (null,(SELECT id FROM colleges WHERE name="College of Business"),"Applied Sciences"),
        (null,(SELECT id FROM colleges WHERE name="College of Business"),"Business Administration and MIS"),
        (null,(SELECT id FROM colleges WHERE name="College of Business"),"Economics and Finance"),
        (null,(SELECT id FROM colleges WHERE name="College of Business"),"Marketing and Management"),
        (null,(SELECT id FROM colleges WHERE name="College of Business"),"China Exchange Program"),
        (null,(SELECT id FROM colleges WHERE name="College of Education and Human Services"),"Counseling"),
        (null,(SELECT id FROM colleges WHERE name="College of Education and Human Services"),"Curriculum and Instruction"),
        (null,(SELECT id FROM colleges WHERE name="College of Education and Human Services"),"Educational Leadership"),
        (null,(SELECT id FROM colleges WHERE name="College of Education and Human Services"),"Health and Human Performance"),
        (null,(SELECT id FROM colleges WHERE name="College of Education and Human Services"),"Psychology and Special Education"),
        (null,(SELECT id FROM colleges WHERE name="College of Education and Human Services"),"Social Work"),
        (null,(SELECT id FROM colleges WHERE name="College of Humanities, Social Sciences, and Arts"),"Art"),
        (null,(SELECT id FROM colleges WHERE name="College of Humanities, Social Sciences, and Arts"),"History"),
        (null,(SELECT id FROM colleges WHERE name="College of Humanities, Social Sciences, and Arts"),"Liberal Studies"),
        (null,(SELECT id FROM colleges WHERE name="College of Humanities, Social Sciences, and Arts"),"Literature & Languages"),
        (null,(SELECT id FROM colleges WHERE name="College of Humanities, Social Sciences, and Arts"),"Mass Media, Communication & Theatre"),
        (null,(SELECT id FROM colleges WHERE name="College of Humanities, Social Sciences, and Arts"),"Music"),
        (null,(SELECT id FROM colleges WHERE name="College of Humanities, Social Sciences, and Arts"),"Political Science"),
        (null,(SELECT id FROM colleges WHERE name="College of Humanities, Social Sciences, and Arts"),"Sociology & Criminal Justice"),
        (null,(SELECT id FROM colleges WHERE name="College of Sciences, Engineering, and Agriculture"),"Agriculture"),
        (null,(SELECT id FROM colleges WHERE name="College of Sciences, Engineering, and Agriculture"),"Biological & Environmental Science"),
        (null,(SELECT id FROM colleges WHERE name="College of Sciences, Engineering, and Agriculture"),"Chemistry"),
        (null,(SELECT id FROM colleges WHERE name="College of Sciences, Engineering, and Agriculture"),"Computer Science & Information Systems"),
        (null,(SELECT id FROM colleges WHERE name="College of Sciences, Engineering, and Agriculture"),"Engineering & Technology"),
        (null,(SELECT id FROM colleges WHERE name="College of Sciences, Engineering, and Agriculture"),"Mathematics"),
        (null,(SELECT id FROM colleges WHERE name="College of Sciences, Engineering, and Agriculture"),"Physics & Astronomy");
/*[END] Inserts*/