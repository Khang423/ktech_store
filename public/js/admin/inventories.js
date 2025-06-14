$(document).ready(() => {});
const addProductToTable = () => {
    const productId = $("#product_version_id").val();
    const productName = $("#product_version_id option:selected").text();
    const quantity = parseInt($("#quantity").val());
    const price = parseFloat($("#price").val());
    if (productId && quantity && price) {
        const productHtml = `
                    <tr>
                        <td hidden>${productId}</td>
                        <td>${productName}</td>
                        <td>${quantity}</td>
                        <td>${formatPriceToVND(price)}</td>
                        <td>${formatPriceToVND(price * quantity)}</td>
                    </tr>
                `;
        $("#product_list").append(productHtml);
        const total = totalPriceList();
        $("#total_price").text(formatPriceToVND(total));
    }
};

const formatPriceToVND = (price) => {
    const number = parseFloat(price); // hoặc Number(price)
    if (isNaN(number)) return "0 12₫";
    return number.toLocaleString("vi-VN", {
        style: "currency",
        currency: "VND",
    });
};

const totalPriceList = () => {
    const products = $("#product_list tr")
        .map((_, row) => {
            const $row = $(row);
            const quantity = parseInt($row.find("td").eq(2).text().trim());
            const priceText = $row.find("td").eq(3).text().trim();
            const price = parseFloat(priceText.replace(/[^\d]/g, ""));

            return quantity * price;
        })
        .get();

    // Tổng tất cả các dòng
    const total = products.reduce((sum, val) => sum + val, 0);
    return total;
};

const countProducts = () => {
    return (products = $("#product_list tr")
        .map((_, row) => {
            const $row = $(row);
            const productId = parseInt($row.find("td").eq(0).text().trim());
            const productName = $row.find("td").eq(1).text().trim();
            const quantity = parseInt($row.find("td").eq(2).text().trim());
            const price = parseFloat($row.find("td").eq(3).text().trim());

            return {
                id: productId,
                name: productName,
                quantity: quantity,
                price: price,
                total: quantity * price,
            };
        })
        .get());
};

const storeInventory = ($routeStore, $routeIndex) => {
    $("#btn-store").click((e) => {
        e.preventDefault();
        let form_data = new FormData();
        const products = countProducts();
        form_data.append("products", JSON.stringify(products));
        form_data.append(
            "_token",
            $('meta[name="csrf-token"]').attr("content")
        );
        form_data.append("supplier_id", $("#supplier_id").val());

        $.ajax({
            url: $routeStore,
            type: "POST",
            dataType: "json",
            contentType: false,
            processData: false,
            data: form_data,
            success: () => {
                window.location.href = $routeIndex;
                toast("Thêm thành công", "success");
            },
            error: (data) => {
                $(".text-danger").text("");
                if (data.responseJSON && data.responseJSON.errors) {
                    let errors = data.responseJSON.errors;
                    for (let field in errors) {
                        if (errors.hasOwnProperty(field)) {
                            $(`.error-${field}`).text(errors[field][0]);
                        }
                    }
                }
            },
        });
    });
};
