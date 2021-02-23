<?php
/**
 * tire-import-form.php
 *
 * @version 1.0
 * @date 6/15/17 8:10 AM
 * @package triangle
 */
?>

<form  method="post" enctype="multipart/form-data">
	<input type="hidden" name="new_import_submit" value="true" />
	<table class="form-table">

		<tr valign="top">
			<th scope="row">
				<label>Upload File</label>
			</th>
			<td>
				<input type='file' id='upload_new_form' name='upload_new_form'></input>
			</td>
		</tr>

	</table>

	<?php submit_button( 'Import Tires' ); ?>

</form>
