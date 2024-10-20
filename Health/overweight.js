const stepper = document.querySelector(".stepper__wrapper");
const steps = stepper.querySelector(".stepper").children;
const stepperContent = stepper.querySelector(".stepper__content");
const stepsContent = stepperContent.querySelectorAll(".step__content");
const stepNext = stepper.querySelector(".step__next");
const stepPrev = stepper.querySelector(".step__prev");
const stepDuration = parseInt(
  getComputedStyle(document.documentElement).getPropertyValue("--step-duration")
);

// Initialize the map
let map = L.map('map').setView([33.8547, 35.8623], 8); // Coordinates for Lebanon
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  maxZoom: 19,
  attribution: '© OpenStreetMap'
}).addTo(map);

// Define markers and polylines
const markers = [
  L.marker([33.8938, 35.5018]).bindPopup('Beirut'), // Step 1: Beirut
  L.marker([34.4333, 35.8333]).bindPopup('Tripoli'), // Step 2: Tripoli
  L.marker([33.7333, 35.5667]).bindPopup('Sidon'), // Step 3: Sidon
  L.marker([33.3032, 35.2036]).bindPopup('Tyre')  // Step 4: Tyre
  
];

const polyline = L.polyline([], { color: 'blue' }).addTo(map);

// Function to update markers and polyline
function updateMarkers(index) {
  // Clear the polyline
  polyline.setLatLngs([]);

  // Add all markers and update the polyline with the ones that have been reached
  markers.forEach((marker, i) => {
    if (!map.hasLayer(marker)) {
      marker.addTo(map);
    }
    if (i <= index) {
      polyline.addLatLng(marker.getLatLng());
    }
  });

  // Zoom to fit the polyline
  map.fitBounds(polyline.getBounds());
}

[...steps].map(function (step, index) {
  step.querySelector(".step__label").addEventListener("click", function (e) {
    const current = e.currentTarget.closest(".step");
    changeSteps(current, index);
  });
});

stepNext.addEventListener("click", function (e) {
  const active = stepper.querySelector(".step.active");
  const next = active.nextElementSibling;
  next.querySelector(".step__label").disabled = false;
  next.querySelector(".step__label").setAttribute('aria-selected', true);
  let isDisabled = next.querySelector(".step__label").disabled;
  if (next && !isDisabled) {
    changeSteps(next, Array.prototype.indexOf.call(steps, next));
  }
});

stepPrev.addEventListener("click", function (e) {
  let active = stepper.querySelector(".step.active");
  let prev = active.previousElementSibling;
  prev.querySelector(".step__label").disabled = false;
  prev.querySelector(".step__label").setAttribute('aria-selected', false);
  let isDisabled = prev.querySelector(".step__label").disabled;
  if (prev && !isDisabled) {
    changeSteps(prev, Array.prototype.indexOf.call(steps, prev));
  }
});

function changeSteps(current, index) {
  if (current.classList.contains("active")) return;

  let nextSibling = current.nextElementSibling;
  let nextSiblings = {};
  nextSiblings["forwards"] = false;
  nextSiblings["items"] = [];

  let prevSibling = current.previousElementSibling;
  let prevSiblings = {};
  prevSiblings["forwards"] = true;
  prevSiblings["items"] = [];

  const prevDisabled =
    prevSibling === null
      ? (stepPrev.disabled = true)
      : (stepPrev.disabled = false);
  const nextDisabled =
    nextSibling === null
      ? (stepNext.disabled = true)
      : (stepNext.disabled = false);

  while (prevSibling) {
    prevSiblings.items.push(prevSibling);
    if (prevSibling.classList.contains("active")) break;
    prevSibling = prevSibling.previousElementSibling;
  }

  while (nextSibling) {
    nextSiblings.items.push(nextSibling);
    if (nextSibling.classList.contains("active")) break;
    nextSibling = nextSibling.nextElementSibling;
  }

  changeStep(prevSiblings, current);
  changeStep(nextSiblings, current);
  switchContent(current);

  // Update the map with the current marker and polyline
  updateMarkers(index);
}

function changeStep(siblings, current) {
  if (siblings.items.length === 0) return;

  let done = siblings.forwards;
  let items = siblings.items.reverse();

  items.map(function (item, index) {
    setTimeout(function () {
      item.classList.toggle("active", false);
      item.querySelector(".step__label").setAttribute('aria-selected', false);
      item.classList.toggle("done", done);
    }, index * stepDuration * 1.75);

    if (items.length - 1 === index) {
      setTimeout(function () {
        current.classList.add("active");
        current.querySelector(".step__label").setAttribute('aria-selected', true);
      }, items.length * stepDuration * 1.75);
    }
  });
}

function switchContent(current) {
  const parent = current.parentNode;
  const currentIndex = Array.prototype.indexOf.call(parent.children, current);
  const newContent = stepsContent[currentIndex];
  const duration = stepDuration / 2;

  if (stepsContent[currentIndex].classList.contains("active")) return;

  [...stepsContent].map(function (content, index) {
    if (content.classList.contains("active")) {
      content.classList.remove("active");
      setTimeout(function () {
        content.classList.add("is-hidden");
      }, duration);
    }
  });

  setTimeout(function () {
    newContent.classList.remove("is-hidden");
    setTimeout(function () {
      newContent.classList.add("active");
    }, duration);
  }, duration);
}

// Initialize the map with the first marker
updateMarkers(0);
