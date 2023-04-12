<?php
include "conectare.php";
session_start();
error_reporting(0);
if(isset($_POST['change']))
{
    $password=($_POST['password']);
    $newpassword=($_POST['newpassword']);
    $user_id=$_SESSION['user_id'];
    $result1=mysqli_query($conn,"select * from users where id='$user_id' and password='$password'");
    $rowq=mysqli_fetch_array($result1);
    $nr11=mysqli_num_rows($result1);
    echo $nr11;
    if($nr11>0)
    {
        $a=mysqli_query($conn,"update users set password='$newpassword' where id='$user_id'");
        $msg="Parola a fost schimbata";
    }
    else 
    {
        if(empty($_POST['password']) || empty($_POST['newpassword']) || empty($_POST['confirmpassword'])) {
            $error="Toate câmpurile trebuie completate!";
        } else {
            $error="Ai introdus parola curenta gresit!";
        }  
    }
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>QuestQuest</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style1.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

<style>
    .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
</style>


</head>
<script type="text/javascript">
function valid()
{
if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
{
alert("Noua parola nu corespunde  !!");
document.chngpwd.confirmpassword.focus();
return false;
}
return true;
}
</script>

<body>
<?php include('includes/header.php');?>
<div class="content-wrapper">
<div class="container">
<div class="row pad-botm">
<div class="col-md-12">
<h4 class="header-line">Schimba parola</h4>
</div>
</div>
  <?php if($error){?><div class="errorWrap"><strong>EROARE</strong>:<?php echo htmlentities($error); ?> </div><?php } 
        else if($msg){?><div class="succWrap"><strong>SUCCES</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>                     
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" >
<div class="panel panel-info">
<div class="panel-heading">
Schimba parola
</div>
<div class="panel-body">
<form role="form" method="post" onSubmit="return valid();" name="chngpwd">

<div class="form-group">
<label>Parola curenta</label>
<input class="form-control" type="password" name="password" autocomplete="off" required  />
</div>

<div class="form-group">
<label>Noua parola</label>
<input class="form-control" type="password" name="newpassword" autocomplete="off" required  />
</div>

<div class="form-group">
<label>Confirma noua parola </label>
<input class="form-control"  type="password" name="confirmpassword" autocomplete="off" required  />
</div>

 <button type="submit" name="change" class="btn btn-info">Schimba </button> 
</form>
 </div>
</div>
</div>
</div>  
<?php include('includes/footer.php');?>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>