<!doctype HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css" /> 
    <script src="../../../assets/js/scripts.js">
    $("#myModal").modal('show')
    </script>
    <script src="../../../assets/js/jquery.js"></script>
</head>
<body>
   <div class="container">
       
       <a href="#unit" role="button" class="btn" data-toggle="modal">New Unit</a>
        
       
        <div id="unit" class="modal hide fade" tabindex="-1" role="dialog">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Modal header</h3>
            </div>
            <div class="modal-body">
                <p>One fine body…</p>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                <button class="btn btn-primary">Save changes</button>
            </div>
        </div>
       
       
       
    </div>
    
</body>
</html>