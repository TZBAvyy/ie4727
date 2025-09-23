const item_1_radios = document.getElementsByName("item-1");
const item_2_radios = document.getElementsByName("item-2");
const item_3_radios = document.getElementsByName("item-3");

const quantity_1_input = document.getElementById("quantity-item-1");
const quantity_2_input = document.getElementById("quantity-item-2");
const quantity_3_input = document.getElementById("quantity-item-3");

const subtotal_1_input = document.getElementById("subtotal-item-1");
const subtotal_2_input = document.getElementById("subtotal-item-2");
const subtotal_3_input = document.getElementById("subtotal-item-3");

const total_input = document.getElementById("total");

let item_1_value="0", item_2_value="0", item_3_value="0";

function updateTotals(item_value, quantity_value, subtotal_input) {
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

