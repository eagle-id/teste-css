// $('#delete-modal').on('show.bs.modal', function (event) {
  // var button = $(event.relatedTarget);
  // var id = button.data('customer');
  
  // var modal = $(this);
  // modal.find('.modal-title').text('Excluir Cliente #' + id);
  // modal.find('#confirm').attr('href', 'delete.php?id=' + id);
// })
$('.delete-this').click(function(){
    var id = $(this).data('customer');
    var r = confirm("Tem certeza que deseja excluir o item #"+id+"?");
    if (r == true) {
        window.location.href = '/customers/delete.php?id=' + id;           
    } 
});
