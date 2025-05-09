document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('product-form');
    const tableBody = document.querySelector('#product-table tbody');
    const totalValueEl = document.getElementById('total-value');
    const editIdInput = document.getElementById('edit-id');
    const searchInput = document.getElementById('search');
    const searchBtn = document.getElementById('search-btn');

    // تحميل المنتجات عند بدء التشغيل
    renderProducts();

    // إضافة/تعديل منتج
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const product = {
            name: document.getElementById('name').value,
            price: parseFloat(document.getElementById('price').value),
            quantity: parseInt(document.getElementById('quantity').value),
            category: document.getElementById('category').value,
            expiry: document.getElementById('expiry').value
        };

        const editId = editIdInput.value;
        const url = editId ? 'php/update.php' : 'php/insert.php';
        const method = editId ? 'PUT' : 'POST';

        if (editId) product.id = editId;

        fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(product)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                renderProducts();
                form.reset();
                editIdInput.value = '';
            } else {
                alert(data.message || 'حدث خطأ!');
            }
        })
        .catch(error => console.error('Error:', error));
    });

    // بحث عن المنتجات
    searchBtn.addEventListener('click', searchProducts);
    searchInput.addEventListener('keyup', function(e) {
        if (e.key === 'Enter') searchProducts();
    });

    // عرض جميع المنتجات
    function renderProducts() {
        fetch('php/fetch_products.php')
            .then(response => response.json())
            .then(products => {
                updateProductsTable(products);
            })
            .catch(error => console.error('Error:', error));
    }

    // بحث عن المنتجات
    function searchProducts() {
        const query = searchInput.value.trim();
        if (!query) {
            renderProducts();
            return;
        }

        fetch(`php/fetch_products.php?search=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(products => {
                updateProductsTable(products);
            })
            .catch(error => console.error('Error:', error));
    }

    // تحديث جدول المنتجات
    function updateProductsTable(products) {
        tableBody.innerHTML = '';
        let totalValue = 0;

        products.forEach(product => {
            totalValue += product.price * product.quantity;

            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${product.name}</td>
                <td>${product.price.toFixed(2)}</td>
                <td>${product.quantity}</td>
                <td>${product.category}</td>
                <td>${product.expiry || '-'}</td>
                <td>
                    <button class="btn btn-sm btn-warning me-2" onclick="editProduct(${product.id})">تعديل</button>
                    <button class="btn btn-sm btn-danger" onclick="deleteProduct(${product.id})">حذف</button>
                </td>
            `;
            tableBody.appendChild(row);
        });

        totalValueEl.textContent = `إجمالي القيمة: ${totalValue.toFixed(2)} ريال`;
    }

    // تعيين وظائف للاستخدام العام
    window.editProduct = function(id) {
        fetch(`php/fetch_products.php?id=${id}`)
            .then(response => response.json())
            .then(product => {
                if (product) {
                    document.getElementById('name').value = product.name;
                    document.getElementById('price').value = product.price;
                    document.getElementById('quantity').value = product.quantity;
                    document.getElementById('category').value = product.category;
                    document.getElementById('expiry').value = product.expiry;
                    editIdInput.value = product.id;
                    window.scrollTo({top: 0, behavior: 'smooth'});
                }
            });
    };

    window.deleteProduct = function(id) {
        if (confirm('هل أنت متأكد من حذف هذا المنتج؟')) {
            fetch('php/delete.php', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({id: id})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    renderProducts();
                } else {
                    alert(data.message || 'حدث خطأ أثناء الحذف!');
                }
            });
        }
    };
});
