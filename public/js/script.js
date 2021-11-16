  //autocomplete script
  $(document).on('focus','.autocomplete_txt',function(){
    
    type = $(this).data('type');
    
    if(type =='mata_kuliah' )autoType='mata_kuliah'; 
    
     $(this).autocomplete({
          
         source: function( request, response ) {
              $.ajax({
                  url: "/searchajax",
                  dataType: "json",
                  data: {
                      term : request.term,
                      type : type,
                      id_mata_kuliah : $('input#id_mata_kuliah').val()
                  },
                  success: function(data) {
                      var array = $.map(data, function (item) {
                         return {
                             label: item[autoType],
                             value: item[autoType],
                             data : item
                         }
                     });
                      response(array)
                  }
              });
         },
         select: function( event, ui ) {          
             var data = ui.item.data;           
             id_arr = $(this).attr('id');
             id = id_arr.split("_");
             elementId = id[id.length-1];
             $('#id_mata_kuliah_'+elementId).val(data.id_barang);
             $('#mata_kuliah_'+elementId).val(data.nama_barang);
             $('#sks_'+elementId).val(data.harga_pokok);
             $('#prodi_'+elementId).val(data.harga_jual);
          }       
    });
});
