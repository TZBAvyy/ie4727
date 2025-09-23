var CafeNode1 = document.getElementById("Qty_Cafe_Single");
var CafeNode2 = document.getElementById("Qty_Cafe_Double");
var CafeNode3 = document.getElementById("QtyCafe");

CafeNode1.addEventListener("change", Cal_Cafe, false);
CafeNode2.addEventListener("change", Cal_Cafe, false);
CafeNode3.addEventListener("change", Cal_Cafe, false);

function Cal_Cafe(event) {

    var qtyCafechk = event.currentTarget;
    var pos = qtyCafechk.value.search=(/^[0-9]*$/);
    if (pos != 0) {
        alert("You entered (" + qtyCafechk.value + ") is not correct. \n" + "Only NUMBER are allowed.");
        qtyCafechk.value = "";
        document.getElementById("Price_Cafe").value = "";
        qtyCafechk.focus()  
        return false;
    }

    if (CafeNode1.checked == true) {
        Total_Cafe_Price = CafeNode1.value * CafeNode3.value;
        document.getElementById("Price_Cafe").value = parseFloat(Total_Cafe_Price).toFixed(2);
    }
    if (CafeNode2.checked == true) {
        Total_Cafe_Price = CafeNode2.value * CafeNode3.value;
        document.getElementById("Price_Cafe").value = parseFloat(Total_Cafe_Price).toFixed(2);
    }
    Cal_total();
}

function Cal_total() {
    var total = 0;
    var itemPrices = document.querySelectorAll('input[id^="Price_"]');
    itemPrices.forEach(function (priceInput) {
        var price = parseFloat(priceInput.value);
        if (!isNaN(price)) {
            total += price;
        }
    });
    document.getElementById("totalPrice").value = total.toFixed(2);
    return total;
}
