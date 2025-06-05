<?php
$id = $_GET['id'] ?? header('Location: ./');
if (empty($id)) {
    header('Location: ./');
    exit();
}

require_once './components/header.php';

// Prepare SQL query
$sql = "SELECT products.*, products_category.name AS category_name 
        FROM products 
        INNER JOIN products_category 
        ON products.category_id = products_category.id 
        WHERE products_category.id = '$id'";

$result = $conn->query(query: $sql);

// Fetch all products and the category name
$products = [];
$category_name = '';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    $category_name = $products[0]['category_name'];
}
?>

<div class="container">
    <h2 class="text-center text-primary my-4 text-decoration-underline">All <?= htmlspecialchars($category_name) ?>
        Item's</h2>

    <div class="row">
        <?php if (!empty($products)): ?>
        <?php foreach ($products as $product): ?>
        <div class="col-lg-3 col-md-4 mb-4">
            <div class="card h-100">
                <img src="./assets/img/products/<?= $product['images'] ?>"
                    alt="<?= htmlspecialchars($product['name']) ?>" class="card-img-top img-thumbnail p-2"
                    style="height: 200px; object-fit: contain;">
                <div class="card-body">
                    <h5 class="card-title text-truncate"
                        style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        <?= htmlspecialchars($product['name']) ?>
                    </h5>
                    <p class="card-text">Category: <?= htmlspecialchars($product['category_name']) ?></p>
                    <p class="card-text">Price: $<?= number_format($product['sales_price'], 2) ?></p>
                    <a href="single-product.php?id=<?= $product['id'] ?>" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php else: ?>
        <p class="text-center">No products found in this category</p>
        <?php endif; ?>
    </div>


    <!-- button -->
    <div class="text-center mt-1 mb-4"><a class="viewDetailsBtns"
            style="color: white; background-color: #6d5ce8; text-decoration: none; padding: 9px 30px; border-radius: 5px;"
            href="shop.php">Back</a>
    </div>
</div>

<?php require_once './components/footer.php'; ?>