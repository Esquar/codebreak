

jQuery.fn.ForceNumericOnly =
function(){
    return this.each(function(){

        $(this).keydown(function(e){
            var key = e.charCode || e.keyCode || 0;
            // allow backspace, tab, delete, arrows, numbers and keypad numbers ONLY
            // home, end, period, and numpad decimal
            return (
                key == 8 || 
                key == 9 ||
                key == 46 ||
                key == 110 ||
                key == 190 ||
                (key >= 35 && key <= 40) ||
                (key >= 48 && key <= 57) ||
                (key >= 96 && key <= 105));
        });
    });
};


$(".Number").ForceNumericOnly();

$(".Money").mask("999999999,99");

$(".Phone").mask("(999) 9999-9999");

$.datepicker.setDefaults({
   showOn: "both",
   buttonImageOnly: true,
   buttonImage: baseURL + "img/calendar.gif",
   buttonText: "Calendar",
   dateFormat: "dd/mm/yy"
});

$('.Date').datepicker();

$('.nav-tabs>li>a').click(
   function(){
      if(this.id != ''){
         var el = '#rel_' + this.id;
         var div = $(el);
         if(typeof div != 'undefined'){
            $('.nav-div').each(function(){ $(this).removeClass('active');});
            $(div).addClass('active');
         }

         $(this).parents('ul.nav').find('li.active').removeClass('active');
         $(this).parent().addClass('active');
      }
   });


$('.ForeingKey').change(function(){
   requestFK(this);
});



function duplica(el){

   var div = $(el).parent();
   var divtop = $(div).parent();

   $(div).clone().appendTo(divtop);
}

function removerArray(el){

   var div = $(el).parent();
   var divtop = $(div).parent();

   $(divtop).length
   if( $(divtop).children("div").length > 1){
      $(div).remove();
   }
}

function remover(el, fkey){

   var div = $(el).parent();
   var divtop = $(div).parent();
   
   $(div).remove();
   
   var html = $(divtop).html().replace(/ /g, '');

   html = html.replace(/\n|\r|\t/g, '');

   if(html == ''){
      $(divtop).html('<button class="btn btn-large btn-block" type="button" onclick="addAppend(this, \'' + fkey + '\')">Clique para adicionar</button>');
   }
}

function addAppend(el, fkey){
   var div = $(el).parent();

   var content = $('#' + fkey);

   $(div).html($(content).html());
}


function requestFK(el){

   //var fk = "http://localhost/CodeBreak/C/requestFKParcial";
   var fk = baseURL + 'controller/requestFKParcial';
console.log(fk);
   //fk = "http://www.codebreak.com.br/controller/requestFKParcial";
   
   /*
    * O que falta.
    * 
    * - Saber o campo de origem
    * - Os campos que compoe a fk para poder fazer a busca dos valores para o where
    * - O campo à atualizar
    * - O Id da FK
    * 
    * */
   
   var id = String(el.id);
   
   if(id.indexOf('[') > 0){
      id = id.replace('[]', '');
   }

   var retrievedObject = localStorage.getItem('FK_' + id);

   if(retrievedObject == null){
      
      return;
   }

   retrievedObject = JSON.parse(retrievedObject);
   var datain;
   var check = true;
   
   // localstorage retrievedObject, tem o conte�do de cada uma das fks que campo que disparou, aparece
   $.each(retrievedObject, function(index, value) {
      
      //obj � o localstorage da fk em si
      var obj = localStorage.getItem('FK_' + value);

      if(obj != null){
         
         obj = JSON.parse(obj);

         datain = {
                     schema: obj.Schema,
                     table: obj.Table,
                     ChaveEstrangeiraId: value,
                     Campo :[]
                   };

         // verifico se cada um dos campos pai, está preenchido.
         // se um dos valores n�o est�, nem farão o request
         $.each(obj.CampoPai, function(i, val) {

            var name= '#' + obj.Schema + '_' + obj.Table + '_' + val;

            var field = $(name);
            
            if(field.val() != ''){
               
               var a = '{"' + val + '": "' + field.val() + '"}';

               datain.Campo.push(JSON.parse(a));
            }else{
               // se tem um dos elementos que está vazio
               
               // sai apenas do each de campo pai

               check = false;

               //console.log('sai:', field);

               return;
            }
         });
         
         if(check == true){
            
            console.log(datain);

            var request = $.ajax({
               type: "POST",
               url: fk,
               dataType: "json",
               data: datain
               });

            request.done(function( msg ) {
               
               console.log(msg);
               
               //obj.CampoRes = nome do campo que receberá o submit
               var name= obj.Schema + '_' + obj.Table + '_' + obj.CampoRes;
               var field = $('select[name="' + name + '"]');

               if(typeof field.get(0) == 'undefined'){

                  field = $('select[name="' + name + '[]"]');
               }

               $.each(field, function(it, fld){

                  
                  $(fld).children('option').remove();
                  
                  $(fld).append($('<option>', {
                     value: '',
                     text: '* Selecione'
                  }));

                  $.each(msg.resolved, function (i, item) {
                     $(fld).append($('<option>', { 
                         value: item.Id,
                         text : item.Resolutor 
                     }));
                  });
               });

            });

            request.fail(function( jqXHR, textStatus ) {
               console.log( "Request failed: " + textStatus );
            });

         }else{
            // para a próxima iteração
            check = true;
         }

      }
   });

  

}
