// Get references to the <a> elements and content divs
const link1 = document.getElementById('link1');
const link2 = document.getElementById('link2');
const content1 = document.getElementById('content1');
const content2 = document.getElementById('content2');

// Show the "All" tab content by default
content1.style.display = 'block';
content2.style.display = 'none';

// Function to remove the 'active' class from all links
function removeActiveClass() {
  [link1, link2].forEach(link => {
    link.classList.remove('active');
  });
}

// Add click event listeners to the <a> elements
link1.addEventListener('click', () => {
  // Show the "All" tab content
  content1.style.display = 'block';
  content2.style.display = 'none';

  // Remove 'active' class from all links
  removeActiveClass();

  // Add 'active' class to the clicked link
  link1.classList.add('active');
});

link2.addEventListener('click', () => {
  // Show the "Paid" tab content
  content1.style.display = 'none';
  content2.style.display = 'block';

  // Remove 'active' class from all links
  removeActiveClass();

  // Add 'active' class to the clicked link
  link2.classList.add('active');
});

// Get all reference numbers
const refNumbers = document.querySelectorAll('.ref_num');

// Add click event listener to each reference number
refNumbers.forEach(refNumber => {
  refNumber.addEventListener('click', () => {
    // Toggle display of additional information
    const additionalInfo = document.getElementById('additional-info');
    additionalInfo.style.display = (additionalInfo.style.display === 'none') ? 'block' : 'none';

    // Update the additional information content if needed
    // You can retrieve the specific information based on the clicked reference number
    // and update the content of the "additional-info" element dynamically
  });
});
