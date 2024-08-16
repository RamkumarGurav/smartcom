<?
$name = "";
$admin_user_id = 0;
$status = 1;
$record_action = "Add New Record";







?>
<!-- /.navbar -->

<!-- Main Sidebar Container -->


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <?= $page_module_name ?> <small>Details</small>
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
                        <li class="breadcrumb-item active">Details</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <? ?>
    <section class="content">
        <div class="row">
            <div class="col-12">

                <div class="card ">

                    <div class="card-header">
                        <h3 class="card-title">
                            <?= $product_data->name ?>
                        </h3>
                        <div class="float-right">
                            <?php
                            if ($user_access->add_module == 1 && false) {
                                ?>
                                <a href="<?= MAINSITE_Admin . $user_access->class_name ?>/edit">
                                    <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add
                                        New</button></a>
                            <? } ?>
                            <?php
                            if ($user_access->update_module == 1) {
                                ?>
                                <a href="<?= MAINSITE_Admin . $user_access->class_name ?>/edit/<?= $product_data->id ?>">
                                    <button type="button" class="btn btn-success btn-sm"><i class="fas fa-edit"></i>
                                        Update</button>
                                </a>
                            <? } ?>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <?php
                    if ($user_access->view_module == 1) {
                        ?>
                        <div class="card-body card-primary card-outline">
                            <?php echo form_open(MAINSITE_Admin . "$user_access->class_name/do_update_status", array('method' => 'post', 'id' => 'ptype_list_form', "name" => "ptype_list_form", 'style' => '', 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data')); ?>

                            <table id="" class="table table-bordered table-hover myviewtable responsiveTableNewDesign">
                                <tbody>
                                    <tr>

                                        <td style="width:25%;">
                                            <strong class="full">Data Base Id</strong>
                                            <?= $product_data->id ?>
                                        </td>

                                        <td style="width:25%;">
                                            <strong class="full">Product Name</strong>
                                            <?php if (!empty($product_data->name)): ?>
                                                <?= $product_data->name ?>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>

                                        <td colspan="2">
                                            <strong class="full">Category</strong>
                                            <? if (!empty($product_data->category_name)) { ?>
                                                <ol>
                                                    <?
                                                    $category_name = explode("~~~", $product_data->category_name);
                                                    foreach ($category_name as $cn) {
                                                        echo "<li>$cn</li>";
                                                    }

                                                    ?>
                                                </ol>
                                            <? } else {
                                                echo "-";
                                            } ?>
                                        </td>


                                    </tr>










                                    <tr>


                                    </tr>
                                    <tr>

                                        <td colspan="5">
                                            <strong class="full">Description</strong>
                                            <div>
                                                <?php if (!empty($product_data->description)) { ?>
                                                    <?= $product_data->description ?>
                                                <?php } else { ?>
                                                    <p>-</p>
                                                <?php } ?>
                                            </div>
                                        </td>



                                    </tr>
                                    <tr>

                                        <td colspan="5">
                                            <strong class="full">Electrical Parameter</strong>
                                            <div>
                                                <?php if (!empty($product_data->electrical_parameter)) { ?>
                                                    <?= $product_data->electrical_parameter ?>
                                                <?php } else { ?>
                                                    <p>-</p>
                                                <?php } ?>
                                            </div>
                                        </td>



                                    </tr>
                                    <tr>

                                        <td colspan="5">
                                            <strong class="full">Mechanical Parameter</strong>
                                            <div>
                                                <?php if (!empty($product_data->mechanical_parameter)) { ?>
                                                    <?= $product_data->mechanical_parameter ?>
                                                <?php } else { ?>
                                                    <p>-</p>
                                                <?php } ?>
                                            </div>
                                        </td>



                                    </tr>
                                    <tr>

                                        <td colspan="5">
                                            <strong class="full">Environmental Parameter</strong>
                                            <div>
                                                <?php if (!empty($product_data->environmental_parameter)) { ?>
                                                    <?= $product_data->environmental_parameter ?>
                                                <?php } else { ?>
                                                    <p>-</p>
                                                <?php } ?>
                                            </div>
                                        </td>



                                    </tr>

                                    <tr>



                                    </tr>













                                    <tr>
                                        <td style="width:25%;">
                                            <strong class="full">Slug URL</strong>
                                            <?php if (!empty($product_data->slug_url)): ?>
                                                <?= $product_data->slug_url ?>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                        <td style="width:25%;">
                                            <strong class="full">Meta Title</strong>
                                            <?php if (!empty($product_data->meta_title)): ?>
                                                <?= $product_data->meta_title ?>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                        <td style="width:25%;">
                                            <strong class="full">Meta Description</strong>
                                            <?php if (!empty($product_data->meta_description)): ?>
                                                <?= $product_data->meta_description ?>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                        <td style="width:25%;">
                                            <strong class="full">Meta Keyword</strong>
                                            <?php if (!empty($product_data->meta_keyword)): ?>
                                                <?= $product_data->meta_keyword ?>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>




                                    </tr>

                                    <tr>
                                        <td style="width:25%;">
                                            <strong class="full">Brochure</strong>
                                            <?php if (!empty($product_data->brochure_file_name)): ?>
                                                <a target="_blank" class="btn btn-outline-danger btn-sm"
                                                    href="<?php echo _uploaded_files_ . 'product_brochure/' . $product_data->brochure_file_name ?>">View</a>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                        <td style="width:25%;">
                                            <strong class="full">Datasheet</strong>
                                            <?php if (!empty($product_data->datasheet_file_name)): ?>
                                                <a target="_blank" class="btn btn-outline-danger btn-sm"
                                                    href="<?php echo _uploaded_files_ . 'product_datasheet/' . $product_data->datasheet_file_name ?>">View</a>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                        <td style="width:25%;">
                                            <strong class="full">Is Display?</strong>
                                            <? if ($product_data->is_display == 1) { ?> Yes <i
                                                    class="fas fa-check btn-success btn-sm "></i>
                                            <? } else { ?> No <i class="fas fa-ban btn-danger btn-sm "></i>
                                            <? } ?>
                                        </td>
                                        <td style="width:25%;">
                                            <strong class="full">Added On</strong>
                                            <?= date("d-m-Y h:i:s A", strtotime($product_data->added_on)) ?>
                                        </td>
                                    </tr>

                                    <tr>

                                        <td style="width:25%;">
                                            <strong class="full">Added By</strong>
                                            <?= $product_data->added_by_name ?>
                                        </td>
                                        <td style="width:25%;">
                                            <strong class="full">Updated On</strong>
                                            <? if (!empty($product_data->updated_on)) {
                                                echo date("d-m-Y h:i:s A", strtotime($product_data->updated_on));
                                            } else {
                                                echo "-";
                                            } ?>
                                        </td>
                                        <td style="width:25%;">
                                            <strong class="full">Updated By</strong>
                                            <? if (!empty($product_data->updated_by_name)) {
                                                echo $product_data->updated_by_name;
                                            } else {
                                                echo "-";
                                            } ?>
                                        </td>
                                        <td style="width:25%;">
                                            <strong class="full">Status</strong>
                                            <? if ($product_data->status == 1) { ?> Active <i
                                                    class="fas fa-check btn-success btn-sm "></i>
                                            <? } else { ?> Block <i class="fas fa-ban btn-danger btn-sm "></i>
                                            <? } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">
                                            <div class="row" style="width:100%;">

                                                <?php if (!empty($product_data->product_gallery_image)): ?>
                                                    <div class="card card-primary" style="width:100%;">

                                                        <div class=" d-flex justify-content-between p-2 " style="width:100%;">
                                                            <strong class="full">Gallery Images</strong>
                                                            <h6 class="">Total Images:


                                                                <?= count($product_data->product_gallery_image) ?>
                                                            </h6>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="filter-container p-0 row">
                                                                <?php foreach ($product_data->product_gallery_image as $gallery_image): ?>


                                                                    <div class="filtr-item col-sm-3 mb-1"
                                                                        data-category="<?= "1 ,4" ?>" data-sort="white sample"
                                                                        style="width:100%;height:180px;">
                                                                        <a href="<?= _uploaded_files_ . 'product_gallery_image/' . $gallery_image->file_name ?>"
                                                                            data-toggle="lightbox" data-title=""
                                                                            style="height:100%;width:100%;">
                                                                            <img src="<?= _uploaded_files_ . 'product_gallery_image/' . $gallery_image->file_name ?>"
                                                                                class="img-fluid mb-2"
                                                                                title="<?= $gallery_image->file_title ?>"
                                                                                alt="<?= $gallery_image->file_alt_title ?>"
                                                                                aria-label=""
                                                                                style="height:100%;width:100%;object-fit:cover;" />
                                                                        </a>


                                                                    </div>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            <?php else: ?>
                                                <div class=" d-flex justify-content-between p-2 " style="width:100%;">
                                                    <strong class="full">Gallery Images</strong>

                                                </div>
                                                <p class="text-center pl-2">-</p>
                                            <?php endif; ?>

                        </div>
                        </td>
                        </tr>
                        </tbody>
                        </table>



                    </div>

                    <?php echo form_close() ?>
                </div>
            <? } else {
                        $this->data['no_access_flash_message'] = "You Dont Have Access To View " . $page_module_name;
                        $this->load->view('admin/template/access_denied', $this->data);
                    } ?>
            <!-- /.card-body -->
        </div>
</div>
</div>


</section>
<? ?>
</div>

<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>