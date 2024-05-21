<?php
$products = [
    ["id" => 1, "name" => "Producto 1", "price" => 10.0],
    ["id" => 2, "name" => "Producto 2", "price" => 20.0],
    ["id" => 3, "name" => "Producto 3", "price" => 30.0],
    ["id" => 3, "name" => "Producto 4", "price" => 40.0],
    ["id" => 3, "name" => "Producto 5", "price" => 50.0],
    ["id" => 3, "name" => "Producto 6", "price" => 60.0],
];

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    foreach ($products as $product) {
        if ($product['id'] === $id) {
            echo json_encode($product);
            exit;
        }
    }
} else {
    echo json_encode($products);
}
?>
