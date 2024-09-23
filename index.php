<?php
include('pages/header.php');
?>

<div id="font-upload-container">
    <form id="font-upload-form" onsubmit="return false;">
      <input type="file" id="font-file" name="font-file" accept=".ttf">
      <label for="font-file" style="padding-top: 62px;">
        <span class="upload-icon"></span>
        <span class="upload-text">Click to upload or drag and drop</span>
        <span class="upload-text">Only TTF File Allowed</span>
      </label>
    </form>
</div>

<h3 style="margin: 10px;">Our Font</h3>
<!-- Uploaded Fonts Table -->
<table id="uploaded-fonts-table" class="table table-striped">
    <thead>
      <tr>
        <th>FONT NAME</th>
        <th>PREVIEW</th>
        <th>ACTION</th>
      </tr>
    </thead>
    <tbody></tbody>
</table>
<!-- <button id="create-font-group-btn">Create group</button> -->
<h3 style="margin: 10px;">Create a font group</h3>
<form method="POST" id="font-group-form-container">
    <div id="font-group-form-fields">
        <input name="groupname" id="groupname" class="form-control" placeholder="groupname"/><br><br>
        <div class="row col-md-12">
        <div class="col-md-6">
          <input name="fontname[]" id="fontname" class="form-control" placeholder="fontname" />
        </div>
        <div class="col-md-6">
        <select name="font[]" class="form-control">
            <option >Select font</option>
        </select>
        </div>
        </div>
    </div>
    <button class="font-group-form-container-button0">Create</button>
    <button class="font-group-form-container-button1">Add row</button>
</form>

<!-- ... -->
<h3 style="margin: 10px;">Our Font Groups</h3>
<table id="font-group-table" class="table table-striped">
  <thead>
    <tr>
      <th style="display:none;">Id</th>
      <th style="display:none;">Group Name</th>
      <th>Name</th>
      <th>Font Name</th>
      <th>Count</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody></tbody>
</table>
<!--------->


<?php
include('pages/footer.php');
?>
<!---style="display:none;"--->