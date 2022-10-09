

DROP PROCEDURE IF EXISTS fix_price;

DELIMITER //
CREATE PROCEDURE fix_price()
  BEGIN
    
    UPDATE carts SET price = (
		SELECT products.price
          FROM products
		 WHERE products.id = carts.product_id
         )
     WHERE carts.price IS NULL LIMIT 100;
     
    END //
     
DELIMITER ;




DROP PROCEDURE IF EXISTS calc_subtotal;

DELIMITER //
CREATE PROCEDURE calc_subtotal()
  BEGIN
    
    UPDATE carts SET subtotal = price*quantity
     WHERE carts.subtotal IS NULL LIMIT 100;
     
    END //
     
DELIMITER ;

     
