<?php 
include 'db.php'; 

$brand = isset($_GET['brand']) ? mysqli_real_escape_string($conn, $_GET['brand']) : '';

if ($brand != '') {
    $sql = "SELECT * FROM car_list WHERE brand = '$brand'";
    $page_title = "Buy Used $brand - DriveX Motor";
} else {
    $sql = "SELECT * FROM car_list";
    $page_title = "DriveX Motor - Car";
}

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("SQL Error: " . mysqli_error($conn));
}

$total_results = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="zh-CN">

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">
    <a href="home.php" style="text-decoration: none; color: inherit;">
        DriveX <span>Motors</span>
    </a>
</div>
            <div class="nav-links">
                <div class="dropdown">
                    <a href="buy_car.php" class="dropbtn">Buy Car</a>
                    <div class="dropdown-content">
                        <div class="dropdown-header">Used Cars</div>
                        <a href="buy_car.php" class="view-all">View All Cars ></a>
                        <div class="brand-grid">
                            <a href="buy_car.php?brand=BMW">BMW</a>
                            <a href="buy_car.php?brand=Honda" class="highlight">Honda</a> 
                            <a href="buy_car.php?brand=Perodua">Perodua</a>
                            <a href="buy_car.php?brand=Toyota">Toyota</a>
                            <a href="buy_car.php?brand=Proton">Proton</a>
                        </div>
                    </div>
                </div>
                <a href="home.php">Sell Car</a>
                <button id="loginBtn" class="nav-signin-btn">Sign Up/Login</button>
            </div>
        </div>
    </nav>

    <div id="modal-container"></div>

    <section class="search-filter-section">
        <div class="search-container">
            <input type="text" placeholder="Search for cars by Brand, Model, or Keywords">
            <button class="search-bar-btn">🔍</button>
        </div>

        <div class="filter-buttons">
            <button class="f-btn">Brand & Model</button>
            <button class="f-btn">Price & Instalment</button>
            <button class="f-btn">Year</button>
            <button class="f-btn">Mileage</button>
        </div>
    </section>

    <main class="car-listing-container">
        <div class="listing-header">
            <h3>
                <?php echo $total_results; ?> result(s) 
                <?php echo ($brand ? "found for <span style='color:var(--blue)'>$brand</span>" : "in total"); ?>
            </h3>
        </div>

        <div class="car-grid">
            <?php 
            if ($total_results > 0) {
                // 核心循环：数据库里有多少车，就自动生成多少卡片
                while($row = mysqli_fetch_assoc($result)) {
                    // 简单的月供计算逻辑 (车价 / 84个月)
                    $monthly = number_format($row['price'] / 84, 0);
            ?>
                <div class="car-card">
                    <div class="promo-tag">RM 5,000 OFF</div>
                    
                    <img src="image/<?php echo $row['image_path']; ?>" alt="<?php echo $row['model']; ?>">
                    
                    <div class="car-info">
                        <h4><?php echo $row['brand'] . " " . $row['model']; ?></h4>
                        
                        <p class="instalment">RM <?php echo $monthly; ?>/mo <span>(Est. 7 Years)</span></p>
                        
                        <p class="total-price">Car Price: RM <?php echo number_format($row['price']); ?></p>
                        
                        <div class="car-stats">
                            <span>Automatic</span> | 
                            <span><?php echo $row['location']; ?></span>
                        </div>
                    </div>
                </div>
            <?php 
                }// While 循环结束
            } else {
                // 如果数据库没数据，显示提示
                echo "<div style='grid-column: 1/-1; text-align: center; padding: 100px 0;'>
                        <h2>No cars available right now.</h2>
                        <p>Try selecting another brand from the menu.</p>
                      </div>";
            }
            ?>
        </div>
    </main>

    <script src="home.js"></script>
</body>
</html>