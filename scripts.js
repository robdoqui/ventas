document.addEventListener("DOMContentLoaded", function() {
    fetch('products.php')
        .then(response => response.json())
        .then(products => {
            const productContainer = document.getElementById('products');
            products.forEach(product => {
                const productDiv = document.createElement('div');
                productDiv.className = 'product';
                productDiv.innerHTML = `
                    <span>${product.name} - $${product.price}</span>
                    <button onclick="addToCart(${product.id})">Añadir al Carrito</button>
                `;
                productContainer.appendChild(productDiv);
            });
        });

    const cartItems = [];

    window.addToCart = function(productId) {
        fetch(`products.php?id=${productId}`)
            .then(response => response.json())
            .then(product => {
                cartItems.push(product);
                updateCart();
            });
    };

    function updateCart() {
        const cartContainer = document.getElementById('cart-items');
        cartContainer.innerHTML = '';
        cartItems.forEach(item => {
            const cartItemDiv = document.createElement('div');
            cartItemDiv.innerHTML = `${item.name} - $${item.price}`;
            cartContainer.appendChild(cartItemDiv);
        });
    }

    document.getElementById('checkout-button').addEventListener('click', function() {
        const email = document.getElementById('email').value;
        if (email && cartItems.length > 0) {
            const data = new FormData();
            data.append('email', email);
            data.append('cart', JSON.stringify(cartItems));

            fetch('send_mail.php', {
                method: 'POST',
                body: data
            })
            .then(response => response.text())
            .then(result => {
                alert(result);
            })
            .catch(error => {
                console.error('Error:', error);
            });
        } else {
            alert("Por favor ingresa tu correo electrónico y agrega productos al carrito.");
        }
    });
});
