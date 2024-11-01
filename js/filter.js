function filterProducts() {
    const searchInput = document.getElementById('search-name').value.toLowerCase();
    const priceFilter = document.getElementById('filter-price').value;
    const categoryFilter = document.getElementById("filter-category").value; 
    const products = document.querySelectorAll('.product-item');

    products.forEach(product => {
        const productName = product.getAttribute('data-name').toLowerCase();
        const productPrice = parseFloat(product.getAttribute('data-price'));
        const productCategory = product.getAttribute('data-category'); 

        const matchesName = productName.includes(searchInput);
        console.log("Matching Name:", matchesName, "| Product Name:", productName);

        let matchesPrice = true;
        if (priceFilter) {
            const [minPrice, maxPrice] = priceFilter.split('-').map(Number);
            matchesPrice = productPrice >= minPrice && (maxPrice ? productPrice <= maxPrice : true);
            console.log("Matching Price:", matchesPrice, "| Product Price:", productPrice);
        }

        const matchesCategory = !categoryFilter || productCategory === categoryFilter; 
        console.log("Matching Category:", matchesCategory, "| Product Category:", productCategory);

        if (matchesName && matchesPrice && matchesCategory) {
            console.log("Showing product:", productName);
            product.style.display = 'block';
        } else {
            console.log("Hiding product:", productName);
            product.style.display = 'none';
        }
    });
}
