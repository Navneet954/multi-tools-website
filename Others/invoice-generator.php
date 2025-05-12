<?php
if (isset($_POST['generate'])) {
    $customer_name = htmlspecialchars($_POST['customer_name']);
    $invoice_number = htmlspecialchars($_POST['invoice_number']);
    $date = htmlspecialchars($_POST['date']);
    $items = $_POST['items'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice Generator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }
        .invoice-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0px 5px 20px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .ad-space {
            height: 90px;
            background: #e2e2e2;
            color: #555;
            text-align: center;
            line-height: 90px;
            font-weight: bold;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .preview-card {
            background: #ffffff;
            border: 2px dashed #ccc;
            padding: 20px;
            border-radius: 15px;
            margin-top: 30px;
        }
        table th, table td {
            vertical-align: middle;
        }
    </style>
</head>

<body>

<div class="container mt-4">
    <!-- Top Ad Space -->
    <div class="ad-space">
        Top Advertisement Space
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="invoice-card">
                <h2 class="mb-4 text-center text-primary">Create Invoice</h2>
                <form method="post" id="invoiceForm" oninput="updatePreview()">
                    <div class="mb-3">
                        <label class="form-label">Customer Name</label>
                        <input type="text" name="customer_name" id="customer_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Invoice Number</label>
                        <input type="text" name="invoice_number" id="invoice_number" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" name="date" id="date" class="form-control" required>
                    </div>

                    <h5 class="mt-4">Items</h5>
                    <div id="itemsContainer">
                        <div class="row g-2 mb-2 item-row">
                            <div class="col-5">
                                <input type="text" name="items[0][name]" placeholder="Item Name" class="form-control" required>
                            </div>
                            <div class="col-3">
                                <input type="number" name="items[0][quantity]" placeholder="Qty" class="form-control" required>
                            </div>
                            <div class="col-4">
                                <input type="number" name="items[0][price]" placeholder="Price ₹" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary btn-sm mb-3" onclick="addItem()">Add More Item</button>

                    <div class="d-grid">
                        <button type="submit" name="generate" class="btn btn-primary">Generate Invoice</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Preview Area -->
        <div class="col-md-6">
            <div class="preview-card">
                <h3 class="text-center mb-4">Invoice Preview</h3>
                <p><strong>Customer Name:</strong> <span id="preview_customer_name">-</span></p>
                <p><strong>Invoice Number:</strong> <span id="preview_invoice_number">-</span></p>
                <p><strong>Date:</strong> <span id="preview_date">-</span></p>

                <table class="table table-bordered mt-3">
                    <thead class="table-light">
                        <tr>
                            <th>Item</th>
                            <th>Qty</th>
                            <th>Price (₹)</th>
                            <th>Total (₹)</th>
                        </tr>
                    </thead>
                    <tbody id="preview_items">
                        <tr><td colspan="4" class="text-center">No Items</td></tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">Grand Total</th>
                            <th id="preview_grand_total">₹0</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <?php if (isset($_POST['generate'])): ?>
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="invoice-card">
                    <h3 class="text-center text-success">Generated Invoice</h3>
                    <hr>
                    <p><strong>Customer Name:</strong> <?php echo $customer_name; ?></p>
                    <p><strong>Invoice Number:</strong> <?php echo $invoice_number; ?></p>
                    <p><strong>Date:</strong> <?php echo $date; ?></p>

                    <table class="table table-bordered mt-3">
                        <thead class="table-light">
                            <tr>
                                <th>Item</th>
                                <th>Qty</th>
                                <th>Price (₹)</th>
                                <th>Total (₹)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $grand_total = 0;
                            foreach ($items as $item) {
                                $name = htmlspecialchars($item['name']);
                                $qty = (int) $item['quantity'];
                                $price = (float) $item['price'];
                                $total = $qty * $price;
                                $grand_total += $total;
                                echo "<tr>
                                        <td>$name</td>
                                        <td>$qty</td>
                                        <td>₹".number_format($price, 2)."</td>
                                        <td>₹".number_format($total, 2)."</td>
                                    </tr>";
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end">Grand Total</th>
                                <th>₹<?php echo number_format($grand_total, 2); ?></th>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Bottom Ad Space -->
    <div class="ad-space mt-4">
        Bottom Advertisement Space
    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript for Items -->
<script>
let itemIndex = 1;

function addItem() {
    const container = document.getElementById('itemsContainer');
    const html = `
        <div class="row g-2 mb-2 item-row">
            <div class="col-5">
                <input type="text" name="items[${itemIndex}][name]" placeholder="Item Name" class="form-control" required>
            </div>
            <div class="col-3">
                <input type="number" name="items[${itemIndex}][quantity]" placeholder="Qty" class="form-control" required>
            </div>
            <div class="col-4">
                <input type="number" name="items[${itemIndex}][price]" placeholder="Price ₹" class="form-control" required>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
    itemIndex++;
}

function updatePreview() {
    document.getElementById('preview_customer_name').innerText = document.getElementById('customer_name').value || '-';
    document.getElementById('preview_invoice_number').innerText = document.getElementById('invoice_number').value || '-';
    document.getElementById('preview_date').innerText = document.getElementById('date').value || '-';

    const itemRows = document.querySelectorAll('#itemsContainer .item-row');
    const previewItems = document.getElementById('preview_items');
    previewItems.innerHTML = '';

    let grandTotal = 0;
    itemRows.forEach(row => {
        const name = row.querySelector('input[name*="[name]"]').value;
        const qty = parseInt(row.querySelector('input[name*="[quantity]"]').value) || 0;
        const price = parseFloat(row.querySelector('input[name*="[price]"]').value) || 0;
        const total = qty * price;
        grandTotal += total;

        if (name && qty && price) {
            previewItems.innerHTML += `
                <tr>
                    <td>${name}</td>
                    <td>${qty}</td>
                    <td>₹${price.toFixed(2)}</td>
                    <td>₹${total.toFixed(2)}</td>
                </tr>
            `;
        }
    });

    if (!previewItems.innerHTML) {
        previewItems.innerHTML = '<tr><td colspan="4" class="text-center">No Items</td></tr>';
    }

    document.getElementById('preview_grand_total').innerText = `₹${grandTotal.toFixed(2)}`;
}
</script>

</body>
</html>
