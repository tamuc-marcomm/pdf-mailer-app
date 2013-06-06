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

    email_subject VARCHAR(255) NOT NULL default "",
    email_body TEXT NOT NULL default "",
    pdf_link TEXT default NULL,
    
    PRIMARY KEY (id)
)Engine = InnoDB;

/*[BEGIN] Apply Constraints*/
    ALTER TABLE departments ADD FOREIGN KEY (parent) REFERENCES colleges(id);
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
        (null,(SELECT id FROM colleges WHERE name="College of Business"),"Accounting",DEFAULT,DEFAULT,DEFAULT),
        (null,(SELECT id FROM colleges WHERE name="College of Business"),"Applied Sciences",DEFAULT,DEFAULT,DEFAULT),
        (null,(SELECT id FROM colleges WHERE name="College of Business"),"Business Administration and MIS",DEFAULT,DEFAULT,DEFAULT),
        (null,(SELECT id FROM colleges WHERE name="College of Business"),"Economics and Finance",DEFAULT,DEFAULT,DEFAULT),
        (null,(SELECT id FROM colleges WHERE name="College of Business"),"Marketing and Management",DEFAULT,DEFAULT,DEFAULT),
        (null,(SELECT id FROM colleges WHERE name="College of Business"),"China Exchange Program",DEFAULT,DEFAULT,DEFAULT),
        (null,(SELECT id FROM colleges WHERE name="College of Education and Human Services"),"Counseling",DEFAULT,DEFAULT,DEFAULT),
        (null,(SELECT id FROM colleges WHERE name="College of Education and Human Services"),"Curriculum and Instruction",DEFAULT,DEFAULT,DEFAULT),
        (null,(SELECT id FROM colleges WHERE name="College of Education and Human Services"),"Educational Leadership",DEFAULT,DEFAULT,DEFAULT),
        (null,(SELECT id FROM colleges WHERE name="College of Education and Human Services"),"Health and Human Performance",DEFAULT,DEFAULT,DEFAULT),
        (null,(SELECT id FROM colleges WHERE name="College of Education and Human Services"),"Psychology and Special Education",DEFAULT,DEFAULT,DEFAULT),
        (null,(SELECT id FROM colleges WHERE name="College of Education and Human Services"),"Social Work",DEFAULT,DEFAULT,DEFAULT),
        (null,(SELECT id FROM colleges WHERE name="College of Humanities, Social Sciences, and Arts"),"Art",DEFAULT,DEFAULT,DEFAULT),
        (null,(SELECT id FROM colleges WHERE name="College of Humanities, Social Sciences, and Arts"),"History",DEFAULT,DEFAULT,DEFAULT),
        (null,(SELECT id FROM colleges WHERE name="College of Humanities, Social Sciences, and Arts"),"Liberal Studies",DEFAULT,DEFAULT,DEFAULT),
        (null,(SELECT id FROM colleges WHERE name="College of Humanities, Social Sciences, and Arts"),"Literature & Languages",DEFAULT,DEFAULT,DEFAULT),
        (null,(SELECT id FROM colleges WHERE name="College of Humanities, Social Sciences, and Arts"),"Mass Media, Communication & Theatre",DEFAULT,DEFAULT,DEFAULT),
        (null,(SELECT id FROM colleges WHERE name="College of Humanities, Social Sciences, and Arts"),"Music",DEFAULT,DEFAULT,DEFAULT),
        (null,(SELECT id FROM colleges WHERE name="College of Humanities, Social Sciences, and Arts"),"Political Science",DEFAULT,DEFAULT,DEFAULT),
        (null,(SELECT id FROM colleges WHERE name="College of Humanities, Social Sciences, and Arts"),"Sociology & Criminal Justice",DEFAULT,DEFAULT,DEFAULT),
        (null,(SELECT id FROM colleges WHERE name="College of Sciences, Engineering, and Agriculture"),"Agriculture",DEFAULT,DEFAULT,DEFAULT),
        (null,(SELECT id FROM colleges WHERE name="College of Sciences, Engineering, and Agriculture"),"Biological & Environmental Science",DEFAULT,DEFAULT,DEFAULT),
        (null,(SELECT id FROM colleges WHERE name="College of Sciences, Engineering, and Agriculture"),"Chemistry",DEFAULT,DEFAULT,DEFAULT),
        (null,(SELECT id FROM colleges WHERE name="College of Sciences, Engineering, and Agriculture"),"Computer Science & Information Systems",DEFAULT,DEFAULT,DEFAULT),
        (null,(SELECT id FROM colleges WHERE name="College of Sciences, Engineering, and Agriculture"),"Engineering & Technology",DEFAULT,DEFAULT,DEFAULT),
        (null,(SELECT id FROM colleges WHERE name="College of Sciences, Engineering, and Agriculture"),"Mathematics",DEFAULT,DEFAULT,DEFAULT),
        (null,(SELECT id FROM colleges WHERE name="College of Sciences, Engineering, and Agriculture"),"Physics & Astronomy",DEFAULT,DEFAULT,DEFAULT);
/*[END] Inserts*/