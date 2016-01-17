
<div class="wrap pt-stimm">
<h2>Seitengruppen</h2>
<h3>Neuer Eintrag</h3>

<form method="post">
<input name="pcamp_groups_name" placeholder="Name" />



  <input id="image-url" style="dsiplay:none;" type="text" name="pcamp_groups_image" />
  <input id="upload-button" type="button" class="button" value="Bild auswählen" />
<input type="hidden" name="pcamp-groups-action" value="entry-add"><button type="submit">Eintrag hinzufügen</button>
</form>

<h3>Einträge</h3>
<table border="1">
<?php	
if (is_array($options) && (count($options) > 0)) {
	foreach ($options as $slug => $c) {
		echo "<tr><td style=\"text-align:center;\"><img src=\"".$c['image']."\" height=\"150\"><br>";
		echo "<strong>".$c['name']."</strong>";
		echo "</td><td>";
		echo '<form method="post">';
		echo '<input type="hidden" name="pcamp_groups_slug" value="'.$slug.'">';
		echo '<button type="submit" name="pcamp-groups-action" value="del">Eintrag löschen</button><br>';
		echo '<button type="submit" name="pcamp-groups-action" value="showedit">Eintrag bearbeiten</button>';
		echo "</form>";
		echo "</td></tr>";
	}
}
?>
</table>
</div>
