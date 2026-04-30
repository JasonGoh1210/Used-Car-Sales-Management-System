<div id="loginModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" id="closeModal">&times;</span>
        
        <h2 id="modalTitle">Welcome Back</h2>
        <p id="modalSubTitle">Login to your DriveX Motors account</p>
        
        <form id="authForm" action="auth_process.php" method="POST">
            <input type="hidden" name="auth_mode" value="login">

            <div class="modal-input-group">
                <span class="prefix">📧</span>
                <input type="email" name="email" placeholder="Email Address" required>
            </div>

            <div class="modal-input-group">
                <span class="prefix">🔒</span>
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <button type="submit" name="submit_auth" class="otp-btn" id="mainAuthBtn">Login</button>

            <p class="signup-text">
                <a href="register.php" class="signup-link">
                    Sign Up
                </a>
            </p>
            
            <p class="forgot-password-text">
                <a href="forgot_password.php" class="forgot-password-link">
                    Forgot Password?
                </a>
            </p>
        </form>
    </div>
</div>
