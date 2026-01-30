<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orlia'26 - Registration</title>
    <link rel="stylesheet" href="assets/styles/styles.css">

    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Space+Grotesk:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    <!-- SweetAlert is loaded in body -->
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
            <h1>ORLIA'26</h1>
            <p>Join us for an incredible technical symposium experience at MKCE</p>
        </div>
        <div class="form-section">
            <div class="registration-form">
                <h2>ORLIA 2K26</h2>
                <form id="Groupform">
                    <div class="form-group">
                        <input type="text" id="TeamName" name="TeamName" placeholder="Team Name" required>
                    </div>
                    <div class="form-group">
                        <input type="text" id="fullName" name="fullName" placeholder="Team Leader Name" required>
                    </div>
                    <div class="form-group">
                        <input type="text" id="rollNumber" name="rollNumber" placeholder="Leader Roll Number" required>
                    </div>
                    <div class="form-group">
                        <input type="email" id="mailid" name="mailid" placeholder="Leader Mail Id" required>
                    </div>

                    <div class="form-group">
                        <select id="year" name="year" required>
                            <option value="" disabled selected>Select Year</option>
                            <option value="I year">I Year</option>
                            <option value="II year">II Year</option>
                            <option value="III year">III Year</option>
                            <option value="IV year">IV Year</option>
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
                            <option value="CSE">Computer Science Engineering</option>
                            <option value="CSBS">Computer Science And Business Systems</option>
                            <option value="ECE">Electronics & Communication Engineering</option>
                            <option value="EEE">Electrical & Electronics Engineering</option>
                            <option value="MECH">Mechanical Engineering</option>
                            <option value="CIVIL">Civil Engineering</option>
                            <option value="IT">Information Technology</option>
                            <option value="VLSI">Electronics Engineering (VLSI Design)</option>
                            <option value="MCA">Master Of Computer Applications</option>
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
                            <option value="" disabled>Select Event</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="number" id="teamMembersCount" name="teamMembersCount"
                            placeholder="Number of Team Members" min="1" max="15" required onchange="addTeamMembers()">
                    </div>
                    <div id="teamMembersContainer"></div>
                    <button type="submit" class="submit-btn">Register</button>
                </form>
            </div>
        </div>
    </div>


    <script src="assets/script/script.js"></script>
    <script src="assets/script/assistant.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const eventTeamSizes = {
            'Divideconquer': {
                min: 4,
                max: 5
            },
            'Firelesscooking': {
                min: 2,
                max: 2
            },
            'Trailertime': {
                min: 2,
                max: 2
            },
            'Iplauction': {
                min: 3,
                max: 3
            },
            'Lyricalhunt': {
                min: 2,
                max: 3
            },
            'Dumpcharades': {
                min: 2,
                max: 3
            },
            'Groupdance': {
                min: 6,
                max: 15
            },
            'Rangoli': {
                min: 3,
                max: 4
            },
            'Sherlockholmes': {
                min: 2,
                max: 3
            },
            'Freefire': {
                min: 4,
                max: 4
            },
            'Treasurehunt': {
                min: 3,
                max: 4
            },
            'Artfromwaste': {
                min: 2,
                max: 2
            },
            'Twindance': {
                min: 2,
                max: 2
            },

            'Vegetablefruitart': {
                min: 2,
                max: 2
            }
        };

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
                    type: 'Group' // Fetch Group events
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
                                }
                                eventsDropdown.appendChild(option);
                            });
                            eventsDropdown.disabled = false;

                            // If an event is pre-selected or selected, trigger change to update team member fields
                            if (preSelectedEvent) {
                                // We need to wait a tick for the DOM to update or manually trigger logic
                                // Since we are setting selected=true above, let's manually call the change logic
                                const event = new Event('change');
                                eventsDropdown.dispatchEvent(event);
                                eventsDropdown.disabled = true;
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

        document.getElementById('events').addEventListener('change', function () {
            const selectedEvent = this.value;
            const teamMembersInput = document.getElementById('teamMembersCount');

            if (eventTeamSizes[selectedEvent]) {
                const {
                    min,
                    max
                } = eventTeamSizes[selectedEvent];
                // Subtract 1 from min and max since leader is counted separately
                teamMembersInput.min = min - 1;
                teamMembersInput.max = max - 1;
                teamMembersInput.disabled = false;
                teamMembersInput.placeholder = `Enter additional members (${min - 1}-${max - 1})`;

                if (teamMembersInput.value < min - 1 || teamMembersInput.value > max - 1) {
                    teamMembersInput.value = min - 1;
                }
                addTeamMembers();
            } else {
                teamMembersInput.disabled = true;
                teamMembersInput.placeholder = 'Select an event first';
                document.getElementById('teamMembersContainer').innerHTML = '';
            }
        });

        function addTeamMembers() {
            const count = parseInt(document.getElementById("teamMembersCount").value);
            const container = document.getElementById("teamMembersContainer");
            container.innerHTML = "";

            const selectedEvent = document.getElementById('events').value;
            const limits = eventTeamSizes[selectedEvent];

            // Add 1 to count to include the leader
            const totalCount = count + 1;

            if (limits && totalCount >= limits.min && totalCount <= limits.max) {
                // Display total team size including leader
                container.innerHTML =
                    `<div class="form-group"><p>Total team size (including leader): ${totalCount}</p></div>`;

                // Generate fields for additional members
                for (let i = 1; i <= count; i++) {
                    container.innerHTML += `
                        <div class="form-group">
                            <input type="text" name="memberName${i}" placeholder="Team Member ${i} Name" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="memberRoll${i}" placeholder="Team Member ${i} Roll Number" required>
                        </div>
                    `;
                }
            }
        }

        window.onload = function () {
            const urlParams = new URLSearchParams(window.location.search);
            const selectedDay = urlParams.get('day');
            const selectedEvent = urlParams.get('event');

            if (selectedDay) {
                const daySelect = document.getElementById('daySelection');
                daySelect.value = selectedDay;

                if (daySelect.value) {
                    daySelect.disabled = true;
                    // Update events and pre-select the event from URL if present
                    updateEvents(selectedEvent);
                }
            }
        };

        $(document).on('submit', '#Groupform', function (e) {
            console.log("Form submitted");
            e.preventDefault();
            var daySelect = $('#daySelection');
            var eventsSelect = $('#events');
            var dayDisabled = daySelect.prop('disabled');
            var eventsDisabled = eventsSelect.prop('disabled');

            // Temporarily enable to capture data
            daySelect.prop('disabled', false);
            eventsSelect.prop('disabled', false);

            var Formdata = new FormData(this);

            Formdata.append("groupnewuser", true);

            // Re-disable if they were disabled
            if(dayDisabled) daySelect.prop('disabled', true);
            if(eventsDisabled) eventsSelect.prop('disabled', true);


            $.ajax({
                url: "backend.php",
                method: "POST",
                data: Formdata,
                processData: false,
                contentType: false,
                success: function (response) {
                    var res = JSON.parse(response);
                    if (res.status == 200) {
                        $('#Groupform')[0].reset();
                        Swal.fire({
                            title: "Great!",
                            text: res.message,
                            icon: "success",
                            confirmButtonColor: '#134e4a'
                        });
                    } else {
                        Swal.fire({
                            title: "Error!",
                            text: res.message,
                            icon: "error",
                            confirmButtonColor: '#d33'
                        });
                    }
                }
            });
        });
    </script>
</body>

</html>