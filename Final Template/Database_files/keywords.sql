CREATE TABLE Keywords (
	FileID				 int             NOT NULL,
	Keyword		   		 text  		 	 NOt NULL,
	ComparedTO	   		 text  		 	 NOt NULL,
	MatchedTO			 text			 NOt NULL,
	PRIMARY KEY (FileID),
	FOREIGN KEY (FileID) REFERENCES uploadinfo(FileID)
	)



	
	
	
