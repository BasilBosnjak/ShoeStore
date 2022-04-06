var ItemService ={
openAddModal: function(){
    $("#addModal").modal("show");
},

  getUsers: function(){
    $.get("rest/users", function(data) {

      $("#todo-list").html("");

      var html = "";
      for(let i = 0; i < data.length; i++){
        html += `
        <div class="col-lg-4">
          <h2>`+ data[i].first_name +`</h2>
          <p>`+ data[i].last_name +`</p>
          <p>
            <button type="button" class="btn btn-primary edit-button" onclick="ItemService.showModal(`+data[i].id+`)" >
            Edit
            </button>
          </p>
          <p>
            <button type="button" class="btn btn-primary delete-button" onclick="ItemService.delete(`+data[i].id+`)" >
              Delete
            </button>
          </p>
        </div>`;
      }
      $("#todo-list").html(html);
      console.log(data);
    });
  },

update: function(){

  $('.save-todo-button').attr('disabled', true);
  var user = {};

  user.first_name = $('#first_name').val();
  user.last_name = $('#last_name').val();

  $.ajax({
    url: 'rest/users/'+$('#id').val(),
    type: 'PUT',
    data: JSON.stringify(user),
    contentType: "application/json",
    dataType: "json",
    success: function(result) {
        $("#editModal").modal("hide");
        $('.save-todo-button').attr('disabled', false);
        $("#todo-list").html('<div class="spinner-border" role="status"> <span class="sr-only"></span>  </div>');
        ItemService.getUsers(); // perf optimization
        console.log(result);
    }
  });

  console.log(shoes);
},

showModal: function(id){
  $('.todo-button').attr('disabled', true);
  $.get('rest/users/'+id, function(data){
    console.log(data);
    $("#first_name").val(data.first_name);
    $("#id").val(data.id);
    $("#last_name").val(data.last_name);
    $("#editModal").modal("show");
    $('.todo-button').attr('disabled', false);
  })
},

delete: function(id){
  $('.delete-button').attr('disabled', true);
      $.ajax({
        url: 'rest/user/'+id,
        type: 'DELETE',
        success: function(result) {
            $("#todo-list").html('<div class="spinner-border" role="status"> <span class="sr-only"></span>  </div>');
            ItemService.getUsers();
        }
      });

},
save: function(){
      $('#addUserForm').validate({
        submitHandler: function(form) {
          var user = Object.fromEntries((new FormData(form)).entries());
          ItemService.add(user);
        }
      });
      ItemService.getUsers();
    },

    add : function(user){
      $.ajax({
       url: 'rest/users',
       type: 'POST',
       data: JSON.stringify(user),
       contentType: "application/json",
       dataType: "json",
       success: function(result) {
           $("#todo-list").html('<div class="spinner-border" role="status"> <span class="sr-only"></span>  </div>');
           ItemService.getUsers(); // perf optimization
           $("#addModal").modal("hide");
       }
     });
    }


}
