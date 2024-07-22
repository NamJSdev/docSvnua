const tabsBox = document.querySelector('.tabsBox');
{
        const allTabs = document.querySelectorAll('.tab');
        const arrowIcons = document.querySelectorAll('.icon i');
        let isDragging = false;
        const handleIcons = (scrollVal) =>{
            let maxScrollWidth = tabsBox.scrollWidth - tabsBox.clientWidth;
            arrowIcons[0].parentElement.style.display = scrollVal <= 0 ? "none" : "flex";
            arrowIcons[1].parentElement.style.display = maxScrollWidth - scrollVal <= 1 ? "none" : "flex";
        };
        arrowIcons.forEach(icon =>{
            icon.addEventListener('click', () =>{
                let scrollWidth = tabsBox.scrollLeft += icon.id === "left" ? -340 : 340;
                handleIcons(scrollWidth);
            });
        });
        allTabs.forEach(tab =>{
            tab.addEventListener('click', () =>{
                tabsBox.querySelector('.active').classList.remove('active');
                tab.classList.add('active');
            });
        });
        const dragging = (e) =>{
            if(!isDragging) return;
            tabsBox.classList.add('dragging');
            tabsBox.scrollLeft -= e.movementX;
            handleIcons(tabsBox.scrollLeft);
        };
        const dragStop = () =>{
            isDragging = false;
            tabsBox.classList.remove('dragging');
        };
        tabsBox.addEventListener('wheel', (e) =>{
            tabsBox.scrollLeft += e.deltaY * 250;
            tabsBox.scrollLeft += e.deltaX * 250;
            handleIcons(tabsBox.scrollLeft);
        });
        tabsBox.addEventListener('mousedown', () => isDragging = true);
        tabsBox.addEventListener('mousemove', dragging);
        document.addEventListener("mouseup", dragStop);

        document.getElementById("myButton").addEventListener("click", function() {
            this.style.display = "none";
          });
    }

    
    