<link href="<?= _admin_files_ ?>skin-lion/ui.easytree.css" rel="stylesheet" type="text/css" />
<?php
$id = 0;
$super_category_id = 0;
$name = $description = $cover_image = $cover_image_title = $cover_image_alt_title = $icon_image = $slug_url = $meta_title = $meta_keyword = $meta_description = "";
$is_display = 1;
$status = 1;
$record_action = "Add New Record";
$record_action_type = "new";
if (!empty($category_data)) {
	$record_action = "Update";
	$record_action_type = "update";
	$id = $category_data->id;
	$super_category_id = $category_data->super_category_id;
	$name = $category_data->name;
	$description = $category_data->description;
	$cover_image = $category_data->cover_image;
	$cover_image_title = $category_data->cover_image_title;
	$cover_image_alt_title = $category_data->cover_image_alt_title;
	$icon_image = $category_data->icon_image;
	$slug_url = $category_data->slug_url;
	$meta_title = $category_data->meta_title;
	$meta_keyword = $category_data->meta_keyword;
	$meta_description = $category_data->meta_description;
	$is_display = $category_data->is_display;
	$status = $category_data->status;

}
?>
<script src="https://cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<style type="text/css">
	.card {

		padding: 10px;

	}

	.input-group {

		position: relative;

		display: table;

		border-collapse: separate;

	}

	.icon_title_box {

		color: var(--primary);

		position: relative;

		display: inline-block;

	}

	.input-group-btn {

		position: relative;

		font-size: 0;

		white-space: nowrap;

	}

	.input-group .form-control:first-child,
	.input-group-addon:first-child,
	.input-group-btn:first-child>.btn,
	.input-group-btn:first-child>.btn-group>.btn,
	.input-group-btn:first-child>.dropdown-toggle,
	.input-group-btn:last-child>.btn-group:not(:last-child)>.btn,
	.input-group-btn:last-child>.btn:not(:last-child):not(.dropdown-toggle) {

		border-top-right-radius: 0;

		border-bottom-right-radius: 0;

	}

	input[type=file].form-control {

		height: auto !important;

	}

	.input-group .form-control,
	.input-group-addon,
	.input-group-btn {

		display: table-cell;

	}

	.input-group .form-control {

		position: relative;

		z-index: 2;

		float: left;

		width: 100%;

		margin-bottom: 0;

	}

	.form-control {

		border-radius: 0;

		box-shadow: none;

		border-color: #d2d6de;

	}

	.form-control {

		display: block;

		width: 100%;

		height: 34px !important;

		padding: 6px 12px !important;

		font-size: 14px !important;

		line-height: 1.42857143;

		color: #555;

		background-color: #fff;

		background-image: none;

		border: 1px solid #ccc;

		border-radius: 4px;

	}

	.form-horizontal .label-wrapper {

		display: table;

		float: right;

		min-height: 28px;

	}

	.input-group-addon,
	.input-group-btn {

		width: 1%;

		white-space: nowrap;

		vertical-align: middle;

	}

	textarea.form-control {

		height: auto !important;

	}

	ul.easytree-container li {

		list-style-image: none;

		list-style-position: outside;

		list-style-type: none;

		-moz-background-clip: border;

		-moz-background-inline-policy: continuous;

		-moz-background-origin: padding;

		background-attachment: scroll;

		background-color: transparent;

		background-position: 0 0;

		background-repeat: repeat-y;

		background-image: none;

		margin: 0;

		padding: 1px 0 0 0;

	}

	.icon_title_box {

		position: relative;

		display: inline-block;

	}
</style>
<!-- /.navbar -->

