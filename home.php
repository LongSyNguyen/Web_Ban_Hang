<link rel='stylesheet' href='css/home.css'>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<?php
include('connDB.php');
include('header.php');
echo "<div id='carouselExampleIndicators' class='carousel slide' data-ride='carousel'>
<ol class='carousel-indicators'>
    <li data-target='#carouselExampleIndicators' data-slide-to='0' class='active'></li>
    <li data-target='#carouselExampleIndicators' data-slide-to='1'></li>
    <li data-target='#carouselExampleIndicators' data-slide-to='2'></li>
</ol>
<div class='carousel-inner'>
    <div class='carousel-item active'>
        <img src='img/iphone12.webp' class='d-block w-100' alt='...'>
    </div>
    <div class='carousel-item'>
        <img src='img/promax.webp' class='d-block w-100' alt='...'>
    </div>
    <div class='carousel-item'>
        <img src='img/tuan-le-infinix-2023-sliding.webp' class='d-block w-100' alt='...'>
    </div>
</div>
<a class='carousel-control-prev' href='#carouselExampleIndicators' role='button' data-slide='prev'>
    <span class='carousel-control-prev-icon' aria-hidden='true'></span>
    <span class='sr-only'>Previous</span>
</a>
<a class='carousel-control-next' href='#carouselExampleIndicators' role='button' data-slide='next'>
    <span class='carousel-control-next-icon' aria-hidden='true'></span>
    <span class='sr-only'>Next</span>
</a>
</div>";
// Function to sanitize user input
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags($data));
}

$quantity = 0;
$itemsPerPage = 10; // Adjust the number of items per page as needed
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$startFrom = ($page - 1) * $itemsPerPage;
$cateID = isset($_GET['cateID']) ? sanitizeInput($_GET['cateID']) : '';

if (!empty($cateID)) {
    $sql = "SELECT product.*, category.status FROM product, category WHERE category_id = '$cateID' AND product.category_id=category.id LIMIT $startFrom, $itemsPerPage";
} else {
    $sql = "SELECT product.*, category.status FROM product, category WHERE product.category_id=category.id LIMIT $startFrom, $itemsPerPage";
}

$result = $conn->query($sql);
$item = mysqli_query($conn, "SELECT COUNT(*) AS total FROM product");
$rowi = mysqli_fetch_assoc($item);
$totalItems = $rowi['total'];
if ($result->num_rows > 0) {
    echo "<div class='list-product'>";
    while ($row = $result->fetch_assoc()) {
        if (isset($row['status']) && $row['status'] == 1) {
            ?>
            <div class="product">
                <a href='product.php?id=<?php echo $row['id'] ?>'>
                    <img src='img/<?php echo $row['thumbnail'] ?>'></a><br>
                <a href='product.php?id=<?php echo $row['id'] ?>'><?php echo $row["title"] ?></a><br>
                <div class="price">Giá: <?php echo $row["price"] ?></div><br>
            </div>
        <?php }
    }

    // Placeholder for total item count (replace with the actual query)

    // Pagination
    $totalPages = ceil($totalItems / $itemsPerPage);

    echo "</div>";
    echo "<div class='bottom-section'>";
    echo "<div class='pagination'>";
    for ($i = 1; $i <= $totalPages; $i++) {
        echo "<a href='?cateID=$cateID&page=$i'>$i</a> "; // Include cateID in pagination links
    }
    echo "</div>";
    echo "<div class='contact-info'>
    <h2>Contact Info</h2>
    <p>Cong Ty TNHH HieuHa</p>
    <p>123 Giang Vo , Ha Noi, Viet Nam</p>
    <p>Email: hieucompany@gmail.com</p>
    <p>Phone: +84 992 313 33</p>
        </div>
        </div>";
} else {
    echo "0 results";
}
?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>