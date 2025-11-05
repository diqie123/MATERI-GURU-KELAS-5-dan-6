// School Cashier System JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Initialize popovers
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });

    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert:not(.alert-permanent)');
    alerts.forEach(alert => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });

    // Confirmation for delete buttons
    const deleteButtons = document.querySelectorAll('.btn-delete');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                e.preventDefault();
            }
        });
    });

    // Format currency input
    const currencyInputs = document.querySelectorAll('.currency-input');
    currencyInputs.forEach(input => {
        input.addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^\d]/g, '');
            if (value) {
                value = new Intl.NumberFormat('id-ID').format(value);
                e.target.value = 'Rp ' + value;
            }
        });
    });

    // Auto-complete for student search
    const studentSearchInput = document.getElementById('student-search');
    if (studentSearchInput) {
        studentSearchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value;
            if (searchTerm.length >= 3) {
                // Implementasi pencarian siswa via AJAX
                searchStudents(searchTerm);
            }
        });
    }

    // Transaction calculation
    const paymentItemCheckboxes = document.querySelectorAll('.payment-item-checkbox');
    paymentItemCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', calculateTotal);
    });

    const quantityInputs = document.querySelectorAll('.quantity-input');
    quantityInputs.forEach(input => {
        input.addEventListener('input', calculateTotal);
    });
});

// Function to search students
function searchStudents(searchTerm) {
    // Ini akan diimplementasikan dengan AJAX
    console.log('Searching students for:', searchTerm);
}

// Function to calculate transaction total
function calculateTotal() {
    let total = 0;
    const paymentItems = document.querySelectorAll('.payment-item-checkbox:checked');
    
    paymentItems.forEach(item => {
        const itemId = item.value;
        const quantity = document.getElementById(`quantity-${itemId}`).value || 1;
        const price = parseFloat(document.getElementById(`price-${itemId}`).value) || 0;
        const subtotal = quantity * price;
        total += subtotal;
        
        // Update subtotal display
        document.getElementById(`subtotal-${itemId}`).textContent = formatCurrency(subtotal);
    });
    
    // Update total display
    document.getElementById('transaction-total').textContent = formatCurrency(total);
}

// Function to format currency
function formatCurrency(amount) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR'
    }).format(amount);
}

// Function to print receipt
function printReceipt(transactionId) {
    window.open(`/transactions/${transactionId}/receipt`, '_blank');
}

// Function to export data
function exportData(type, format) {
    window.location.href = `/export/${type}?format=${format}`;
}

// Function to generate payment schedule
function generatePaymentSchedule() {
    if (confirm('Apakah Anda yakin ingin generate tagihan untuk bulan ini?')) {
        // Implementasi AJAX untuk generate tagihan
        console.log('Generating payment schedule...');
    }
}

// Initialize DataTables for better table functionality
function initializeDataTables() {
    const tables = document.querySelectorAll('.data-table');
    tables.forEach(table => {
        if (typeof $.fn.DataTable !== 'undefined') {
            $(table).DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/id.json'
                },
                responsive: true
            });
        }
    });
}

// Call initializeDataTables when DOM is loaded
document.addEventListener('DOMContentLoaded', initializeDataTables);