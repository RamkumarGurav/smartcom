<!-- <link rel="stylesheet" href="<?= _admin_files_ ?>css/tablednd.css" type="text/css" /> -->
<style>
	* {
		box-sizing: border-box;
	}

	#myUL {
		list-style-type: none;
		padding: 0;
		margin: 0;
	}

	#myUL li a {
		background-color: #f6f6f6;
	}

	#myUL li a:hover:not(.header) {
		background-color: #eee;
	}

	.edit_button {
		padding: 5px !important;
		font-size: 14px !important;
	}

	.bg-blue {
		background-color: #007bff !important;
		font-size: 14px !important;
	}
</style>

<link href="<?= _admin_files_ ?>skin-lion/ui.easytree.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<?





$product_gallery_image_id = $product_id = 0;


$record_action = "Add New Record";
$record_action_type = "insert";
$id = 0;
$category_id = 0;
$name = "";
$description = $mechanical_parameter = $electrical_parameter = $environmental_parameter = "";
$brochure_file_name = $datasheet_file_name = "";
$slug_url = "";
$meta_title = "";
$meta_keyword = "";
$meta_description = "";
$position = 1;
$is_display = 1;
$status = 1;
$category_id_arr = array();

if (!empty($product_data)) {

	$record_action = "Update";
	$record_action_type = "update";
	$id = $product_data->id;
	$category_id = $product_data->category_id;
	$name = $product_data->name;
	$description = $product_data->description;
	$mechanical_parameter = $product_data->mechanical_parameter;
	$electrical_parameter = $product_data->electrical_parameter;
	$environmental_parameter = $product_data->environmental_parameter;
	$brochure_file_name = $product_data->brochure_file_name;
	$datasheet_file_name = $product_data->datasheet_file_name;
	$slug_url = $product_data->slug_url;
	$meta_title = $product_data->meta_title;
	$meta_description = $product_data->meta_description;
	$meta_keyword = $product_data->meta_keyword;
	$position = $product_data->position;
	$is_display = $product_data->is_display;
	$status = $product_data->status;


	if (!empty($join_product_category_data)) {

		foreach ($join_product_category_data as $row) {

			$category_id_arr[] = $row->category_id;

		}

	}




}






?>
<script src="https://cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>




<script>
	$(document).ready(function () {
		$.ajax({
			type: "POST",

			url: '<? echo MAINSITE_Admin ?>catalog/Product-module/get_product_gallery_image_list',
			//dataType : "json",
			data: { "product_gallery_image_id": '<? echo $product_gallery_image_id; ?>', "product_id": '<? echo $id; ?>', "withPosition": 1, 'sortByPosition': 1, "<?= $csrf['name'] ?>": "<?= $csrf['hash'] ?>" },
			success: function (result) {
				//   alert(result);
				$('#product_gallery_image_list').html(result);
				//ArrangeTable();
				dragEvent();
			}
		});
	});
</script>
<!-- /.navbar -->

<!-- Main Sidebar Container -->


