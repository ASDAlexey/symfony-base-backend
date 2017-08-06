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
    if (this.files && this.files[0]) {
      const FR = new FileReader();

      FR.addEventListener("load", function (e) {
        document.querySelector('.wrapper-image-block img').src = e.target.result;
      });
      FR.readAsDataURL(this.files[0]);
    }
  }

  document.querySelector('.wrap-file input').addEventListener("change", readFile);
});
