select `order`.id, `date_of_purchase`, `name`, category, price, `quantity`
from `order` 
join `orderitem` ON `order`.`id`=`orderitem`.`order_id` 
join `drinkcategory` ON drinkcategory.id=`orderitem`.`drink_id`
join `drink` on drink.id=drinkcategory.drink_id;