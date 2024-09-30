<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopify Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Include Nexaris CSS -->
    @vite('resources/css/nexaris.css')
</head>
<body class="bg-gray-100">
<div class="container mx-auto px-4 py-8">
    <div class="nx-page-layout nx-page-layout--one-column">
        <div class="nx-card">
            <h1 class="text-2xl font-bold mb-4">Shopify Orders</h1>

            <div class="mb-4">
                <button id="importData" class="btn btn-primary">Import Data</button>
            </div>

            <div class="mb-4 form-select">
                <label for="financialStatus" class="block mb-2">Filter by Financial Status:</label>
                <select id="financialStatus">
                    <option value="">All</option>
                    <option value="paid">Paid</option>
                    <option value="pending">Pending</option>
                    <option value="refunded">Refunded</option>
                </select>
            </div>

            <div class="card">
                <div class="index-table-wrapper">
                    <div class="index-table-header">
                        <div class="index-table-header-filter">

                            <div class="col-left">
                                <div class="resptabs tabs3">
                                    <ul class="primary-list" id="financialStatus">
                                        <li><button class="tab-item active" data-tab="">All</button></li>
                                        <li><button class="tab-item" data-tab="paid">Paid</button></li>
                                        <li><button class="tab-item" data-tab="pending">Pending</button></li>
                                        <li><button class="tab-item" data-tab="refunded">Refunded</button></li>
                                    </ul>
                                </div>
                                <div class="form-input form-collapsable">
                                    <input type="search" class="input-icon icon-search" placeholder="Search customers">
                                </div>
                            </div>

                            <div class="col-right">
                                <button class="btn btn-secondary btn-search-cancel">Cancel</button>
                                <button class="btn btn-icon btn-no-label btn-search">
            <span class="btn-icon-holder">
              <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg_375hu" focusable="false" aria-hidden="true"><path fill-rule="evenodd" d="M12.323 13.383a5.5 5.5 0 1 1 1.06-1.06l2.897 2.897a.75.75 0 1 1-1.06 1.06l-2.897-2.897Zm.677-4.383a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z"></path></svg>
            </span>
                                    <span class="btn-icon-holder">
              <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg_375hu" focusable="false" aria-hidden="true"><path d="M3 6a.75.75 0 0 1 .75-.75h12.5a.75.75 0 0 1 0 1.5h-12.5a.75.75 0 0 1-.75-.75Z"></path><path d="M6.75 14a.75.75 0 0 1 .75-.75h5a.75.75 0 0 1 0 1.5h-5a.75.75 0 0 1-.75-.75Z"></path><path d="M5.5 9.25a.75.75 0 0 0 0 1.5h9a.75.75 0 0 0 0-1.5h-9Z"></path></svg>
            </span>Search
                                </button>
                                <div class="dropdown">
                                    <button class="btn btn-icon btn-no-label btn-sort dropdown-toggle">
              <span class="btn-icon-holder">
                <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg_375hu" focusable="false" aria-hidden="true"><path d="M7.75 6.06v7.69a.75.75 0 0 1-1.5 0v-7.69l-1.72 1.72a.75.75 0 0 1-1.06-1.06l3-3a.75.75 0 0 1 1.06 0l3 3a.75.75 0 1 1-1.06 1.06l-1.72-1.72Z"></path><path d="M13.75 6.25a.75.75 0 0 0-1.5 0v7.69l-1.72-1.72a.75.75 0 1 0-1.06 1.06l3 3a.75.75 0 0 0 1.06 0l3-3a.75.75 0 1 0-1.06-1.06l-1.72 1.72v-7.69Z"></path></svg>
              </span>Sort
                                    </button>
                                    <ul class="dropdown-menu align-right"> <!-- align-right -->
                                        <li><button>Import</button></li>
                                        <li><button>Export</button></li>
                                        <li><button>Duplicate</button></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="search-filter">
                                <span class="tag">Wholesale</span>
                                <span class="tag">Wholesale<button class="tag-close">Close</button></span>
                            </div>

                        </div>
                    </div>

                    <div class="index-table-footer-action">
                        <div class="index-table-footer-inner">
                            <button class="btn btn-secondary">Bulk edit</button>
                            <button class="btn btn-secondary">Set as active</button>
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-icon btn-no-label dropdown-toggle">
            <span class="btn-icon-holder">
              <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg_375hu" focusable="false" aria-hidden="true"><path d="M6 10a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"></path><path d="M11.5 10a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"></path><path d="M15.5 11.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z"></path></svg>
            </span>
                                    Cancel
                                </button>
                                <ul class="dropdown-menu align-right">
                                    <li><button class="dropdown-item">Import</button></li>
                                    <li><button class="dropdown-item">Export</button></li>
                                    <li><button class="dropdown-item delete">Delete</button></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="index-table-inner">

                        <div class="index-table-header-action">
                            <div class="index-table-header-inner">
                                <div class="form-checkbox">
                                    <label>
                                        <input type="checkbox">
                                        <span class="checkbox-icon"></span>
                                        <span class="label-text">2 Selected</span>
                                    </label>
                                </div>
                                <button class="link">Cancel</button>
                            </div>
                        </div>

                        <table class="index-table">
                            <thead>
                            <tr>
                                <th class="checkbox-all">
                                    <div class="form-checkbox">
                                        <label>
                                            <input type="checkbox">
                                            <span class="checkbox-icon"></span>
                                        </label>
                                    </div>
                                </th>
                                <th>Customer name</th>
                                <th>Email</th>
                                <th>Total Price</th>
                                <th>Financial status</th>
                                <th>Fulfillment Status</th>
                                <th>Go to</th>
                            </tr>
                            </thead>
                            <tbody id="ordersTable">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="pagination" class="mt-4">
                <!-- Pagination links will be populated here -->
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@vite('resources/js/load-orders.js')
</body>
</html>
