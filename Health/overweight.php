<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="overweight.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <div id="map" style="height: 400px;"></div>
  <title>Stepper with Map</title>
</head>
<body>
  <section class="section stepper__wrapper">
    <ol class="stepper" role="tablist">
      <li class="step active">
        <button id="step1-tab" class="step__label" role="tab" aria-controls="step1-panel" aria-selected="true">
          <span class="step__circle"><span class="step__circle__inner" aria-label="Step 1">1</span></span>
          <span class="step__title">Step 1</span>
        </button>
      </li>
      <li class="step">
        <button id="step2-tab" class="step__label" role="tab" aria-controls="step2-panel" aria-selected="false" disabled>
          <span class="step__circle"><span class="step__circle__inner" aria-label="Step 2">2</span></span>
          <span class="step__title">Step 2</span>
        </button>
        <div class="step__connector">
          <div class="step__connector__line"></div>
        </div>
      </li>
      <li class="step">
        <button id="step3-tab" class="step__label" role="tab" aria-controls="step3-panel" aria-selected="false" disabled>
          <span class="step__circle"><span class="step__circle__inner" aria-label="Step 3">3</span></span>
          <span class="step__title">Step 3</span>
        </button>
        <div class="step__connector">
          <div class="step__connector__line"></div>
        </div>
      </li>
      <li class="step">
        <button id="step4-tab" class="step__label" role="tab" aria-controls="step4-panel" aria-selected="false" disabled>
          <span class="step__circle"><span class="step__circle__inner" aria-label="Step 4">4</span></span>
          <span class="step__title">Step 4</span>
        </button>
        <div class="step__connector">
          <div class="step__connector__line"></div>
        </div>
      </li>
    </ol>
    <p>Once per week </p>
    <div class="stepper__content" aria-live="polite">
        
      <div id="step1-panel" class="step__content active" role="tabpanel" aria-labelledby="step1-tab">Running</div>
      <div id="step2-panel" class="step__content" role="tabpanel" aria-labelledby="step2-tab">Biking</div>
      <div id="step3-panel" class="step__content" role="tabpanel" aria-labelledby="step3-tab">Hiking</div>
      <div id="step4-panel" class="step__content" role="tabpanel" aria-labelledby="step4-tab">Climbing</div>
    </div>
    <div class="stepper__controls">
      <button class="btn step__prev" disabled aria-label="Go to previous Step">Previous</button>
      <button class="btn step__next" aria-label="Go to next Step">Next</button>
    </div>
  </section>
 
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script src="overweight.js" defer></script>
</body>
</html>
