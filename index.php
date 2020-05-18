<?php
include 'Class/Dbh.php';
include 'Class/Tasks.php';
$obj = new Tasks();
    // echo $obj->items();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assests/css/bootstrap.css">

    <link rel="stylesheet" href="css/styles.css">
    <title>Simple todolist</title>
</head>

<body>


<div class="main-section">
       <div class="add-section">
        <h1 class="todos">todos</h1>
        <!-- <input id="toggle-all" type="checkbox"> -->
            <form id="form-a" action="set.php" method="POST" autocomplete="off" required>
                <?php if(isset($_GET['mess']) && $_GET['mess'] == 'error') {?>
                    <input type="text" name="name" style="border-color: #ff6666" placeholder="This field is required" />

                <?php } else {?>
                <input id="text-added" type="text" 
                        name="name" 
                        placeholder="What needs to be done?" autofocus/>
                <?php }?>
            </form>
        </div>

       <?php 
            $todos = $obj->getAllTasks();
            
       ?>

       <div class="show-todo-section">
            <?php foreach($todos as $todo) { ?>
                <div class="todo-item">
                    <span id="<?php echo $todo['id']; ?>"
                          class="remove-to-do">X</span>
                    <?php if($todo['checked']){ ?> 
                        <input type="checkbox"
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
            <div> <p id="mess"></p> </div>
            <p id="arr-id"></p>
                    <div class="yose">
                        <a id="ind" href="index.php" class="btn btn-light">All</a>

                        <a href="active.php" class="btn btn-light">Active</a>

                        <a href="complete.php" class="btn btn-light">Completed</a>
                        <a id="btn-comp" href="clearcompleted.php" class="btn btn-light">Clear completed</a>
                    </div>
                    <!-- <form action="remove.php" method="post">
                        <button id="btn-comp">Clear completed</button>
                    </form> -->

        </div>
    </div>

    <script src="js/jquery-3.2.1.min.js"></script>

    <script>
            if(!$(".todo-item").text()) {
                $('#mess').hide();
                // $("#btn-comp").hide();
                // $("#ind").show();
            }
            else {
                $("mess").show();
            }
            if($(".check-box").is(':checked')) {
                $.post('newCheck.php', (data) => {
                    if(data != 'error') {
                        if(data > 1) { $("#mess").text(data + " items left");}
                        else { $("#mess").text(data + " item left"); }
                    }
                });
            }        

        
        // $(".todo-item").hide();
        // $("#btn-group-show").hide();
        $(document).ready(function(){
            
     
            
            $("#btn-comp").click(function() {
                // alert(checkedValue);
                // $.post("clearCompleted.php", {'data[]': checkedValue}, (data) => {
                //     alert(data);
                // });
            });


            if(!$(".todo-item").text()) {
                $('.yose').hide();
                // $("#btn-comp").hide();
                // $("#ind").show();
            }
            else {
                $(".yose").show();
                // $("#ind").hide();
            }
            // $("#btn-comp").show();
            // $("#btn-comp").click(function() {
            //     $.post()
            // });
            // $("#btn-group-show").keyup(function() {
            //     $("#btn-group-show").show();
            // });
            $('.remove-to-do').click(function(){
                const id = $(this).attr('id');
                $.post("remove.php", 
                      {
                          id: id
                      },
                      (data)  => {
                         if(data){
                            $(this).parent().hide();
                            if(data[1] > 1) {
                                $("#mess").text(data[1] + " items left");
                            }
                            else {
                                $("#mess").text(data[1] + " item left");
                            }
                         }
                      }
                );
            });
            if(!$(".check-box").is(':checked')) {
                $.post('newCheck.php', (data) => {
                    if(data != 'error') {
                        if(data > 1) { $("#mess").text(data + " items left");}
                        else { $("#mess").text(data + " item left"); }
                    }
                });
            }
            // else($(".check-box").is(':checked')) {
            //     $.post('newCheck.php', (data) => {
            //         if(data != 'error') {
            //             if(data > 1) { $("#mess").text(data) + " items left");}
            //             else { $("#mess").text(data + " item left"); }
            //         }
            //     });
            // }


                $(".check-box").click(function(e) {
      
                    // window.location.href = "index.php";
                const id = $(this).attr('data-todo-id');
                
                if($(".check-box").is(':checked')){
                    $("#btn-comp").show();
                }
                else{
                    $("#btn-comp").hide();
                }
                
                // alert(id);
                $.post('check.php', 
                      {
                          id: id
                      },
                      (data) => {
                        //   $.get('newCheck.php', id: id,
                        //         function(data) {
                        //             alert(data);
                        //         }
                        //     );
                        // alert(data);
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
                      }
                );
                
                
            });
             
            // $(".check-box").click(function(e){
                
            //     // if($(".check-box").is(':checked'))
            //     //     $("#btn-comp").show();
            //     // else
            //     //     $("#btn-comp").hide();
            //     const id = $(this).attr('data-todo-id');

            //     // $.get("newCheck.php", {id:id}, function(data, status) {
            //     //     $("mess").text(data[0]);
            //     // });
            //     $.post('newCheck.php', 
            //           {
            //               id: id
            //           },
            //           (data) => {
            //             //   $.get('newCheck.php', id: id,
            //             //         function(data) {
            //             //             alert(data);
            //             //         }
            //             //     );

            //                   $("#mess").text(data);
            //               }

            //     );
            // });            

            // $("h2").click(function() {
            //     var id = $(this).attr('need');
            //     alert(id);
            // });
            
            var id1;
            var value;
            $(function () {
                
            $("h2").each(function () {
                // var id = document.getElementById("dawg");
                
                var label = $(this);
                
                
                label.after("<input type = 'text' style = 'display:none' />");
        
                
                var textbox = $(this).next();
        

                textbox[0].name = this.id.replace("lbl", "txt");
        
                
                textbox.val(label.html());
        
                
                label.dblclick(function () {
                    $(this)
                    $(this).next().show();
                });

                textbox.focusout(function () {
                    $(this).hide();
                    $(this).prev().html($(this).val());
                    $(this).prev().show();
                });
                // textbox.keypress(function(event) {
                //     var keycode = (event.keyCode ? event.keyCode : event.which);
                    
                //     if(keycode == 13) {
                //         $(this).hide();
                //         $(this).prev().html($(this).val());
                //         $(this).prev().show();
                //     }

                // });
                

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
                        
                        // alert(value);
                        // alert(id1);
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
                
                // $.post('edit.php', 
                //           {
                //               id: id,
                //               task: value
                //           },
                //     );

            });
            $('h2').click(function() {
                id1 = $(this).attr('need');
                // $.post('edit.php', 
                //           {
                //               id: id1,
                //               task: value
                //           },
                //     );
            });

            // $('h2').click(function() {

            //     alert(value);
            // });
            
        });
    });

    </script>

</body>
</html>
