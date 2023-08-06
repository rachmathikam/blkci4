<!DOCTYPE html>
<html>
<head>
  <title>Change TD Background Color After Update</title>
  <style>
    td {
      font-size: 16px;
      padding: 5px;
      border: 1px solid #ccc;
    }
    .active {
      background-color: green;
    }
    .inactive {
      background-color: red;
    }
  </style>
</head>
<body>
  <table>
    <tr>
      <td>
        <select class="mySelect">
          <option value="option1">Option 1</option>
          <option value="option2">Option 2</option>
          <option value="option3">Option 3</option>
        </select>
      </td>
      <td>
        <select class="mySelect">
          <option value="option1">Option 1</option>
          <option value="option2">Option 2</option>
          <option value="option3">Option 3</option>
        </select>
      </td>
      <td>
        <select class="mySelect">
          <option value="option1">Option 1</option>
          <option value="option2">Option 2</option>
          <option value="option3">Option 3</option>
        </select>
      </td>
    </tr>
  </table>

  <!-- Include jQuery library -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
  // Simulated data received from an AJAX response
  const responseData = [
    { id: 1, active: true },
    { id: 2, active: false },
    { id: 3, active: true }
  ];

  // Function to update the TD background color based on the selected option using AJAX
  function updateBackgroundColor(selectedOption, tdElement) {
    // Simulate AJAX request with a slight delay (remove setTimeout in the actual implementation)
    setTimeout(function() {
      const dataId = tdElement.data('id');
      const response = responseData.find(item => item.id === dataId);

      // Remove any previous classes
      tdElement.removeClass('active inactive');

      // Update the background color of the td element based on the response
      if (response && response.active) {
        tdElement.addClass('active');
      } else {
        tdElement.addClass('inactive');
      }
    }, 500); // Simulated delay of 500ms (remove this in the actual implementation)
  }

  // Initial update for each td based on the default selected option
  $('.mySelect').each(function() {
    const selectedOption = $(this).val();
    const tdElement = $(this).closest('td');
    updateBackgroundColor(selectedOption, tdElement);
  });

  // Listen for changes to the select elements
  $('.mySelect').on('change', function() {
    const selectedOption = $(this).val();
    const tdElement = $(this).closest('td');
    updateBackgroundColor(selectedOption, tdElement);
  });
});

  </script>
</body>
</html>
