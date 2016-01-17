
<div class="wrap pt-stimm">
<h2>Seitengruppen</h2>
<h3>Eintrag bearbeiten</h3>

<form method="post">
<input name="pcamp_groups_name" placeholder="Name" value="<?php echo $data['name'];?>" />



  <input id="image-url" value="<?php echo $data['image'];?>" type="text" name="pcamp_groups_image" />
  <input id="upload-button" type="button" class="button" value="Bild auswählen" />
<input type="hidden" name="pcamp_groups_slug" value="<?php echo $data_slug; ?>">
<input type="hidden" name="pcamp-groups-action" value="entry-edit"><button type="submit">Eintrag ändern</button>
</form>


</div>
