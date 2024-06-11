<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Specialist Finder</title>
    <link rel="stylesheet" href="styles_landing.css">
    <style>
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        select, button {
            padding: 10px;
            width: 100%;
            max-width: 300px;
            display: block;
            margin-bottom: 15px;
            background: rgba(255, 255, 255, 0.2); /* Semi-transparent white */
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px); /* Blurs the background behind the element */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Adds a slight shadow */
            border-radius: 10px; /* Rounds the corners */
            color: #fff; /* Text color */
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: rgba(255, 255, 255, 0.3); /* Lighten the background on hover */
        }
        select::placeholder, button::placeholder {
            color: #fff; /* Placeholder text color */
        }
        #result {
            margin-top: 20px;
            margin-bottom: 10px;
        }
        .close-button, .go-back-button {
            background: rgba(255, 255, 255, 0.2); /* Semi-transparent white */
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px); /* Blurs the background behind the element */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Adds a slight shadow */
            border-radius: 10px; /* Rounds the corners */
            padding: 10px;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .close-button:hover, .go-back-button:hover {
            background-color: rgba(255, 255, 255, 0.3); /* Lighten the background on hover */
        }

        /* Add Glass Effect */
        select {
            background: none;
            backdrop-filter: blur(10px);
            border: none;
            box-shadow: none;
        }
        select option {
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            backdrop-filter: blur(10px); /* Adding blur effect to options */
            border: 1px solid rgba(255, 255, 255, 0.3); /* Adding border to options */
            padding: 5px; /* Adding padding to options */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="ball-1"></div>
        <div class="ball-2"></div>
        <div class="ball-3"></div>
        <div class="box">
            <div class="contains">
                <div class="section-1">
                    <h1>Find a Doctor Specialist</h1>
                    <form id="doctorForm">
                        <div class="form-group">
                            <label for="doctorType">Select Doctor Type:</label>
                            <select id="doctorType">
                                <?php
                                    // Assuming you have fetched doctor types from the database and stored in an array called $doctorTypes
                                    $doctorTypes = ['Cardiologist', 'Dermatologist', 'Neurologist', 'Pediatrician', 'Orthopedic Surgeon', 'Oncologist', 'Gynecologist', 'Urologist', 'Endocrinologist'];

                                    // Loop through the array to generate the options dynamically
                                    foreach ($doctorTypes as $type) {
                                        echo "<option value=\"$type\">$type</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="doctorRole">Select Doctor Role:</label>
                            <select id="doctorRole">
                                <option value="Surgeon">Surgeon</option>
                                <option value="Consultant">Consultant</option>
                                <option value="Researcher">Researcher</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>
                        <button type="button" onclick="findSpecialist()">Find Specialist</button>
                    </form>
                    <div id="result"></div>
                    <div class="button-group">
                        <button class="close-button" onclick="clearResult()">Close</button>
                        <button class="go-back-button" onclick="goBack()">Go Back</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function findSpecialist() {
            const doctorType = document.getElementById('doctorType').value;
            const doctorRole = document.getElementById('doctorRole').value;

            fetch('find_specialist.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ doctorType, doctorRole }),
            })
            .then(response => response.json())
            .then(data => {
                const resultDiv = document.getElementById('result');
                if (data.success) {
                    resultDiv.innerHTML = `Specialist Name: ${data.specialistName}`;
                } else {
                    resultDiv.innerHTML = 'No specialist found for the selected type and role.';
                }
            });
        }

        function clearResult() {
            document.getElementById('result').innerHTML = '';
        }

        function goBack() {
            window.location.href = './card.php';
        }
    </script>
</body>
</html>
