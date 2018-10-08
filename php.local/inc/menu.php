<nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="150">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>                        
			</button>
			<a class="navbar-brand" href="/"><?=SITE_NAME?></a>
		</div>
		<div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
<?php
	// navbar-right?
	$sql = "SELECT page_id, menupoint_name FROM menupoints ORDER BY menupoint_order;";
	$rs = $db->execute($sql);
	while($row = $rs->fetchRow()) {
		$menupoint_slug = $row['page_id'];
		$menupoint_name = $row['menupoint_name'];
		echo '					<li';
		if($page_id === $menupoint_slug)
			echo ' class="active"';
		echo "><a href=\"/$menupoint_slug\">$menupoint_name</a></li>\n";
	};
?>
				</ul>
				<form id="login" class="navbar-form navbar-right" action="" method="post">
<?php
if($logged) {
?>
					<div class="form-group loggedin-user">Belépett felhasználó:
						<strong><a href="/profil"><?=$user?></a></strong>
					</div>
					<input type="hidden" name="logout" value="true" />
<?php
} else {
?>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Felhasználói név" name="user" />
						<input type="password" class="form-control" placeholder="Jelszó" name="pass" />
					</div>
<?php
};
?>
					<button type="submit" class="btn btn-primary"><?php
						echo ($logged ?
							'Kilépés <span class="glyphicon glyphicon-log-out"></span>' :
							'Belépés <span class="glyphicon glyphicon-log-in"></span>');
					?></button>
				</form>
			</div>
		</div>
	</div>
</nav>
