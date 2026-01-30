<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Day 2 Events - Orlia'26</title>
  <link rel="stylesheet" href="assets/styles/styles.css" />
  <link
    href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Space+Grotesk:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">


</head>

<body>
  <!-- Animated Background Particles -->
  <div class="particles-container">
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
  </div>
  <div class="theme-switch-wrapper">
    <div class="theme-switch" id="theme-toggle" title="Toggle Theme">
      <i class="ri-moon-line"></i>
    </div>
  </div>
  <a href="index.php" class="back-btn">
    <i class="ri-arrow-left-line"></i>
    Back to Home
  </a>

  <section class="day-hero">
    <div class="glitch-wrapper">
      <h1 class="glitch-text" data-text="DAY 02">DAY 02</h1>
    </div>
    <p class="section-subtitle">
      April 4, 2026 - Cultural Events
    </p>
  </section>

  <section class="day2-events">
    <div class="events-container">
      <!-- Dance Competition -->
      <div class="event-card">
        <div class="event-image">
          <img src="assets/images/rangoli.jpg" alt="Dance Competition" />
          <a href="#" onclick="disableLink(event)" class="register-btn">Register Now</a>
        </div>
        <div class="event-header">
          <div class="event-header-row">
            <div class="event-time">
              <i class="ri-time-line"></i>
              <span>9.00 AM - 10.30 AM</span>
            </div>
            <div class="event-venue">
              <i class="ri-map-pin-line"></i>
              <span>Ground</span>
            </div>
          </div>
        </div>
        <div class="event-content">
          <h3>Rangoli</h3>
          <p>Group Performance</p>
          <ul class="rules-list">
            <li>
              <i class="ri-checkbox-circle-line"></i>Duration: 60 minutes
            </li>
            <li>
              <i class="ri-checkbox-circle-line"></i>Maximum 3-4 Members.
            </li>
            <li>
              <i class="ri-checkbox-circle-line"></i>Bring own materials.
              artwork must match the theme (Orlia2k26 Cultural Fest).
            </li>
          </ul>
        </div>
      </div>

      <!-- Singing Competition -->
      <div class="event-card">
        <div class="event-image">
          <img src="assets/images/photo.jpeg" alt="Singing Competition" />
          <a href="#" onclick="disableLink(event)" class="register-btn">Register Now</a>
        </div>
        <div class="event-header">
          <div class="event-header-row">
            <div class="event-time">
              <i class="ri-time-line"></i>
              <span>9 AM - 3.30 PM</span>
            </div>
            <div class="event-venue">
              <i class="ri-map-pin-line"></i>
              <span>APJ&RK Entrance</span>
            </div>
          </div>
        </div>
        <div class="event-content">
          <h3>Photography</h3>
          <p>Solo Performance</p>
          <ul class="rules-list">
            <li>
              <i class="ri-checkbox-circle-line"></i>Solo participation;
              only one image per participant.
            </li>
            <li>
              <i class="ri-checkbox-circle-line"></i>Submit the image via
              the provided link before 31.03.2025.
            </li>
            <li>
              <i class="ri-checkbox-circle-line"></i>Theme: Favorite place
              in MKCE.
            </li>
          </ul>
        </div>
      </div>

      <div class="event-card">
        <div class="event-image">
          <img src="assets/images/instrument.jpg" alt="Quiz Competition" />
          <a href="register.php?day=day2&event=Instrumentalplaying" class="register-btn">Register Now</a>
        </div>
        <div class="event-header">
          <div class="event-header-row">
            <div class="event-time">
              <i class="ri-time-line"></i>
              <span>9 AM - 10 AM</span>
            </div>
            <div class="event-venue">
              <i class="ri-map-pin-line"></i>
              <span>CH-5</span>
            </div>
          </div>
        </div>
        <div class="event-content">
          <h3>Instrumental Playing</h3>
          <p>Solo Performance</p>
          <ul class="rules-list">
            <li>
              <i class="ri-checkbox-circle-line"></i>Any instrument allowed
              (guitar, piano, violin, flute, drums, etc.). Bring your own
              instruments and accessories.
            </li>
            <li>
              <i class="ri-checkbox-circle-line"></i>
              Performance duration: 3 to 5 minutes.
            </li>
            <li>
              <i class="ri-checkbox-circle-line"></i>Singing is allowed
              along with instrument playing.
            </li>
          </ul>
        </div>
      </div>

      <div class="event-card">
        <div class="event-image">
          <img src="assets/images/treasure.jpg" alt="Poetry Recitation" />
          <a href="#" onclick="disableLink(event)" class="register-btn">Register Now</a>
        </div>
        <div class="event-header">
          <div class="event-header-row">
            <div class="event-time">
              <i class="ri-time-line"></i>
              <span>10.00 AM - 12.00 PM</span>
            </div>
            <div class="event-venue">
              <i class="ri-map-pin-line"></i>
              <span>Vivekanandha</span>
            </div>
          </div>
        </div>
        <div class="event-content">
          <h3>Treasure Hunt</h3>
          <p>Group Performance</p>
          <ul class="rules-list">
            <li>
              <i class="ri-checkbox-circle-line"></i>Clues must be solved in
              order; no skipping or tampering.
            </li>
            <li>
              <i class="ri-checkbox-circle-line"></i>Maximum 3-4 Members
            </li>
            <li>
              <i class="ri-checkbox-circle-line"></i>
              Time-bound challenge; penalties for delays or rule violations.
            </li>
          </ul>
        </div>
      </div>
      <!-- Drama Performance -->
      <div class="event-card">
        <div class="event-image">
          <img src="assets/images/shortflim.jpg" alt="Drama Performance" />
          <a href="register.php?day=day2&event=Shortflim" class="register-btn">Register Now</a>
        </div>
        <div class="event-header">
          <div class="event-header-row">
            <div class="event-time">
              <i class="ri-time-line"></i>
              <span>11.00 AM - 12.30 PM</span>
            </div>
            <div class="event-venue">
              <i class="ri-map-pin-line"></i>
              <span>CH-3</span>
            </div>
          </div>
        </div>
        <div class="event-content">
          <h3>Short Flim</h3>
          <p>Solo Performance</p>
          <ul class="rules-list">
            <li>
              <i class="ri-checkbox-circle-line"></i>Original content only;
              plagiarism or prior publication leads to disqualification.
            </li>
            <li>
              <i class="ri-checkbox-circle-line"></i>
              Duration: Maximum 12 minutes (including credits).
            </li>
            <li>
              <i class="ri-checkbox-circle-line"></i>No offensive,
              religious, or political content; violations will result in
              disqualification.
            </li>
          </ul>
        </div>
      </div>

      <div class="event-card">
        <div class="event-image">
          <img src="assets/images/mime.jpg" alt="Music Band Performance" />
          <a href="register.php?day=day2&event=Mime" class="register-btn">Register Now</a>
        </div>
        <div class="event-header">
          <div class="event-header-row">
            <div class="event-time">
              <i class="ri-time-line"></i>
              <span>2 PM - 4 PM</span>
            </div>
            <div class="event-venue">
              <i class="ri-map-pin-line"></i>
              <span>CH-3</span>
            </div>
          </div>
        </div>
        <div class="event-content">
          <h3>Mime / Skit</h3>
          <p>Solo Performance</p>
          <ul class="rules-list">
            <li>
              <i class="ri-checkbox-circle-line"></i>Duration: 7 to 12
              minutes
            </li>
            <li>
              <i class="ri-checkbox-circle-line"></i>Background
              music/soundtracks allowed
            </li>
            <li>
              <i class="ri-checkbox-circle-line"></i>Avoid sensitive topics
              like politics, religion, or violence
            </li>
          </ul>
        </div>
      </div>

      <div class="event-card">
        <div class="event-image">
          <img src="assets/images/managerever.jpg" alt="Photography Contest" />
          <a href="register.php?day=day2&event=Bestmanager" class="register-btn">Register Now</a>
        </div>
        <div class="event-header">
          <div class="event-header-row">
            <div class="event-time">
              <i class="ri-time-line"></i>
              <span>11.00 AM - 12.30 PM</span>
            </div>
            <div class="event-venue">
              <i class="ri-map-pin-line"></i>
              <span>CH-4</span>
            </div>
          </div>
        </div>
        <div class="event-content">
          <h3>Best Manager</h3>
          <p>Solo Performance</p>
          <ul class="rules-list">
            <li><i class="ri-checkbox-circle-line"></i>Round-1:Quiz.</li>
            <li>
              <i class="ri-checkbox-circle-line"></i>Round-2: Group
              Discussion.
            </li>
            <li>
              <i class="ri-checkbox-circle-line"></i>Round-3: Scenario based
              talk.
            </li>
          </ul>
        </div>
      </div>

      <!-- Art Exhibition -->

      <!-- Photography Contest -->

      <div class="event-card">
        <div class="event-image">
          <img src="assets/images/art.jpg" alt="Debate Competition" />
          <a href="teamRegister.php?day=day2&event=Artfromwaste" class="register-btn">Register Now</a>
        </div>
        <div class="event-header">
          <div class="event-header-row">
            <div class="event-time">
              <i class="ri-time-line"></i>
              <span>11 AM - 1:30 PM</span>
            </div>
            <div class="event-venue">
              <i class="ri-map-pin-line"></i>
              <span>Vishweshwaraya</span>
            </div>
          </div>
        </div>
        <div class="event-content">
          <h3>Art from Waste</h3>
          <p>Group Performance</p>
          <ul class="rules-list">
            <li>
              <i class="ri-checkbox-circle-line"></i>Duration: 60 minutes
            </li>
            <li>
              <i class="ri-checkbox-circle-line"></i>Maximum 2 Members
            </li>
            <li>
              <i class="ri-checkbox-circle-line"></i>

              Use only recyclable/waste materials (e.g., newspapers, plastic
              bottles, fabric scraps, cardboard). Pre-made parts are not
              allowed. Participants must bring their own materials.
            </li>
          </ul>
        </div>
      </div>
      <!-- Debate Competition -->

      <div class="event-card">
        <div class="event-image">
          <img src="assets/images/sherlhome.jpg" alt="Art Exhibition" />
          <a href="#" onclick="disableLink(event)" class="register-btn">Register Now</a>
        </div>
        <div class="event-header">
          <div class="event-header-row">
            <div class="event-time">
              <i class="ri-time-line"></i>
              <span>11 AM - 1:30 PM</span>
            </div>
            <div class="event-venue">
              <i class="ri-map-pin-line"></i>
              <span>CH-2</span>
            </div>
          </div>
        </div>
        <div class="event-content">
          <h3>Sherlock Holmes</h3>
          <p>Group Performance</p>
          <ul class="rules-list">
            <li>
              <i class="ri-checkbox-circle-line"></i>
              Multiple rounds testing deduction and investigative skills
            </li>
            <li>
              <i class="ri-checkbox-circle-line"></i>Maximum 2-3 Members
            </li>
            <li>
              <i class="ri-checkbox-circle-line"></i>Solve encrypted
              messages and detective-themed puzzles
            </li>
          </ul>
        </div>
      </div>
      <div class="event-card">
        <div class="event-image">
          <img src="assets/images/freefire.jpg" alt="Fashion Show" />
          <a href="#" onclick="disableLink(event)" class="register-btn">Register Now</a>
        </div>
        <div class="event-header">
          <div class="event-header-row">
            <div class="event-time">
              <i class="ri-time-line"></i>
              <span>2.00 PM - 4.00 PM</span>
            </div>
            <div class="event-venue">
              <i class="ri-map-pin-line"></i>
              <span>Vivekanandha</span>
            </div>
          </div>
        </div>
        <div class="event-content">
          <h3>Free Fire</h3>
          <p>Group Performance</p>
          <ul class="rules-list">
            <li>
              <i class="ri-checkbox-circle-line"></i>Only mobile players, No
              pc players allowed.
            </li>
            <li>
              <i class="ri-checkbox-circle-line"></i>Maximum 4 Members.
            </li>
            <li>
              <i class="ri-checkbox-circle-line"></i>Gun skin off and
              Character skill allowed.
            </li>
          </ul>
        </div>
      </div>

      <!-- Short Film Festival -->

      <!-- Music Band Performance -->

      <!-- Stand-up Comedy -->
      <div class="event-card">
        <div class="event-image">
          <img src="assets/images/rjvj.jpg" alt="Stand-up Comedy" />
          <a href="register.php?day=day2&event=Rjvj" class="register-btn">Register Now</a>
        </div>
        <div class="event-header">
          <div class="event-header-row">
            <div class="event-time">
              <i class="ri-time-line"></i>
              <span>2.00 PM - 3.30 PM</span>
            </div>
            <div class="event-venue">
              <i class="ri-map-pin-line"></i>
              <span>CH-4</span>
            </div>
          </div>
        </div>
        <div class="event-content">
          <h3>RJ / VJ Hunt</h3>
          <p>Solo Performance</p>
          <ul class="rules-list">
            <li>
              <i class="ri-checkbox-circle-line"></i>On-the-spot topic.
            </li>
            <li>
              <i class="ri-checkbox-circle-line"></i> 3 to 5 minutes to
              present.
            </li>
            <li>
              <i class="ri-checkbox-circle-line"></i>Judged on originality,
              engagement, and innovation.
            </li>
          </ul>
        </div>
      </div>

      <!-- Traditional Arts -->
      <div class="event-card">
        <div class="event-image">
          <img src="assets/images/fruits.jpg" alt="Stand-up Comedy" />
          <a href="teamRegister.php?day=day2&event=Vegetablefruitart" class="register-btn">Register Now</a>
        </div>
        <div class="event-header">
          <div class="event-header-row">
            <div class="event-time">
              <i class="ri-time-line"></i>
              <span>2 PM - 3.30 PM</span>
            </div>
            <div class="event-venue">
              <i class="ri-map-pin-line"></i>
              <span>Vishweshwaraya</span>
            </div>
          </div>
        </div>
        <div class="event-content">
          <h3>Vegetable & Fruit Art</h3>
          <p>Group Performance</p>
          <ul class="rules-list">
            <li>
              <i class="ri-checkbox-circle-line"></i>Duration: 60 minutes
            </li>
            <li>
              <i class="ri-checkbox-circle-line"></i>Maximum 1-2 Members
            </li>
            <li>
              <i class="ri-checkbox-circle-line"></i>
              Use only vegetables & fruits; pre-made parts are not allowed.
              Participants must bring their own materials.
            </li>
          </ul>
        </div>
      </div>

      <div class="event-card">
        <div class="event-image">
          <img src="assets/images/twindnce.jpg" alt="Short Film Festival" />
          <a href="teamRegister.php?day=day2&event=Twindance" class="register-btn">Register Now</a>
        </div>
        <div class="event-header">
          <div class="event-header-row">
            <div class="event-time">
              <i class="ri-time-line"></i>
              <span>2 PM - 4 PM</span>
            </div>
            <div class="event-venue">
              <i class="ri-map-pin-line"></i>
              <span>CH-5</span>
            </div>
          </div>
        </div>
        <div class="event-content">
          <h3>Twin Dance</h3>
          <p>Group Performance</p>
          <ul class="rules-list">
            <li>
              <i class="ri-checkbox-circle-line"></i>Duration: Up to 4
              minutes. film
            </li>
            <li>
              <i class="ri-checkbox-circle-line"></i>Maximum 2 Members
            </li>
            <li>
              <i class="ri-checkbox-circle-line"></i>Only verified tracks
              allowed (must be approved by Fine Arts staff coordinator
              before 29.03.2025). Proper dress code required.
            </li>
          </ul>
        </div>
      </div>
    </div>
    </div>
  </section>
  <footer class="single-line-footer">
    <p>&copy; 2026 TECHNOLOGY INNOVATION HUB. All Rights Reserved.</p>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
<script src="assets/script/script.js"></script>
<script src="assets/script/assistant.js"></script>
</body>

</html>