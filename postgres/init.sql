CREATE SEQUENCE links_id_seq INCREMENT BY 1 MINVALUE 1 START 1;
CREATE TABLE links (id INT NOT NULL, link TEXT NOT NULL, short_link VARCHAR(1024) DEFAULT NULL, PRIMARY KEY(id))