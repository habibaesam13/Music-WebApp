


var activeLink = null; // Store the active link
function toggleTab(element) {
    var tab = document.getElementById('tab');
    var link = element.parentElement;

    if (tab) {
        if (link === activeLink) {
            return;
        }
        tab.style.display = 'none';
        tab.parentElement.removeChild(tab);
    }

    if (link !== activeLink) {
        link.classList.add('active');
        tab = document.createElement('div');
        tab.id = 'tab';
        tab.classList.add('tab');
        link.appendChild(tab);
        tab.style.display = 'block';
        tab.style.top = (link.offsetTop - 25) + 'px'; // Move the tab 5 pixels up
        tab.style.left = (link.offsetLeft + link.offsetWidth) + 'px';
        activeLink = link; // Update the active link
    }
}
