<!DOCTYPE html>
<html>
<head>
    <title>Display Old Value for File Input</title>
</head>
<body>
    <label for="file-input">Select a file:</label>
    <input type="file" id="file-input" />
    <p id="selected-file-name">No file selected</p>
    <button id="reset-btn">Reset</button>
    <script src="your-javascript-file.js"></script>
</body>
</html>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const fileInput = document.getElementById("file-input");
    const selectedFileNameElement = document.getElementById("selected-file-name");
    const resetBtn = document.getElementById("reset-btn");

    // Add an event listener to the file input element
    fileInput.addEventListener("change", function (event) {
        const file = event.target.files[0];
        if (file) {
            selectedFileNameElement.textContent = file.name;
        } else {
            selectedFileNameElement.textContent = "No file selected";
        }
    });

    // Add an event listener to the reset button
    resetBtn.addEventListener("click", function () {
        // Clear the file input value
        fileInput.value = "";
        selectedFileNameElement.textContent = "No file selected";
    });
});

</script>