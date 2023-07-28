<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Authorization Header Generator Tool</title>
    <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre.min.css">
    <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre-exp.min.css">
    <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre-icons.min.css">
    <style>
        pre {
            font-size: 60%;
            word-break: break-all;
            white-space: pre-wrap;
        }

        input,
        textarea {
            width: 50%;
            font-size: 80%;
        }

        @media only screen and (max-width: 768px) {

            input,
            textarea {
                width: 80%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h4>Authorization Header Generator Tool</h4>
        <form id="mainForm" onsubmit="convertString(); return false">
            <label>Username = ServerKey:</label><br>
            <input onkeyup="concatString();" id="serverkey" type="text" value="SB-Mid-server-abc123cde456"><br><br>
            <label>Password (leave it empty):</label><br>
            <input onkeyup="concatString();" id="pass" type="text" disabled><br><br>
            <label>Appended String: ServerKey + ":"</label>
            <br>
            <textarea name="inputString" id="inputString" rows="2"></textarea>
            <br>
            <input class="btn btn-primary" type="submit" value="Generate Authorization">
        </form>

        <div>
            <br>
            <b>Authorization Header formula:</b>
            <br>
            <code>Authorization: Basic base64Encoded(ServerKey+":")</code>
            <br>
        </div>
        <br>
        <hr>

        <div>
            <br>
            <b>Authorization Header Result</b>
            <br><br>
            <textarea name="outputString" id="outputString" rows="4" disabled></textarea>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/gh/emn178/js-sha512/build/sha512.min.js"></script>
    <script>
        var concatString = function(evt) {
            document.querySelector('#inputString').value =
                document.querySelector('#serverkey').value +
                ":" +
                document.querySelector('#pass').value;
        }

        var convertString = function(evt) {
            var inputStr = document.querySelector('#inputString').value
            document.querySelector('#outputString').value = "Authorization: Basic " + btoa(inputStr);
            return false;
        }

        concatString();
        convertString();
    </script>
</body>

</html>
