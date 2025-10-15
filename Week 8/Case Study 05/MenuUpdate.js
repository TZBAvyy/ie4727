document.addEventListener("DOMContentLoaded", function () {

  function updateTotal() {
    const prices = [
      parseFloat(document.getElementById("Price_Cafe1").value) || 0,
      parseFloat(document.getElementById("Price_Cafe2").value) || 0,
      parseFloat(document.getElementById("Price_Cafe3").value) || 0
    ];
    const total = prices.reduce((sum, val) => sum + val, 0);
    document.getElementById("Total_Price").value = total.toFixed(2);
  }

  function setupProduct(singleId, doubleId, qtyId, priceId) {
    const single = document.getElementById(singleId);
    const double = document.getElementById(doubleId);
    const qty = document.getElementById(qtyId);
    const price = document.getElementById(priceId);

    function calculate() {
      if (!qty.value || isNaN(qty.value)) {
        price.value = 0;
        updateTotal();
        return;
      }

      let unitPrice = 0;
      if (single.checked) unitPrice = parseFloat(single.value);
      if (double.checked) unitPrice = parseFloat(double.value);

      price.value = (unitPrice * qty.value).toFixed(2);
      updateTotal();
    }

    [single, double, qty].forEach(input => {
      if (input) input.addEventListener("change", calculate);
    });
  }

  setupProduct("Qty_Cafe_Single1", "Qty_Cafe_Double1", "QtyCafe1", "Price_Cafe1");
  setupProduct("Qty_Cafe_Single2", "Qty_Cafe_Double2", "QtyCafe2", "Price_Cafe2");
  setupProduct("Qty_Cafe_Single3", "Qty_Cafe_Double3", "QtyCafe3", "Price_Cafe3");

});
