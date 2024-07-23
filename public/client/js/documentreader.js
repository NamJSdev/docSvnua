document.addEventListener("DOMContentLoaded", function() {
    const toolbar = document.querySelector('.toolbar');
    const content = document.getElementById('content');
    const pageList = document.getElementById('pageList');
    const pages = document.getElementsByClassName('page');
    const pageIndicator = document.getElementById('pageIndicator');

    let isFixed = false;
    const toolbarOffsetTop = toolbar.offsetTop;

    // Xử lý sự kiện cuộn
    window.addEventListener('scroll', function() {
        const scrollPosition = window.scrollY;

        // Logic cố định thanh công cụ
        if (scrollPosition >= toolbarOffsetTop && !isFixed) {
            toolbar.classList.add('fixed');
            isFixed = true;
        } else if (scrollPosition < toolbarOffsetTop && isFixed) {
            toolbar.classList.remove('fixed');
            isFixed = false;
        }

        // Dừng cố định ở cuối trang
        const maxScroll = document.documentElement.scrollHeight - window.innerHeight;
        if (scrollPosition >= maxScroll - toolbar.clientHeight) {
            toolbar.classList.remove('fixed');
            isFixed = false;
        }
    });

    // Mã hiện có để xử lý điều hướng trang
    for (let i = 0; i < pages.length; i++) {
        let listItem = document.createElement('li');
        let link = document.createElement('a');
        link.href = "#";
        link.innerHTML = `<img src="https://image.slidesharecdn.com/1707826910254-240215090210-009c7a2b/75/2024-State-of-Marketing-Report-by-Hubspot-${i+1}-2048.jpg" alt="Trang ${i + 1}">`;
        link.dataset.page = i + 1;
        link.addEventListener('click', function() {
            showPage(i + 1);
        });
        listItem.appendChild(link);
        pageList.appendChild(listItem);
    }

    function showPage(pageNumber) {
        const page = document.getElementById(`page${pageNumber}`);
        page.scrollIntoView({ behavior: 'smooth' });
        updatePageIndicator(pageNumber);
    }

    function updatePageIndicator(pageNumber) {
        pageIndicator.textContent = `Page ${pageNumber} of ${pages.length}`;
    }

    function highlightCurrentPage(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const currentIndex = Array.from(pages).indexOf(entry.target);
                const links = pageList.querySelectorAll('a');
                links.forEach(link => link.classList.remove('active'));
                links[currentIndex].classList.add('active');
                updatePageIndicator(currentIndex + 1);

                const activeLink = links[currentIndex];
                const sidebar = document.querySelector('.sidebar_document_reader ul');
                sidebar.scrollTop = activeLink.offsetTop - sidebar.clientHeight / 2 + activeLink.clientHeight / 2;
           }
        });
    }

    const observer = new IntersectionObserver(highlightCurrentPage, {
        root: content,
        threshold: 0.5
    });

    Array.from(pages).forEach(page => {
        observer.observe(page);
    });

    showPage(1);
});