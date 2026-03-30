<div id="loginModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" id="closeModal">&times;</span>
        
        <h2 id="modalTitle">Welcome Back</h2>
        <p id="modalSubTitle">Login to your FYP account</p>
        
        <form id="authForm" action="auth_process.php" method="POST">
            
            <input type="hidden" name="auth_mode" id="authMode" value="login">

            <div class="modal-input-group">
                <span class="prefix">📧</span>
                <input type="email" name="email" placeholder="Email Address" id="authEmail" required>
            </div>

            <div class="modal-input-group">
                <span class="prefix">🔒</span>
                <input type="password" name="password" placeholder="Password" id="authPassword" required>
            </div>

            <div id="confirmGroup" style="display: none;">
                <div class="modal-input-group" style="border-color: #ffcc00;">
                    <span class="prefix">🛡️</span>
                    <input type="password" name="confirm_password" placeholder="Confirm Password" id="authConfirmPassword">
                </div>
            </div>

            <button type="submit" name="submit_auth" class="otp-btn" id="mainAuthBtn">Login</button>

            <p style="font-size: 14px; margin-top: 20px; color: #666;">
                <span id="switchText">New user?</span> 
                <a href="javascript:void(0)" id="switchLink" style="color: #002d62; font-weight: bold; text-decoration: none;">Sign Up here</a>
            </p>
        </form>
    </div>
</div>

<script>
    // 这里是控制弹窗切换的逻辑
    const switchLink = document.getElementById('switchLink');
    const modalTitle = document.getElementById('modalTitle');
    const modalSubTitle = document.getElementById('modalSubTitle');
    const confirmGroup = document.getElementById('confirmGroup');
    const mainAuthBtn = document.getElementById('mainAuthBtn');
    const authMode = document.getElementById('authMode');
    const switchText = document.getElementById('switchText');
    const authConfirmPassword = document.getElementById('authConfirmPassword');

    switchLink.onclick = function() {
        if (authMode.value === 'login') {
            // 切换到 注册 模式
            authMode.value = 'signup';
            modalTitle.innerText = 'Create Account';
            modalSubTitle.innerText = 'Join CARSOME FYP today';
            confirmGroup.style.display = 'block';
            mainAuthBtn.innerText = 'Sign Up';
            switchText.innerText = 'Already have an account?';
            switchLink.innerText = 'Login here';
            authConfirmPassword.required = true; // 注册时必须填确认密码
        } else {
            // 切换回 登录 模式
            authMode.value = 'login';
            modalTitle.innerText = 'Welcome Back';
            modalSubTitle.innerText = 'Login to your FYP account';
            confirmGroup.style.display = 'none';
            mainAuthBtn.innerText = 'Login';
            switchText.innerText = 'New user?';
            switchLink.innerText = 'Sign Up here';
            authConfirmPassword.required = false;
        }
    };
</script>