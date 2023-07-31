$(document).ready(function() {
    // Function to toggle the selected content's visibility
    function toggleContent() {
      const selectedValue = $("#contentToggle").val();
      console.log(selectedValue);
  
      // Hide all content first
      $("#content1, #content2, #content3").hide();
      // Show the selected content based on the option value
      if (selectedValue === "hidden") {
        $("#content1").show();
      } else if (selectedValue === "visible") {
        $("#content2").show();
      } else if (selectedValue === "other") {
        $("#content3").show();
      }
    }
  
    // Function to store the selected value in local storage
    function storeValueInLocalStorage() {
      const selectedValue = $("#contentToggle").val();
      localStorage.setItem("selectedValue", selectedValue);
    }
  
    // Function to retrieve the selected value from local storage
    function retrieveValueFromLocalStorage() {
      const selectedValue = localStorage.getItem("selectedValue");
      if (selectedValue) {
        $("#contentToggle").val(selectedValue);
        toggleContent();
      } else {
        // If no previous value found, show the first content by default
        $("#content1").show();
      }
    }
  
    // Event listener for the select option change
    $("#contentToggle").on("change", function() {
      toggleContent();
      storeValueInLocalStorage();
    });
  
    // Retrieve the selected value from local storage when the page loads
    retrieveValueFromLocalStorage();
  });



  