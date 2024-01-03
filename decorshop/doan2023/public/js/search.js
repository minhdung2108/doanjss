function getParam(param) {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString)
    return urlParams.get(param)
}

$(document).ready(function() {
    var key = getParam('key')
    $.ajax({
        url: 'http://localhost/api/products/search.php?key=' + key,
        type: 'GET',
        success: function(data) {
            var productList = JSON.parse(data)
            renderProductListUI(productList)
        },
        error: function(e) {
            console.log(e.message);
        }
    });
})


// show Search Products
function renderProductListUI(productList) {
    productList.forEach(product => {
        $('#product-search').append(
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
                <a href="#" onclick="addToCart(); navigateToProductDetail();" id="addtocart"><i class="fas fa-shopping-cart"></i></a>
            </div>
            
            `
        )
    });
}