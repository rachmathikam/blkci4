<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<style>
   .editInput{
		height:36px; background-color:#f6f6f6; border:1px; border-radius:5px; display:none; width:100%;
	}
</style>
<div class="container">
    <div class="col">
        <div class="row">
            <h2>TEST</h2>
        </div>
    </div>
</div>
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title"><?php echo $content_title ?></h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="#">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#"><?php echo $content_title ?></a>
                </li>
            </ul>
        </div>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i> Tambah  visi misi</button>
                    <button class="btn btn-danger btn-sm float-right mr-1"><i class="fas fa-trash"></i> Tambah
                        visi misi</button>
                    <div class="card-body mt-5">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-hover">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="select_all"></th>
                                        <th>Kategori</th>
                                        <th>Deskripsi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="add_new">

                                    <?php foreach($data as $visi_misi): ?>
                                    <tr id="data<?= $visi_misi->id?>">
                                        <td><input type="checkbox" class="checkbox_ids" name="ids" value="<?= $visi_misi->id?>"></td>
                                        <td>
                                            <span class="editSpan kategori"><?= $visi_misi->kategori?></span>
                                            <?php if($check == null){ ?>
                                                   <?php $disabled = 'disabled'; ?>
                                                        <select name="" id="" class="editInput kategori">
                                                            <option selected value="visi">visi</option>
                                                            <option value="">misi</option>
                                                        </select>
                                            <?php }else if($check != null) { ?>
                                                       <input type="text" class="editInput Kategori" disabled value="<?= $visi_misi->kategori?>">
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <span class="editSpan deskripsi"><?= $visi_misi->deskripsi?></span>
                                            <input type="text" class="editInput deskripsi" name="deskripsi" value="<?= $visi_misi->deskripsi?>">
                                        </td>
                                        <td>
                                            <button class="btn text-warning  edit_inline"><i
                                                    class="fa fa-edit"></i></button>
                                            <button class="btn text-primary  btnSave" style="display:none;"><i
                                                    class="fa fa-check"></i></button>
                                            <button class="btn text-danger  editCancel" style="display:none;"><i
                                                    class="fa fa-times"></i></button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Visi atau Misi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="row" enctype='multipart/form-data' id="modal_form">
                    <div class="col-md-12">
                        <label for="">Pilih Kategori</label>
                    <select name="" id="mySelect" class="form-control ">
                         <option selected disabled>-- Pilih Kategori --</option>
                        <option value="option1Content">Visi</option>
                        <option value="option2Content">Misi</option>
                    </select>
                    </div>
                    <div id="option1Content" class="form-group col-sm-12 hidden" style="display:none;">
                        <label for="">Visi</label>
                        <?php if(!empty($check)){?>
                        <input type="hidden" name="update_visi" value="<?php if(!empty($check)){ echo $check['id']; }?>">
                        <?php } ?>
                        <textarea name="visi" class="form-control mb-1" rows="3"><?php if(!empty($check)){ echo $check['deskripsi']; }  ?></textarea>
                        <small style="font-size:12px;">Visi hanya bisa di inputkan 1 kali, jika data visi sudah ada maka akan mengupdate data visi jika di pilih !</small>
                    </div>
                    <div id="option2Content" class="form-group col-md-12 hidden"  style="display:none;">
                        <label for="">Misi</label>
                        <br>
                        <small style="font-size:12px;">Tambah data misi sesuai dengan kebutuhan !</small>
                        <div id="inputContainer">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="misi[]" placeholder="Masukkan deskripsi misi">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-danger remove-input" disabled><i
                                                class="fas fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary btn-sm ml-2" onclick="addInput()">Add
                            Input</button>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary add_user">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col">
            <br><br><br>

        </div>
    </div>
</div>


<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
    crossorigin="anonymous"></script>

<script>
    $("#form_profile").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        var url = '<?php echo base_url(); ?>';

        $.ajax({
            type: 'POST',
            url: url + 'hero_store', // URL to the server-side script that handles file upload
            data: formData,
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting the content type
            dataType: 'json', // Specify the expected response type
            success: function (response) {


            },
        });
    });

    $("#add_new").on('click', '.edit_inline', function () {
        var btn = $(this);
        btn.closest("tr").find(".edit_inline").hide();

        $(this).closest("tr").find(".editSpan").hide();
        $(this).closest("tr").find(".editInput").show(250);
        $(this).closest("tr").find(".editCancel").show(250);
        $(this).closest("tr").find(".edit_inline").hide();
        $(this).closest("tr").find(".btnSave").show(250);
    });

    $("#add_new").on('click', '.editCancel', function (e) {
        e.preventDefault();

        $(this).closest("tr").find(".editSpan").show();
        $(this).closest("tr").find(".editInput").hide();

        $(this).closest("tr").find(".edit_inline").show(250);
        $(this).closest("tr").find(".editCancel").hide();

        $(this).closest("tr").find(".btnSave").hide();
    });

    $("#add_new").on("click", '.btnSave', function (e) {
        e.preventDefault();
        var trObj = $(this).closest("tr");
        var ID = $(this).closest("tr").attr('id');
        var inputData = $(this).closest("tr").find(".editInput").serialize();
        var url = '<?= base_url(); ?>';

        $.ajax({
            type: "POST",
            url: url+"visi_misi_edit",
            dataType: "json",
            data: 'action=edit&id=' + ID + '&' + inputData + '&' + 'user_id=<?php echo $id_user?>',
            success: function (response) {
                if (response.status == 200) {
                    toastr.success(response.message);
                    trObj.find(".editSpan.social_media_name").text(response.data.social_media_name);
                    trObj.find(".editSpan.icon_id").text(response.data.icon_id);
                    trObj.find(".editSpan.link").text(response.data.link);

                    trObj.find(".editInput.social_media_name").val(response.data.social_media_name);
                    trObj.find(".editInput.icon_id").val(response.data.icon_id);
                    trObj.find(".editInput.link").val(response.data.link);

                    trObj.find(".editInput").hide();
                    trObj.find(".editSpan").show();
                    trObj.find(".btnSave").hide();
                    trObj.find(".editCancel").hide();
                    trObj.find(".edit_inline").show();
                    setTimeout(function () {
                        location = 'http://localhost/blk/setting_profile/setting.php';
                    }, 1500)
                }
            }
        });

    });

    $(document).ready(function () {
        $('#mySelect').change(function () {
            $('.hidden').hide();
            $('#' + $(this).val()).show();

        });
    });

    function addInput() {
        var html = '<div class="form-group">' +
            '<div class="input-group">' +
            '<input type="text" class="form-control" name="misi[]" placeholder="Enter a value">' +
            '<div class="input-group-append">' +
            '<button type="button" class="btn btn-danger remove-input" onclick="removeInput(this)"><i class="fas fa-times"></i></button>' +
            '</div>' +
            '</div>' +
            '</div>';
        $('#inputContainer').append(html);
    }

    function removeInput(element) {
        var inputGroup = $(element).closest('.input-group');
        if (inputGroup.parent().is(':nth-child(1)')) {
            // Prevent removing the first input
            alert('Cannot remove the first input!');
        } else {
            inputGroup.parent().remove();
        }
    }
</script>
<?= $this->endSection(); ?>