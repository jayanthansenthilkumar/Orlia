<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Orlia'26</title>
    <link rel="stylesheet" href="assets/styles/styles.css">

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
    <div class="registration-container">
        <div class="brand-section">
            <div class="floating-circle"></div>
            <div class="floating-circle"></div>
            <div class="floating-circle"></div>
            <h1>ORLIA'26</h1>
            <p>Join us for an incredible technical symposium experience at MKCE</p>
        </div>
        <div class="form-section">
            <div class="floating-circle"></div>
            <div class="floating-circle"></div>
            <div class="registration-form">
                <!-- <h2>ORLIA 2K26</h2> -->
                <form id="registerForm">
                    <div class="form-group">
                        <input type="text" id="fullName" name="fullName" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <input type="text" id="rollNumber" name="rollNumber" placeholder="Roll Number" required>
                    </div>
                    <div class="form-group">
                        <input type="email" id="mailid" name="mailid" placeholder="Mail Id" required>
                    </div>
                    <div class="form-group">

                        <select id="year" name="year" required>
                            <option value="" disabled selected>Select Year</option>
                            <option value="I year">I Year</option>
                            <option value="II year">II year</option>
                            <option value="III year">III year</option>
                            <option value="IV year">IV year</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <input type="tel" id="phoneNumber" name="phoneNumber" placeholder="Phone Number" required>
                    </div>
                    <div class="form-group">
                        <select id="department" name="department" required>
                            <option value="" disabled selected>Select Department</option>
                            <option value="AIDS">Artificial Intelligence and Data Science</option>
                            <option value="AIML">Artificial Intelligence and Machine Learning</option>
                            <option value="CYBER">CSE - Cyber Security</option>
                            <option value="CSE">Computer Science Engineering</option>
                            <option value="CSBS">Computer Science And Business Systems</option>
                            <option value="ECE">Electronics & Communication Engineering</option>
                            <option value="EEE">Electrical & Electronics Engineering</option>
                            <option value="MECH">Mechanical Engineering</option>
                            <option value="CIVIL">Civil Engineering</option>
                            <option value="IT">Information Technology</option>
                            <option value="VLSI">Electronics Engineering (VLSI Design)</option>
                            <option value="MCA">Master of Computer Applications</option>
                            <option value="MBA">Master of Business Administration</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <select id="daySelection" name="daySelection" required onchange="updateEvents()">
                            <option value="" disabled>Select Day</option>
                            <option value="day1">Day 1
                            </option>
                            <option value="day2">Day 2
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <select id="events" name="events" required>
                            <option value="" disabled selected>Select Event</option>
                        </select>
                    </div>

                    <button type="submit" class="submit-btn">Register</button>
                    <div class="event-footer">
                        <div class="event-location">
                            <i class="ri-map-pin-line"></i>
                            <span>MKCE</span>
                        </div>
                        <a href="index.php" class="event-btn">Home</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="assets/script/script.js"></script>
    <script src="assets/script/assistant.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).on('submit', '#registerForm', function (e) {
            e.preventDefault();
            var daySelect = $('#daySelection');
            var eventsSelect = $('#events');
            var dayDisabled = daySelect.prop('disabled');
            var eventsDisabled = eventsSelect.prop('disabled');

            // Temporarily enable to capture data
            daySelect.prop('disabled', false);
            eventsSelect.prop('disabled', false);

            var Formdata = new FormData(this);
            Formdata.append("Add_newuser", true);

            // Re-disable if they were disabled (to maintain UI state if error occurs)
            if (dayDisabled) daySelect.prop('disabled', true);
            if (eventsDisabled) eventsSelect.prop('disabled', true);

            console.log(Object.fromEntries(Formdata));

            $.ajax({
                url: "backend.php",
                method: "POST",
                data: Formdata,
                processData: false,
                contentType: false,
                success: function (response) {
                    var res = JSON.parse(response);
                    if (res.status == 200) {
                        $('#registerForm')[0].reset();
                        Swal.fire({
                            title: "Good job!",
                            text: res.message,
                            icon: "success"
                        });
                    } else {
                        Swal.fire({
                            title: "Error!",
                            text: res.message,
                            icon: "error"
                        });
                    }
                }
            });
        });

        function updateEvents(preSelectedEvent = null) {
            const daySelection = document.getElementById("daySelection");
            const eventsDropdown = document.getElementById("events");

            eventsDropdown.innerHTML = '<option value="" disabled selected>Loading...</option>';
            eventsDropdown.disabled = true;

            const selectedDay = daySelection.value;

            if (!selectedDay) return;

            $.ajax({
                url: 'backend.php',
                type: 'GET',
                data: {
                    get_events: true,
                    day: selectedDay,
                    type: 'Solo' // Fetch Solo events for individual registration
                },
                success: function (response) {
                    try {
                        const events = JSON.parse(response);
                        eventsDropdown.innerHTML = '<option value="" disabled selected>Select Event</option>';

                        if (events.length > 0) {
                            events.forEach(event => {
                                const option = document.createElement("option");
                                option.value = event.value;
                                option.textContent = event.text;
                                if (preSelectedEvent && event.value.toLowerCase() === preSelectedEvent.toLowerCase()) {
                                    option.selected = true;
                                    eventsDropdown.disabled = true; // Lock event selection if pre-selected
                                }
                                eventsDropdown.appendChild(option);
                            });

                            // Only enable if not locked by pre-selection
                            if (!eventsDropdown.disabled) {
                                eventsDropdown.disabled = false;
                            }
                        } else {
                            eventsDropdown.innerHTML = '<option value="" disabled selected>No events available</option>';
                        }
                    } catch (e) {
                        console.error("Error parsing events", e);
                        eventsDropdown.innerHTML = '<option value="" disabled selected>Error loading events</option>';
                    }
                },
                error: function () {
                    eventsDropdown.innerHTML = '<option value="" disabled selected>Error connection</option>';
                }
            });
        }

        window.onload = function () {
            const urlParams = new URLSearchParams(window.location.search);
            const selectedDay = urlParams.get('day');
            const selectedEvent = urlParams.get('event');

            if (selectedDay) {
                const daySelect = document.getElementById('daySelection');
                daySelect.value = selectedDay;

                // If a valid day is selected
                if (daySelect.value) {
                    daySelect.disabled = true; // Fix day selection
                    // Update events and pre-select the event from URL if present
                    updateEvents(selectedEvent);
                }
            }
        };

    </script>
</body>

</html>