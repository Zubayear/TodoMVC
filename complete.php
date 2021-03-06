<?php
require 'vendor/autoload.php';

    $obj = new Tasks();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assests/css/bootstrap.css">
    
    <link rel="stylesheet" href="css/styles.css">
    <title>Simple todolist</title>
        <script>
            document.getElementById('tasks')
        .addEventListener('keyup', function(event) {
            if (event.code === 'Enter') {
            event.preventDefault();
            document.querySelector('form').submit();
            }
        });
    </script>
</head>

<body>

<div class="main-section">
       <div class="add-section">
           <h1 class="todos">todos</h1>
          <form action="set.php" method="POST" autocomplete="off" required>
              <input type="text" 
                     name="name" 
                     placeholder="What needs to be done?" autofocus/>
          </form>
    </div>

       <?php 
          $todos = $obj->completed();
       ?>
       <div class="show-todo-section">
            <?php foreach($todos as $todo) { ?>
                <div class="todo-item">
                    <span id="<?php echo $todo['id']; ?>"
                          class="remove-to-do">X</span>
                    <?php if($todo['checked']){ ?> 
                        <input id="dawg" type="checkbox"
                               class="check-box"
                               data-todo-id ="<?php echo $todo['id']; ?>"
                               checked />
                        <h2 id="editable" need="<?php echo $todo['id']; ?>" class="checked"><?php echo $todo['task_name'] ?></h2>
                    <?php }else { ?>
                        <input type="checkbox"
                               data-todo-id ="<?php echo $todo['id']; ?>"
                               class="check-box" />
                        <h2 need="<?php echo $todo['id']; ?>" ><?php echo $todo['task_name'] ?></h2>
                    <?php } ?>
                    </div>
            <?php } ?>
            <div><p id="mess"></p></div>
                        
                    <a href="index.php" class="btn btn-light">All</a>

                    <a href="active.php" class="btn btn-light">Active</a>
                    
                    <a href="complete.php" class="btn btn-light">Completed</a>

                    <a id="btn-comp" href="index.php" class="btn btn-light">Clear completed</a>

       </div>
</div>

    <script src="js/jquery-3.2.1.min.js"></script>

    
    <script>
            // $("#btn-comp").show();
            if($(".check-box").is(':checked')) {
                $.post('newCheck.php', (data) => {
                    if(data != 'error') {
                        if(data > 1) { $("#mess").text(data + " items left");}
                        else { $("#mess").text(data + " item left"); }
                    }
                });
            }
            if(!$(".todo-item").text()) {
                $.post('newCheck.php', (data) => {
                    if(data != 'error') {
                        if(data > 1) { $("#mess").text(data + " items left");}
                        else { $("#mess").text(data + " item left"); }
                    }
                });        
            }              
            $(document).ready(function(){
            if(!$(".todo-item").text()) {
                $('#btn-comp').hide();
                // $("#btn-comp").hide();
                // $("#ind").show();
            }
            else {
                $(".yose").show();
                // $("#ind").hide();
            }                
            $('.remove-to-do').click(function(){

                const id = $(this).attr('id');
                $.post("remove.php", 
                      {
                          id: id
                      },
                      (data)  => {
                         if(data){
                            $(this).parent().hide();
                            $("#mess").text(data[1] + " items left");
                         }
                      }
                );
            });
            // if(!$(".check-box").is(':checked')) {
            //     $.post('newCheck.php', (data) => {
            //         if(data != 'error') {
            //             if(data > 1) { $("#mess").text(data + " items left");}
            //             else { $("#mess").text(data + " item left"); }
            //         }
            //     });
            // }
            // if($(".check-box").is(':checked')) {
            //     $.post('newCheck.php', (data) => {
            //         if(data != 'error') {
            //             if(data > 1) { $("#mess").text(data) + " items left");}
            //             else { $("#mess").text(data + " item left"); }
            //         }
            //     });
            // }
                     

            $(".check-box").click(function(e){

                if($(".check-box").is(':checked'))
                    $("#btn-comp").show();
                else
                    $("#btn-comp").hide();                
                const id = $(this).attr('data-todo-id');
                // alert(id);
                $.post('check.php', 
                      {
                          id: id,
                      },
                      (data) => {
                          if(data != 'error'){
                              const h2 = $(this).next();
                              if(data[0] === '1'){

                                  h2.removeClass('checked');
                                  if(data[1] > 1) {
                                    $("#mess").text(data[1] + " items left");
                                  }
                                  else {
                                      $("#mess").text(data[1] + " item left");
                                  }
                                  
                              }else {
                                  h2.addClass('checked');
                                  if(data[1] > 1) {
                                    $("#mess").text(data[1] + " items left");
                                  }
                                  else {
                                      $("#mess").text(data[1] + " item left");
                                  }                                  
                              }
                          }
                        // if(data != 'error') {
                        //     $("#mess").text(data); 
                        // }
                        
                      }
                );
            });
            // var ids = [];
            $("#btn-comp").click(function() {
                $.post("clearCompleted.php", (data) => {
                    if(data > 1) { $("#mess").text(data + " items left"); }
                    else { $("#mess").text(data + " item left"); }
                    // alert(data);
                });
            });                
            //     var ids = [];
            //     $.each($("input[type='checkbox']:checked"), function() {
            //         ids.push($(this).attr('data-todo-id'));
            //     });
            //     // .each()
            //     var result = ids.map(Number);
            //     alert(result);
            //     // alert(ids[0]);
            //     $("#btn-comp").click(function() {
            //         $.post("clearCompleted.php", {ids: result}, (data) => {
            //             alert(data);
            //             // if(data > 1) { $("#mess").text(data + " items left"); }
            //             // else { $("#mess").text(data + " item left"); }
            //         });
            //     });                
            // });

            var id1;
            var value;
            $(function () {
                
            $("h2").each(function () {
                var label = $(this);
                label.after("<input type = 'text' style = 'display:none' />");
                var textbox = $(this).next();
                textbox[0].name = this.id.replace("lbl", "txt");
                textbox.val(label.html());
                label.dblclick(function () {
                    $(this).hide();
                    $(this).next().show();
                });
                textbox.focusout(function () {
                    $(this).hide();
                    $(this).prev().html($(this).val());
                    $(this).prev().show();
                });
                textbox.blur(function() {
                    if ($.trim(this.value) == ''){
                        this.value = (this.defaultValue ? this.defaultValue : '');
                    }
                    else{
                        $(this).prev().prev().html(this.value);
                    }

                    $(this).hide();
                    $(this).prev().show();
                    $(this).prev().prev().show();
                });
                
                textbox.keypress(function(event) {
                    if (event.keyCode == '13') {
                        
                        if ($.trim(this.value) == ''){
                            this.value = (this.defaultValue ? this.defaultValue : '');
                        }
                        else
                        {
                            $(this).prev().prev().html(this.value);
                        }

                        $(this).hide();
                        $(this).prev().show();
                        $(this).prev().prev().show();
                        value = this.value;
                        $.post('edit.php', 
                          {
                              id: id1,
                              task: value
                          },
                    );
                        
                    }
                });                
            });

            $('h2').click(function(){
                
                $(this).hide();
                $(this).prev().hide();
                $(this).next().show();
                $(this).next().select();
            });
            $('h2').click(function() {
                id1 = $(this).attr('need');
            });
        });
    });
    </script>
</body>
</html>
