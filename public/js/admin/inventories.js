$(document).ready(() => {});
const addProductToTable = () => {
    const productId = $("#product_version").val();
    const productName = $("#product_version option:selected").text();
    const quantity = parseInt($("#quantity").val());
    const price = parseFloat($("#price").val());
    const vat = parseFloat($("#vat").val());
    let price_vat = (price * vat) / 100;
    let price_include_vat = price_vat + price;
    if (productId && quantity && price) {
        const productHtml = `
                    <tr>
                        <td hidden>${productId}</td>
                        <td hidden>${vat}</td>
                        <td class="text-center">${productName}</td>
                        <td class="text-center">${quantity}</td>
                        <td class="text-center">${formatPriceToVND(price)}</td>
                        <td class="text-center">${formatPriceToVND(
                            price_vat
                        )}</td>
                        <td class="text-center">${formatPriceToVND(
                            price_include_vat
                        )}</td>
                        <td class="text-center">${formatPriceToVND(
                            price_include_vat * quantity
                        )}</td>
                    </tr>
                `;
        $("#product_list").append(productHtml);
        const total = totalPriceList();
        $("#total_price").text(formatPriceToVND(total));
    }
};

const formatPriceToVND = (price) => {
    const number = parseFloat(price); // hoặc Number(price)
    if (isNaN(number)) return "0₫";
    return number.toLocaleString("vi-VN", {
        style: "currency",
        currency: "VND",
    });
};

const totalPriceList = () => {
    const products = $("#product_list tr")
        .map((_, row) => {
            const $row = $(row);
            const quantity = parseInt($row.find("td").eq(3).text().trim());
            const price_include_vat_Text = $row.find("td").eq(6).text().trim();
            const price_include_vat = parseFloat(
                price_include_vat_Text.replace(/[^\d]/g, "")
            );

            return quantity * price_include_vat;
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
            const vat_rate = parseInt($row.find("td").eq(1).text().trim());
            const productName = $row.find("td").eq(2).text().trim();
            const quantity = parseInt($row.find("td").eq(3).text().trim());

            const price_Text = $row.find("td").eq(4).text().trim();
            const cleaned = price_Text.replace(/\./g, "").replace(/[^\d]/g, "");
            const price = parseFloat(cleaned);

            const total_price_Text = $row.find("td").eq(7).text().trim();
            const total_price_Text_cleaned = total_price_Text
                .replace(/\./g, "")
                .replace(/[^\d]/g, "");
            const total_price = parseFloat(total_price_Text_cleaned);
            return {
                id: productId,
                name: productName,
                quantity: quantity,
                vat_rate: vat_rate,
                price: price,
                total: total_price,
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
                toast("Thêm thành công", "success");
                window.location.href = $routeIndex;
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
