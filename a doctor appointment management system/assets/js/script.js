const hamburger = document.querySelector('.hamburger');
const navLinks = document.querySelector('.nav-links');

hamburger.addEventListener('click', function() {
    navLinks.classList.toggle('active');
    hamburger.classList.toggle('toggle');
});
//slider
const sliderWrapper = document.querySelector('.slider-wrapper');
const slides = document.querySelectorAll('.slider img');
const leftArrow = document.querySelector('.left-arrow');
const rightArrow = document.querySelector('.right-arrow');

let currentIndex = 0;
const totalSlides = slides.length;

function updateSliderPosition() {
  const width = sliderWrapper.clientWidth;
  sliderWrapper.style.transform = `translateX(-${currentIndex * width}px)`;
}

function showNextSlide() {
  currentIndex = (currentIndex + 1) % totalSlides;
  updateSliderPosition();
}

function showPreviousSlide() {
  currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
  updateSliderPosition();
}

rightArrow.addEventListener('click', showNextSlide);
leftArrow.addEventListener('click', showPreviousSlide);

// Disable image dragging
slides.forEach(img => {
  img.addEventListener('dragstart', (e) => {
    e.preventDefault();
  });
});

// Swipe functionality for touch and mouse devices
let startX, isDragging = false;

function startDragging(e) {
  startX = e.clientX || e.touches[0].clientX;
  isDragging = true;
}

function duringDragging(e) {
  if (!isDragging) return;
  const moveX = e.clientX || e.touches[0].clientX;
  const diffX = startX - moveX;

  if (diffX > 50) {
    showNextSlide();
    isDragging = false;
  } else if (diffX < -50) {
    showPreviousSlide();
    isDragging = false;
  }
}

function stopDragging() {
  isDragging = false;
}

// Event listeners for mouse dragging
sliderWrapper.addEventListener('mousedown', startDragging);
sliderWrapper.addEventListener('mousemove', duringDragging);
sliderWrapper.addEventListener('mouseup', stopDragging);
sliderWrapper.addEventListener('mouseleave', stopDragging);

// Event listeners for touch dragging
sliderWrapper.addEventListener('touchstart', startDragging);
sliderWrapper.addEventListener('touchmove', duringDragging);
sliderWrapper.addEventListener('touchend', stopDragging);

// Handle window resize to adjust slider position
window.addEventListener('resize', updateSliderPosition);

// Initial position
updateSliderPosition();



//contact
