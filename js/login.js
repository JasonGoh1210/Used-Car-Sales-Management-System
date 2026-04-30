let isSignUpMode = false;

// 这个函数会被 home.js 手动调用
function initLoginEvents() {
    const closeModal = document.getElementById('closeModal');
    const switchLink = document.getElementById('switchLink');
    const mainAuthBtn = document.getElementById('mainAuthBtn');

    console.log("Login logic initialized!"); // 调试用：如果控制台没看到这个，说明没跑起来

    // 关闭弹窗
    if (closeModal) {
        closeModal.onclick = function() {
            document.getElementById('loginModal').style.display = "none";
            document.body.style.overflow = "auto";
        };
    }

    // 切换登录/注册模式
    if (switchLink) {
        switchLink.onclick = function() {
            isSignUpMode = !isSignUpMode;
            
            const confirmGroup = document.getElementById('confirmGroup');
            const title = document.getElementById('modalTitle');
            const switchText = document.getElementById('switchText');

            if (isSignUpMode) {
                confirmGroup.style.display = "block";
                title.innerText = "Create Account";
                mainAuthBtn.innerText = "Sign Up";
                switchText.innerText = "Already have an account?";
                switchLink.innerText = "Login here";
            } else {
                confirmGroup.style.display = "none";
                title.innerText = "Welcome Back";
                mainAuthBtn.innerText = "Login";
                switchText.innerText = "New user?";
                switchLink.innerText = "Sign Up here";
            }
        };
    }

    // 处理提交（Login 或 Sign Up）
    if (mainAuthBtn) {
        mainAuthBtn.onclick = function() {
            const email = document.getElementById('authEmail').value;
            const pass = document.getElementById('authPassword').value;

            if (isSignUpMode) {
                const confirmPass = document.getElementById('authConfirmPassword').value;
                if (!email || !pass || !confirmPass) {
                    alert("Please fill all fields");
                    return;
                }
                if (pass !== confirmPass) {
                    alert("Passwords do not match!");
                    return;
                }
                alert("Sign Up Success! Now please login.");
                switchLink.click(); // 自动切回登录状态
            } else {
                if (email && pass) {
                    alert("Login Success!");
                    closeModal.onclick(); // 登录成功关闭
                } else {
                    alert("Please enter email and password.");
                }
            }
        };
    }
}