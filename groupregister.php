<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Orlia'25</title>
    <link rel="stylesheet" href="assets/styles/styles.css">
    <link rel="stylesheet" href="assets/styles/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
</head>

<body>
    <div class="registration-container">
        <div class="brand-section">
            <h1>ORLIA'25</h1>
            <p>Join us for an incredible technical symposium experience at MKCE</p>
        </div>
        <div class="form-section">
            <div class="registration-form">
                <h2>ORLIA 2K25</h2>
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
                            <option value="FE">Freshman Engineering</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <select id="daySelection" name="daySelection" required onchange="updateEvents()">
                            <option value="" disabled selected>Select Day</option>
                            <option value="day1">Day 1</option>
                            <option value="day2">Day 2</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <select id="events" name="events" required disabled>
                            <option value="" disabled selected>Select Event</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="number" id="teamMembersCount" name="teamMembersCount" placeholder="Number of Team Members" min="1" max="15" required onchange="addTeamMembers()">
                    </div>
                    <div id="teamMembersContainer"></div>
                    <button type="submit" class="submit-btn">Register</button>
                </form>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>

    <script>


        function addTeamMembers() {
            const count = document.getElementById("teamMembersCount").value;
            const container = document.getElementById("teamMembersContainer");
            container.innerHTML = "";
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

        function updateEvents() {
            const daySelection = document.getElementById("daySelection");
            const eventsDropdown = document.getElementById("events");

            // Clear previous options and enable the dropdown
            eventsDropdown.innerHTML = '<option value="" disabled selected>Select Event</option>';
            eventsDropdown.disabled = false; // Enable the dropdown

            let eventList = [];

            if (daySelection.value === "day1") {
                eventList = [
                    {
                        value: "Divideconquer",
                        text: "Divide conquer"
                    },
                    {
                        value: "Firelesscooking",
                        text: "Fireless cooking"
                    },
                    
                    
                    {
                        value: "Trailertime",
                        text: "Trailer Time"
                    },
                    
                    {
                        value: "Iplauction",
                        text: "Ipl Auction"
                    },
                    {
                        value: "Lyricalhunt",
                        text: "Lyrical Hunt"
                    },
                    {
                        value: "Dumpcharades",
                        text: "Dump Charades"
                    },
                    
                    {
                        value: "Groupdance",
                        text: "Group Dance"
                    },
                ];
            } else if (daySelection.value === "day2") {
                eventList = [{
                        value: "Rangoli",
                        text: "Rangoli"
                    },
                    
                   
                    {
                        value: "Sherlockholmes",
                        text: "Sherlock Holmes"
                    },
                    
                    {
                        value: "Freefire",
                        text: "Free Fire"
                    },
                    {
                        value: "Treasurehunt",
                        text: "Treasure Hunt"
                    },
                   
                    {
                        value: "Artfromwaste",
                        text: "Art From Waste"
                    },
                    {
                        value: "Twindance",
                        text: "Twin Dance"
                    },
                    {
                        value: "Mime",
                        text: "Mime"
                    },
                    
                ];
            }

            eventList.forEach(event => {
                const option = document.createElement("option");
                option.value = event.value;
                option.textContent = event.text;
                eventsDropdown.appendChild(option);
            });
        }


        $(document).on('submit', '#Groupform', function(e) {
            console.log("Form submitted");
            e.preventDefault();
            var Formdata = new FormData(this);
        
            Formdata.append("groupnewuser", true);

            
            $.ajax({
                url: "backend.php",
                method: "POST",
                data: Formdata,
                processData: false,
                contentType: false,
                success: function(response) {
                    var res = jQuery.parseJSON(response);
                    console.log(res);
                    if (res.status == 200) {
                        $('#Groupform')[0].reset(); // Corrected form reset

                        iziToast.success({
                            title: 'OK',
                            message: 'Event Register Success'
                        });
                    } else if (res.status == 500) {
                        $('#Groupform')[0].reset(); // Corrected form reset
                        console.error("Error:", res.message);
                        alert("Something went wrong! Try again.");
                    }
                }
            });
        });
    </script>
</body>

</html>