<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopify Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Include Nexaris CSS -->
    <link href="/path/to/nexaris.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<div class="container mx-auto px-4 py-8">
    <div class="nx-page-layout nx-page-layout--one-column">
        <div class="nx-card">
            <h1 class="text-2xl font-bold mb-4">Shopify Orders</h1>

            <div class="mb-4">
                <button id="importData" class="nx-button nx-button--primary">Import Data</button>
            </div>

            <div class="mb-4">
                <label for="financialStatus" class="block mb-2">Filter by Financial Status:</label>
                <select id="financialStatus" class="nx-select">
                    <option value="">All</option>
                    <option value="paid">Paid</option>
                    <option value="pending">Pending</option>
                    <option value="refunded">Refunded</option>
                </select>
            </div>

            <table class="nx-table w-full">
                <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Customer Email</th>
                    <th>Total Price</th>
                    <th>Financial Status</th>
                    <th>Fulfillment Status</th>
                </tr>
                </thead>
                <tbody id="ordersTable">
                <!-- Orders will be populated here -->
                </tbody>
            </table>

            <div id="pagination" class="mt-4">
                <!-- Pagination links will be populated here -->
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script >
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
</script>
</body>
</html>
