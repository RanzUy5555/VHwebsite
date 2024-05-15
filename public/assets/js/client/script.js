const token = $('meta[name="csrf-token"]').attr("content");
const baseUrl = window.location.origin;
let pond;
let product;

$(() => {
    if (window.location.href === route("user.carts.index")) {
        calculateCartSubTotal();
    }

    // Request
    if (window.location.href === route("user.requests.index")) {
        const columns = [
            {
                data: "id",
                render(data, type, row) {
                    return row.DT_RowIndex;
                },
            },
            { data: "service" },
            { data: "message" },
            {
                data: "is_reviewed",
                render(data) {
                    return data ? "Reviewed" : "Pending";
                },
            },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index($(".request_dt"), route("user.requests.index"), columns);
    }
});

//=========================================================
// Custom Functions()

document.addEventListener("DOMContentLoaded", function (event) {
    // initiate global glightbox

    setTimeout(() => {
        GLightbox({
            selector: ".glightbox",
        });
    }, 1000);
});

// Tool Tip
$('[data-toggle="tooltip"]').tooltip({
    html: true,
});

async function removeProductFromCart(cart) {
    const result = await confirm(
        "Do you want to remove the product from your cart?",
        "",
        "Yes"
    );
    if (result.isConfirmed) {
        try {
            const res = await axios.delete(route("user.carts.destroy", cart));
            success(res.data.success);
            $("#cart_row-" + cart).remove();
            location.reload();
        } catch (e) {
            const responses = e.response.data.errors;
            if (responses) {
                const errors = Object.values(responses);
                errors.forEach((e) => {
                    toastDanger(e);
                });
            } else {
                error(e.response.data.message);
            }
        }
    }
}

/**
 * add more product qty
 */
function addQty(product) {
    let product_price = parseFloat(product.price); // product price

    if (product_price) {
        let current_product_qty = parseInt(
            $("#quantity_field-" + product.id).val()
        ); // the current product qty in the cart
        let remaining_product_qty = parseInt(product.qty); // the overall product qty

        if (current_product_qty >= 0) {
            if (current_product_qty === remaining_product_qty) {
                toastWarning(
                    `Oops sorry, the max quantity of the product is ${remaining_product_qty}`
                );
                return false;
            }

            $("#remove_qty_btn-" + product.id).attr("disabled", false); // enable minus button

            let updated_qty_field = current_product_qty + 1; // increment 1

            $("#quantity_field-" + product.id).val(updated_qty_field); // update the current qty

            let updated_product_price = product_price * updated_qty_field;

            $("#product_price-" + product.id).text(
                `PHP ${updated_product_price.toFixed(2)}`
            ); // update the current product price text

            $("#product_price-" + product.id).attr(
                "data-price",
                `${updated_product_price.toFixed(2)}`
            ); // update the current product price value

            calculateCartSubTotal();
        }
    }
}

/**
 * remove product qty
 */
function removeQty(product) {
    let product_price = parseFloat(product.price); // product price
    if (product_price) {
        let current_product_qty = parseInt(
            $("#quantity_field-" + product.id).val()
        ); // the current product qty in the cart
        let remaining_product_qty = parseInt(product.qty); // the overall product qty

        if (current_product_qty > 1) {
            $("#remove_qty_btn-" + product.id).attr("disabled", false); // enable minus button

            let updated_qty_field = current_product_qty - 1; // decrement 1

            $("#quantity_field-" + product.id).val(updated_qty_field); // update the current qty

            let updated_product_price = product_price * updated_qty_field;

            $("#product_price-" + product.id).text(
                `PHP ${updated_product_price.toFixed(2)}`
            ); // update the current product price (text)

            $("#product_price-" + product.id).attr(
                "data-price",
                `${updated_product_price.toFixed(2)}`
            ); // update the current product price (value)

            calculateCartSubTotal();
        } else {
            $("#remove_qty_btn-" + product.id).attr("disabled", true); // disabled
        }
    }
}

/**
 * convert decimal to percentage
 */
function decimalToPercentage(decimal) {
    return parseFloat(decimal) * 100;
}

/**
 * convert percentage to decimal
 */
function percentageToDecimal(percentage) {
    return parseFloat(percentage) / 100.0;
}

/**
 * calculate cart sub total
 */
function calculateCartSubTotal() {
    const delivery_fee = $("#delivery_fee").val(); // the default delivery fee
    let total_product_price = []; // the sum of * product prices
    const product_prices = document.querySelectorAll(".product_price"); // the individual product price

    if (delivery_fee !== "") {
        product_prices.forEach((st) => {
            total_product_price.push(st.dataset.price);
        });

        // enable only if the array is not empty
        if (total_product_price.length > 0) {
            const sub_total = total_product_price.reduce(
                (previousValue, currentValue) =>
                    parseFloat(previousValue) + parseFloat(currentValue)
            ); // the product subtotal

            const grand_total =
                parseFloat(sub_total) + parseFloat(delivery_fee);

            $("#grand_total").val(grand_total.toFixed(2));

            $("#sub_total").val(sub_total); // calculate product subtotal
        }
    }
}

function getDeliveryFee(barangay) {
    if (barangay.value !== "") {
        $("#delivery_fee").val($(barangay).find(":selected").attr("data-fee"));

        log($(barangay).find(":selected").attr("data-fee"));
        calculateCartSubTotal(); // update
    }
}

async function sendOtp(event) {
    const contact = $("#contact");
    log(contact.val());

    if (isNotEmpty(contact)) {
        try {
            event.target.innerText = "Sending ...";

            const res = await axios.post(route("user.otp.store"), {
                contact: contact.val(),
            });
            success(res.data.message);
            event.target.innerText = "Send OTP";
        } catch (e) {
            log(contact.val());
            const responses = e.response.data.errors;
            if (responses) {
                const errors = Object.values(responses);
                errors.forEach((e) => {
                    toastDanger(e);
                });
            } else {
                error(e.response.data.message);
            }
        }
    }
}
