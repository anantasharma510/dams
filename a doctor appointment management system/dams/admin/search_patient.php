<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Search</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        #suggestion-box {
            border: 1px solid #ccc;
            display: none;
            position: absolute;
            z-index: 1000;
            background: #fff;
            max-height: 200px;
            overflow-y: auto;
        }
        #suggestion-box div {
            padding: 10px;
            cursor: pointer;
        }
        #suggestion-box div:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <h1>Search Patient</h1>
    <input type="text" id="patient-search" placeholder="Search patient name...">
    <div id="suggestion-box"></div>

    <script>
        $(document).ready(function() {
            $("#patient-search").on("keyup", function() {
                let query = $(this).val();

                if (query.length > 0) {
                    $.ajax({
                        url: 'search_patient.php',
                        method: 'POST',
                        data: { query: query },
                        success: function(data) {
                            $("#suggestion-box").html(data).show();
                        }
                    });
                } else {
                    $("#suggestion-box").hide();
                }
            });

            // When clicking on a suggestion, fill the input field with the selected name
            $(document).on("click", "#suggestion-box div", function() {
                $("#patient-search").val($(this).text());
                $("#suggestion-box").hide();
            });
        });
    </script>
</body>
</html>
