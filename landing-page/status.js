// Get references to the <a> elements and content divs
const link1 = document.getElementById('link1');
const link2 = document.getElementById('link2');
const content1 = document.getElementById('content1');
const content2 = document.getElementById('content2');

// Add click event listeners to the <a> elements
link1.addEventListener('click', () => {
  // Hide all content divs
  content1.style.display = 'block';
  content2.style.display = 'none';
});

link2.addEventListener('click', () => {
  // Hide all content divs
  content1.style.display = 'none';
  content2.style.display = 'block';
});


