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
                    <button class="btn btn-danger btn-sm float-right mr-1 deleteData"><i class="fas fa-trash"></i> Hapus Data terpilih</button>
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
                                        <td class="kategori_only">
                                            <span class="editSpan kategori"><?= $visi_misi->kategori?></span>
                                            <?php if($check == null){ ?>
                                                   <?php $disabled = 'disabled'; ?>
                                                        <select name="kategori" id="kategori" class="editInput kategori">
                                                            <option selected value="visi">visi</option>
                                                            <option value="misi">misi</option>
                                                        </select>
                                            <?php }else if($check != null) { ?>
                                                       <input type="text" name="kategori" class="editInput Kategori" readonly value="<?= $visi_misi->kategori?>">
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <span class="editSpan deskripsi"><?= $visi_misi->deskripsi?></span>
                                            <textarea class="editInput deskripsi" name="deskripsi" style="height:100px;"><?= $visi_misi->deskripsi?></textarea>
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
            <label for="">Pilih Kategori</label>
                    <select name="" id="mySelect" class="form-control mb-3">
                         <option selected disabled>-- Pilih Kategori --</option>
                        <option value="option1Content">Visi</option>
                        <option value="option2Content">Misi</option>
                    </select>
                    <div class="row">
                        <div class="col-12 option1Content hidden" style="display:none;">
                            <form id="form_visi">
                                <input type="hidden" id="user_id" name="user_id" value="<?= $id_user?>">
                                <?php if(!empty($check)){ ?>
                                    <input type="hidden" id="update_id" name="update_id" value="<?= $check['id']?>">
                                <?php }?>
                                <textarea id="mytextarea"  name="visi"><?php if(!empty($check)){ echo $check['deskripsi'];}?></textarea>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-12 option2Content hidden" style="display:none;">
                            <form id="form_misi">
                                    <div id="inputContainer">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="hidden" id="user_id" name="user_id" value="<?= $id_user?>">
                                                    <input type="text" class="form-control" name="misi[]" id="misi" placeholder="masukkan deskripsi misi..">
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-danger remove-input" disabled><i class="fas fa-times"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                     <button type="button" class="btn btn-primary btn-sm ml-2 mb-3" onclick="addInput()">Add Input</button>
                                     <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                             </form>
                        </div>
                    </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/krcamgkrexa4e46g2kn9h8x80o7prt3skd1rmvtv4dal06hh/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>    
   tinymce.init({
      selector: '#mytextarea',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
      ],
    });

    $("#form_visi").submit(function (e) {
        e.preventDefault();
        var formData = {
           'user_id' : $("#user_id").val(),
           'visi' : 'visi',
           'deskripsi' : tinymce.get('mytextarea').getContent(),
           'id' : $("#update_id").val(),
        } 
        var url = '<?php echo base_url(); ?>';

        $.ajax({
            type: 'POST',
            url: url + 'visi_store', // URL to the server-side script that handles file upload
            data: formData,
            dataType: 'json', // Specify the expected response type
            success: function (response) {
                if(response.status == 'success'){
                        toastr.success(response.message);
                        setTimeout(function () {
                        location = url+'visi_misi';
                    }, 1500)
                }else{
                    toastr.error('gagal menambahkan visi');
                }
            },
        });
    });

    var url = '<?php echo base_url(); ?>';
    $("#form_misi").submit(function (e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: url + 'misi_store', // URL to the server-side script that handles file upload
            data: formData,
            dataType: 'json', // Specify the expected response type
            success: function (response) {
                if(response.status == 'success'){
                        toastr.success(response.message);
                        setTimeout(function () {
                        location = url+'visi_misi';
                    }, 1500)
                }else{
                    toastr.error('gagal menambahkan misi');
                }
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
                if (response.status == 'success') {
                    toastr.success(response.message);
                   
                    trObj.find(".editSpan.kategori").text(response.data.kategori);
                    trObj.find(".editSpan.deskripsi").text(response.data.deskripsi);
                

                    trObj.find(".editInput.kategori").val(response.data.kategori);
                    trObj.find(".editInput.deskripsi").val(response.data.deskripsi);
                
                    trObj.find(".editInput").hide();
                    trObj.find(".editSpan").show();
                    trObj.find(".btnSave").hide();
                    trObj.find(".editCancel").hide();
                    trObj.find(".edit_inline").show();
                    setTimeout(function () {
                        location = url+'visi_misi';
                    }, 1500)
                }
            }
        });

    });

    $(document).ready(function () {
        $('#mySelect').change(function () {
            $('.hidden').hide();
            $('.' + $(this).val()).show();

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

 $("#select_all").click(function() {
      $('.checkbox_ids').prop('checked', $(this).prop('checked'));
 });

$(document).on('click','.deleteData',function() {
var all_ids = [];
$('input:checkbox[name=ids]:checked').each(function() {
    all_ids.push($(this).val());
});

const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
    },
    buttonsStyling: true
});
swalWithBootstrapButtons.fire({
    title: 'Are you sure?',
    text: "Do you want to delete ?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, delete it!',
    cancelButtonText: 'No, cancel!',
    reverseButtons: true
}).then((result) => {
    if (result.value) {
        if (result.isConfirmed) {
          $.ajax({
              url: url+"visi_misi_delete",
              type: "POST",
              data: {
                  ids: all_ids,
              },
              success: function(response) {
                toastr.success('behasil menghapus data');
                $.each(all_ids, function(key, val) {
                    var datas = $('#data' + val);
                     datas.remove();
                  })
                  setTimeout(function () {
                        location = url+'visi_misi';
                    }, 1500)
              }
          });
        }
    } else if (
        result.dismiss === Swal.DismissReason.cancel
    ) {
        swal.fire(
            'Cancelled',
            'Data is not deleted',
            'error'
        )
    }
});
});
</script>
<?= $this->endSection(); ?>