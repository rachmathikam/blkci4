<input type="file" id="imageInput" accept="image/*">
<button id="submitBtn">Submit</button>
<div id="message"></div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  $('#submitBtn').on('click', function() {
    var fileInput = $('#imageInput');
    var file = fileInput[0].files[0];

    if (file) {
      var fileName = file.name;
      var fileExtension = fileName.split('.').pop().toLowerCase();

      var allowedExtensions = ['jpeg', 'jpg', 'png', 'gif'];
      if ($.inArray(fileExtension, allowedExtensions) === -1) {
        $('#message').text('Please select a valid image file (JPEG, JPG, PNG, or GIF).');
        fileInput.val(''); // Reset file input to clear invalid selection
      } else {
        $('#message').text('File is valid. You can proceed with the submission.');
        // Proceed with submission or other actions
      }
    } else {
      $('#message').text('Please select an image file.');
    }
  });
});
</script>
