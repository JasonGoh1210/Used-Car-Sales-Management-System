<?php 
include 'db.php'; 
session_start();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DriveX Motors - Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">
                <a href="home.php">USEDCAR <span>FYP</span></a>
            </div>
            
            <div class="nav-links">
                <div class="dropdown">
                    <a href="buy_car.php" class="dropbtn">Buy Car</a>
                    <div class="dropdown-content">
                        <div class="dropdown-header">Used Cars</div>
                        <a href="buy_car.php" class="view-all">View All Cars ></a>
                        <div class="brand-grid">
                            <a href="buy_car.php?brand=BMW">BMW</a>
                            <a href="buy_car.php?brand=Honda">Honda</a> 
                            <a href="buy_car.php?brand=Perodua">Perodua</a>
                            <a href="buy_car.php?brand=Toyota">Toyota</a>
                            <a href="buy_car.php?brand=Proton">Proton</a>
                        </div>
                    </div>
                </div>
                <a href="sell_car.php">Sell Car</a>
                
                <?php if(isset($_SESSION['user_name'])): ?>
                    <span class="user-name">Hi, <?php echo $_SESSION['user_name']; ?></span>
                    <a href="logout.php" class="logout-btn">Logout</a>
                <?php else: ?>
                    <button id="loginBtn" class="nav-signin-btn">Sign Up/Login</button>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div id="modal-container"></div>

    <section class="home-hero">
        <div class="main-entrance-card">
            <div class="entrance-left">
                <h2 class="section-title">Buy a Car </h2>
                <div class="search-box-home">
                    <input type="text" placeholder="Search for cars by Brand, Model, or Keywords">
                    <button class="search-icon-btn">🔍</button>
                </div>

                <div class="brand-grid-home">
                    <a href="buy_car.php?brand=Perodua" class="brand-item"><span>🚗</span><p>Perodua</p></a>
                    <a href="buy_car.php?brand=Honda" class="brand-item"><span>🚗</span><p>Honda</p></a>
                    <a href="buy_car.php?brand=Toyota" class="brand-item"><span>🚗</span><p>Toyota</p></a>
                    <a href="buy_car.php?brand=Proton" class="brand-item"><span>🚗</span><p>Proton</p></a>
                    <a href="buy_car.php?brand=Nissan" class="brand-item"><span>🚗</span><p>Nissan</p></a>
                </div>
                <div class="view-all-wrapper">
                    <a href="buy_car.php" class="bold-link">View All Cars ></a>
                </div>
            </div>

            <div class="entrance-right">
                <h2 class="section-title">Sell Your Car ></h2>
                <p class="subtitle">Get a professional inspection and fair price.</p>
                <a href="sell_car.php" class="sell-btn-large">💰 Sell Car</a>
                
                <div class="sell-features-home">
                    <div class="feature-small"><span>🛠️</span><p>30-Min Inspection</p></div>
                    <div class="feature-small"><span>📄</span><p>No Paperwork</p></div>
                    <div class="feature-small"><span>💵</span><p>Instant Payment</p></div>
                    <div class="feature-small"><span>🤝</span><p>Professional</p></div>
                </div>
            </div>
        </div>
    </section>

    <section class="toggle-section">
        <div class="toggle-container">
            <button id="sellBtn" class="toggle-btn active" onclick="switchTab('sell')">How to Sell</button>
            <button id="tradeBtn" class="toggle-btn" onclick="switchTab('buy')">How to Buy</button>
        </div>

        <div class="content-area">
            <div id="sellContent">
                <h2 class="content-title">Your Car Selling Journey Made Hassle-Free</h2>
                <div class="card-grid">
                    <div class="info-card">
                        <div class="step-num">1</div>
                        <div class="icon-circle">📝</div>
                        <h4>Submit Request</h4>
                        <p>Fill in car details online.</p>
                    </div>
                    <div class="info-card">
                        <div class="step-num">2</div>
                        <div class="icon-circle">🔍</div>
                        <h4>Inspection</h4>
                        <p>Professional 175-point check.</p>
                    </div>
                    <div class="info-card">
                        <div class="step-num">3</div>
                        <div class="icon-circle">🤝</div>
                        <h4>Offer</h4>
                        <p>Get the best price offer.</p>
                    </div>
                    <div class="info-card">
                        <div class="step-num">4</div>
                        <div class="icon-circle">💰</div>
                        <h4>Paid</h4>
                        <p>Receive money in 1 hour.</p>
                    </div>
                </div>
            </div>

            <div id="tradeContent" style="display: none;">
                <h2 class="content-title">Steps to Own Your Dream Car</h2>
                <div class="card-grid">
                    <div class="info-card">
                        <div class="step-num">1</div>
                        <div class="icon-circle">🚗</div>
                        <h4>Browse</h4>
                        <p>Find your car online.</p>
                    </div>
                    <div class="info-card">
                        <div class="step-num">2</div>
                        <div class="icon-circle">📅</div>
                        <h4>Test Drive</h4>
                        <p>Experience the ride.</p>
                    </div>
                    <div class="info-card">
                        <div class="step-num">3</div>
                        <div class="icon-circle">💳</div>
                        <h4>Deposit</h4>
                        <p>Secure it with payment.</p>
                    </div>
                    <div class="info-card">
                        <div class="step-num">4</div>
                        <div class="icon-circle">🔑</div>
                        <h4>Done</h4>
                        <p>Drive your car home.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="home.js"></script>
</body>
</html>