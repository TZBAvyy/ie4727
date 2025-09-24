var CafeNode1 = document.getElementById("Qty_Cafe_Single1");
var CafeNode2 = document.getElementById("Qty_Cafe_Double1");
var CafeNode3 = document.getElementById("QtyCafe1");

CafeNode1.addEventListener("change", Cal_Cafe, false);
CafeNode2.addEventListener("change", Cal_Cafe, false);
CafeNode3.addEventListener("change", Cal_Cafe, false);

function Cal_Cafe(event) {
    var qtyCafechk = event.currentTarget;
    var pos = qtyCafechk.value.search(/^[0-9]*$/);
    if (pos != 0) {
        alert("You entered (" + qtyCafechk.value + ") is not correct. \n" + "Only NUMBER are allowed.");
        qtyCafechk.value = "";
        document.getElementById("Price_Cafe1").value = "";
        qtyCafechk.focus()  
        return false;
    }
    if (CafeNode1.checked == true) {
        var Total_Cafe_Price = CafeNode1.value * CafeNode3.value;
        document.getElementById("Price_Cafe1").value = parseFloat(Total_Cafe_Price).toFixed(2);
    }
    if (CafeNode2.checked == true) {
        Total_Cafe_Price = CafeNode2.value * CafeNode3.value;
        document.getElementById("Price_Cafe1").value = parseFloat(Total_Cafe_Price).toFixed(2);
    }
    Cal_total();
}

var CafeNode4 = document.getElementById("Qty_Cafe_Single2");
var CafeNode5 = document.getElementById("Qty_Cafe_Double2");
var CafeNode6 = document.getElementById("QtyCafe2");

CafeNode4.addEventListener("change", Cal_Cafe1, false);
CafeNode5.addEventListener("change", Cal_Cafe1, false);
CafeNode6.addEventListener("change", Cal_Cafe1, false);

function Cal_Cafe1(event) {
    var qtyCafechk = event.currentTarget;
    var pos = qtyCafechk.value.search(/^[0-9]*$/);
    if (pos != 0) {
        alert("You entered (" + qtyCafechk.value + ") is not correct. \n" + "Only NUMBER are allowed.");
        qtyCafechk.value = "";
        document.getElementById("Price_Cafe2").value = "";
        qtyCafechk.focus()  
        return false;
    }
    if (CafeNode4.checked == true) {
        var Total_Cafe_Price1 = CafeNode4.value * CafeNode6.value;
        document.getElementById("Price_Cafe2").value = parseFloat(Total_Cafe_Price1).toFixed(2);
    }
    if (CafeNode5.checked == true) {
        Total_Cafe_Price1 = CafeNode5.value * CafeNode6.value;
        document.getElementById("Price_Cafe2").value = parseFloat(Total_Cafe_Price1).toFixed(2);
    }
    Cal_total();
}

var CafeNode7 = document.getElementById("Qty_Cafe_Single3");
var CafeNode8 = document.getElementById("Qty_Cafe_Double3");
var CafeNode9 = document.getElementById("QtyCafe3");

CafeNode7.addEventListener("change", Cal_Cafe2, false);
CafeNode8.addEventListener("change", Cal_Cafe2, false);
CafeNode9.addEventListener("change", Cal_Cafe2, false);

function Cal_Cafe2(event) {
    var qtyCafechk = event.currentTarget;
    var pos = qtyCafechk.value.search(/^[0-9]*$/);
    if (pos != 0) {
        alert("You entered (" + qtyCafechk.value + ") is not correct. \n" + "Only NUMBER are allowed.");
        qtyCafechk.value = "";
        document.getElementById("Price_Cafe3").value = "";
        qtyCafechk.focus()
        return false;
    }
    if (CafeNode7.checked == true) {
        var Total_Cafe_Price2 = CafeNode7.value * CafeNode9.value;
        document.getElementById("Price_Cafe3").value = parseFloat(Total_Cafe_Price2).toFixed(2);
    }
    if (CafeNode8.checked == true) {
        Total_Cafe_Price2 = CafeNode8.value * CafeNode9.value;
        document.getElementById("Price_Cafe3").value = parseFloat(Total_Cafe_Price2).toFixed(2);
    }
    Cal_total();
}

function Cal_total() {
    var total = 0;
    var Price1 = document.getElementById("Price_Cafe1").value;
    var Price2 = document.getElementById("Price_Cafe2").value;
    var Price3 = document.getElementById("Price_Cafe3").value;
    if (Price1 != "") {
        total = total + parseFloat(Price1);
    }
    if (Price2 != "") {
        total = total + parseFloat(Price2);
    }
    if (Price3 != "") {
        total = total + parseFloat(Price3);
    }
    document.getElementById("Total_Price").value = parseFloat(total).toFixed(2);
}
