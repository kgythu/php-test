	<table class="table table-striped table-hover table-bordered">
		<thead>
			<tr>
				<th><a href="?o=id">ID <span class="glyphicon glyphicon-chevron-up"></span></a>
					<a href="?o=id2"><span class="glyphicon glyphicon-chevron-down"></span></a></th>
				<th><a href="?o=name">Név <span class="glyphicon glyphicon-chevron-up"></span></a>
					<a href="?o=name2"><span class="glyphicon glyphicon-chevron-down"></span></a></th>
				<th><a href="?o=sex">Nem <span class="glyphicon glyphicon-chevron-up"></span></a>
					<a href="?o=sex2"><span class="glyphicon glyphicon-chevron-down"></span></a></th>
				<th><a href="?o=chip">Chip <span class="glyphicon glyphicon-chevron-up"></span></a>
					<a href="?o=chip2"><span class="glyphicon glyphicon-chevron-down"></span></a></th>
				<th><a href="?o=birth">Születési dátum <span class="glyphicon glyphicon-chevron-up"></span></a>
					<a href="?o=birth2"><span class="glyphicon glyphicon-chevron-down"></span></a></th>
				<th><a href="?o=neutered">Ívartalanítás <span class="glyphicon glyphicon-chevron-up"></span></a>
					<a href="?o=neutered2"><span class="glyphicon glyphicon-chevron-down"></span></a></th>
				<th class="text-right">Műveletek</th>
			</tr>
		</thead>
		<tfoot>
			<tr class="success">
				<td>Új beszúrás</td>
				<td><input class="form-control" name="cat_name" placeholder="Ide jön a dög neve" /></td>
				<td><select class="form-control" name="cat_sex">
					<option selected="selected" value="-1">Válassz!</option>
<?php
		$sql = 'SELECT * FROM cat_sexes;';
		$rs2 = $db->execute($sql);
		while($row2 = $rs2->fetchRow()) {
			echo "\t\t\t\t\t<option value=\"{$row2['cat_sex_id']}\">{$row2['cat_sex_name']}</option>\n";
		};
?>
				</select></td>
				<td><select class="form-control" name="cat_chip">
					<option selected="selected" value="-1">Válassz!</option>
<?php
		$yesno = array('nem', 'igen');
		foreach($yesno as $key => $value) {
			echo "\t\t\t\t\t<option";
			echo " value=\"$key\">$value</option>\n";
		};
?>
				</select></td>
				<td><input class="form-control" type="date" name="cat_birth" /></td>
				<td><select class="form-control" name="cat_neutered">
					<option selected="selected" value="-1">Válassz!</option>
<?php
		$yesno = array('nem', 'igen');
		foreach($yesno as $key => $value) {
			echo "\t\t\t\t\t<option";
			echo " value=\"$key\">$value</option>\n";
		};
?>				</select></td>
				<td class="text-right"><button class="btn btn-success btn-block" id="new_cat">
					Létrehozás <span class="glyphicon glyphicon-floppy-disk"></span>
				</button></td>
			</tr>
		</tfoot>
		<tbody id="cat_list">
<?php
	$order = isset($_GET['o']) ? $_GET['o'] : '';
	require_once('modules/catadmin.tbody.php');
?>
		</tbody>
	</table>
