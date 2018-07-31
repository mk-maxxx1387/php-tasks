<!DOCTYPE html>
<html>
<head>
    <title>SOAP and cURL</title>
    <script
src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/main.js"></script>
</head>
<body>
    <div>
        <h2><span>Enter a text for invert text casing</span></h2><br>
        <label for="text-casing-inp">Enter a text</label>
        <input type="text" id="text-casing-inp" name="text-casing-inp"><br>
        <br>
        <input type="button" id="soap-butt-1" value="Invert (SOAP)">
        <input type="button" id="curl-butt-1" value="Invert (cURL)">
        <div id="result-1"></div>
    </div>
    <div>
        <h2><span>Press the button to get list of currencies</span></h2><br>
        <input type="button" id="soap-butt-2" value="Get currencies (SOAP)">
        <input type="button" id="curl-butt-2" value="Get currencies (cURL)">
    </div>
     <div id="result-2"></div>
</body>
</html>

