$(document).ready(function () {
    const storedProducts =
        JSON.parse(sessionStorage.getItem("selectedProducts")) || [];
    renderSelectedProducts(storedProducts);
});
function renderSelectedProducts(products) {
    let html = "";

    products.forEach((item) => {
        const thumbnailPath = `/asset/admin/products/${item.product_id}/${item.thumbnail}`;

        html += `
            <div class="item">
                <div class="thumbnail">
                    <img src="${thumbnailPath}" alt="${
            item.name
        }" onerror="this.src='/asset/default-thumbnail.jpg';">
                </div>
                <div class="product-info">
                    <div class="name">
                        ${item.name}
                    </div>
                    <div class="price">
                        ${formatPriceToVND(item.price)}
                    </div>
                </div>
                <div class="product-quantity">
                    Số lượng: ${item.quantity}
                </div>
            </div>
        `;
    });

    $(".product-list").html(html);
}

function formatPriceToVND(price) {
    return price.toLocaleString("vi-VN", {
        style: "currency",
        currency: "VND",
    });
}
