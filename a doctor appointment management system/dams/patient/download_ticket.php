<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Ticket</title> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .ticket-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 400px;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .ticket-details {
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .ticket-details p {
            margin: 5px 0;
            font-size: 14px;
            color: #555;
        }

        button {
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #218838;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>
<body>
    <div class="ticket-container">
        <h1>Appointment Ticket</h1>
        <div class="ticket-details">
            <p><strong>Patient Name:</strong> <span id="patientName">Samir Sharma</span></p>
            <p><strong>Doctor Name:</strong> <span id="doctorName">Dr. John Doe</span></p>
            <p><strong>Consultancy Fees:</strong> <span id="consultancyFees">1000</span></p>
            <p><strong>Appointment Date:</strong> <span id="appointmentDate">2024-10-15</span></p>
        </div>
        <button id="downloadBtn"><i class="fas fa-download"></i> Download Appointment Ticket</button>
    </div>

    <script>
        $(document).ready(function() {
            $('#downloadBtn').click(function() {
                generatePDF();
            });
        });

        function generatePDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            const appointmentDetails = {
                patientName: $('#patientName').text(),
                doctorName: $('#doctorName').text(),
                consultancyFees: $('#consultancyFees').text(),
                appointmentDate: $('#appointmentDate').text()
            };

            doc.setFontSize(16);
            doc.text('Appointment Ticket', 105, 20, null, null, 'center');
            doc.setFontSize(12);
            doc.text('Patient Name: ' + appointmentDetails.patientName, 10, 40);
            doc.text('Doctor Name: ' + appointmentDetails.doctorName, 10, 50);
            doc.text('Consultancy Fees: ' + appointmentDetails.consultancyFees, 10, 60);
            doc.text('Appointment Date: ' + appointmentDetails.appointmentDate, 10, 70);

            doc.save('appointment_ticket.pdf');
        }
    </script>
</body>
</html>
