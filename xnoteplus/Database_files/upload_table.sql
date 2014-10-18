USE a_database
GO
CREATE TABLE UploadInfo (
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
	PRIMARY KEY (FileID),
	UNIQUE (FileName),
	FOREIGN KEY (StudentID) REFERENCES users(Id)
	)
GO


	
	
	
