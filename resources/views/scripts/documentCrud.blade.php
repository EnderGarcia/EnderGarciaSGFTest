<script type="text/javascript">
  var currentPageDocuments = 1;

  $('#addDocument').on('shown.bs.modal', function () {
    $('#document_name').trigger('focus');
  });

  $("#v-pills-CRUD2").on('click', '.page-link', function(event){
     event.preventDefault();
     var page = $(this).attr('href').split('page=')[1];
     currentPageDocuments = page;
     documentIndex();
  });

  function documentIndex()
  {
    $.ajax({
          type: "POST",
          url: '{{route('documents.list')}}',
          data: {
            page:currentPageDocuments,
          },
          headers: { "api-key-laika": apiKeyLaika },
          beforeSend: function(xhr){
            $("#loadingDocumentsTable").fadeIn(200);
            xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
          },
          success: function (response) {
            $('#documentTableContainer').html(response);
            // location.hash = page;
          },
          error: function (errors) {
            alert(errors['responseJSON'][0]);
          },
          complete: function () {
            $("#loadingDocumentsTable").fadeOut(200);
          },
      });
  }



  function addDocument()
  {
    var send = true;
    if (jqueryValidation) {
      if (!$('#addDocumentForm').valid()) {
        send = false;
      }
    }
    if (send) {
      $.ajax({
            type: "POST",
            url: '{{route('documents.store')}}',
            data: {
              name: $("#addDocumentForm").find('#document_name').val(),
            },
            headers: { "api-key-laika": apiKeyLaika },
            beforeSend: function(xhr){
              $("#loadingAddDocument").fadeIn(200);
              $.each(['name'], function( index, errorMsg ) {
                var element = $("#document_"+index);
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
              $('#addDocument').modal('hide');
              documentIndex();
            },
            error: function (errors) {
              errorsBag = errors.responseJSON;
              if (errors.status == 400) {
                alert(errors['responseJSON'][0]);
              }
              $.each(errorsBag, function( index, errorMsg ) {
                var element = $("#document_"+index);
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
              $("#loadingAddDocument").fadeOut(200);
            },
        });
    }
  }

  $('#addDocumentForm').validate({
    onkeyup: false,
      rules: {
        document_name: {
          required: true,
          minlength:3,
          maxlength:100
        },
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

  function editDocument(info)
  {
    info = jQuery.parseJSON(info);
    $("#edit_document_name").val(info['name']);
    $('#updateDocumentButton').attr('data-id', info['id']);
    $('#editDocument').modal('show');
  }

  $('#editDocumentForm').validate({
    onkeyup: false,
      rules: {
        edit_document_name: {
          required: true,
          minlength:3,
          maxlength:100
        },
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

  function updateDocument(elem)
  {
    var documentId = $(elem).attr('data-id');
    var send = true;
    if (jqueryValidation) {
      if (!$('#editDocumentForm').valid()) {
        send = false;
      }
    }
    if (send) {
      $.ajax({
            type: "POST",
            url: '{{route('documents.update')}}'+'/'+documentId,
            data: {
              name: $("#editDocumentForm").find('#edit_document_name').val(),
            },
            headers: { "api-key-laika": apiKeyLaika },
            beforeSend: function(xhr){
              $("#loadingeditDocument").fadeIn(200);
              $.each(['name'], function( index, errorMsg ) {
                var element = $("#edit_document_"+index);
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
              $('#editDocument').modal('hide');
              documentIndex();
            },
            error: function (errors) {
              errorsBag = errors.responseJSON;
              if (errors.status == 400) {
                alert(errors['responseJSON'][0]);
              }
              $.each(errorsBag, function( index, errorMsg ) {
                var element = $("#edit_document_"+index);
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
              $("#loadingeditDocument").fadeOut(200);
            },
        });
    }
  }

  function deleteDocument(info)
  {
    info = jQuery.parseJSON(info);
    $("#delete_document_name").text(info['name']);
    $('#deleteDocumentButton').attr('data-id', info['id']);
    $('#deleteDocument').modal('show');
  }

  function destroyDocument(elem)
  {
    var documentId = $(elem).attr('data-id');
    $.ajax({
          type: "DELETE",
          url: '{{route('documents.destroy')}}'+'/'+documentId,
          headers: { "api-key-laika": apiKeyLaika },
          beforeSend: function(xhr){
            $("#loadingDeleteDocument").fadeIn(200);
            xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
          },
          success: function (response) {
            $('#deleteDocument').modal('hide');
            documentIndex();
          },
          error: function (errors) {
            alert(errors['responseJSON'][0]);
          },
          complete: function () {
            $("#loadingDeleteDocument").fadeOut(200);
          },
      });
  }
</script>
