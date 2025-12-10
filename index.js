function switchMainPage(pageId) {
  const pages = document.querySelectorAll('.page');
  pages.forEach(p => p.setAttribute('hidden', ''));

  document.getElementById(pageId).removeAttribute('hidden');

  const tabs = document.querySelectorAll('#nav-menu .tab');
  tabs.forEach(tab => tab.classList.remove('active'));

  event.target.classList.add('active');
}

function showPage(pageId) {
    // Hide all analytics subpages
    const subpages = document.querySelectorAll('.analytics-page');
    subpages.forEach(page => page.setAttribute('hidden', ''));

    // Show the selected subpage
    const selected = document.getElementById(pageId);
    selected.removeAttribute('hidden');

    // Update active tab UI (only inside analytics nav)
    const tabs = document.querySelectorAll('#analytics-menu .tab');
    tabs.forEach(tab => tab.classList.remove('active'));

    event.target.classList.add('active');
}
