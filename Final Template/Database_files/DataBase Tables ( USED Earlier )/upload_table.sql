CREATE TABLE uploadinfo (
	StudentID			 int		     NOT NULL,
	FileID				 int             NOT NULL AUTO_INCREMENT,
	FileName    		 varchar(50) 	 NOT NULL,
	FileLocation   		 varchar(60) 	 NOT NULL,
	School				 varchar(100)	 NOT NULL,
	ClassName			 varchar(50) 	 NOT NULL,
	Teacher				 varchar(50) 	 NOT NULL,
	Chapter				 varchar(50) 	 NOT NULL,
	NotesTitle			 varchar(100) 	 NOT NULL,	
	Comments    		 text  		 	 NOt NULL,
	Content              MEDIUMBLOB      NOT NULL,
	PRIMARY KEY (FileID),
	UNIQUE (FileName,StudentID),
	FOREIGN KEY (StudentID) REFERENCES users(Id)
	)



	
	
	
