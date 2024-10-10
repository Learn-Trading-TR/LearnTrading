document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    if (username === '798564' && password === 'J7x!pQ$2mVr8@Ls') {
        window.location.href = '798564.php';
    } else if (username === '468452' && password === 'T#8lKs%9fWq@7Xz') {
        window.location.href = '468452.php';
    } else {
        alert('اسم المستخدم أو كلمة المرور غير صحيحة');
    }
});

