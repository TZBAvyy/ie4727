import { useState } from 'react';
import './Menu.css'

const Menu = () => {
    let MenuItems = [
        {
            "name":"Just Java",
            "desc":"Regular house blend, decaffeinated coffee, or flavor of the day.",
            "types": [
                {
                "type-name": "Endless Cup",
                "price": 2.00
                }
            ]
        },
        {
            "name":"Cafe au Lait",
            "desc":"House blended coffee infused into a smooth, steamed milk.",
            "types": [
                {
                    "type-name": "Single",
                    "price": 2.00
                },
                {
                    "type-name": "Double",
                    "price": 3.00
                }
            ]
            
        },
        {
            "name":"Iced Cappuccino",
            "desc":"Sweetened espresso blended with icy-cold milk and served in a chilled glass.",
            "types": [
                {
                    "type-name": "Single",
                    "price": 4.75
                },
                {
                    "type-name": "Single",
                    "price": 5.75
                }
            ]
        },
    ];

    let [total, setTotal] = useState(0.0);
    let [priceList, setPriceList] = useState(new Array(MenuItems.length).fill(0));
    let [qtyList, setQtyList] = useState(new Array(MenuItems.length).fill(0));
    let [subtotalList, setSubtotalList] = useState(new Array(MenuItems.length).fill(0));

    function handleChecked(index, newPrice) {
        const nextPriceList = priceList.map((price, i) => {
            if (index === i) {
                return newPrice;
            } else {
                return price;
            }
        });
        setPriceList(nextPriceList);
        handleSubtotalChange(index,qtyList,nextPriceList);
    }

    function handleQuantityChange(event,index) {
        const nextQtyList = qtyList.map((qty, i) => {
            if (index === i) {
                return event.target.value;
            } else {
                return qty;
            }
        });
        setQtyList(nextQtyList);
        handleSubtotalChange(index,nextQtyList,priceList);
    }

    function handleSubtotalChange(index, qtyL, priceL) {
        const nextSubtotalList = subtotalList.map((subtotal, i) => {
            if (index === i) {
                return qtyL[index] * priceL[index];
            } else {
                return subtotal;
            }
        });
        setSubtotalList(nextSubtotalList);
        setTotal(nextSubtotalList.reduce((partialSum, a) => partialSum + a, 0));
    }

    return (
<>
    <h2>Coffee at JavaJam</h2>
    <table className="menu-table">
        <tbody>
            {/* START OF LIST */}
            {MenuItems.map((item, index) => (
            <tr>
                <td className="dark-row menu-item">({index+1}) <strong>{item.name}</strong></td>
                <td className="dark-row">{item.desc}<br/> 

                    {item.types.map((type) => (

                    <strong>
                        {type['type-name']} ${type['price']} 
                        <input 
                            type="radio" 
                            name={"item-"+(index+1)} 
                            onClick={() => {handleChecked(index,type['price'])}}
                        />
                    </strong>
                    ))}
                    <strong>
                        NIL <input 
                                type="radio"
                                name={"item-"+(index+1)} 
                                onClick={() => {handleChecked(index,0)}}
                            />
                    </strong>
                </td>
                <td>
                Qty: <input 
                        className="quantity-input" 
                        type="number" 
                        name={"quantity-item-"+(index+1)} 
                        id={"quantity-item-"+(index+1)} 
                        min="0" 
                        max="10" 
                        step="1" 
                        value={qtyList[index]}
                        onChange={(e) => {handleQuantityChange(e,index)}}
                    />
                </td>
                <td>
                    $<input 
                        className="subtotal-input"
                        type="text" 
                        name={"subtotal-item-"+(index+1)} 
                        id={"subtotal-item-"+(index+1)} 
                        readonly 
                        value={subtotalList[index]}
                    />
                </td>
            </tr>

            ))} 
            {/* END OF LIST */}
            
            <tr>
                <td></td>
                <td></td>
                <td><p>Total:</p></td>
                <td>$<input 
                        className="subtotal-input" 
                        type="text" 
                        name="total" 
                        id="total" 
                        readonly 
                        value={total.toFixed(2)}/>
                </td>
            </tr>
        </tbody>
    </table>
</>
    )
    
}

export default Menu;