<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style type="text/css" media="all">@import url(style/reset.css);@import url(style/generic.css);@import url(style/teste.css);</style>
        <script type="text/javascript" src="js/jquery.js"></script>
        
        <script type="text/javascript">
            $(document).ready(function(){      
                $('.nav li').hover(
                
                function(){
		    $('ul', this).fadeIn();
		},
		
		function(){
                    $('ul', this).fadeOut();
		}          
            );       
            });
            
        </script>
        <title></title>
    </head>
    <body>
        <div class="cssuser">
            <?php
            echo "<ul class=><li><a href='' class='link_font_user'>".$_SESSION['nome']."</a></li></ul>";
            ?>
        </div>
        
        
       
                  
</ul>

 
           
    </body>
</html>
