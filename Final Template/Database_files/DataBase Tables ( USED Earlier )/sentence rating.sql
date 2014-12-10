CREATE TABLE sentencerating (
	ClassID				 int 			 NOT NULL,
	SentenceID			 int		     NOT NULL,
	StudentID			 int			 NOT NULL,
	Rate				 int			 NOT NULL,
	
	PRIMARY KEY (ClassID,SentenceID,StudentID),
	FOREIGN KEY (StudentID) REFERENCES users(Id)	
	)