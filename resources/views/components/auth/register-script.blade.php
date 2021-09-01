@include('components.toast.script-generate')
@include('components.crud-form.basic-script-submit')

@push('footer-scripts')
<script>
    $(document).ready(function () {
      var inputFormId = '#registerForm';

      $(inputFormId).on('submit', function (event) {
        event.preventDefault();

        let url_action = '/register';
        let formData = new FormData(this);

        $.ajax({
          headers: {
            "X-CSRF-TOKEN": $(
              'meta[name="csrf-token"]'
            ).attr("content")
          },
          url: url_action,
          method: "POST",
          data: formData,
          cache:false,
          contentType: false,
          processData: false,
          beforeSend:function(){
            let l = $( '.ladda-button-submit' ).ladda();
            l.ladda( 'start' );
            $('[class^="invalid-feedback-"]').html('');
            $('#registerBtn').prop('disabled', true);
          },
          error: function(data){
            let errors = data.responseJSON.errors;
            if (errors) {
              $.each(errors, function (index, value) {
                $('div.invalid-feedback-'+index).html(value);
              })
            }
          },
          success: function (data) {
            if (data.status == 200) {
              window.location = "/login";
              setTimeout(function(){
                generateToast ('success', data.success);
              }, 2000);
            }
            else {
              swal.fire({
                titleText: "Action Failed",
                text: data.error,
                icon: "error",
              });
            }
          },
          complete: function () {
            let l = $( '.ladda-button-submit' ).ladda();
            l.ladda( 'stop' );
            $('#registerBtn'). prop('disabled', false);
          }
        });
        // $('#description').summernote('code', '');
      });

    });
</script>
@endpush
