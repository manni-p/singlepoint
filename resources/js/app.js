
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');

 window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 Vue.component(
  'passport-clients',
  require('./components/passport/Clients.vue')
  );

 Vue.component(
  'passport-authorized-clients',
  require('./components/passport/AuthorizedClients.vue')
  );

 Vue.component(
  'passport-personal-access-tokens',
  require('./components/passport/PersonalAccessTokens.vue')
  );

 axios.get('/oauth/clients')
 .then(response => {
  console.log(response.data);
});

 const app = new Vue({
  el: '#app'
});

    /// Toggle between active and non-active
    $(".toggle-master").on("click", function () {

      var getID = $(this).data('id');
      var model = $(this).data('model');
      var url = $(this).data('url');

      if ($(this).prop('checked')){
       var checked = 1;
     } else {
       var checked = null;
     }

     var post_url = url;

     $.post(post_url,{
       getID: getID,
       checked: checked,
       model: model
     }, function(data){

     });

   });

    //popup and change data for the delete button
    $(document).on("click", ".delete", function(){
      var id = $(this).data('id');
      var name = $(this).data('name');
      $("h4.modal-title").text("Delete "+name);
      $("button.btn-danger").attr('data-id', id);
    })

  //delete and send through on the page
  $(document).on("click", "#deleteModal button.btn-danger", function(){
    var delete_id = $(this).attr("data-id");
    var deleteLink = $(this).data('delete');
    var model = $(this).data('model');
    $.post(deleteLink,{
      deleteID: delete_id,
      model: model,
    }, function(data){
      $("tr[data-id='"+delete_id+"']").remove();
      $('#deleteModal').modal('toggle');
    });
  });
