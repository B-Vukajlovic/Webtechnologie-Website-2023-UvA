$(document).ready(function() {
  sendFilterRequest();

  $('input[type="checkbox"]').change(function() {
    sendFilterRequest();
  });
});

// Sends a request to apply the new filter
function sendFilterRequest() {
  // Gets all selected ingredients
  var selectedIngredients = sessionStorage.getItem('selectedIngredients');
  // Gets all checked filters
  var checkedCheckboxes = $('input[type="checkbox"]:checked');
  var checkedValues = checkedCheckboxes.map(function() {
    return this.value;
  }).get();

  // Sends AJAX request to update recipes based on changed filters
  $.ajax({
    url: 'overview_include/process-filter-request.php',
    type: 'POST',
    data: { filtersApplied: checkedValues, selectedIngredients: selectedIngredients},
    success: function(response) {
      $('.recipes').html(response);
    },
    error: function(error) {
      console.error('Error:', error);
    }
  });
}
