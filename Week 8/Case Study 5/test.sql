select `order`.`date_of_purchase`, `customer`.`name`, drink.name, drinkcategory.category, drinkcategory.price, `orderitem`.`quantity`
from `order` 
join customer on `order`.`customer_id`=`customer`.`id`
join `orderitem` ON `order`.`id`=`orderitem`.`order_id` 
join `drinkcategory` ON drinkcategory.id=`orderitem`.`drink_id`
join `drink` on drink.id=drinkcategory.drink_id;