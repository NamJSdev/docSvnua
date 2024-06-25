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

