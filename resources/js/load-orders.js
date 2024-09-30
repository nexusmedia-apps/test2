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
                            <td class="checkbox-cell">
                                <div class="form-checkbox">
                                    <label>
                                        <input type="checkbox">
                                        <span class="checkbox-icon"></span>
                                    </label>
                                </div>
                            </td>
                            <td><a href="#1"><span>${order.customer.name}</span></a></td>
                            <td><span class="badge">${order.customer.email}</span></td>
                            <td><p>$${order.total_price}</p></td>
                            <td><p>${order.financial_status}</p></td>
                            <td><p>${order.fulfillment_status}</p></td>
                            <td>
                                <button class="btn btn-icon btn-no-label btn-secondary">
                                    <span class="btn-icon-holder">
                                      <svg viewBox="0 0 20 20" class="Icon_Icon__Dm3QW" style="width: 20px; height: 20px;"><path d="M8 16a.999.999 0 0 1-.707-1.707l4.293-4.293-4.293-4.293a.999.999 0 1 1 1.414-1.414l5 5a.999.999 0 0 1 0 1.414l-5 5a.997.997 0 0 1-.707.293z"></path></svg>
                                    </span>
                                    Go to
                                </button>
                            </td>
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
            paginationHtml += `<button class="button button--secondary mr-2" data-page="${currentPage - 1}">Previous</button>`;
        }
        paginationHtml += `<span class="mx-2">Page ${currentPage} of ${totalPages}</span>`;
        if (currentPage < totalPages) {
            paginationHtml += `<button class="button button--secondary ml-2" data-page="${currentPage + 1}">Next</button>`;
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
