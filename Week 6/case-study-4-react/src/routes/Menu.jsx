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

    let [values, setValues] = useState(new Array(MenuItems.length));
    let [qty, setQtys] = useState(new Array(MenuItems.length));
    let [subtotals, setSubtotals] = useState(new Array(MenuItems.length));

    function handleChange(e) {
        const item_subtotal = parseFloat(item_value) * parseInt(quantity_value)
        subtotal_input.value = `${item_subtotal.toFixed(2)}`;
        const total_result = parseFloat(subtotal_1_input.value) + parseFloat(subtotal_2_input.value) + parseFloat(subtotal_3_input.value);
        total_input.value = `${total_result.toFixed(2)}`
    }

    quantity_1_input.addEventListener("input", (e) => {
        updateTotals(item_1_value, quantity_1_input.value, subtotal_1_input);
    })

    quantity_2_input.addEventListener("input", (e) => {
        updateTotals(item_2_value, quantity_2_input.value, subtotal_2_input);
    })

    quantity_3_input.addEventListener("input", (e) => {
        updateTotals(item_3_value, quantity_3_input.value, subtotal_3_input);
    })

    for (let i=0; i < item_1_radios.length ; i++) {
        item_1_radios[i].addEventListener("click", (e) => {
            item_1_value = item_1_radios[i].value;
            updateTotals(item_1_value, quantity_1_input.value, subtotal_1_input);
        })
    }

    for (let i=0; i < item_2_radios.length ; i++) {
        item_2_radios[i].addEventListener("click", (e) => {
            item_2_value = item_2_radios[i].value;
            updateTotals(item_2_value, quantity_2_input.value, subtotal_2_input);
        })
    }

    for (let i=0; i < item_3_radios.length ; i++) {
        item_3_radios[i].addEventListener("click", (e) => {
            item_3_value = item_3_radios[i].value;
            updateTotals(item_3_value, quantity_3_input.value, subtotal_3_input);
        })
    }

    return (
<>
    <h2>Coffee at JavaJam</h2>
    <table className="menu-table"> 
        <tbody>
            {MenuItems.map((item, index) => (
            <tr>
                <td className="dark-row menu-item">({index+1}) <strong>{item.name}</strong></td>
                <td className="dark-row">{item.desc}<br/> 
                    {item.types.map((type) => (
                    <strong>
                        {type['type-name']} ${type['price']} <input type="radio" name={"item-"+(index+1)} value="2"/>
                    </strong>
                    ))}
                    <strong>NIL <input type="radio" name={"item-"+(index+1)} value="0" checked="checked"/></strong>
                </td>
                <td>Qty: <input className="quantity-input" type="number" name={"quantity-item-"+(index+1)} id={"quantity-item-"+(index+1)} min="0" max="10" step="1" value="0"/></td>
                <td>$<input className="subtotal-input" type="text" name={"subtotal-item-"+(index+1)} id={"subtotal-item-"+(index+1)} readonly value="0.00"/></td>
            </tr>
            ))}
            

            <tr>
                <td></td>
                <td></td>
                <td><p>Total:</p></td>
                <td>$<input className="subtotal-input" type="text" name="total" id="total" readonly value="0.00"/></td>
            </tr>
        </tbody>
    </table>
</>
    )
    
}

export default Menu;