<!--{{{{{{ Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<!--{{{{{{ Page Module Header with breadcrumb -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">

				<div class="col-sm-6">
					<h1 class="m-0 text-dark">
						<?= $page_module_name ?> </small>
					</h1>
				</div><!-- /.col -->

				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= MAINSITE_Admin . "wam" ?>">Home</a></li>
						<li class="breadcrumb-item"><a
								href="<?= MAINSITE_Admin . $user_access->class_name . "/" . $user_access->function_name ?>">
								<?= $user_access->name ?>
								List
							</a></li>
						<? if (!empty($product_data)) { ?>
							<li class="breadcrumb-item"><a
									href="<?= MAINSITE_Admin . $user_access->class_name . "/view/" . $id ?>">View</a>
							</li>
						<? } ?>
						<li class="breadcrumb-item">
							<?= $record_action ?>
						</li>
					</ol>
				</div><!-- /.col -->

			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- }}}}}} Page Module Header with breadcrumb -->

	<!--{{{{{{ Main content -->
	<section class="content">
		<div class="row">
			<div class="col-12">

				<!-- {{{{{{ Main Card form with Header -->
				<div class="card">

					<!-- {{{{{form-header -->
					<div class="card-header">
						<h3 class="card-title">
							<?= $name ?> <small>
								<?= $record_action ?>
							</small>
						</h3>
					</div>
					<!-- }}}}}.form-header -->


					<!-- {{{{{ Main Form -->
					<?php
					if ($user_access->view_module == 1 || true) {
						?>

						<!-- {{{{{ always echo the "alert_message" before the main "card-body"-->
						<? echo $this->session->flashdata('alert_message'); ?>
						<!-- }}}}} "alert_message" -->


						<div class="card-body">
							<?php echo form_open(
								MAINSITE_Admin . "$user_access->class_name/do_edit",
								array(
									'method' => 'post',
									'id' => 'product_form',
									"name" => "product_form",
									'style' => '',
									'class' => 'form-horizontal',
									'role' => 'form',
									'enctype' => 'multipart/form-data'
								)
							); ?>
							<input type="hidden" name="id" id="id" value="<?= $id ?>" />
							<input type="hidden" name="redirect_type" id="redirect_type" value="" />





							<div class="form-group row">




								<div class="col-sm-8">

									<div class="row">
										<div class="col-md-6">
											<label for="name" class="col-sm-12 label_content px-2 py-0"> Product Name <span
													style="color:#f00;font-size: 22px;margin-top: 3px;">*</span></label>
											<div class="col-sm-12">
												<input type="text" class="form-control form-control-sm" required id="name" name="name"
													value="<?= $name ?>" placeholder="Product Name">
											</div>
										</div>
										<div class="col-sm-6">
											<label for="name" class="col-sm-12 label_content px-2 py-0">Slug URL <span
													style="color:#f00;font-size: 22px;margin-top: 3px;">*</span></label>
											<div class="col-sm-12">
												<input type="text" class="form-control form-control-sm" required id="slug_url" name="slug_url"
													pattern="^[a-z0-9]+(?:-[a-z0-9]+)*$"
													title="Slug URL can only contain lowercase letters, numbers, and hyphens."
													value="<?= $slug_url ?>" placeholder="Slug URL">
											</div>
										</div>
									</div>
									<div class="form-group row">


										<div class="col-md-4 col-sm-6">
											<label for="name" class="col-sm-12 label_content px-2 py-0">Meta Title <span
													style="color:#f00;font-size: 22px;margin-top: 3px;">*</span></label>
											<div class="col-sm-12">
												<input type="text" class="form-control form-control-sm" required id="meta_title" name="meta_title"
													value="<?= $meta_title ?>" placeholder="Meta Title">
											</div>
										</div>




										<div class="col-md-4 col-sm-6">
											<label for="name" class="col-sm-12 label_content px-2 py-0">Meta Description <span
													style="color:#f00;font-size: 22px;margin-top: 3px;">*</span></label>
											<div class="col-sm-12">
												<input type="text" class="form-control form-control-sm" required id="meta_description"
													name="meta_description" value="<?= $meta_description ?>" placeholder="Meta Description">
											</div>
										</div>

										<div class="col-md-4 col-sm-6">
											<label for="name" class="col-sm-12 label_content px-2 py-0">Meta Keyword <span
													style="color:#f00;font-size: 22px;margin-top: 3px;">*</span></label>
											<div class="col-sm-12">
												<input type="text" class="form-control form-control-sm" required id="meta_title"
													name="meta_keyword" value="<?= $meta_keyword ?>" placeholder="Meta Keyword">
											</div>
										</div>
									</div>

								</div>

								<div class="col-sm-4" style="overflow-y: scroll;">
									<div class="sidebar1">

										<label class="control-label" for="Name">Select Category Name<span
												style="color:#f00;font-size: 22px;margin-top: 3px;">*</span></label>

										<div class="input-group input-group-required">

											<input type="hidden" id="inputType" value="checkbox" />

											<div id="demo1_menu">

												<ul>

													<li class="isFolder isExpanded" title="New Parent Category">

														<i class="fa fa-folder"></i>
														<?php /*?><a href="0" target="super_category_id,0,true" ><?php */ ?> New
														Parent Category<?php /*?></a><?php */ ?>

														<? foreach ($category_list as $row1) {

															if ($row1->super_category_id == 0) { ?>

																<ul>

																	<? $liClassExpend = '';
																	$liClass = '';
																	$liFolderCount = 0;
																	foreach ($category_list as $row2) {
																		if (in_array($row2->id, $category_id_arr))
																			$liClassExpend = 'isExpanded';
																		if ($row2->super_category_id == $row1->id)
																			$liFolderCount++;
																	}
																	if ($liFolderCount > 0) {
																		$liClass = 'isFolder';
																	} ?>

																	<li class="<? echo $liClass . " " . $liClassExpend; ?> " title="Parent Category">

																		<i class="fa fa-angle-right"></i>

																		<?php /*?> <a href="0" target="super_category_id,<? echo $row1['category_id']; ?>,false" ><? echo $row1['name']; ?></a>

																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																								<a href="0" target="category_id[],<? echo $row1['category_id']; ?>,false" ><? echo $row1['name']; ?></a><?php */ ?>

																		<a href="0" target="category_id[],<? echo $row1->id; ?>,<? if (in_array($row1->id, $category_id_arr)) {
																				 echo 'true';
																			 } else {
																				 echo "false";
																			 } ?>"><? echo $row1->name; ?></a>

																		<? foreach ($category_list as $row3) {

																			if ($row3->super_category_id == $row1->id) {

																				?>

																				<ul>

																					<? $liClassExpend = '';
																					$liClass = '';
																					$liFolderCount = 0;
																					foreach ($category_list as $row4) {
																						if ($row4->super_category_id == $row3->id)
																							$liFolderCount++;
																					}
																					if ($liFolderCount > 0) {
																						$liClass = 'isFolder';
																						if (in_array($row3->id, $category_id_arr))
																							$liClassExpend = 'isExpanded';
																					} ?>

																					<li class="<? echo $liClass . " " . $liClassExpend; ?>	" title="Sub Category">

																						<a href="0" target="category_id[],<? echo $row3->id; ?>,<? if (in_array($row3->id, $category_id_arr)) {
																								 echo 'true';
																							 } else {
																								 echo "false";
																							 } ?>"><? echo $row3->name; ?></a>

																						<ul>

																							<? foreach ($category_list as $row5) {

																								if ($row5->super_category_id == $row3->id) { ?>

																									<li class="" title="Super Sub Category"><a href="0" target="category_id[],<? echo $row5->id; ?>,<? if (in_array($row5->id, $category_id_arr)) {
																											 echo 'true';
																										 } else {
																											 echo "false";
																										 } ?>"><? echo $row5->name; ?></a>
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

											<div class="input-group-btn"><span class="required"></span>

											</div>

										</div>

										<span class="field-validation-valid" data-valmsg-for="Name" data-valmsg-replace="true"></span>

									</div>
								</div>



							</div>








							<div class="form-group">

								<div class="col-md-12">
									<label for="description" class="col-sm-12 label_content px-2 py-0">Product Description<span
											style="color:#f00;font-size: 22px;margin-top: 3px;">*</span>

									</label>

									<textarea class="search_textbox ckeditor" name="description" id="description" required
										style="width: 576px; height: 200px;"><? echo $description; ?></textarea>

									<span class="field-validation-valid" data-valmsg-for="description" data-valmsg-replace="true"></span>

								</div>

							</div>

							<div class="form-group">

								<div class="col-md-12">
									<label for="electrical_parameter" class="col-sm-12 label_content px-2 py-0">Electrical Parameter<span
											style="color:#f00;font-size: 22px;margin-top: 3px;">*</span>

									</label>

									<textarea class="search_textbox ckeditor" name="electrical_parameter" id="electrical_parameter" required
										style="width: 576px; height: 200px;"><? echo $electrical_parameter; ?></textarea>

									<span class="field-validation-valid" data-valmsg-for="electrical_parameter"
										data-valmsg-replace="true"></span>

								</div>

							</div>
							<div class="form-group">

								<div class="col-md-12">
									<label for="mechanical_parameter" class="col-sm-12 label_content px-2 py-0">Mechanical Parameter<span
											style="color:#f00;font-size: 22px;margin-top: 3px;">*</span>

									</label>

									<textarea class="search_textbox ckeditor" name="mechanical_parameter" id="mechanical_parameter" required
										style="width: 576px; height: 200px;"><? echo $mechanical_parameter; ?></textarea>

									<span class="field-validation-valid" data-valmsg-for="mechanical_parameter"
										data-valmsg-replace="true"></span>

								</div>

							</div>
							<div class="form-group">

								<div class="col-md-12">
									<label for="environmental_parameter" class="col-sm-12 label_content px-2 py-0">Environmental
										Parameter<span style="color:#f00;font-size: 22px;margin-top: 3px;">*</span>

									</label>

									<textarea class="search_textbox ckeditor" name="environmental_parameter" id="environmental_parameter"
										required style="width: 576px; height: 200px;"><? echo $environmental_parameter; ?></textarea>

									<span class="field-validation-valid" data-valmsg-for="environmental_parameter"
										data-valmsg-replace="true"></span>

								</div>

							</div>



							<div class="form-group row">

								<div class="col-md-4 col-sm-6">
									<label for="inputEmail3" class="col-sm-12 label_content px-2 py-0">Upload Brochure <span
											style="color:#f00;font-size: 22px;margin-top: 3px;">*</span></label>
									<div class="col-sm-12 d-flex">
										<div class="input-group" style="width:90%">
											<div class="custom-file">
												<input type="file" name="brochure_file_name" class="custom-file-input"
													<?= $record_action_type == "insert" ? "required" : "" ?> id="brochure_file_name">
												<label class="custom-file-label form-control-sm" for="files"></label>
											</div>
										</div>
										<div class="custom-file-display custom-file-display1">
											<?php if (!empty($brochure_file_name)) { ?>
												<span class="pip pip1">
													<a target="_blank" class="btn btn-sm btn-primary"
														href="<?php echo _uploaded_files_ . 'product_brochure/' . $brochure_file_name ?>">
														view
													</a>
												</span>

											<?php } ?>
										</div>
									</div>
								</div>

								<div class="col-md-4 col-sm-6">
									<label for="inputEmail3" class="col-sm-12 label_content px-2 py-0">Upload Datasheet <span
											style="color:#f00;font-size: 22px;margin-top: 3px;">*</span></label>
									<div class="col-sm-12 d-flex">
										<div class="input-group" style="width:90%">
											<div class="custom-file">
												<input type="file" name="datasheet_file_name" class="custom-file-input"
													<?= $record_action_type == "insert" ? "required" : "" ?> id="datasheet_file_name">
												<label class="custom-file-label form-control-sm" for="files"></label>
											</div>
										</div>
										<div class="custom-file-display custom-file-display1">
											<?php if (!empty($datasheet_file_name)) { ?>
												<span class="pip pip1">
													<a target="_blank" class="btn btn-sm btn-primary"
														href="<?php echo _uploaded_files_ . 'product_datasheet/' . $datasheet_file_name ?>">
														view
													</a>
												</span>

											<?php } ?>
										</div>
									</div>
								</div>






							</div>


							<div class="form-group row">


								<div class="col-md-12 ">
									<label for="asdf" class="col-sm-12 label_content px-2 py-0">Product Images </label>


									<div class="card-body py-0 px-2">
										<table class="table table-sm">
											<thead>
												<tr>
													<th>#</th>
													<th width="25%">Image Title</th>
													<th width="25%">Image Alt Title</th>
													<th>Image</th>
													<th></th>
												</tr>
											</thead>
											<tbody class="RFQDetailBody_pgi">
												<? $this->load->view('secureRegions/catalog/Product_module/template/file_line_add_more_pgi', $this->data); ?>
											</tbody>
											<tfoot>
												<tr>
													<td colspan="9"><button type="button" onclick="addNewRFQDeatilLine_pgi(0)"
															class="btn btn-block btn-default">Add New Line</button>
													<td>
												</tr>
											</tfoot>
										</table>

									</div>

								</div>

							</div>


							<?php if (!empty($product_data->product_gallery_image)) { ?>
								<div class="form-group row">
									<label for="slug_url" class="col-sm-12 label_content px-2 py-0">Uploaded Product Images </label>
									<div class="col-sm-12">
										<div class="row card">
											<div class="col-md-12 card-body ">
												<div class="box box-primary">
													<div class="box-header with-border">

													</div>
													<div class="box-body">

														<link rel="stylesheet" href="<?= _admin_files_ ?>css/tablednd.css" type="text/css" />
														<div class="tableDemo">
															<table class="table table-striped" id="table-2">
																<thead>
																	<tr>
																		<th>Slno.</th>
																		<th>Image</th>
																		<th>Image Title</th>
																		<th>Image Alt Title</th>
																		<th>Position</th>
																		<th>Is Default?</th>
																		<th>Status</th>
																		<th>Delete</th>
																	</tr>
																</thead>
																<tbody id="product_gallery_image_list">


																	<tr>
																		<td colspan="10">
																			<div class="clearfix text-center">
																				<img src="<? echo MAINSITE . "assets/admin/images/load.gif"; ?>" />
																			</div>
																		</td>
																	</tr>


																</tbody>

															</table>
															<div class="result"></div>
														</div>



														<script src="<?= _admin_files_ ?>js/jquery.tablednd.js" type="text/javascript"></script>

														<script>



															function dragEvent() {
																table_2 = $("#table-2");
																table_2.find("tr:even").addClass("alt");

																$("#table-2").tableDnD({
																	onDragClass: "myDragClass",
																	onDrop: function (table, row) {
																		var rows = table.tBodies[0].rows;
																		var podId = '';
																		for (var i = 0; i < rows.length; i++) {
																			podId += rows[i].id + ",";
																		}

																		$('#product_gallery_image_list').html('<tr><td colspan="10"> <div class="clearfix text-center" ><img  src="<? echo MAINSITE . "assets/admin/images/load.gif"; ?>" /></div></td></tr>');
																		$.ajax({
																			type: "POST",
																			url: '<?= MAINSITE_Admin . 'catalog/Product-module/get_product_gallery_image_list_new_pos' ?>',
																			//dataType : "json",
																			data: { "product_gallery_image_id": '<? echo $product_gallery_image_id; ?>', "product_id": '<? echo $id; ?>', 'podId': podId, "<?= $csrf['name'] ?>": "<?= $csrf['hash'] ?>" },
																			success: function (result) {
																				// alert(result);
																				$('#product_gallery_image_list').html(result);
																				$(table).parent().find('.result').text("Order Changed Successfully");
																				dragEvent();
																			}
																		});

																	},
																	onDragStart: function (table, row) {
																		$(table).parent().find('.result').text("Started dragging row id " + row.id);

																	},

																});

															}


														</script>
													</div>
												</div>
											</div>
										</div>
									</div>


								</div>

							<?php } ?>

							<div class="form-group row">



								<div class="col-md-4 col-sm-6">
									<label for="radioSuccess4" class="col-sm-12 label_content px-2 py-0">Is Display ?<span
											style="color:#f00;font-size: 22px;margin-top: 3px;">*</span></label>

									<div class="col-sm-12">
										<div class="form-check" style="">
											<div class="form-group clearfix">
												<div class="icheck-success d-inline">
													<input type="radio" name="is_display" <?php if ($is_display == 1) {
														echo "checked";
													} ?> value="1"
														id="radioSuccess4">
													<label for="radioSuccess4"> Yes
													</label>
												</div>
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<div class="icheck-danger d-inline">
													<input type="radio" name="is_display" <?php if ($is_display != 1) {
														echo "checked";
													} ?> value="0" id="radioSuccess5">
													<label for="radioSuccess5"> No</label>
												</div>
											</div>
										</div>
									</div>
								</div>


								<div class="col-md-4 col-sm-6">
									<label for="radioSuccess3" class="col-sm-12 label_content px-2 py-0">Status<span
											style="color:#f00;font-size: 22px;margin-top: 3px;">*</span></label>

									<div class="col-sm-12">
										<div class="form-check" style="">
											<div class="form-group clearfix">
												<div class="icheck-success d-inline">
													<input type="radio" name="status" <?php if ($status == 1) {
														echo "checked";
													} ?> value="1"
														id="radioSuccess3">
													<label for="radioSuccess3"> Active
													</label>
												</div>
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<div class="icheck-danger d-inline">
													<input type="radio" name="status" <?php if ($status != 1) {
														echo "checked";
													} ?> value="0"
														id="radioSuccess4">
													<label for="radioSuccess4"> Blocked</label>
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
							<!-- /.card-footer -->

							<?php echo form_close() ?>
							</table>
						</div>
					<? } else {
						$this->data['no_access_flash_message'] = "You Dont Have Access To View " . $page_module_name;
						$this->load->view('admin/template/access_denied', $this->data);
					} ?>

					<!-- }}}}} Main Form -->
				</div>
				<!--   }}}}}} Main Card form with Header -->
			</div>
		</div>


	</section>
	<!-- }}}}} Main content -->
</div>
<!--}}}}}} Content Wrapper. Contains page content -->


<aside class="control-sidebar control-sidebar-dark">
	<!-- Control sidebar content goes here -->
</aside>




<script src="https://cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script>
<script src="<?= _admin_files_ ?>js/jquery.easytree.js"></script>


<script>

	window.addEventListener('load', function () {

		$('#demo1_menu').easytree();

	});

</script>
<script>


	function redirect_type_func(data) {
		var category_id_arr = document.getElementsByName('category_id[]');
		var category_id_checked = 0;
		//alert(category_id_arr.length);
		for (var i = 0; i < category_id_arr.length; i++) {
			if (category_id_arr[i].checked) {
				category_id_checked++;
			}
		}
		//alert(category_id_checked);
		if (category_id_checked == 0) {
			alert("Please Select Atleast One Category");
			return false;
		}
		document.getElementById("redirect_type").value = data;
		return true;
	}





</script>

<script>
	window.addEventListener('load', function () {
		//add validation for description
		document.getElementById('product_form').addEventListener('submit', function (event) {
			var description = document.getElementById('description').value.trim();

			if (description === "") {
				toastrDefaultErrorFunc("Product description is required");
				event.preventDefault(); // Prevent form from submitting
			}
		});
	});
</script>





<script>
	/*  >>> ADDING MORE GALLERY FILES*/

	var append_id_pgi = 1;

	function addNewRFQDeatilLine_pgi(id_pgi = 0) {
		append_id_pgi++;
		Pace.restart();
		$.ajax({
			url: "<?= MAINSITE_Admin . $user_access->class_name . '/addNewLine_pgi' ?>",
			type: 'post',
			dataType: "json",
			data: { 'id_pgi': id_pgi, 'append_id_pgi': append_id_pgi, "<?= $csrf['name'] ?>": "<?= $csrf['hash'] ?> " },
			success: function (response) {
				$(".RFQDetailBody_pgi").append(response.template);
				set_qe_sub_table_count_pgi();
				set_qe_sub_table_remove_btn_pgi();
				calculate_qe_sub_table_price_pgi();
				set_input_element_functions_pgi();
				// Initialize Summernote
				$('.summernote').summernote({
					<?= _summernote_ ?>
				});
			},
			error: function (request, error) {
				toastrDefaultErrorFunc("Unknown Error. Please Try Again");
			}
		});
	}

	// Use event delegation for file input change event
	$(document).on('change', '.custom-file-input', function () {
		let fileName = Array.from(this.files).map(x => x.name).join(', ');
		$(this).siblings('.custom-file-label').addClass("selected").html(fileName);
	});

	function set_qe_sub_table_count_pgi() {
		var count_pgi = 0;
		$('.qe_sub_table_count_pgi').each(function (index, value) {
			count_pgi++;
			$(this).html(count_pgi + '.');
		});
	}

	function set_qe_sub_table_remove_btn_pgi() {
		$('.qe_sub_table_remove_td_pgi').html('');
		var count_pgi = 0;
		$('.qe_sub_table_remove_td_pgi').each(function (index, value) {
			count_pgi++;
		});
		if (count_pgi > 1) {
			$('.qe_sub_table_remove_td_pgi').html('<button class="btn btn-outline-danger btn-xs" onclick="remove_qe_sub_table_row_pgi($(this))" title="remove"><i class="fas fa-trash"></i></button>');
		}
	}

	function remove_qe_sub_table_row_pgi(row) {
		row.closest('tr').remove();
		set_qe_sub_table_remove_btn_pgi();
		set_qe_sub_table_count_pgi();
	}



	function del_pgi($pgi_id) {
		if (parseInt($pgi_id) > 0) {
			var s = confirm('You want to delete this file?');
			if (s) {
				$.ajax({
					url: "<?= MAINSITE_Admin . 'Ajax/del_any_file' ?>",
					type: 'post',
					//dataType: "json",
					data: {
						"table_name": "product_gallery_image",
						"id_column": "id",
						'id': $pgi_id,
						"folder_name": "product_gallery_image",
						"<?= $csrf['name'] ?>": "<?= $csrf['hash'] ?>"
					},
					success: function (response) {
						toastrDefaultSuccessFunc("Record Deleted Successfully");
						window.location.reload();
						//alert(response);
						$("#quotation_enquiry_file_" + $pgi_id).hide();
					},
					error: function (request, error) {
						toastrDefaultErrorFunc("Unknown Error. Please Try Again");
					}
				});
			}
		}

		return false;
	}
	/* <<<< ADDING MORE GALLERY FILES*/
</script>

<script>
	$(document).on('change', '.default-image-switch', function () {
		var imageId = $(this).data('id');
		if ($(this).is(':checked')) {
			// Uncheck all other switches
			$('.default-image-switch').not(this).prop('checked', false);

			// Send AJAX request to update the default image
			$.ajax({
				url: "<?= MAINSITE_Admin . 'Ajax/update_product_image_as_default' ?>",
				type: 'POST',
				data: { "id": imageId, "product_id": <?= $id ?>, "<?= $csrf['name'] ?>": "<?= $csrf['hash'] ?>" },
				success: function (response) {
					toastrDefaultSuccessFunc("Default image updated successfully");
					window.location.reload();
					//alert(response);
					// $("#quotation_enquiry_file_" + $pgi_id).hide();
				},
				error: function (request, error) {
					toastrDefaultErrorFunc("Unknown Error. Please Try Again");
				}

			});
		} else {
			// Prevent unchecking the last remaining checked switch
			$(this).prop('checked', true);
		}
	});

</script>