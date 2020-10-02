<html>
<head>
	<title>[SPARSH]</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.11/css/mdb.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
  <link rel="icon" href="favico.png" type="image/gif" sizes="16x16">
</head>
<html></html>
<style>
body {
  background-image: url('4.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed;  
  background-size: cover;
}
  </style>
<body>
	<br>
		<div class="row col-md-12">
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
<div class="card col-sm-8">
  <h5 class="card-body h6">TEAM KSHJ CC CHECKER </h5>
  <h5 class="card-body h6">🏴‍☠️CCN CHECKER</h5>
  <div class="card-body">
    <center><span>[KSHJ]</span></center>
<div class="md-form">
	<div class="col-md-12">
  <textarea type="text" style="text-align: center;" id="lista" class="md-textarea form-control" rows="2"></textarea>
  <label for="lista">Drop CC Here</label>
</div>
</div>
<center>
 <button class="btn btn-primary" style="width: 200px; outline: none;" id="testar" onclick="enviar()" >Start</button>
  <button class="btn btn-danger" style="width: 200px; outline: none;">Stop</button>
</center>
</div>
            
</div>
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
<div class="card col-sm-2">
  <h5 class="card-body h6">Informations:</h5>
  <div class="card-body">
  	<span>Status:</span><span class="badge badge-secondary"> Waiting </span>
<div class="md-form">
	<span>
Approved:</span>&nbsp<span id="cLive" class="badge badge-success">0</span>
	<span>Declined:</span>&nbsp<span id="cDie" class="badge badge-danger"> 0</span>
	<span>Tested:</span>&nbsp<span id="total" class="badge badge-info">0</span>
	<span>Uploaded:</span>&nbsp<span id="Uploaded" class="badge badge-dark">0</span>
</div>
  </div>
</div>
</div>
<br>

<div class="col-md-12">
<div class="card">
<div style="position: absolute;
        top: 0;
        right: 0;">
	<button id="mostra" class="btn btn-primary">SHOW/HIDE</button>
</div>
  <div class="card-body">
    <h6 style="font-weight: bold;" class="card-title">Approved - <span  id="cLive2" class="badge badge-success">0</span></h6>
    <div id="bode"><span id=".approved" class="approved"></span>
</div>
  </div>
</div>
</div>

<br>
<br>
<br>
<div class="col-md-12">
<div class="card">
	<div style="position: absolute;
        top: 0;
        right: 0;">
	<button id="mostra2" class="btn btn-primary">SHOW/HIDE</button>
</div>
  <div class="card-body">
    <h6 style="font-weight: bold;" class="card-title">Declined - <span id="cDie2" class="badge badge-danger">0</span></h6>
    <div id="bode2"><span id=".declined" class="declined"></span>
    </div>
  </div>
</div>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js" type="text/javascript"></script>
<script type="text/javascript">

$(document).ready(function(){


    $("#bode").hide();
	$("#esconde").show();
	
	$('#mostra').click(function(){
	$("#bode").slideToggle();
	});

});

</script>

<script type="text/javascript">

$(document).ready(function(){


    $("#bode2").hide();
	$("#esconde2").show();
	
	$('#mostra2').click(function(){
	$("#bode2").slideToggle();
	});

});

</script>

<script title="ajax do checker">
    function enviar() {
        var linha = $("#lista").val();
        var linhaenviar = linha.split("\n");
        var total = linhaenviar.length;
        var ap = 0;
        var rp = 0;
        linhaenviar.forEach(function(value, index) {
            setTimeout(
                function() {
                    $.ajax({
                        url: 'api.php?lista=' + value,
                        type: 'GET',
                        async: true,
                        success: function(resultado) {
                            if (resultado.match("#Aprovada")) {
                                removelinha();
                                ap++;
                                approved(resultado + "");
                            }else {
                                removelinha();
                                rp++;
                                declined(resultado + "");
                            }
                            $('#carregadas').html(total);
                            var fila = parseInt(ap) + parseInt(rp);
                            $('#cLive').html(ap);
                            $('#cDie').html(rp);
                            $('#total').html(fila);
                            $('#cLive2').html(ap);
                            $('#cDie2').html(rp);
                        }
                    });
                }, 5000 * index);
        });
    }
    function approved(str) {
        $(".approved").append(str + "<br>");
    }
    function declined(str) {
        $(".declined").append(str + "<br>");
    }
    function removelinha() {
        var lines = $("#lista").val().split('\n');
        lines.splice(0, 1);
        $("#lista").val(lines.join("\n"));
    }
</script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.11/js/mdb.min.js"></script>
</body>
<br>
<footer >


    <div class="footer-copyright text-center py-3">
      <a href="https://t.me/team_kshj"> TEAM KSHJ</a>
	  <div class="footer-copyright text-center py-3">
       </div>


  </footer>

</html>