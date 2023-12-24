CREATE VIEW itemsview AS
SELECT items.*, categories.* FROM items
INNER JOIN categories ON items.items_categories = categories_id


SELECT items1view.*, 1 as favorite 
FROM items1view INNER JOIN favorite
ON favorite.favorite_itemsid = items1view.items_id AND favorite.favorite_usersid = 25
UNION ALL
SELECT * , 0 as favorite
FROM items1view
WHERE items_id != 
(SELECT items1view.items_id
 FROM items1view INNER JOIN favorite 
 ON favorite.favorite_itemsid = items1view.items_id AND favorite.favorite_usersid = 25);