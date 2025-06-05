<?php
$query = $_GET['query'] ?? header('Location: index.php');
empty($query) && header('Location: index.php');
require_once './components/header.php';



$sql = "SELECT products.*, products_category.name AS category_name 
        FROM products 
        INNER JOIN products_category 
        ON products.category_id = products_category.id 
        WHERE products.name LIKE '%$query%' 
        OR products.description LIKE '%$query%' 
        OR products_category.name LIKE '%$query%' 
        ORDER BY products.created_at DESC";

$result = $conn->query($sql);

?>


<div class="container">

    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center text-primary mt-5 mb-4 text-decoration-underline">Search
                Result:_<?= htmlspecialchars($query) ?></h2>
            <?php if ($result->num_rows > 0): ?>

            <div class="row">
                <?php while ($product = $result->fetch_assoc()): ?>
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="./assets/img/products/<?= $product['images'] ?>"
                            alt="<?= htmlspecialchars($product['name']) ?>" class="card-img-top img-thumbnail p-2"
                            style="height: 200px; object-fit: contain">

                        <div class="card-body">
                            <h5 class="card-title text-truncate"
                                style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                <?= htmlspecialchars($product['name']) ?></h5>

                            <p class="card-text">Category: <?= htmlspecialchars($product['category_name']) ?></p>

                            <p class="card-text">Price: <?= number_format($product['sales_price']) ?></p>

                            <a href="single-product.php?id=<?= $product['id'] ?>" class="viewDetailsBtns"
                                style="color: white; background-color: #6d5ce8; text-decoration: none; padding: 9px 12px; border-radius: 5px;">View
                                Details</a>
                        </div>
                    </div>
                </div>

                <?php endwhile; ?>
            </div>
            <?php else: ?>

            <p class="text-center text-danger">No Product Found</p>
            <?php endif; ?>
            <div class="text-center my-4">
                <a href="index.php" class="viewDetailsBtns"
                    style="color: white; background-color: #6d5ce8; text-decoration: none; padding: 9px 12px; border-radius: 5px;">Back
                    to Home</a>
            </div>


        </div>

    </div>
</div>



<?php
require_once './components/footer.php';
?>