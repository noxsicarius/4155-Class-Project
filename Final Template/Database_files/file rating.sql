CREATE TABLE filerating (
	FileID				 int 			 NOT NULL,
	StudentID			 int		     NOT NULL,
	Rate				 int			 NOT NULL,
	
	PRIMARY KEY (FileID,StudentID),
	FOREIGN KEY (StudentID) REFERENCES users(Id),
	FOREIGN KEY (FileID) REFERENCES uploadinfo(FileID)
	)