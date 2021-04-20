<script type="text/javascript">
  var currentPageUsers = 1;

  $('#addUser').on('shown.bs.modal', function () {
    $('#user_name').trigger('focus');
  });

  $("#v-pills-CRUD1").on('click', '.page-link', function(event){
     event.preventDefault();
     var page = $(this).attr('href').split('page=')[1];
     currentPageUsers = page;
     userIndex();
  });

  function userIndex()
  {
    $.ajax({
          type: "POST",
          url: '{{route('users.list')}}',
          headers: { "api-key-laika": apiKeyLaika },
          data: {
            page:currentPageUsers,
          },
          beforeSend: function(xhr){
            $("#loadingUsersTable").fadeIn(200);
            xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
          },
          success: function (response) {
            $('#userTableContainer').html(response);
            // location.hash = page;
          },
          error: function (errors) {
            alert(errors['responseJSON'][0]);
          },
          complete: function () {
            $("#loadingUsersTable").fadeOut(200);
          },
      });
  }



  function addUser()
  {
    var send = true;
    if (jqueryValidation) {
      if (!$('#addUserForm').valid()) {
        send = false;
      }
    }
    if (send) {
      $.ajax({
            type: "POST",
            url: '{{route('users.store')}}',
            headers: { "api-key-laika": apiKeyLaika },
            data: {
              name: $("#addUserForm").find('#user_name').val(),
              email: $("#addUserForm").find('#user_email').val(),
              document_type_id: $("#addUserForm").find('#user_document_type_id').val(),
            },
            beforeSend: function(xhr){
              $("#loadingAddUser").fadeIn(200);
              $.each(['name','email','document_type_id'], function( index, errorMsg ) {
                var element = $("#user_"+index);
                element.removeClass("valid");
                if (!element.prev().hasClass("alert alert-danger m-0")) {
                    var itm = $("<div />").html('<strong>'+errorMsg+'</strong>').addClass("alert alert-danger m-0").hide();
                    itm.insertBefore(element).slideDown();
                }
                else {
                    if (element.prev().html() != '<strong>'+errorMsg+'</strong>') {
                      element.prev().fadeOut('fast', function() {
                        $(this).html('<strong>'+errorMsg+'</strong>').fadeIn('slow');
                        element.prev().html('<strong>'+errorMsg+'</strong>').slideDown();
                      });
                    }
                    else {
                      element.prev().html('<strong>'+errorMsg+'</strong>').slideDown();
                    }
                }
              });
              xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
            },
            success: function (response) {
              $('#addUser').modal('hide');
              userIndex();
            },
            error: function (errors) {
              errorsBag = errors.responseJSON;
              if (errors.status == 400) {
                alert(errors['responseJSON'][0]);
              }
              $.each(errorsBag, function( index, errorMsg ) {
                var element = $("#user_"+index);
                if (!element.prev().hasClass("alert alert-danger m-0")) {
                    var itm = $("<div />").html('<strong>'+errorMsg+'</strong>').addClass("alert alert-danger m-0").hide();
                    itm.insertBefore(element).slideDown();
                }
                else {
                    if (element.prev().html() != '<strong>'+errorMsg+'</strong>') {
                      element.prev().fadeOut('fast', function() {
                        $(this).html('<strong>'+errorMsg+'</strong>').fadeIn('slow');
                        element.prev().html('<strong>'+errorMsg+'</strong>').slideDown();
                      });
                    }
                    else {
                      element.prev().html('<strong>'+errorMsg+'</strong>').slideDown();
                    }
                }
              });
            },
            complete: function () {
              $("#loadingAddUser").fadeOut(200);
            },
        });
    }
  }

  $('#addUserForm').validate({
    onkeyup: false,
      rules: {
        user_name: {
          required: true,
          minlength:3,
          maxlength:100
        },
        user_email: {
          required: true,
          maxlength:100,
          email:true
        },
        user_document_type_id: {
          required: true,
          digits:true,
          min:1
        }
      },
      errorPlacement: function(error, element) {
        if (jqueryValidation) {
          if (!element.prev().hasClass("alert alert-danger m-0")) {
              var itm = $("<div />").html('<strong>'+error.html()+'</strong>').addClass("alert alert-danger m-0").hide();
              itm.insertBefore(element).slideDown();
          }
          else {
              if (element.prev().html() != '<strong>'+error.html()+'</strong>') {
                element.prev().fadeOut('fast', function() {
                  $(this).html('<strong>'+error.html()+'</strong>').fadeIn('slow');
                  element.prev().html('<strong>'+error.html()+'</strong>').slideDown();
                });
              }
              else {
                element.prev().html('<strong>'+error.html()+'</strong>').slideDown();
              }
          }
        }

      }
  });

  jQuery.extend(jQuery.validator.messages, {
    required: "Este campo es requerido.",
    email: "Este campo debe tener un correo electrónico válido.",
    digits: "Este campo permite únicamente dígitos.",
    minlength: jQuery.validator.format("Este campo debe tener al menos {0} caracteres en longitud."),
    min: jQuery.validator.format("Este campo es requerido."),
    maxlength: jQuery.validator.format("Este campo debe tener un máximo de {0} caracteres en longitud."),
  });

  var typingTimer;
  var doneTypingInterval = 3000;
  var $input = $('[class^=form-control]');
  $input.on('keyup', function () {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(doneTyping(this), doneTypingInterval);
  });
  $input.on('keydown', function () {
    clearTimeout(typingTimer);
  });
  function doneTyping (elem) {
      $('#'+elem.id).valid();
        if ((($('#'+elem.id).val() == '') || ($('#'+elem.id).val() == null)) || ($('#'+elem.id).valid() == false))  {
          $('#'+elem.id).removeClass('alert-success');
        }
        if ($('#'+elem.id).valid() == true) {
          $('#'+elem.id).addClass('alert-success');
        }
  }

  setInterval(function() {
    $('.valid').each(function(i, obj) {
      if ($(this).prev().hasClass("alert alert-danger m-0")) {
        $(this).prev().slideUp();
      }
    });
  },10000);

  function editUser(info)
  {
    info = jQuery.parseJSON(info);
    $("#edit_name").val(info['name']);
    $("#edit_email").val(info['email']);
    $("#edit_document_type_id").val(info['document_type_id']);
    $('#updateUserButton').attr('data-id', info['id']);
    $('#editUser').modal('show');
  }

  $('#editUserForm').validate({
    onkeyup: false,
      rules: {
        edit_name: {
          required: true,
          minlength:3,
          maxlength:100
        },
        edit_email: {
          required: true,
          maxlength:100,
          email:true
        },
        edit_document_type_id: {
          required: true,
          digits:true,
          min:1
        }
      },
      errorPlacement: function(error, element) {
        if (jqueryValidation) {
          if (!element.prev().hasClass("alert alert-danger m-0")) {
              var itm = $("<div />").html('<strong>'+error.html()+'</strong>').addClass("alert alert-danger m-0").hide();
              itm.insertBefore(element).slideDown();
          }
          else {
              if (element.prev().html() != '<strong>'+error.html()+'</strong>') {
                element.prev().fadeOut('fast', function() {
                  $(this).html('<strong>'+error.html()+'</strong>').fadeIn('slow');
                  element.prev().html('<strong>'+error.html()+'</strong>').slideDown();
                });
              }
              else {
                element.prev().html('<strong>'+error.html()+'</strong>').slideDown();
              }
          }
        }

      }
  });

  function updateUser(elem)
  {
    var userId = $(elem).attr('data-id');
    var send = true;
    if (jqueryValidation) {
      if (!$('#editUserForm').valid()) {
        send = false;
      }
    }
    if (send) {
      $.ajax({
            type: "POST",
            url: '{{route('users.update')}}'+'/'+userId,
            headers: { "api-key-laika": apiKeyLaika },
            data: {
              name: $("#editUserForm").find('#edit_name').val(),
              email: $("#editUserForm").find('#edit_email').val(),
              document_type_id: $("#editUserForm").find('#edit_document_type_id').val(),
            },
            beforeSend: function(xhr){
              $("#loadingEditUser").fadeIn(200);
              $.each(['name','email','document_type_id'], function( index, errorMsg ) {
                var element = $("#edit_"+index);
                element.removeClass("valid");
                if (!element.prev().hasClass("alert alert-danger m-0")) {
                    var itm = $("<div />").html('<strong>'+errorMsg+'</strong>').addClass("alert alert-danger m-0").hide();
                    itm.insertBefore(element).slideDown();
                }
                else {
                    if (element.prev().html() != '<strong>'+errorMsg+'</strong>') {
                      element.prev().fadeOut('fast', function() {
                        $(this).html('<strong>'+errorMsg+'</strong>').fadeIn('slow');
                        element.prev().html('<strong>'+errorMsg+'</strong>').slideDown();
                      });
                    }
                    else {
                      element.prev().html('<strong>'+errorMsg+'</strong>').slideDown();
                    }
                }
              });
              xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
            },
            success: function (response) {
              $('#editUser').modal('hide');
              userIndex();
            },
            error: function (errors) {
              errorsBag = errors.responseJSON;
              if (errors.status == 400) {
                alert(errors['responseJSON'][0]);
              }
              $.each(errorsBag, function( index, errorMsg ) {
                var element = $("#edit_"+index);
                if (!element.prev().hasClass("alert alert-danger m-0")) {
                    var itm = $("<div />").html('<strong>'+errorMsg+'</strong>').addClass("alert alert-danger m-0").hide();
                    itm.insertBefore(element).slideDown();
                }
                else {
                    if (element.prev().html() != '<strong>'+errorMsg+'</strong>') {
                      element.prev().fadeOut('fast', function() {
                        $(this).html('<strong>'+errorMsg+'</strong>').fadeIn('slow');
                        element.prev().html('<strong>'+errorMsg+'</strong>').slideDown();
                      });
                    }
                    else {
                      element.prev().html('<strong>'+errorMsg+'</strong>').slideDown();
                    }
                }
              });
            },
            complete: function () {
              $("#loadingEditUser").fadeOut(200);
            },
        });
    }
  }

  function deleteUser(info)
  {
    info = jQuery.parseJSON(info);
    $("#delete_user_name").text(info['name']);
    $("#delete_user_email").text(info['email']);
    $('#deleteUserButton').attr('data-id', info['id']);
    $('#deleteUser').modal('show');
  }

  function destroyUser(elem)
  {
    var userId = $(elem).attr('data-id');
    $.ajax({
          type: "DELETE",
          url: '{{route('users.destroy')}}'+'/'+userId,
          headers: { "api-key-laika": apiKeyLaika },
          beforeSend: function(xhr){
            $("#loadingDeleteUser").fadeIn(200);
            xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
          },
          success: function (response) {
            $('#deleteUser').modal('hide');
            userIndex();
          },
          error: function (errors) {
            alert(errors['responseJSON'][0]);
          },
          complete: function () {
            $("#loadingDeleteUser").fadeOut(200);
          },
      });
  }
</script>
