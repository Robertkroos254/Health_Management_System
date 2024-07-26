document.addEventListener('DOMContentLoaded', function() {
    const loadContentDiv = document.querySelector('.load-content');
    const nbuLink = document.querySelector('a[href="antinato.html"]');

    nbuLink.addEventListener('click', function(e) {
        e.preventDefault();
        loadNBUContent();
    });

    function loadNBUContent() {
        const nbuContent = `
            <style>
                /* Sidebar and main content styles */
                body {
                    margin: 0;
                    padding: 0;
                    font-family: Arial, sans-serif;
                }
                #sidebar {
                    background-color: #f1f1f1;
                    width: 200px;
                    position: fixed;
                    top: 0;
                    bottom: 0;
                    left: 0;
                    overflow-y: auto;
                    padding: 20px;
                }
                #sidebar ul {
                    list-style-type: none;
                    padding: 0;
                }
                #sidebar ul header {
                    font-size: 30px;
                    margin-top: 35%;
                }
                #sidebar ul li {
                    margin-bottom: 10px;
                }
                #sidebar ul li a {
                    text-decoration: none;
                    color: #333;
                }
                #sidebar ul li a:hover {
                    text-decoration: underline;
                    color: coral;
                }
                #main-content {
                    margin-left: 250px;
                    padding: 20px;
                }
            </style>
            <div class="content">
                <div id="sidebar">
                    <ul>
                        <header>ANTI-NATAL WARD</header>
                        <li style="margin-left: 50px; margin-top: 50px;">
                            <a href="#" id="add-report-link">Add Report</a>
                        </li>
                        <li style="margin-left: 50px; margin-top: 60px;">
                            <a href="#" id="view-report-link">View Report</a>
                        </li>
                    </ul>
                </div>
                <div id="main-content">
                    <h1>ANTI-NATAL Dashboard</h1>
                    <p>Welcome to the ANTI-NATAL dashboard. Select an option from the sidebar.</p>
                </div>
            </div>
        `;

        loadContentDiv.innerHTML = nbuContent;

        // Add event listeners for the new links
        document.getElementById('add-report-link').addEventListener('click', function(e) {
            e.preventDefault();
            loadAddReportForm();
        });

        document.getElementById('view-report-link').addEventListener('click', function(e) {
            e.preventDefault();
            loadViewReportInput();
        });
    }

    function loadAddReportForm() {
        const formContent = `
        <style>
            body {
            font-family: Arial, sans-serif;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .form-container {
            width: 100%;
            max-width: 1200px; /* Adjusted max-width to fit within typical screen sizes */
            height: auto;
            padding: 10px; /* Reduced padding */
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
            overflow: auto;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
        }
        .header img {
            max-width: 80px; /* Adjust the size of the image as needed */
            height: auto;
        }
        .contact-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .summary-title {
            text-align: center;
            margin-bottom: 10px;
            margin-top: 0; /* Adjusted margin top to bring it closer to the header */
        }
        .summary-title hr {
            margin-top: 5px; /* Adjusted margin top for hr to align better */
        }
        .summary-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .column {
            width: 48%;
        }
        .form-group {
            margin-bottom: 5px; /* Reduced margin */
        }
        label {
            display: inline-block;
            width: 150px; /* Reduced label width */
            font-size: 14px;
        }
        input {
            width: calc(100% - 160px); /* Full width input minus label width */
            border: none;
            border-bottom: 1px solid #ccc; /* Bottom border only */
            padding: 3px 0; /* Adjusted padding for input */
            box-sizing: border-box; /* Box sizing includes padding */
            font-size: 14px;
        }
        .additional-info {
            width: 100%;
            margin-top: 10px;
            padding-top: 10px;
        }
        .additional-info .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 5px; /* Adjusting margin bottom for spacing */
        }
        .additional-info label {
            width: auto;
            margin-right: 5px;
        }
        .additional-info input {
            flex-grow: 1;
            border: none;
            border-bottom: 1px solid #ccc; /* Bottom border only */
            padding: 3px 0; /* Adjusted padding for input */
            box-sizing: border-box; /* Box sizing includes padding */
            font-size: 14px;
        }
        .totals {
            width: 100%;
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center; /* Aligning items vertically */
        }
        .totals .form-group {
            width: 30%;
            margin-bottom: 5px; /* Adjusting margin bottom for spacing */
        }
        .totals label {
            width: auto; /* Auto width for labels */
            margin-right: 5px; /* Adjusting margin right */
        }
        .totals input {
            width: 60px; /* Adjusted width for inputs */
            border: none;
            border-bottom: 1px solid #ccc; /* Bottom border only */
            padding: 3px 0; /* Adjusted padding for input */
            box-sizing: border-box; /* Box sizing includes padding */
            font-size: 14px;
        }
        .submit-container {
            width: 100%;
            text-align: center;
            margin-top: 10px; /* Reduced margin */
        }
        .submit-btn {
            background-color: #0056b3;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .submit-btn:hover {
            background-color: #003d82;
        }
            </style>
            <form class="form-container" id="report-form">
        <div class="header">
            <h1>Ministry of Health</h1>
            <img src="./photos/Court of arms.jpg" alt="Kenyan Court of Arms">
        </div>

        <div class="contact-info">
            <div>
                <p>Telephone: 0712168203</p>
                <p>Email: maraguahospital@gmail.com</p>
            </div>
            <div>
                <p>The Medical Superintendent</p>
                <p>Maragua Sub County Hospital</p>
                <p>P.O. Box 72, Maragua</p>
            </div>
        </div>

        <div class="summary-title">
            <h2>Summary Sheet (Report)</h2>
            <hr>
        </div>

        <div class="summary-content">
            <div class="column">
                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date">
                </div>
                <div class="form-group">
                    <label for="admissions">No. of Admissions:</label>
                    <input type="number" id="admissions" name="admissions">
                </div>
                <div class="form-group">
                    <label for="doctor">Dr. on Call:</label>
                    <input type="text" id="doctor" name="doctor">
                </div>
                <div class="form-group">
                    <label for="co">C.O. on duty:</label>
                    <input type="text" id="co" name="co">
                </div>
                <div class="form-group">
                    <label for="nursing_officer">Nursing officer on night duty:</label>
                    <input type="text" id="nursing_officer" name="nursing_officer">
                </div>
                <div class="form-group">
                    <label for="lab_technician">Lab technician on night duty:</label>
                    <input type="text" id="lab_technician" name="lab_technician">
                </div>
                <div class="form-group">
                    <label for="anesthetist">Anesthetist on duty:</label>
                    <input type="text" id="anesthetist" name="anesthetist">
                </div>
                <div class="form-group">
                    <label for="pharmacist">Pharmacist on duty:</label>
                    <input type="text" id="pharmacist" name="pharmacist">
                </div>
                <div class="form-group">
                    <label for="driver">Driver on duty:</label>
                    <input type="text" id="driver" name="driver">
                </div>
            </div>
            <div class="column">
                <div class="form-group">
                    <label for="time">Time:</label>
                    <input type="time" id="time" name="time">
                </div>
                <div class="form-group">
                    <label for="deaths">No. of Deaths:</label>
                    <input type="number" id="deaths" name="deaths">
                </div>
                <div class="form-group">
                    <label for="referrals">No. of Referrals:</label>
                    <input type="number" id="referrals" name="referrals">
                </div>
                <div class="form-group">
                    <label for="operations">No. of Operations:</label>
                    <input type="number" id="operations" name="operations">
                </div>
                <div class="form-group">
                    <label for="deliveries">No. of Deliveries:</label>
                    <input type="number" id="deliveries" name="deliveries">
                </div>
                <div class="form-group">
                    <label for="well_adults">No. of well adults:</label>
                    <input type="number" id="well_adults" name="well_adults">
                </div>
                <div class="form-group">
                    <label for="well_children">No. of well children/Babies:</label>
                    <input type="number" id="well_children" name="well_children">
                </div>
                <div class="form-group">
                    <label for="sick_children">No. of sick children:</label>
                    <input type="number" id="sick_children" name="sick_children">
                </div>
                <div class="form-group">
                    <label for="radiographer">Radiographer on duty:</label>
                    <input type="text" id="radiographer" name="radiographer">
                </div>
                <div class="form-group">
                    <label for="cashier">Cashier on duty:</label>
                    <input type="text" id="cashier" name="cashier">
                </div>
                <div class="form-group">
                    <label for="nhif_officer">N.H.I.F officer on duty:</label>
                    <input type="text" id="nhif_officer" name="nhif_officer">
                </div>
                <div class="form-group">
                    <label for="watchman">Watchman on duty:</label>
                    <input type="text" id="watchman" name="watchman">
                </div>
            </div>
        </div>

        <div class="additional-info">
            <h3>Additional Information:</h3>
            <div class="form-group">
                <label for="additional_1">1.</label>
                <input type="text" id="additional_1" name="additional_1">
            </div>
            <div class="form-group">
                <label for="additional_2">2.</label>
                <input type="text" id="additional_2" name="additional_2">
            </div>
            <div class="form-group">
                <label for="additional_3">3.</label>
                <input type="text" id="additional_3" name="additional_3">
            </div>
            <div class="form-group">
                <label for="additional_4">4.</label>
                <input type="text" id="additional_4" name="additional_4">
            </div>
        </div>
        <div class="totals">
            <div class="form-group">
                <label for="total_well">Total well people:</label>
                <input type="number" id="total_well" name="total_well">
            </div>
            <div class="form-group">
                <label for="total_patients">Total patients:</label>
                <input type="number" id="total_patients" name="total_patients">
            </div>
            <div class="form-group">
                <label for="grand_total">Grand total:</label>
                <input type="number" id="grand_total" name="grand_total">
            </div>
        </div>
        <div class="submit-container">
          <button type="submit" class="submit-btn">Submit</button>
        </div>
      </form>
        `;

        document.getElementById('main-content').innerHTML = formContent;

        const reportForm = document.getElementById('report-form');
        reportForm.addEventListener('submit', function(e) {
            e.preventDefault();
            submitForm();
        });
    }

    function submitForm() {
        const reportForm = document.getElementById('report-form');
        const formData = new FormData(reportForm);
        
        // Validation check
        const requiredFields = [
            'date', 'time', 'admissions', 'deaths', 'referrals', 'operations', 'deliveries', 
            'well_adults', 'well_children', 'sick_children', 'doctor', 'co', 'nursing_officer', 
            'lab_technician', 'anesthetist', 'pharmacist', 'driver', 'radiographer', 'cashier', 
            'nhif_officer', 'watchman', 'total_well', 'total_patients', 'grand_total'
        ];
        
        let isValid = true;
        for (let field of requiredFields) {
            if (!formData.get(field)) {
                isValid = false;
                alert(`Please fill out the ${field.replace(/_/g, ' ')} field.`);
                break;
            }
        }

        if (isValid) {
            fetch('report_antinato.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(result => {
                alert('Report submitted successfully!');
                window.location.href = 'home.html';
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while submitting the report.');
            });
        }
    }

    function loadViewReportInput() {
        const inputContent = `
            <style>
        .input-container {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }
        .input-container label {
            margin-right: 10px;
            font-size: 16px;
        }
        .input-container input {
            margin-top: 0;
            padding: 5px;
            font-size: 16px;
            margin-right: 10px;
        }
        .generate-btn {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .generate-btn:hover {
            background-color: #218838;
        }
        .data-container {
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-family: Arial, sans-serif;
        }
        table thead {
            background-color: #f2f2f2;
        }
        table th, table td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        table tr:hover {
            background-color: #f1f1f1;
        }
        table th {
            background-color: #4CAF50;
            color: white;
        }
        .print-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            display: none; /* Initially hidden */
        }
        .print-btn:hover {
            background-color: #0056b3;
        }
    </style>
    <div class="input-container">
        <label for="report-date">Select Date:</label>
        <input type="date" id="report-date" name="report-date">
        <button class="generate-btn" id="generate-report-btn">Generate Report</button>
    </div>
    <div class="data-container" id="data-container"></div>
    <button class="print-btn" id="print-btn">Print Report</button>
        `;

        document.getElementById('main-content').innerHTML = inputContent;

        document.getElementById('generate-report-btn').addEventListener('click', function() {
            const reportDate = document.getElementById('report-date').value;
            if (reportDate) {
                fetchReport(reportDate);
            } else {
                alert('Please select a date.');
            }
        });

        document.getElementById('print-btn').addEventListener('click', printReport);
    }

    function fetchReport(date) {
        fetch('fetch_antinato.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ date: date })
        })
        .then(response => response.json())
        .then(data => {
            displayReport(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function displayReport(data) {
        const dataContainer = document.getElementById('data-container');
        const printBtn = document.getElementById('print-btn');

        if (data.length === 0) {
            dataContainer.innerHTML = 'No data available for the selected date.';
            printBtn.style.display = 'none'; // Hide the print button
            return;
        }

        let tableHTML = '<table><thead><tr>';
        Object.keys(data[0]).forEach(key => {
            tableHTML += `<th>${key}</th>`;
        });
        tableHTML += '</tr></thead><tbody>';

        data.forEach(row => {
            tableHTML += '<tr>';
            Object.values(row).forEach(value => {
                tableHTML += `<td>${value}</td>`;
            });
            tableHTML += '</tr>';
        });

        tableHTML += '</tbody></table>';
        dataContainer.innerHTML = tableHTML;
        printBtn.style.display = 'block'; // Show the print button
    }

    function printReport() {
        const printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write('<html><head><title>ANTI-NATAL REPORT</title>');
        printWindow.document.write('<style>table { width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; }');
        printWindow.document.write('table thead { background-color: #f2f2f2; }');
        printWindow.document.write('table th, table td { border: 1px solid #dddddd; text-align: left; padding: 8px; }');
        printWindow.document.write('table tr:nth-child(even) { background-color: #f9f9f9; }');
        printWindow.document.write('table tr:hover { background-color: #f1f1f1; }');
        printWindow.document.write('table th { background-color: #4CAF50; color: white; }</style></head><body>');
        printWindow.document.write(document.querySelector('.data-container').innerHTML);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
    }
});