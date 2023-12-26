CREATE OR REPLACE VIEW itemsview AS
SELECT items.*, categories.* FROM items
INNER JOIN categories ON items.items_categories = categories_id

CREATE OR REPLACE VIEW myfavorite AS
SELECT users.users_id, favorite.* , items.* FROM favorite
INNER JOIN users ON users.users_id = favorite.favorite_usersid
INNER JOIN items ON items.items_id = favorite.favorite_itemsid


