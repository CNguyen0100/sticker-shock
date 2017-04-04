<!--
Graham L.:
I kind of want to rename "Shop" to "Browse" and have it link to the Item index 
page (which is currently a clone of the home page).
//-->
<nav class="navbar fixed-top navbar-toggleable-md navbar-inverse bg-inverse">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarExample" aria-controls="navbarExample" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="container">
        <a class="navbar-brand" href="/">STICKERSHOCK</a>
        <div class="collapse navbar-collapse" id="navbarExample">
        	
        	<?php
        		if (strpos ($_SERVER['REQUEST_URI'], 'sell'))
        			$page=1;
        		else if (strpos ($_SERVER['REQUEST_URI'], 'account'))
        			$page=2;
        		else if (strpos ($_SERVER['REQUEST_URI'], 'contact'))
        			$page=3;
        		else
        			$page=0;
        	?>
        	
            <ul class="navbar-nav ml-auto">
                <li class= "<?php if ($page==0) echo 'nav-item active'; else echo 'nav-item'?>" >
                    <a class="nav-link" href="/">Browse<span class="sr-only">(current)</span></a>
                </li>
                <li class= "<?php if ($page==1) echo 'nav-item active'; else echo 'nav-item'?>">
                    <a class="nav-link" href="/account/sell">Sell</a>
                </li>
                <li class= "<?php if ($page==2) echo 'nav-item active'; else echo 'nav-item'?>">
                    <a class="nav-link" href="/account">Account</a>
                </li>
                <li class= "<?php if ($page==3) echo 'nav-item active'; else echo 'nav-item'?>">
                    <a class="nav-link" href="/pages/contact">Contact Us</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