<!-- Main Sidebar Container -->


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark"><?php echo $page_module_name ?> </small></h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo MAINSITE_Admin . "wam" ?>">Home</a></li>
						<li class="breadcrumb-item"><a
								href="<?php echo MAINSITE_Admin . $user_access->class_name . "/" . $user_access->function_name ?>"><?php echo $user_access->name ?>
								List</a></li>
						<?php if (!empty($category_data)) { ?>
							<li class="breadcrumb-item"><a
									href="<?php echo MAINSITE_Admin . $user_access->class_name . "/view/" . $id ?>">View</a>
							</li>
						<?php } ?>
						<li class="breadcrumb-item"><?php echo $record_action ?></li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<?php ?>

	<section class="content">
		<div class="row">
			<div class="col-12">

				<div class="card">

					<div class="card-header">
						<h3 class="card-title"><?php echo $name ?> <small><?php echo $record_action ?></small></h3>
					</div>
					<!-- /.card-header -->
					<?php
					if ($user_access->view_module == 1 || true) {
						?>
						<?php echo $this->session->flashdata('alert_message'); ?>
						<div class="card-body">

							<?php echo form_open(MAINSITE_Admin . "$user_access->class_name/do_edit", array('method' => 'post', 'id' => 'ptype_list_form', "name" => "ptype_list_form", 'style' => '', 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data')); ?>

							<input type="hidden" name="id" id="id" value="<?php echo $id ?>" />
							<input type="hidden" name="redirect_type" id="redirect_type" value="" />
							<div class="row">

								<div class="col-lg-8 col-md-6 col-sm-6">


									<div class="form-group row">
										<div class="col-md-4 col-sm-6">
											<label for="name" class="col-sm-12 label_content px-2 py-0">Category Name<span
													style="color:#f00;font-size: 22px;margin-top: 3px;">*</span></label>
											<div class="col-sm-12">
												<input type="text" class="form-control form-control-sm" required id="name" name="name"
													value="<?= $name ?>" placeholder="Category Name">
											</div>
										</div>
										<div class="col-md-4 col-sm-6">
											<label for="inputEmail3" class="col-sm-12 label_content px-2 py-0">Cover Image <span
													style="color:#f00;font-size: 22px;margin-top: 3px;">*</span></label>
											<div class="col-sm-12 d-flex">
												<div class="input-group" style="width:90%">
													<div class="custom-file">
														<input type="file" name="cover_image" class="custom-file-input" <?= $record_action_type == "new" ? "required" : "" ?> id="cover_image" accept="image/*">
														<label class="custom-file-label form-control-sm" for="files"></label>
													</div>
												</div>
												<div class="custom-file-display custom-file-display1">
													<?php if (!empty($cover_image)) { ?>
														<span class="pip pip1">
															<a target="_blank"
																href="<?php echo _uploaded_files_ . 'category_cover_image/' . $cover_image ?>">
																<img class="imageThumb imageThumb1"
																	src="<?php echo _uploaded_files_ . 'category_cover_image/' . $cover_image ?>" />
															</a>
														</span>
													<?php } else { ?>
														<span class="pip pip1">
															<img class="imageThumb imageThumb1" src="<?php echo IMAGE_ADMIN ?>no_img.png" />
														</span>
													<?php } ?>
												</div>
											</div>
										</div>


										<div class="col-md-4 col-sm-6">
											<label for="name" class="col-sm-12 label_content px-2 py-0">Cover Image Title <span
													style="color:#f00;font-size: 22px;margin-top: 3px;">*</span></label>
											<div class="col-sm-12">
												<input type="text" class="form-control form-control-sm" required id="cover_image_title"
													name="cover_image_title" value="<?= $cover_image_title ?>" placeholder="Cover Image Title">
											</div>
										</div>



									</div>
									<div class="form-group row">




										<div class="col-md-4 col-sm-6">
											<label for="name" class="col-sm-12 label_content px-2 py-0">Cover Image Alt Title <span
													style="color:#f00;font-size: 22px;margin-top: 3px;">*</span></label>
											<div class="col-sm-12">
												<input type="text" class="form-control form-control-sm" required id="cover_image_alt_title"
													name="cover_image_alt_title" value="<?= $cover_image_alt_title ?>"
													placeholder="Cover Image Alt Title">
											</div>
										</div>


										<div class="col-md-8 col-sm-6">

											<label for="inputEmail3" class="col-sm-12 label_content px-2 py-0">Slug URL<span
													style="color:#f00;font-size: 22px;margin-top: 3px;">*</span></label>

											<div class="col-sm-12">

												<input type="text" class="form-control form-control-sm" required id="slug_url" name="slug_url"
													pattern="^[a-z0-9]+(?:-[a-z0-9]+)*$"
													title="Slug URL can only contain lowercase letters, numbers, and hyphens."
													value="<? echo $slug_url; ?>" placeholder="Slug URL">

											</div>

										</div>





									</div>
									<div class="form-group row">










										<div class="col-md-4 col-sm-6">

											<label for="inputEmail3" class="col-sm-12 label_content px-2 py-0">Meta Title <span
													style="color:#f00;font-size: 22px;margin-top: 3px;">*</span></label>

											<div class="col-sm-12">

												<input type="text" class="form-control form-control-sm" maxlength="60" required id="meta_title"
													name="meta_title" value="<? echo $meta_title; ?>" placeholder="Meta Title">

											</div>

										</div>

										<div class="col-md-4 col-sm-6">

											<label for="inputEmail3" class="col-sm-12 label_content px-2 py-0">Meta Description
												<span style="color:#f00;font-size: 22px;margin-top: 3px;">*</span></label>

											<div class="col-sm-12">

												<input type="text" class="form-control form-control-sm" maxlength="160" required
													id="meta_description" name="meta_description" value="<? echo $meta_description; ?>"
													placeholder="Meta Description">

											</div>

										</div>

										<div class="col-md-4 col-sm-6">

											<label for="inputEmail3" class="col-sm-12 label_content px-2 py-0">Meta Keyword<span
													style="color:#f00;font-size: 22px;margin-top: 3px;">*</span></label>

											<div class="col-sm-12">

												<input type="text" class="form-control form-control-sm" required id="meta_keyword"
													name="meta_keyword" value="<? echo $meta_keyword; ?>" placeholder="Meta Keyword">

											</div>

										</div>

									</div>



								</div>

								<div class="col-lg-4 col-md-4 col-sm-6">


									<div class="sidebar1">

										<label class="control-label" for="Name">Super Category Name <div
												data-title="The name of the Main Category." class="ico-help icon_title_box"><i
													class="fa fa-question-circle"></i></div><span class="required">*</span></label>

										<div class="input-group input-group-required">

											<input type="hidden" id="inputType" value="radio" />



											<div id="demo1_menu">

												<ul>

													<li class="isFolder isExpanded" title="New Parent Category">

														<a href="0" target="super_category_id,0,<? if ($super_category_id == 0)
															echo "true";
														else
															echo "false"; ?>">
															New Parent Category</a>

														<?

														foreach ($category_list as $row1) {

															if ($row1->super_category_id == 0) {

																?>

																<ul>

																	<?

																	$liClassExpend = '';
																	$liClass = '';
																	$liFolderCount = 0;

																	foreach ($category_list as $row2) {

																		if ($super_category_id == $row2->id)

																			$liClassExpend = 'isExpanded';

																		if ($row2->super_category_id == $row1->id)

																			$liFolderCount++;

																	}

																	if ($liFolderCount > 0) {

																		$liClass = 'isFolder';

																	}

																	?>

																	<? ?>

																	<li class="<? echo $liClass . " " . $liClassExpend; ?> " title="Parent Category">

																		<a href="0" target="super_category_id,<? echo $row1->id; ?>,<? if ($super_category_id == $row1->id)
																				 echo "true";
																			 else
																				 echo "false"; ?>"><? echo $row1->name; ?></a>

																		<? foreach ($category_list as $row3) {

																			if ($row3->super_category_id == $row1->id) {

																				?>

																				<ul>

																					<? $liClassExpend = '';
																					$liClass = '';
																					$liFolderCount = 0;
																					foreach ($category_list as $row4) {
																						//if the current category's super_category_id is any one's category_id then current $row3 is expanded 
																						if ($super_category_id == $row4->id)
																							$liClassExpend = 'isExpanded';
																						//if the current $row3->id is any one's super_category_id then it's folder
																						if ($row4->super_category_id == $row3->id)
																							$liFolderCount++;
																					}
																					if ($liFolderCount > 0) {
																						$liClass = 'isFolder';
																					} ?>



																					<li class="<? echo $liClass . " " . $liClassExpend; ?> " title="Sub Category">

																						<a href="0" target="super_category_id,<? echo $row3->id; ?>,
																						 <? if ($super_category_id == $row3->id)
																							 echo "true";
																						 else
																							 echo "false"; ?>"><? echo $row3->name; ?></a>
																						<? echo $row3->name; ?>

																						<ul>

																							<? foreach ($category_list as $row5) { //echo "<pre>"; print_r($category_list); echo "</pre>";
																								
																														if ($row5->super_category_id == $row3->id) { ?>

																									<li class="" title="Super Sub Category"><a href="0"
																											target="super_category_id,<? echo $row5->id; ?>,false"><? echo $row5->name; ?></a>
																									</li>

																								<? }
																													} ?>

																						</ul>

																					</li>

																				</ul>

																			<? }
																		} ?>

																	</li>

																</ul>

															<? }
														} ?>

													</li>

												</ul>

											</div>

										</div>

										<span class="field-validation-valid" data-valmsg-for="Name" data-valmsg-replace="true"></span>

									</div>

								</div>

							</div>

							<div class="">

								<div class="">

									<div class="form-group row">



										<div class="col-md-12">

											<label for="inputEmail3" class="col-sm-12 label_content px-2 py-0"> Description
												<span style="color:#f00;font-size: 22px;margin-top: 3px;">*</span>

											</label>



											<textarea name="description" id="description" placeholder="Description"
												class="form-control ckeditor"><? echo $description; ?></textarea>

										</div>



										<script>

											CKEDITOR.replace('description');

										</script>

										<script type="text/javascript">

											function readTextFile(file, callback, encoding) {

												var reader = new FileReader();

												reader.addEventListener('load', function (e) {

													callback(this.result);

												});

												if (encoding) reader.readAsText(file, encoding);

												else reader.readAsText(file);

											}



											function fileChosen(input, output) {

												if (input.files && input.files[0]) {

													readTextFile(

														input.files[0],

														function (str) {

															output.value = str;

														}

													);

												}

											}



											$('#files').on('change', function () {

												var result = $("#files").text();



												fileChosen(this, document.getElementById('description'));

												CKEDITOR.instances['description'].setData(result);

											});

										</script>

									</div>



									<hr>

									<div class="form-group row">
										<div class="col-lg-3 col-md-6 col-sm-6">

											<label for="radioSuccess4" class="col-sm-12 label_content px-2 py-0">Is Display?
												<span style="color:#f00;font-size: 22px;margin-top: 3px;">*</span>

											</label>

											<div class="col-sm-10">

												<div class="form-check" style="">

													<div class="form-group clearfix">

														<div class="icheck-success d-inline">

															<input type="radio" name="is_display" <? if ($is_display == 1) {
																echo "checked";
															} ?> value="1" id="radioSuccess4">

															<label for="radioSuccess4"> Yes

															</label>

														</div>

														&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

														<div class="icheck-danger d-inline">

															<input type="radio" name="is_display" <? if ($is_display != 1) {
																echo "checked";
															} ?> value="0" id="radioSuccess5">

															<label for="radioSuccess5"> No

															</label>

														</div>

													</div>

												</div>

											</div>

										</div>
										<div class="col-lg-3 col-md-6 col-sm-6">

											<label for="radioSuccess1" class="col-sm-12 label_content px-2 py-0">Status
												<span style="color:#f00;font-size: 22px;margin-top: 3px;">*</span>

											</label>

											<div class="col-sm-10">

												<div class="form-check" style="">

													<div class="form-group clearfix">

														<div class="icheck-success d-inline">

															<input type="radio" name="status" <? if ($status == 1) {
																echo "checked";
															} ?> value="1"
																id="radioSuccess1">

															<label for="radioSuccess1"> Active

															</label>

														</div>

														&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

														<div class="icheck-danger d-inline">

															<input type="radio" name="status" <? if ($status != 1) {
																echo "checked";
															} ?> value="0"
																id="radioSuccess2">

															<label for="radioSuccess2"> Block

															</label>

														</div>

													</div>

												</div>

											</div>

										</div>

									</div>

									<!-- /.card-body -->

									<div class="card-footer">

										<center>

											<button type="submit" name="save" onclick=" redirect_type_func('');" value="1"
												class="btn btn-info">Save</button>

											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

											<button type="submit" name="save-add-new" onclick=" redirect_type_func('save-add-new');" value="1"
												class="btn btn-default ">Save And Add New</button>

										</center>

									</div>

								</div>

							</div>


							<?php echo form_close() ?>
							</table>
						</div>
					<?php } else {
						$this->data['no_access_flash_message'] = "You Dont Have Access To View " . $page_module_name;
						$this->load->view('secureRegions/template/access_denied', $this->data);
					} ?>
					<!-- /.card-body -->
				</div>
			</div>
		</div>


	</section>
	<?php ?>

</div>

<aside class="control-sidebar control-sidebar-dark">
	<!-- Control sidebar content goes here -->
</aside>
<script>
	function redirect_type_func(data) {
		document.getElementById("redirect_type").value = data;
		return true;
	}
</script>
<script src="<?= _admin_files_ ?>js/jquery.easytree.js"></script>

<script>
	$('#demo1_menu').easytree();
	function deleteImage(obj) {
		if (confirm('Do you really want to delete the image?')) {
			$('.loader').show();
			$(obj).data("column");
			var column = $(obj).data("column");
			var id = $(obj).data("id");
			//alert($(obj).data("table") + ' : ' + $(obj).data("column") + ' : ' + $(obj).data("id"));
			$.ajax({
				type: "POST",
				url: '<? echo MAINSITE_Admin ?>catalog/Category-Module/deleteImagesForCategory',
				//dataType : "json",
				data: { "column": column, "id": id },
				success: function (result) {
					if (result == 1) {
						location.reload();
					}
					else {
						$('.loader').hide();
						alert("Error while process.");
						location.reload();
					}
				}
			});
		}
	}
</script>
<script>
	// Check if the File API is supported by the browser
	if (window.File && window.FileList && window.FileReader) {
		$("#cover_image").on("change", function (e) {
			var files = e.target.files, // Get the selected files
				filesLength = files.length; // Get the number of selected files

			// Loop through each selected file
			for (var i = 0; i < filesLength; i++) {
				var f = files[i]; // Get the current file
				var fileReader = new FileReader(); // Create a new FileReader object
				fileReader.onload = (function (e) {
					var file = e.target; // Get the file from the event

					// Customized code to display the image
					$(".pip1").remove(); // Remove any existing .pip elements
					$(".custom-file-display1").html("<span class=\"pip pip1\">" + // Insert the new image inside .custom-file-display element
						"<img class=\"imageThumb imageThumb1\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" + "</span>");
				});
				fileReader.readAsDataURL(f);//actualy this triggers the above "	fileReader.onload"  // Read the file as a data URL (base64 encoded string)
			}
		});
	} else {
		alert("Your browser doesn't support to File API"); // Alert the user if the File API is not supported
	}
</script>