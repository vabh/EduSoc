<html>
<style>
#yourBtn{
   position: relative;
   top: 150px;
   font-family: calibri;
   width: 150px;
   padding: 10px;
   -webkit-border-radius: 5px;
   -moz-border-radius: 5px;
   border: 1px dashed #BBB; 
   text-align: center;
   background-color: #DDD;
   cursor:pointer;
  }
</style>
<script type="text/javascript">
 function getFile(){
   document.getElementById("upfile").click();
 }
 function sub(obj){
    var file = obj.value;
    var fileName = file.split("\\");
    document.getElementById("yourBtn").innerHTML = fileName[fileName.length-1];
    document.forms[0].submit();
    event.preventDefault();
  }
</script>
<body>
<center>
<?php echo form_open_multipart();?>
<div id="yourBtn" onclick="getFile()">
    click to upload a file<br>
    
</div>
<div style='height: 0px; width: 0px;overflow:hidden;'>
    <input  name="video" type="file" id="upfile" onchange="sub(this)"/>
</div>

</form>
</center>
</body>
</html>