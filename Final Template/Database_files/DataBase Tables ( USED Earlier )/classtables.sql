CREATE TABLE st_class_names (
	ClassID				 int 			 NOT NULL AUTO_INCREMENT,
	ClassName			 varchar(50)     NOT NULL,
	SchoolName			 varchar(50)     NOT NULL,
	TableName			 varchar(100)    NOT NULL,
	RelatedClass		 int    		 NOT NULL,
	
	
	PRIMARY KEY (ClassID)
	)