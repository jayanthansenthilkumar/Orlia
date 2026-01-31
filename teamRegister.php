<?php
include 'includes/auth.php';
checkUserAccess(true);
?>
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
        <!-- <div class="theme-switch" id="theme-toggle" title="Toggle Theme">
            <i class="ri-moon-line"></i>
        </div> -->
    </div>

    <div class="registration-container">
        <div class="brand-section">
            <h1>ORLIA'26</h1>
            <p>Join us for an incredible technical symposium experience at MKCE</p>
        </div>
        <div class="form-section">
            <div class="registration-form">
                <h2>Team Registration</h2>

                <div class="step-indicators" id="stepIndicators">
                    <span class="step-dot active"></span>
                    <span class="step-dot"></span>
                </div>

                <form id="Groupform">
                    <!-- Step 1: Team & Leader Details -->
                    <div class="step-container active" id="step1">
                        <h3>Team & Leader Details</h3>
                        <div class="form-group">
                            <input type="text" id="TeamName" name="TeamName" placeholder="Team Name" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="fullName" name="fullName" placeholder="Team Leader Name" required>
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
                            <select id="year" name="year" required>
                                <option value="" disabled selected>Select Year</option>
                                <option value="I year">I Year</option>
                                <option value="II year">II Year</option>
                                <option value="III year">III Year</option>
                                <option value="IV year">IV Year</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="text" id="rollNumber" name="rollNumber" placeholder="Leader Roll Number"
                                required>
                        </div>

                        <div class="form-group">
                            <input type="email" id="mailid" name="mailid" placeholder="Leader Mail Id" required>
                        </div>

                        <div class="form-group">
                            <input type="tel" id="phoneNumber" name="phoneNumber" placeholder="Phone Number" required>
                        </div>

                        <div class="form-navigation">
                            <button type="button" class="btn-next" onclick="nextStep(1)">Next</button>
                        </div>
                    </div>

                    <!-- Step 2: Event Details & Member Count -->
                    <div class="step-container" id="step2">
                        <h3>Event Details</h3>
                        <div class="form-group">
                            <select id="daySelection" name="daySelection" required onchange="updateEvents()">
                                <option value="" disabled>Select Day</option>
                                <option value="day1">Day 1</option>
                                <option value="day2">Day 2</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <select id="events" name="events" required>
                                <option value="" disabled>Select Event</option>
                            </select>
                        </div>

                        <div class="form-group" id="songFieldContainer" style="display: none;">
                            <label for="songFile"
                                style="display: block; margin-bottom: 5px; color: var(--text-color);">Upload Song (MP3
                                only)</label>
                            <input type="file" id="songFile" name="song" accept=".mp3">
                        </div>

                        <div class="form-group">
                            <input type="number" id="teamMembersCount" name="teamMembersCount"
                                placeholder="Number of Team Members" min="1" max="15" required>
                        </div>

                        <div class="form-navigation">
                            <button type="button" class="btn-prev" onclick="prevStep(2)">Previous</button>
                            <button type="button" class="btn-next" onclick="nextStep(2)">Next</button>
                        </div>
                    </div>

                    <!-- Dynamic Steps Placeholder -->
                    <div id="dynamicStepsContainer"></div>

                </form>
            </div>
        </div>
    </div>


    <script src="assets/script/script.js"></script>
    <script src="assets/script/assistant.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        // Multi-step Form Logic
        // Multi-step Form Logic
        function updateIndicators() {
            const dots = document.querySelectorAll('.step-dot');
            const steps = document.querySelectorAll('.step-container');
            let activeStepIndex = 0;

            steps.forEach((step, index) => {
                if (step.classList.contains('active')) {
                    activeStepIndex = index;
                }
            });

            dots.forEach((dot, index) => {
                if (index === activeStepIndex) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });
        }

        function createIndicators(totalSteps) {
            const container = document.getElementById('stepIndicators');
            container.innerHTML = '';
            for (let i = 0; i < totalSteps; i++) {
                const dot = document.createElement('span');
                dot.className = 'step-dot';
                if (i === 0) dot.classList.add('active');
                container.appendChild(dot);
            }
            updateIndicators();
        }

        function nextStep(currentStep) {
            // Validate current step fields
            const currentContainer = document.getElementById('step' + currentStep);
            const inputs = currentContainer.querySelectorAll('input, select');
            let isValid = true;

            // Check HTML5 validation
            inputs.forEach(input => {
                if (input.hasAttribute('required') && !input.value) {
                    isValid = false;
                    input.reportValidity();
                    return;
                }
                if (!input.checkValidity()) {
                    isValid = false;
                    input.reportValidity();
                }
            });

            if (!isValid) return;

            // If we are on Step 2, generate the dynamic steps before moving
            if (currentStep === 2) {
                generateTeamSteps();
            }

            // Go to next
            document.getElementById('step' + currentStep).classList.remove('active');
            const nextStepContainer = document.getElementById('step' + (currentStep + 1));

            if (nextStepContainer) {
                nextStepContainer.classList.add('active');
                updateIndicators();

                // Set focus to the first input of the new step
                const firstInput = nextStepContainer.querySelector('input, select');
                if (firstInput) {
                    firstInput.focus();
                }
            }
        }

        function prevStep(currentStep) {
            document.getElementById('step' + currentStep).classList.remove('active');
            const prevStepContainer = document.getElementById('step' + (currentStep - 1));

            if (prevStepContainer) {
                prevStepContainer.classList.add('active');
                updateIndicators();

                // Set focus
                const firstInput = prevStepContainer.querySelector('input, select');
                if (firstInput) {
                    firstInput.focus();
                }
            }
        }

        // Prevent Enter key from submitting the form on early steps
        document.getElementById('Groupform').addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                const activeStep = document.querySelector('.step-container.active');
                // Only prevent if we are NOT on the last step containing submit-btn
                if (activeStep) {
                    const submitBtn = activeStep.querySelector('.submit-btn');
                    if (!submitBtn) {
                        e.preventDefault();
                        const nextBtn = activeStep.querySelector('.btn-next');
                        if (nextBtn) nextBtn.click();
                    }
                }
            }
        });

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

            // Handle Song Field Visibility
            const songContainer = document.getElementById('songFieldContainer');
            const songInput = document.getElementById('songFile');

            if (selectedEvent && selectedEvent.toLowerCase() === 'groupdance') {
                songContainer.style.display = 'block';
                songInput.required = true;
            } else {
                songContainer.style.display = 'none';
                songInput.required = false;
                songInput.value = '';
            }

            const teamMembersInput = document.getElementById('teamMembersCount');

            // Case-insensitive lookup for event configs
            let config = null;
            // Try direct lookup first
            if (eventTeamSizes[selectedEvent]) {
                config = eventTeamSizes[selectedEvent];
            } else {
                // Try case-insensitive matching
                const lowerSelected = selectedEvent.toLowerCase();
                const key = Object.keys(eventTeamSizes).find(k => k.toLowerCase() === lowerSelected);
                if (key) {
                    config = eventTeamSizes[key];
                }
            }

            if (config) {
                const {
                    min,
                    max
                } = config;
                // Subtract 1 from min and max since leader is counted separately
                teamMembersInput.min = min - 1;
                teamMembersInput.max = max - 1;
                teamMembersInput.disabled = false;
                teamMembersInput.placeholder = `Enter additional members (${min - 1}-${max - 1})`;

                // Adjust value if out of bounds
                const currentVal = parseInt(teamMembersInput.value) || 0;
                if (currentVal < min - 1) {
                    teamMembersInput.value = min - 1;
                } else if (currentVal > max - 1) {
                    teamMembersInput.value = max - 1;
                }

                // If the value was empty or 0 and min-1 is > 0, we just set it. 
                // No immediate generation needed, will generate on nextStep(2)
            } else {
                teamMembersInput.disabled = true;
                teamMembersInput.placeholder = 'Select an event first';
                teamMembersInput.value = '';
            }
        });

        function generateTeamSteps() {
            const count = parseInt(document.getElementById("teamMembersCount").value) || 0;
            const container = document.getElementById("dynamicStepsContainer");
            container.innerHTML = ""; // Clear existing

            if (count === 0) return;

            // Configuration
            const memberChunkSize = 1; // Number of members per tab/slide
            const totalMembers = count;
            const totalSteps = Math.ceil(totalMembers / memberChunkSize);

            // We start numbering dynamic steps from 3
            // Step 1: Leader, Step 2: Event, Step 3+: Members

            for (let s = 0; s < totalSteps; s++) {
                const stepId = 3 + s;
                const memberIndex = s + 1; // 1, 2, 3...

                const isLastStep = (s === totalSteps - 1);

                let html = `
                <div class="step-container" id="step${stepId}">
                    <h3>Team Member ${memberIndex} Details</h3>
                `;

                // We are only showing one member per step now
                html += `
                    <div class="member-block">
                        <div class="form-group">
                            <input type="text" name="memberName${memberIndex}" placeholder="Team Member ${memberIndex} Name" required>
                        </div>
                        <div class="form-group">
                            <select name="memberDept${memberIndex}" required>
                                <option value="" disabled selected>Select Department</option>
                                <option value="AIDS">AIDS</option>
                                <option value="AIML">AIML</option>
                                <option value="CSE">CSE</option>
                                <option value="CSBS">CSBS</option>
                                <option value="ECE">ECE</option>
                                <option value="EEE">EEE</option>
                                <option value="MECH">MECH</option>
                                <option value="CIVIL">CIVIL</option>
                                <option value="IT">IT</option>
                                <option value="VLSI">VLSI</option>
                                <option value="MCA">MCA</option>
                                <option value="MBA">MBA</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="memberYear${memberIndex}" required>
                                <option value="" disabled selected>Select Year</option>
                                <option value="I year">I Year</option>
                                <option value="II year">II Year</option>
                                <option value="III year">III Year</option>
                                <option value="IV year">IV Year</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" name="memberRoll${memberIndex}" placeholder="Team Member ${memberIndex} Roll Number" required>
                        </div>
                        <div class="form-group">
                            <input type="tel" name="memberPhone${memberIndex}" placeholder="Team Member ${memberIndex} Phone Number" required>
                        </div>
                    </div>
                `;

                html += `
                    <div class="form-navigation">
                        <button type="button" class="btn-prev" onclick="prevStep(${stepId})">Previous</button>
                `;

                if (isLastStep) {
                    html += `<button type="submit" class="submit-btn" style="width: auto; min-width: 120px;">Register</button>`;
                } else {
                    html += `<button type="button" class="btn-next" onclick="nextStep(${stepId})">Next</button>`;
                }

                html += `
                    </div>
                </div>`;

                container.insertAdjacentHTML('beforeend', html);
            }

            // Update indicators (Step 1 + Step 2 + Dynamic Steps)
            createIndicators(2 + totalSteps);
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

            // Auto-fill roll number logic
            const departmentSelect = document.getElementById('department');
            const yearSelect = document.getElementById('year');
            const rollNumberInput = document.getElementById('rollNumber');

            let currentFixedPrefix = '';
            let isRollPrefixLocked = false;

            const deptCodes = {
                'AIDS': 'BAD',
                'AIML': 'BAM',
                'CSE': 'BCS',
                'CSBS': 'BCB',
                'CYBER': 'BSC',
                'ECE': 'BEC',
                'EEE': 'BEE',
                'MECH': 'BME',
                'CIVIL': 'BCE',
                'IT': 'BIT',
                'VLSI': 'BEV',
                'MBA': 'MBA',
                'MCA': 'MCA'
            };

            const yearCodes = {
                'I year': '927625',
                'II year': '927624',
                'III year': '927623',
                'IV year': '927622'
            };

            // Enforce the prefix if locked
            rollNumberInput.addEventListener('input', function () {
                if (isRollPrefixLocked && currentFixedPrefix) {
                    if (!this.value.startsWith(currentFixedPrefix)) {
                        this.value = currentFixedPrefix;
                    }
                }
            });

            // Prevent deleting the prefix via backspace for better UX
            rollNumberInput.addEventListener('keydown', function (e) {
                if (isRollPrefixLocked && currentFixedPrefix) {
                    if (this.selectionStart <= currentFixedPrefix.length && e.key === 'Backspace') {
                        e.preventDefault();
                    }
                }
            });

            // Real-time Team Name Validation
            const teamNameInput = document.getElementById('TeamName');
            let typingTimer;
            const doneTypingInterval = 500; // 0.5s

            teamNameInput.addEventListener('keyup', function () {
                clearTimeout(typingTimer);
                const val = this.value;

                // Clear feedback if empty
                if (!val) {
                    setTeamNameFeedback('');
                    return;
                }

                typingTimer = setTimeout(checkTeamName, doneTypingInterval);
            });

            function checkTeamName() {
                const teamName = teamNameInput.value;
                if (!teamName) return;

                $.ajax({
                    url: 'backend.php',
                    method: 'POST',
                    data: { check_team_name: true, teamName: teamName },
                    success: function (response) {
                        try {
                            const res = JSON.parse(response);
                            if (res.status == 200) {
                                setTeamNameFeedback('available');
                            } else {
                                setTeamNameFeedback('taken');
                            }
                        } catch (e) {
                            console.error('Error parsing response');
                        }
                    }
                });
            }

            function setTeamNameFeedback(status) {
                // Remove existing feedback
                const existing = teamNameInput.parentNode.querySelector('.feedback-msg');
                if (existing) existing.remove();

                if (!status) {
                    teamNameInput.style.borderColor = '';
                    return;
                }

                const msg = document.createElement('span');
                msg.classList.add('feedback-msg');
                msg.style.fontSize = '0.8rem';
                msg.style.marginTop = '5px';
                msg.style.display = 'block';

                if (status === 'available') {
                    teamNameInput.style.borderColor = 'green';
                    msg.style.color = 'green';
                    msg.innerHTML = '<i class="ri-check-line"></i> Team name available';
                } else {
                    teamNameInput.style.borderColor = 'red';
                    msg.style.color = 'red';
                    msg.innerHTML = '<i class="ri-close-line"></i> Team name already taken';
                }

                teamNameInput.parentNode.appendChild(msg);
            }

            function checkAutoFillRollNumber() {
                const dept = departmentSelect.value;
                const year = yearSelect.value;

                let prefix = '';

                // Check if both valid
                if (dept && year && yearCodes[year]) {
                    const yCode = yearCodes[year];
                    let dCode = deptCodes[dept] || '';

                    // SPECIAL CASE: For AIML only if year == IV means prefix is 927622BAL
                    if (dept === 'AIML' && year === 'IV year') {
                        dCode = 'BAL';
                    }

                    if (dCode) {
                        prefix = yCode + dCode;
                    }
                }

                if (prefix) {
                    if (currentFixedPrefix !== prefix) {
                        rollNumberInput.value = prefix;
                    } else if (!rollNumberInput.value.startsWith(prefix)) {
                        rollNumberInput.value = prefix;
                    }

                    currentFixedPrefix = prefix;
                    isRollPrefixLocked = true;
                } else {
                    isRollPrefixLocked = false;
                    currentFixedPrefix = '';
                }
            }

            departmentSelect.addEventListener('change', checkAutoFillRollNumber);
            yearSelect.addEventListener('change', checkAutoFillRollNumber);

            // Team Member Roll Number Logic (Event Delegation)
            // Team Member Roll Number Logic (Event Delegation)
            // Updated to listen on document because elements are dynamic
            document.addEventListener('change', function (e) {
                if (e.target.tagName === 'SELECT' && (e.target.name.startsWith('memberDept') || e.target.name.startsWith('memberYear'))) {
                    const memberIndex = e.target.name.match(/\d+/)[0];
                    updateMemberRollPrefix(memberIndex);
                }
            });

            // Prevent backspace on frozen prefix for team members
            document.addEventListener('keydown', function (e) {
                if (e.target.name && e.target.name.startsWith('memberRoll') && e.key === 'Backspace') {
                    const memberIndex = e.target.name.match(/\d+/)[0];
                    const rollInput = e.target;
                    const prefix = rollInput.dataset.fixedPrefix;
                    if (prefix && rollInput.selectionStart <= prefix.length) {
                        e.preventDefault();
                    }
                }
            });

            // Enforce prefix on input
            document.addEventListener('input', function (e) {
                if (e.target.name && e.target.name.startsWith('memberRoll')) {
                    const rollInput = e.target;
                    const prefix = rollInput.dataset.fixedPrefix;
                    if (prefix && !rollInput.value.startsWith(prefix)) {
                        rollInput.value = prefix;
                    }
                }
            });

            function updateMemberRollPrefix(index) {
                const deptSelect = document.querySelector(`select[name="memberDept${index}"]`);
                const yearSelect = document.querySelector(`select[name="memberYear${index}"]`);
                const rollInput = document.querySelector(`input[name="memberRoll${index}"]`);

                if (!deptSelect || !yearSelect || !rollInput) return;

                const dept = deptSelect.value;
                const year = yearSelect.value;

                let prefix = '';
                if (dept && year && yearCodes[year]) {
                    const yCode = yearCodes[year];
                    let dCode = deptCodes[dept] || '';
                    if (dept === 'AIML' && year === 'IV year') {
                        dCode = 'BAL';
                    }
                    if (dCode) {
                        prefix = yCode + dCode;
                    }
                }

                if (prefix) {
                    rollInput.dataset.fixedPrefix = prefix;
                    if (!rollInput.value.startsWith(prefix)) {
                        rollInput.value = prefix;
                    }
                } else {
                    delete rollInput.dataset.fixedPrefix;
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
            if (dayDisabled) daySelect.prop('disabled', true);
            if (eventsDisabled) eventsSelect.prop('disabled', true);


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
                        // Reset wizard to step 1
                        document.querySelectorAll('.step-container').forEach(s => s.classList.remove('active'));
                        document.getElementById('step1').classList.add('active');
                        updateIndicators(); // Will reset dots

                        Swal.fire({
                            title: "Great!",
                            text: res.message,
                            icon: "success",
                            confirmButtonColor: '#134e4a',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'index.php';
                            }
                        });
                    } else if (res.status == 409) {
                        Swal.fire({
                            title: "Duplicate Team Name!",
                            text: res.message,
                            icon: "warning",
                            confirmButtonColor: '#d33'
                        });
                        $('#TeamName').val('');
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