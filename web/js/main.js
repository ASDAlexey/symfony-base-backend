$(document).ready(function () {
  $('.product-row .delete').click(function () {
    const url = $(this).data('url');
    $.ajax({
      url,
      type: 'POST',
    }).done((data) => {
      $(this).parents('.product-row').remove();
      if (!$('.product-row').length) {
        $('.products-table').append(`
           <tr class="product-row">
              <td colspan="6">Products no found</td>
           </tr>
        `);
      }
    }).fail(err => (console.error(err)));
  });

  // file
  function readFile() {
    const MIME_TYPES = ['image/jpeg', 'image/png'];
    if (this.files && this.files[0]) {
      const FR = new FileReader();

      FR.addEventListener("load", function (e) {
        const file = e.target.result;
        if (file.match(MIME_TYPES[0]) || file.match(MIME_TYPES[1])) {
          $('.wrap-file .form-group').removeClass('has-error');
          $('.wrap-file .help-block').remove();
          document.querySelector('.wrapper-image-block img').src = file;
        }
      });
      FR.readAsDataURL(this.files[0]);
    }
  }

  if ($('.wrap-file input').length) {
    document.querySelector('.wrap-file input').addEventListener("change", readFile);
  }
});
