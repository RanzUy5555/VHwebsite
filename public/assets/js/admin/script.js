const token = $('meta[name="csrf-token"]').attr("content");
const baseUrl = window.location.origin;
let pond;

$(() => {
    // Activity Logs
    if (window.location.href === route("admin.activity_logs.index")) {
        const columns = [
            {
                data: "id",
            },
            { data: "description" },
            {
                data: "created_at",
                render(data) {
                    return formatDate(data, "datetime");
                },
            },
            { data: "properties.ip" },
        ];
        c_index(
            $(".activitylog_dt"),
            route("admin.activity_logs.index"),
            columns
        );
    }

    //Contact;
    if (window.location.href === route("admin.contacts.index")) {
        const columns = [
            {
                data: "id",
                render(data, type, row) {
                    return row.DT_RowIndex;
                },
            },
            { data: "name" },
            { data: "email" },
            { data: "contact" },
            { data: "message" },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index($(".contact_dt"), route("admin.contacts.index"), columns);
    }

    //Municipality;
    if (window.location.href === route("admin.municipalities.index")) {
        const columns = [
            {
                data: "id",
                render(data, type, row) {
                    return row.DT_RowIndex;
                },
            },
            { data: "name" },
            { data: "fee" },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index(
            $(".municipality_dt"),
            route("admin.municipalities.index"),
            columns,
            {
                title: "<h3 class='text-center'>List of Municipality </h3>",
            }
        );
    }

    /** Start Product Management  */

    // Supplier
    if (window.location.href === route("admin.suppliers.index")) {
        const columns = [
            {
                data: "id",
                render(data, type, row) {
                    return row.DT_RowIndex;
                },
            },
            {
                data: "company",
                render(data) {
                    return `<span class='text-capitalize'>${data}</span>`;
                },
            },
            {
                data: "manager",
                render(data) {
                    return `<span class='text-capitalize'>${data}</span>`;
                },
            },
            { data: "contact" },
            { data: "email" },
            {
                data: "created_at",
                render(data) {
                    return formatDate(data, "full");
                },
            },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index($(".supplier_dt"), route("admin.suppliers.index"), columns);
    }

    //Category;
    if (window.location.href === route("admin.categories.index")) {
        const columns = [
            {
                data: "id",
                render(data, type, row) {
                    return row.DT_RowIndex;
                },
            },
            { data: "name" },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index($(".category_dt"), route("admin.categories.index"), columns, {
            title: "<h3 class='text-center'>List of Category </h3>",
        });
    }

    //Brand;
    if (window.location.href === route("admin.brands.index")) {
        const columns = [
            {
                data: "id",
                render(data, type, row) {
                    return row.DT_RowIndex;
                },
            },
            { data: "name" },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index($(".brand_dt"), route("admin.brands.index"), columns, {
            title: "<h3 class='text-center'>List of Brand </h3>",
        });
    }

    // Product
    if (window.location.href === route("admin.products.index")) {
        const columns = [
            {
                data: "id",
                render(data, type, row) {
                    return row.DT_RowIndex;
                },
            },
            {
                data: "featured_photo",
                render(data) {
                    return handleNullImage(data);
                },
            },
            {
                data: "name",
            },
            { data: "category" },
            { data: "brand" },
            { data: "supplier" },
            {
                data: "qty",
                render(data) {
                    return handleProductQty(data);
                },
            },
            {
                data: "is_customized",
                render(data) {
                    return isCustomized(data);
                },
            },

            {
                data: "is_available",
                render(data) {
                    return isAvailable(data);
                },
            },
            {
                data: "updated_at",
            },
            { data: "actions", orderable: false, searchable: false },
        ];
        const table = c_index(
            $(".product_dt"),
            route("admin.products.index"),
            columns
        );

        $("#product_management_nav").addClass("active");
        $("#product").addClass("text-primary");
    }

    /** End Product Management  */

    //User;
    if (window.location.href === route("admin.users.index")) {
        const user_data = [
            { data: "id" },
            {
                data: "avatar",
                render(data) {
                    return handleNullAvatar(data);
                },
            },
            { data: "name" },
            {
                data: "email_verified_at",
                render(data) {
                    return isVerified(data);
                },
            },
            {
                data: "role",
                render(data) {
                    return `<span class='badge badge-primary'>${data}</span>`;
                },
            },
            {
                data: "is_activated",
                render(data) {
                    return isActivated(data);
                },
            },
            {
                data: "created_at",
                render(data) {
                    return formatDate(data.date, "full");
                },
            },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index($(".user_dt"), route("admin.users.index"), user_data, {
            title: "<h3 class='text-center'>List of User Account </h3>",
        });
    }

    // Manage Payment Methods
    if (window.location.href === route("admin.payment_methods.index")) {
        const column_data = [
            { data: "type" },
            { data: "account_name" },
            { data: "account_no" },
            {
                data: "is_online",
                render(data) {
                    return isActivated(data);
                },
            },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index(
            $(".payment_method_dt"),
            route("admin.payment_methods.index"),
            column_data
        );
    }

    // Order
    if (window.location.href === route("admin.orders.index")) {
        const columns = [
            {
                data: "id",
                render(data, type, row) {
                    return row.DT_RowIndex;
                },
            },
            { data: "transaction_no" },
            { data: "reference_no" },
            {
                data: "customer",
                render(data) {
                    return `<span class='text-capitalize'>${data}</span>`;
                },
            },
            {
                data: "status",
                render(data) {
                    return handleOrderStatus(data);
                },
            },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index($(".order_dt"), route("admin.orders.index"), columns);

        $("#order_management_nav").addClass("active");
    }

    // Manage Services
    if (window.location.href === route("admin.services.index")) {
        const columns = [
            {
                data: "featured_photo",
                render(data) {
                    return handleNullImage(data, "", 150);
                },
            },
            { data: "name" },
            { data: "description" },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index($(".services_dt"), route("admin.services.index"), columns);

        initiateFilePond(
            ".service_image",
            ["image/png", "image/jpeg", "image/jpg", "image/webp"],
            `Drag & Drop or <span class="filepond--label-action"> Browse Featured Photo </span`
        );
    }

    // Request
    if (window.location.href === route("admin.requests.index")) {
        const columns = [
            {
                data: "id",
                render(data, type, row) {
                    return row.DT_RowIndex;
                },
            },
            { data: "user" },
            { data: "service" },
            { data: "message" },
            {
                data: "target_date",
                render(data) {
                    return formatDate(data, "full");
                },
            },
            {
                data: "file_link",
                render(data) {
                    return `<a href='${data}' target='_blank'>${data}</a>`;
                },
            },

            {
                data: "is_reviewed",
                render(data) {
                    return data ? "Reviewed" : "Pending";
                },
            },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index($(".request_dt"), route("admin.requests.index"), columns);
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

function getOrderByStatus(status) {
    if (status.value) {
        const columns = [
            {
                data: "id",
                render(data, type, row) {
                    return row.DT_RowIndex;
                },
            },
            { data: "transaction_no" },
            {
                data: "customer",
                render(data) {
                    return `<span class='text-capitalize'>${data}</span>`;
                },
            },
            {
                data: "status",
                render(data) {
                    return handleOrderStatus(data);
                },
            },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index(
            $(".order_dt"),
            route("admin.orders.index", {
                status: status.value,
            }),
            columns,
            null,
            true
        );
    }
}

/**
 * get product by qty
 * @param {*} qty
 */
function getProductByQty(qty) {
    if (qty.value) {
        const columns = [
            {
                data: "id",
                render(data, type, row) {
                    return row.DT_RowIndex;
                },
            },
            {
                data: "featured_photo",
                render(data) {
                    return handleNullImage(data);
                },
            },
            {
                data: "name",
            },
            { data: "category" },
            { data: "brand" },
            { data: "supplier" },
            {
                data: "qty",
                render(data) {
                    return handleProductQty(data);
                },
            },
            { data: "expired_at" },

            {
                data: "is_expired",
                render(data) {
                    return isExpired(data);
                },
            },
            {
                data: "is_available",
                render(data) {
                    return isAvailable(data);
                },
            },
            {
                data: "updated_at",
            },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index(
            $(".product_dt"),
            route("admin.products.index", {
                qty: qty.value,
            }),
            columns,
            null,
            true
        );
    }
}

    // function toggleSideNavAvatar() {
//     const sideNavAvatar = $("#sidenav_avatar");

//     if (sideNavAvatar.css("display") === "block") {
//         sideNavAvatar.css("display", "none");
//     } else {
//         sideNavAvatar.css("display", "block");
//     }
// }
