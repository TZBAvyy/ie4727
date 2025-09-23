import './Menu.css'

const Menu = () => {
    const MenuItems = [
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