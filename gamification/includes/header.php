<div class="navbar navbar-inverse set-radius-zero" >
        <div class="container">
            <div class="navbar-header">
                  <a href="index.php" > <img src="images/1.png" /> </a>

            </div>
<?php 
session_start();
include "conectare.php";

if($_SESSION['login']!=0)
{
?> 
            <div class="right-div">
			<?php 
				$user_id=$_SESSION['user_id'];
				$result = mysqli_query($conn, "SELECT * FROM users WHERE id='$user_id'");
				$row=mysqli_fetch_array($result);
				
				echo "Bine ai venit,  <strong>$row[name]!</strong>" ?>

            </div>
            <?php }?>
        </div>
    </div>
    <!-- LOGO HEADER END-->
<?php if($_SESSION['login']!=0)
{
?>    
<section class="menu-section">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                           <li> <a href="logout.php"  >LOG OUT <br></a> </li>
							
                        </ul>
						
						<ul id="menu-top" class="nav navbar-nav navbar-left">
                            <li><a href="index.php" class="menu-top-active">DASHBOARD</a></li>
							<li><a href="toatequesturile.php">Vezi quest-uri</a></li>
							<li><a href="adaugarequest.php" name="add_quest">Adaugare quest</a></li>
							<li><a href="clasament.php">Clasament</a></li>
							<li><a href="rewards.php">Rewards</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="my-profile.php">Profilul meu</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <?php } else { ?>
        <section class="menu-section">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">                        
                          
								<li><a href="adminlogin.php">Admin Login</a></li>              
                             <li><a href="index.php">User Login</a></li>
                          

                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <?php } ?>