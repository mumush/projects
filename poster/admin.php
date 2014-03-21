<?php 

	$currentPage = "admin"; //set the current page

	require("assets/inc/lib.php");

	include ("assets/inc/header.php"); 

?>

		<div id="editDiv">

			<div class="catalogMark"><i class="fa fa-pencil-square-o"></i> Edit Item</div>

			<form id="editItemForm" name="editItemForm" action="#" method="post" enctype="multipart/form-data"> <!--IS NOT POSTING ANYWHERE YET!!!!!!!!-->

				<input name="editItemId" id="editItemId" type="hidden">
				<input type="text" name="itemName" placeholder="Your Poster Name Here" required>
				<textarea rows="3" name="itemDesc" placeholder="Short Description of Item" required></textarea>
				<input type="text" name="itemPrice" placeholder="Price of Item" required>
				<input type="number" name="itemQuant" placeholder="Number of Items Available" required>
				<input type="text" name="itemSalePrice" placeholder="Sale Price" required>
				<!-- <label for="itemImage"><i class="fa fa-upload"></i> Select Image<input type="file" name="itemImage" id="itemImage"></label> -->
				<input type="password" name="adminPass" placeholder="Admin Password" required>

				<button type="submit" id="updateItemButton"><i class="fa fa-check-circle"></i> Update Item</button>
				<button type="button" id="discardChanges"><i class="fa fa-trash-o"></i> Discard Changes</button>
				<button type="reset"><i class="fa fa-times-circle"></i> Clear Form</button>

			</form>

		</div>

		<div class="catalogMark"><i class="fa fa-plus-circle"></i> Add Item</div>

		<form id="addItemForm" name="addItemForm" action="#" method="post" enctype="multipart/form-data"> <!--IS NOT POSTING ANYWHERE YET!!!!!!!!-->

			<input type="text" name="itemName" placeholder="Your Poster Name Here" required>
			<textarea rows="3" name="itemDesc" placeholder="Short Description of Item" required></textarea>
			<input type="text" name="itemPrice" placeholder="Price of Item" required>
			<input type="number" name="itemQuant" placeholder="Number of Items Available" required>
			<input type="text" name="itemSalePrice" placeholder="Sale Price" required>
			<!-- <label for="itemImage"><i class="fa fa-upload"></i> Select Image<input type="file" name="itemImage" id="itemImage"></label> -->
			<input type="password" name="adminPass" placeholder="Admin Password" required>

			<button type="submit" id="addItemButton"><i class="fa fa-plus-circle"></i> Add Item</button>
			<button type="reset"><i class="fa fa-times-circle"></i> Clear Form</button>

		</form>


		<div class="catalogMark"><i class="fa fa-pencil-square-o"></i> All Items</div>

		<table id="editItemTable">

			<tr>
				<th>Name</th>
				<th>Description</th>
				<th>Action</th>
			</tr>

			<?php

			$allItems = getAllItems();

			foreach( $allItems as $item ) { 

				$itemDataString = 'data-id="' . $item['id'] . '"'; ?>

				<tr>
					<?php
						echo '<td>' . $item['name'] . '</td>';
						echo '<td>' . $item['desc'] . '</td>';
					?>
					<td><a href="#" class="editItemLink" <?php echo $itemDataString; ?>><i class="fa fa-pencil"></i> Edit</a></td>
				</tr>

			<?php

			}

			?>

		</table>

		

	<?php include("assets/inc/footer.php"); ?>
