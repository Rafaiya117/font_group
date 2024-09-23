$(document).ready(function() {
    $('#font-upload-form').on('submit', function(event) {
      event.preventDefault();
      $('#font-file').trigger('click'); 
    });
  
    $('#font-file').on('change', function(event) {
      var file = event.target.files[0];
      var fileExtension = file.name.split('.').pop().toLowerCase(); 
  
      if (file && fileExtension === 'ttf') { 
        var formData = new FormData();
        formData.append('font_file', file);
  
        $.ajax({
          type: 'POST',
          url: 'query/upload_font.php',
          data: formData,
          contentType: false,
          processData: false,
          success: function(fontName) { 
            if (fontName) {
              addFontRow(fontName);
            } else {
              alert('Error uploading font.');
            }
          },
          error: function(error) {
            console.error('Error:', error);
            alert('An error occurred during upload.');
          }
        });
      } else {
        alert('Please select a valid TTF font file.');
      }
    });
  
    // Function to add a new font row to the table
    function addFontRow(fontName) {
      var row = $('<tr></tr>');
      row.append('<td>' + fontName + '</td>');
      row.append('<td><p class="font-preview" style="font-family: \'' + fontName + '\'">The quick brown fox jumps over the lazy dog.</p></td>');
      row.append('<td><span class="delete-button" data-font-name="' + fontName + '">Delete</span></td>');
      $('#uploaded-fonts-table tbody').append(row);
      row.find('.delete-button').on('click', function() {
        deleteFont(fontName);
        row.remove();
      });
    }
// Function to delete a font
function deleteFont(fontName) {
    $.ajax({
      type: 'POST',
      url: 'query/delete_font.php',
      data: { fontName: fontName },
      success: function(data) {
        console.log('Font deleted successfully!');
        $('#font-file').val('');
      },
      error: function(error) {
        console.error('Error deleting font:', error);
      }
    });
    }

  // --- Font Group Section --- //
     $('#font-group-form-container').show();
    $.ajax({
      type: 'GET',
      url: 'js/dummy_font.json',
      dataType: 'json',
      success: function(data) {
        var selectElement = $('select[name="font[]"]');
        selectElement.empty().append('<option>Select font</option>');
        $.each(data.fontGroups, function(index, group) {
          $.each(group.fonts, function(index, font) {
            selectElement.append('<option value="' + font.fontFile + '">' + font.fontName + '</option>');
          });
        });
      }
    });
  });

  // --- Adding a new row for additional font groups --- //
  $('#font-group-form-container button:eq(1)').on('click', function(event) {
    event.preventDefault(); 
    var newRow = $('<div class="font-group-row"><div class="row col-md-12"><div class="col-md-6"><input name="fontname[]" class="form-control" id="fontname" placeholder="fontname" /></div><div class="col-md-6"><select name="font[]" class="form-control"><option>Select font</option></select></div></div></div>');
    $.ajax({
      type: 'GET',
      url: 'js/dummy_font.json',
      dataType: 'json',
      success: function(data) {
        $.each(data.fontGroups, function(index, group) {
          $.each(group.fonts, function(index, font) {
            newRow.find('select').append('<option value="' + font.fontFile + '">' + font.fontName + '</option>');
          });
        });
      }
    });
    $('#font-group-form-fields').append(newRow);
  });

  // --- Handle form submission to create the font group --- //
  $('#font-group-form-container button:eq(0)').on('click', function(event) {
    event.preventDefault();
    var formData = $('#font-group-form-container').serializeArray();
    $.ajax({
      type: 'POST',
      url: 'query/create_font_group.php',
      data: formData,
      success: function(data) {
        var newRow = $('<tr>');
        // newRow.append('<td>' + $('input[name="groupname"]').val() + '</td>');
        newRow.append('<td>' + $('input[name="fontname[]"]').val() + '</td>');
        newRow.append('<td>' + $('select[name="font[]"] :selected').map(function() {
          return $(this).val();
        }).get().join(', ') + '</td>');
        $('#font-group-table tbody').append(newRow);
        
        // Clear the form fields
        $('#font-group-form-container input').val('');
        $('#font-group-form-container select').val('');
        
        $('#font-group-form-container')[0].reset();
        
      },
      error: function(error) {
        console.error('Error saving font group:', error);
      }
    });
    
});
function loadFontGroups() {
  $.ajax({
      type: 'GET',
      url: 'query/get_data.php',  
      success: function(response) {
          $('#font-group-table tbody').html(response); 
          attachDeleteEditEvents();
      },
      error: function(error) {
          console.error('Error fetching font groups:', error);
      }
  });
}

loadFontGroups();

function attachDeleteEditEvents() {
  // Delete Font Group
  $('.delete-button').on('click', function() {
      var id = $(this).closest('tr').find('td:first').text(); 
      $.ajax({
          type: 'POST',
          url: 'query/delete_font_group.php',
          data: { id:id },
          success: function(response) {
              loadFontGroups();
          },
          error: function(error) {
              console.error('Error deleting font group:', error);
          }
      });
  });

  // Edit Font Group
  $('.edit-button').on('click', function() {
      var id = $(this).closest('tr').find('td:first').text();
      $.ajax({
          type: 'POST',
          url: 'query/get_font_group_details.php',
          data: { id: id },
          success: function(data) {
              // Populate the form with the fetched data
              $('#groupname').val(data.groupname);
              $('#fontname').val(data.fontname);
              $('select[name="font[]"]').val(data.font);
              
              $('#font-group-form-container').show();
          },
          error: function(error) {
              console.error('Error fetching font group details:', error);
          }
      });
  });

  $('.font-group-form-container-button0').on('click', function(event) {
      event.preventDefault();
      var formData = $('#font-group-form-container').serialize();

      $.ajax({
          type: 'POST',
          url: 'query/update_font_group.php',
          data: formData,
          success: function(response) {
              loadFontGroups();
          },
          error: function(error) {
              console.error('Error updating font group:', error);
          }
      });
  });
}

