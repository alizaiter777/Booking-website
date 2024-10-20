<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="navbar.css"> 

    <title>BMI Calculator</title>
    <?php


require("Config.php");
include ("authentication.php");

?>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    height: 100vh; /* Use full viewport height */
    background-image: url(https://images.askmen.com/news/sports/_1496763766.gif);
    background-repeat: no-repeat;
    background-size: cover; /* Ensure the image covers the entire screen */
    background-position: center;
}

.container {
    display: flex;
    flex: 1;
    align-items: center;
    justify-content: center;
    height: 100vh; /* Use full viewport height */
}

.left, .right {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.left {
    padding: 10px;
    border-radius: 8px;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
}

        .calculator input, .calculator select {
            display: block;
            width: calc(100% - 20px);
            padding: 0px;
            margin: 15px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 18px;
        }
        .calculator button {
            background: #007BFF;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 18px;
            width: 100%;
        }
        .calculator button:hover {
            background: #0056b3;
        }
        .result {
            text-align: center;
            font-size: 10px;
        }
        .gauge-container {
            position: relative;
            width: 400px;
            height: 100px;
            margin-top: 20px;
        }
        .gauge {
            width: 100%;
            height: 100%;
        }
        .needle {
            width: 4px;
            height: 80px;
            background: red;
            position: absolute;
            top: 10px;
            left: 50%;
            transform-origin: bottom center;
            transform: rotate(90deg);
        }
        . img {
            width: 800px;
            height: 800px;
            display: none;
        }
        .hidden {
            display: none;
        }

        .button {
            background-color: #4CAF50; /* Green background */
            border: none;
            color: white; /* White text */
            padding: 15px 32px; /* Padding */
            text-align: center; /* Centered text */
            text-decoration: none; /* Remove underline */
            font-size: 16px; /* Font size */
            margin: 4px 2px; /* Margin */
            cursor: pointer; /* Pointer cursor on hover */
            border-radius: 8px; /* Rounded corners */
            transition: background-color 0.3s ease; /* Smooth background color transition */
        }
        .obese{
            background-color: #f44336; /* Red background */
        }
        .overweight{
            background-color: orange;
        }
        
        
    </style>
</head>
<body>
<body>
    <div class="container left">

        <div class="calculator">
            <h1 style="color:white">BMI Calculator</h1>
            <form id="bmiForm">
                <label for="height" style="color:white">Height (cm):</label>
                <input type="number" id="height" name="height" required>

                <label for="weight" style="color:white">Weight (kg):</label>
                <input type="number" id="weight" name="weight" required>

                <label for="gender" style="color:white">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>

                <label for="age" style="color:white">Age:</label>
                <input type="number" id="age" name="age" required>

                <button type="button" onclick="calculateBMI()">Calculate</button>
            </form>
        </div>
    </div>  

    <div class="container right">
        <div class="result" style="color:white" id="result"></div>
        <div class="gauge-container">
            <svg class="gauge" viewBox="0 0 200 100">
                <path d="M 10 90 A 80 80 0 0 1 70 10" stroke="green" stroke-width="20" fill="none" />
                <path d="M 68 10 A 800 80 0 0 1 132 10" stroke="yellow" stroke-width="20" fill="none" />
                <path d="M 130 10 A 80 80 0 0 1 190 90" stroke="red" stroke-width="20" fill="none" />
            </svg>
            
            <div class="needle" id="needle"></div>
        </div>
    </br>
    </br>
    <a href="overweight.php" id="overweightButton" class="button hidden overweight">Overweight Advice</a>
    <a href="obese.php" id="obeseButton" class="button hidden obese">Obese Advice</a>
    </div>

    <script>

        function calculateBMI() {
            var height = document.getElementById('height').value;
            var weight = document.getElementById('weight').value;
            var age = document.getElementById('age').value;

            if (height > 0 && weight > 0 && age > 0) {
                var bmi = (weight / ((height / 100) ** 2)).toFixed(2);
                var result = document.getElementById('result');
                var needle = document.getElementById('needle');
                
                result.innerHTML = `<h2>Your BMI is ${bmi}</h2>`;
                var category = "";
                if (bmi < 18.5) {
                    category = "Underweight";
                } else if (bmi >= 18.5 && bmi < 24.9) {
                    category = "Normal weight";
                } else if (bmi >= 25 && bmi < 29.9) {
                    category = "Overweight";
                    document.getElementById('overweightButton').classList.remove('hidden');
                } else {
                    category = "Obese";
                    document.getElementById('obeseButton').classList.remove('hidden');
                }

                result.innerHTML += `<p>${category}</p>`;
                if (age >= 65) {
                    result.innerHTML += `<p>Note: For people aged 65 and older, BMI categories may differ. It's important to consider overall health and muscle mass.</p>`;
                } else if (age < 18) {
                    result.innerHTML += `<p>Note: For children and teenagers, BMI needs to be interpreted differently, using age and gender-specific percentiles.</p>`;
                }

                // Animate needle rotation
                // Calculate needle rotation
                var minAngle = -90;
                var maxAngle = 90;
                var minBMI = 10;
                var maxBMI = 40;
                var angle = ((bmi - minBMI) / (maxBMI - minBMI)) * (maxAngle - minAngle) + minAngle;
                needle.style.transform = `rotate(${angle}deg)`;
            } else {
                alert("Please enter valid height, weight, and age");
            }
        }
    </script>
</body>
</html>
