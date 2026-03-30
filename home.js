// 页面加载时执行
window.onload = function() {
    // 1. 抓取弹窗 PHP 内容
    fetch('login.php')
        .then(response => {
            if (!response.ok) throw new Error("无法加载 login.php，请检查文件是否存在");
            return response.text();
        })
        .then(data => {
            // 将获取到的 HTML 内容塞进容器
            const container = document.getElementById('modal-container');
            if (container) {
                container.innerHTML = data;
            }

            // --- 核心修改：确保 HTML 渲染后，再绑定按钮点击事件 ---
            const loginBtn = document.getElementById('loginBtn');
            if (loginBtn) {
                loginBtn.onclick = function() {
                    const modal = document.getElementById('loginModal');
                    if (modal) {
                        modal.style.display = "block";
                        document.body.style.overflow = "hidden";
                    } else {
                        console.error("找不到 ID 为 loginModal 的元素，请检查 login.php 内容");
                    }
                };
            }

            // --- 核心修改：加载并运行 login.js 处理弹窗内部逻辑 ---
            const authScript = document.createElement('script');
            authScript.src = 'login.js';
            authScript.onload = () => {
                // 确保 login.js 加载完后，再运行初始化
                if (typeof initLoginEvents === "function") {
                    initLoginEvents();
                }
            };
            document.head.appendChild(authScript);
        })
        .catch(err => console.error("加载弹窗失败:", err));
};

// 你原有的 Tab 切换逻辑 (保持在 home.js 底部)
function switchTab(type) {
    const sellBtn = document.getElementById('sellBtn');
    const tradeBtn = document.getElementById('tradeBtn');
    const sellContent = document.getElementById('sellContent');
    const tradeContent = document.getElementById('tradeContent');

    if (type === 'sell') {
        sellBtn.classList.add('active');
        tradeBtn.classList.remove('active');
        sellContent.style.display = 'block';
        tradeContent.style.display = 'none';
    } else {
        tradeBtn.classList.add('active');
        sellBtn.classList.remove('active');
        tradeContent.style.display = 'block';
        sellContent.style.display = 'none';
    }
}