insert into categories (name) VALUES ('category1');
insert into categories (name) VALUES ('category2');
insert into products (category_id, name, description, price, img_md,img_sm) VALUES (1,'name1', 'description1', 123, '/asdfoioce','/asdfoioce');
insert into products (category_id, name, description, price, img_md,img_sm) VALUES (2,'name2', 'description2', 12123, '/asdfoioceasdf','/asdfoioceasdf');
insert into products (category_id, name, description, price, img_md,img_sm) VALUES (1, 'name3', 'description3', 12123, '/asdfoioceasdfasdf','/asdfoioceasdf');
insert into images (product_id, path) VALUES (1, 'path1'),(1, 'path2'),(2, 'path3'),(2, 'path4'),(3, 'path5');

