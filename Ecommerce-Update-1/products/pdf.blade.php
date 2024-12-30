<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products List</title>
</head>
<body>
    <h1>Products List</h1>
    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Stock Quantity</th>
                <th>Stock Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->product_price }}</td>
                <td>{{ $product->stock_quantity }}</td>
                <td>{{ $product->stock_status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
