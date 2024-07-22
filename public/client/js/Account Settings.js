// settings.js
function saveSettings() {
    var industry = document.getElementById('industry').value;
    var about = document.getElementById('about').value;

    // Lưu thông tin vào localStorage
    localStorage.setItem('industry', industry);
    localStorage.setItem('about', about);

    // Hiển thị thông báo thành công
    document.getElementById('success-message').style.display = 'block';

    // Ẩn thông báo sau 3 giây
    setTimeout(function() {
        document.getElementById('success-message').style.display = 'none';
    }, 3000);
}
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.sidebar li');
    const contents = document.querySelectorAll('.tab-content');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            // Remove active class from all tabs
            tabs.forEach(item => item.classList.remove('active'));
            // Add active class to the clicked tab
            tab.classList.add('active');

            // Hide all tab contents
            contents.forEach(content => content.classList.remove('active'));
            // Show the content corresponding to the clicked tab
            const activeContent = document.getElementById(tab.dataset.tab);
            activeContent.classList.add('active');
        });
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.tab-link');
    const tabContents = document.querySelectorAll('.tab-content');

    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            tabs.forEach(item => item.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));

            tab.classList.add('active');
            document.getElementById(tab.dataset.tab).classList.add('active');
        });
    });

    const aboutInput = document.getElementById('about');
    const charRemaining = document.getElementById('char-remaining');

    aboutInput.addEventListener('input', function() {
        const maxChars = 700;
        const currentChars = aboutInput.value.length;
        charRemaining.textContent = `${maxChars - currentChars} ký tự còn lại`;
    });

    // Set the default active tab
    document.querySelector('.tab-link.active').click();

    // Handle form submission
    document.getElementById('personal-info-form').addEventListener('submit', function(event) {
        event.preventDefault();
        
        const userInfo = {
            accountType: document.getElementById('account-type').value,
            firstName: document.getElementById('first-name').value,
            lastName: document.getElementById('last-name').value,
            occupation: document.getElementById('occupation').value,
            institution: document.getElementById('institution').value,
            about: document.getElementById('about').value
        };

        localStorage.setItem('userInfo', JSON.stringify(userInfo));
        window.location.href = 'details.html';
    });
});


