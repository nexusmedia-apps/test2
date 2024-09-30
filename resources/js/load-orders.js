$(document).ready(function() {
    let currentPage = 1;
    let totalPages = 1;

    function loadOrders(page = 1) {
        const financialStatus = $('#financialStatus').val();
        $.ajax({
            url: '/api/orders',
            method: 'GET',
            data: {
                page: page,
                financial_status: financialStatus
            },
            success: function(response) {
                const orders = response.orders;
                let tableHtml = '';

                orders.forEach(order => {
                    tableHtml += `
                        <tr>
                            <td>${order.customer.name}</td>
                            <td>${order.customer.email}</td>
                            <td>$${order.total_price}</td>
                            <td>${order.financial_status}</td>
                            <td>${order.fulfillment_status}</td>
                        </tr>
                    `;
                });

                $('#ordersTable').html(tableHtml);

                // Update pagination
                currentPage = parseInt(response.current_page);
                totalPages = parseInt(response.last_page);
                updatePaginationControls();
            },
            error: function(xhr, status, error) {
                console.error('Error loading orders:', error);
            }
        });
    }

    function updatePaginationControls() {
        let paginationHtml = '';
        if (currentPage > 1) {
            paginationHtml += `<button class="nx-button nx-button--secondary mr-2" data-page="${currentPage - 1}">Previous</button>`;
        }
        paginationHtml += `<span class="mx-2">Page ${currentPage} of ${totalPages}</span>`;
        if (currentPage < totalPages) {
            paginationHtml += `<button class="nx-button nx-button--secondary ml-2" data-page="${currentPage + 1}">Next</button>`;
        }
        $('#pagination').html(paginationHtml);
    }

    // Load initial orders
    loadOrders();

    // Handle pagination clicks
    $('#pagination').on('click', 'button', function() {
        const page = parseInt($(this).data('page'));
        loadOrders(page);
    });

    // Handle financial status filter change
    $('#financialStatus').on('change', function() {
        loadOrders(1);
    });

    // Handle import data button click
    $('#importData').on('click', function() {
        $.ajax({
            url: '/api/import',
            method: 'POST',
            success: function(response) {
                alert('Data imported successfully');
                loadOrders(1);
            },
            error: function(xhr, status, error) {
                console.error('Error importing data:', error);
                alert('Error importing data. Please try again.');
            }
        });
    });
});
