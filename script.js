$(document).ready(function(){

  var data = "data_product.php";
  $('#data_product').load(data);

  function getAll()
  {
    $.ajax({
      url: 'data_product.php',
      data: 'action=show-all',
      cache: false,
      success: function(response){
        // jika berhasil 
        $("#data-product").html(response);
        
      }
    });     
}

    getAll();

  // ketika ada event change
  $("#kategori").change(function()
  {       
    var pil = $(this).find(":selected").val();
    var dataString = 'action='+ pil;
        
    $.ajax({
      url: 'data_product.php',
      data: dataString,
      cache: false,
      success: function(response){
        // jika berhasil 
        $("#data-product").html(response);
      } 
    });
})



  });