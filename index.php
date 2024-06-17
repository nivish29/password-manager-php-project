<?php
  include "middleware.php";
  include "displaypasswords.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <!-- Modal of Add New Password -->
  <div class="modal fade" id="addPassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Add New Password</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="p-4">
            <form id="addCredientials">
              <input type="text" name="description" id="addDescriptionInput" placeholder="Enter the Password Description or Details Here" class="form-control form-control-lg my-3">
              <input type="text" name="password" id="addPasswordInput" placeholder="Enter the Password" class="form-control form-control-lg my-3">
            </form>
          </div>
        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-primary" id="addCredientialsBtn">Add Password</button>
        </div>
      </div>
    </div>
  </div>

    <!-- Modal of Edit Password -->
    <div class="modal fade" id="updatePassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Password Credientials</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="p-4">
            <form id="updateCredientials">
              <input type="hidden" name="id" id="updateIdInput">
              <input type="text" name="description" id="updateDescriptionInput" placeholder="Enter the Password Description or Details Here" class="form-control form-control-lg my-3">
              <input type="text" name="password" id="updatePasswordInput" placeholder="Enter the Password" class="form-control form-control-lg my-3">
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="updateCredientialsBtn">Update Credientials</button>
        </div>
      </div>
    </div>
  </div>

  <div class="bg-white min-vh-100 ">
    <div class=" container d-flex justify-content-between align-items-center mt-3">
    <h1 class="fw-bold text-dark">
      Welcome to Your Dashboard
    </h1>
    <a href="logout.php" class="btn btn-danger ">
      Logout
    </a>
    </div>
    <div class="container mt-5">
      <div class="mb-5">
        <div class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPassword">+ Add New Password</div>
      </div>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>S No.</th>
              <th>Description</th>
              <th>Password</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $index=0;
            if($result->num_rows>0){
              while ($row=$result->fetch_assoc()){
            ?>
            <tr>
              <td><?=++$index?></td>
              <td><?=$row['description']?></td>
              <td><span class="me-3" id="pwd-<?=$row['id']?>"><?=base64_encode($row['password'])?></span><i class="bi bi-eye-fill text-primary" onclick="viewPassword(<?=$row['id']?>,'<?=$row['password']?>')" style="cursor: pointer;"></i></td>
              <td>
                <div class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updatePassword"><i class="bi bi-pencil-square"></i></div>
                <div class="btn btn-danger btn-sm delete-password" data-id="<?= $row['id'] ?>"><i class="bi bi-trash"></i></div>
              </td>
            </tr>

            <?php
            }}
            ?>
          </tbody>
</table>
      </div>
    </div>
  </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  function viewPassword(id, password) {
    $("#pwd-" + id).html(password)
  }
  $(document).ready(function() {
    // $('.edit-password').on('click', function() {
    //   var id = $(this).data('id');
    //   var description = $(this).data('description');
    //   var password = $(this).data('password');

    //   $('#updateIdInput').val(id);
    //   $('#updateDescriptionInput').val(description);
    //   $('#updatePasswordInput').val(password);
    // });
    $('#addCredientialsBtn').on('click', function() {
      var description = $('#addDescriptionInput').val();
      var password = $('#addPasswordInput').val();
      if (description == '' || password == '') {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "plz enter both description and password!",
        });
        return 0;
      }
      $.ajax({
        url: 'storepassword.php',
        type: 'POST',
        data: {
          description: description,
          password: password
        },
        success: function(response) {
          Swal.fire({
            position: "center",
            icon: "success",
            title: "Added Successfully",
            showConfirmButton: false,
            timer: 1500
          });
          setTimeout(() => {

            window.location.reload();
          }, 1500);
        },
        error: function(jqXHR, textStatus, errorThrown) {

          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!",
          });
        }
      });
    });

    // $('#updateCredientialsBtn').on('click', function() {
    //   var id = $('#updateIdInput').val();
    //   var description = $('#updateDescriptionInput').val();
    //   var password = $('#updatePasswordInput').val();

    //   if (description == '' || password == '') {
    //     Swal.fire({
    //       icon: "error",
    //       title: "Oops...",
    //       text: "Please enter both description and password!",
    //     });
    //     return;
    //   }

    //   $.ajax({
    //     url: 'updatepassword.php',
    //     type: 'POST',
    //     data: {
    //       id: id,
    //       description: description,
    //       password: password
    //     },
    //     success: function(response) {
    //       Swal.fire({
    //         position: "center",
    //         icon: "success",
    //         title: "Updated Successfully",
    //         showConfirmButton: false,
    //         timer: 1500
    //       });
    //       setTimeout(() => {
    //         window.location.reload();
    //       }, 1500);
    //     },
    //     error: function(jqXHR, textStatus, errorThrown) {
    //       Swal.fire({
    //         icon: "error",
    //         title: "Oops...",
    //         text: "Something went wrong!",
    //       });
    //     }
    //   });
    // });
    $('.delete-password').on('click', function() {
      var id = $(this).data('id');
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: 'deletepassword.php',
            type: 'GET',
            data: {
              id: id
            },
            success: function(response) {
              Swal.fire(
                'Deleted!',
                'Your password has been deleted.',
                'success'
              )
              setTimeout(() => {
                window.location.reload();
              }, 1500);
            },
            error: function(jqXHR, textStatus, errorThrown) {
              Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!",
              });
            }
          });
        }
      });
    });
  });
</script>

</html>