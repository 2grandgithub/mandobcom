
 var myChat = new Vue({
      el: '#myChat',
      data: {
          users: [],
          the_chat: [],
          inp_message: '',
          current_user_model: '',
          show_spinner:true,
          userType: user_type
      },
      mounted(){ console.log('mounted');
          this.getUser();
          this.getLatestChat();

          window.Echo.channel( 'the_chat')
                .listen('SendChatMessage' ,(e) => { console.log('listen'); console.log(e.chat);

                  if( this.userType == e.chat.type ) //if same type 
                  {
                    //--check if user exist in the chat list
                    var find_find_userId_in_users_list = false;
                    for(var key in this.users)
                    {
                        if (this.users[key].user_id == e.chat.user_id)
                          { find_userId_in_users_list = true; }
                    }
                    //--if new user in the chat---
                    if (find_userId_in_users_list == false)
                    {
                        this.getUser();
                        this.the_chat = [];
                        this.current_user_id = e.chat.user_id;
                    }
                    //----push chat to the exact chat---
                    if (e.chat.user_id == this.current_user_model.user_id )
                    {
                        myChat.the_chat.push(e.chat);
                        // $("#chat_container").scrollTop($("#chat_container")[0].scrollHeight);
                        console.log('down');
                        $("#chat_container").scrollTop($("#chat_container")[0].scrollHeight);
                        console.log('d down');
                        // this.scrollToEnd();
                    }
                      $("#chat_container").scrollTop($("#chat_container")[0].scrollHeight);
                      $('#sound')[0].play();
                  }//End if( this.userType == e.chat.type ) //if same type
            });

      },//End mounted
      methods:{
          getUser: function(){
              $.get(api_get_chat_users,function(response){
                  myChat.users = response;
                  myChat.current_user_model = response[0];
              });
          },
          getLatestChat: function(){
              this.the_chat = [];
              this.show_spinner = true;
              $.get(api_get_latest_chat+'/'+this.userType,function(response){
                  myChat.the_chat = response;
                  myChat.show_spinner = false;
                  $("#chat_container").scrollTop($("#chat_container")[0].scrollHeight);
              });
          },
          checkifAdmin: function(chat){
              return chat.admin_id;
          },
          choose_user:function(model){
              this.the_chat = [];
              this.show_spinner = true;
              $.get(api_get_chat+'/'+model.user_id+'/'+this.userType,function(response){
                  myChat.the_chat = response;
                  myChat.current_user_model = model;
                  myChat.echo_the_chat_id = 'the_chat.'+ myChat.current_user_id;
                  myChat.the_chat = response;
                  myChat.show_spinner = false;
                  myChat.inp_message = '';
              });
          },
          send: function(){
            // event.preventDefault();

                  let my_formData = new FormData();
                  my_formData.append('_token', token);
                  my_formData.append('message', this.inp_message);
                  my_formData.append('user_id', myChat.current_user_model.user_id);
                  my_formData.append('type', this.userType);
                  // Attach file
                  // my_formData.append('image', $('#inp_image')[0].files[0]);

                  $.ajax({
                      type:"post",
                      url:api_Chat,
                      data: my_formData,
                      processData: false,
                      contentType: false,
                      success : function(responce){
                         myChat.inp_message = '';
                         myChat.the_chat.push(responce.data);
                         $("#chat_container").scrollTop($("#chat_container")[0].scrollHeight);
                      },
                  });
          },
          get_down(){
              $("#chat_container").scrollTop($("#chat_container")[0].scrollHeight);
          },
          camera_click(){
            $('#inp_image').click();
          },
          go_submit(){
              $('#send_form').submit();
          },
          image_change(){
               this.send();
          },

      } //End methods
 });


 // $('#send_form').submit(function(event) { console.log('in');
 //
 //       // $.post(api_Chat, $('#send_form').serializeArray() , function(response) {
 //       //   console.log(response);
 //       // });
 //
 //        var formData = new FormData(this);
 //        $.ajax({
 //            type:'POST',
 //            url: api_Chat,
 //            data:formData,
 //            enctype: 'multipart/form-data',
 //            cache:false,
 //            contentType: false,
 //            processData: false,
 //            success:function(data){
 //                console.log("success");
 //                // console.log(data);
 //            },
 //            error: function(data){
 //                console.log("error");
 //                // console.log(data);
 //            }
 //        });
 //
 //
 // });
