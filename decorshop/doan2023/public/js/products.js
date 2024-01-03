/**
 * Home Page
 */
// ready
$(document).ready(function () {
    getAllProducts();
    getHotProducts();
    getNewProducts();
})

// get all products
function getAllProducts() {
    $.ajax({
        url: 'http://localhost/api/products/index.php',
        type: 'GET',
        success: function (data) {
            var productList = JSON.parse(data)
            renderProductListUI(productList)
        },
        error: function (e) {
            console.log(e.message);
        }
    });
}

// showAllProducts
function renderProductListUI(productList) {
    productList.forEach(product => {
        $('#product-list').append(
            `
            <div class="pro" onclick="window.location.href='detail.html'";>
                <a class="item" style="text-decoration:none" href=detail.html?productId=${product.id}>
                <img src="${product.image}" alt="">
                <div class="des">
                    <span>${product.description}</span>
                    <h5>${product.name}</h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>$${product.price}</h4>
                </div>
                <a href="#" onclick="addToCart();" id="addtocart"><i class="fas fa-shopping-cart"></i></a>
            </div>
            `
        )
    });
}

// get hot Products
function getHotProducts() {
    $.ajax({
        url: 'http://localhost/api/products/hot.php',
        type: 'GET',
        success: function(data) {
            var productList = JSON.parse(data)
            renderHotProducts(productList)
        },
        error: function(e) {
            console.log(e.message);
        }
    });
}
addEventListener
// show hot products
function renderHotProducts(productList) {
    productList.forEach(product => {
        $('#product-hot').append(
            `
            <div class="col-md-3 py-2">
                <a class="card" style="text-decoration: none" href="detail.html?productId=${product.id}">
                 <img src= "${product.image}" alt="">
                    <div class="card-body">
                        <h3 class="text-center">${product.name}</h3>
                        <p class="text-center">Sản phẩm bán chạy nhất.</p>
                        <div class="star text-center">
                        <i class="fa-solid fa-star checked"></i>
                        <i class="fa-solid fa-star checked"></i>
                        <i class="fa-solid fa-star checked"></i>
                        <i class="fa-solid fa-star checked"></i>
                        <i class="fa-solid fa-star checked"></i>
                        </div>
                        <h2>$${product.price} <span>
                            <li class="fa-solid fa-cart-shopping"></li>
                        </span></h2>
                    </div>
                </a>
            </div> 
            `
        )
    });
}
