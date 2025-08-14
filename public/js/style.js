
    document.querySelectorAll('.quantity-btn').forEach(function (button) {
        button.addEventListener('click', function () {
            const input = this.closest('form').querySelector('.quantity-input');
            let currentValue = parseInt(input.value);
            if (this.dataset.action === 'increase') {
                input.value = currentValue + 1;
            } else if (this.dataset.action === 'decrease' && currentValue > 1) {
                input.value = currentValue - 1;
            }
            input.dispatchEvent(new Event('input')); // Trigger input change event after update
        });
    });

    document.querySelectorAll('.quantity-input').forEach(function (input) {
        const originalQuantity = input.getAttribute('data-original-quantity');

        input.addEventListener('input', function () {
            const form = input.closest('form');
            const quantity = input.value;

            // AJAX request to update the cart without submitting the form
            const formData = new FormData(form);
            formData.append('quantity', quantity); // Add updated quantity to the form data

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest', // For Laravel to detect AJAX request
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update the UI with new totals
                    const totalCell = input.closest('tr').querySelector('.fw-bold');
                    totalCell.textContent = `৳${data.itemTotal.toFixed(2)}`;
                    
                    // Update the cart total
                    const cartTotal = document.querySelector('.cart-total strong');
                    cartTotal.textContent = `৳${data.cartTotal.toFixed(2)}`;
                    window.location.href = '/cart';
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
