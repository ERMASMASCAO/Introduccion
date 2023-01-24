//Immediately-Invoked Function Expression (IIFE)
(function(){
  const totalItems = $("#totalItems");
  const infoProduct = $("#infoProduct");
  $( "a.open-info-product" ).click(function(event) {
    event.preventDefault();
    const id = $( this ).attr('data-id');
    const href = `/api/show/${id}`;
    $.get( href, function(data) {
      $( infoProduct ).find( "#productName" ).text(data.name);
      $( infoProduct ).find( "#productPrice" ).text(data.price);
      $( infoProduct ).find( "#productImage" ).attr("src", "/img/" + data.photo);
      infoProduct.modal('show');
    })
  });
  $(".closeInfoProduct").click(function (e) {
    infoProduct.modal('hide');
  });

  const cartModal = $("#cart-modal");
 
  $( "a.open-cart-product" ).click(function(event) {
    event.preventDefault();
    const id = $( this ).attr('data-id');
    const href = `/cart/add/${id}`;
    $.get( href, function(data) {       
      $( cartModal ).find( ".name" ).text(data.name);
      $( cartModal ).find( "#quantity" ).val(data.quantity);
      $( cartModal ).find( ".img-thumbnail" ).attr("src", "/img/" + data.photo);
      totalItems.text(data.totalItems);
      cartModal.modal('show');
      const updateButton = cartModal.find("#data-container .update")
      updateButton.unbind();
      updateButton.click(function(event){
          event.preventDefault();
          var hrefUpdate = "/cart/update/" + id; 
          //Hacer un post a update con la cantidad introducida por el usuario
          hrefUpdate += "/" + $( cartModal ).find( "#quantity" ).val();
          $.post( hrefUpdate, {}, function(data) {
              totalItems.text(data.totalItems);
          });
      });
    })
  });
  $(".closeCart").click(function (e) {
    cartModal.modal('hide');
  });

  $( "a.remove-item" ).click(function(event) {
    event.preventDefault();
    const id = $( this ).attr('data-id');
    const href = `/cart/delete/${id}`;
    $.post( href, function(data) {
      totalItems.text(data.totalItems);
      $( "#totalCart" ).text(new Intl.NumberFormat('es-ES', { style: 'currency', currency: 'EUR' }).format(data.total));  
      //Ahora eliminanos el contenedor del producto
      $(`#item-${id}`).hide('slow', function(){ $(`#item-${id}`).remove(); });
    })
  });
  
})();