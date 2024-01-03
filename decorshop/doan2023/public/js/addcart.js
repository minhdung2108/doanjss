document.addEventListener("DOMContentLoaded", (event) => {
    console.log("DOM fully loaded and parsed");
    const ordersString = localStorage.getItem("ORDERS")
    try {
        const list = JSON.parse(ordersString)
        if (Array.isArray(list)) {
            renderCart(list)
        }
    } catch (error) {
        console.log({error})

    }
    function getAllProducts() {
        $.ajax({
            URL: "http://localhost/api/products/index.php",
            type: "GET",
            success: function (data) {
                var productList = JSON.parse(data);
                renderProductListUI(productList);
            },
            error: function (e) {
                console.log(e.message);
            },
        });
    }
});

var itemList = []

function loadCart() {
    var json = localStorage.getItem('cart')
    if (json != null) {
        itemList = JSON.parse(json) //sử dụng để chuyển đổi một chuỗi JSON thành một đối tượng JavaScript.
    }

    console.log(itemList)
    render(itemList)
}

function saveToLocaStorage() {
    this.localStorage.setItem('cart', JSON.stringify(itemList))
}
//Save todoList to localStorage when tab closing
window.addEventListener('beforeunload', function(e) {
    saveToLocaStorage()
});

function addToCart(item) {
    let count = 0
    itemList.forEach(it => {
        if (it.productId == item.productId) {
            it.quantity += item.quantity
            count++;
        }
    })
    if (count == 0) {
        itemList.push(item)
    }

    saveToLocaStorage()
}

function removeFromCart(productId) {
    for (let i = 0; i < itemList.length; i++) {
        if (productId == itemList[i].productId) {
            itemList.splice(i, 1)

        }
    }
    render(itemList)
}

function render(cart) {
    $('#cart-list').empty()
    for (let i = 0; i < cart.length; i++) {
        let product = cart[i];
        let productElement = `
        <section id="cart" class="section-p1" >
        <table width="100%">
            <thead>
                <tr>
                    <td>Remove</td>
                    <td>Image</td>
                    <td>Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Subtotal</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <input type="hidden" id="productId" value="${product.id}" />
                    <td><a href="#" onclick="doDeleteItem(${product.id}><i class="far fa-times-circle"></i></a></td>
                    <td><img src="${product.image}" alt="${product.name}"></td>
                    <td>${product.name}</td>
                    <td>$${product.price}</td>
                    <td><input type="number" value="${product.quantity}"></td>
                    <td>$${product.price}</td>
                </tr>

            </tbody>
        </table>
    </section>
           
        `;

        // Thêm sản phẩm vào #cart-list
        $('#cart-list').append(productElement);

    }

    // Tính tổng số lượng và giá trị đơn hàng
    let subtotal = 0;
    for (let i = 0; i < cart.length; i++) {
        subtotal += cart[i].productPrice * cart[i].quantity;
    }

    // Hiển thị thông tin tổng giỏ hàng
    let summaryElement = `
    <div id="subtotal">
        <h3>Cart Totatal</h3>
        <table>
            <tr>
                <td>Cart Subtotal </td>
                <td>$${subtotal}</td>
            </tr>
            <tr>
                <td>Shipping</td>
                <td>Free</td>
            </tr>
            <tr>
                <td><strong>Total</strong></td>
                <td>$${subtotal}</td>
            </tr>
        </table>
        <button>Proceed to checkout</button>

    </div>

</section>
       
        
    `;

    // Thêm thông tin tổng giỏ hàng vào #cart-list
    $('#cart-list').append(summaryElement);
    addCartEvents()

}

function addCartEvents() {
    let btnDeleteItem = document.getElementById('btnDeleteItem')
    btnDeleteItem.addEventListener('click', doDeleteItem)
}

function doDeleteItem(productId) {
    removeFromCart(productId)
}


// update quantity
function updateQuantity(productId, newQuantity) {
    for (let i = 0; i < itemList.length; i++) {
        if (productId == itemList[i].productId) {
            itemList[i].quantity = parseInt(newQuantity);
            break;
        }
    }
    saveToLocaStorage();
    render(itemList);
}