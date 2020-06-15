create database TestExample;
use TestExample;

CREATE TABLE Products (
    ID INT NOT NULL AUTO_INCREMENT, 
    Name VARCHAR(50) NOT NULL,  
    Description VARCHAR(500),
    Price INT NOT NULL,
    Picture VARCHAR(50),
    PRIMARY KEY (ID)
);

INSERT INTO Products (Name,Description,Price,Picture) VALUES("Carrots","Yummy vegetable", 1, "carrot.jpg");
INSERT INTO Products (Name,Description,Price,Picture) VALUES("Tomatoe","Red vegetable that makes you healthy", 3, "tomato.jpg");
INSERT INTO Products (Name,Description,Price,Picture) VALUES("Watermelon","Healthy fruit", 4, "watermelon.jpg");
INSERT INTO Products (Name,Description,Price,Picture) VALUES("Apple","Best apple", 10, "apple.jpg");
INSERT INTO Products (Name,Description,Price,Picture) VALUES("Grapes","Wonderful grapes", 1, "grapes.jpg");

COMMIT;
