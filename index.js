function showPage(pageId) {
  // Hide all pages
  const pages = document.querySelectorAll('.page');
  pages.forEach(page => page.setAttribute('hidden', ''));

  // Show selected page
  const selectedPage = document.getElementById(pageId);
  selectedPage.removeAttribute('hidden');

  // Update navbar active styles
  const tabs = document.querySelectorAll('#menu .tab');
  tabs.forEach(tab => tab.classList.remove('active'));

  event.target.classList.add('active');
}
