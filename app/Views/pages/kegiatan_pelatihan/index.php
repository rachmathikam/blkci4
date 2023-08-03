<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
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
            <h4 class="page-title"><?php echo $content_title?></h4>
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
                    <a href="#"><?php echo $content_title?></a>
                </li>
            </ul>
        </div>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h3>Kegiatan Pelatihan</h3>
                    <button class="btn btn-primary btn-sm float-right" data-toggle="modal"
                        data-target="#exampleModal"><i class="fas fa-plus"></i> Tambah Kegiatan Pelatihan</button>
                    <button class="btn btn-danger btn-sm float-right mr-1 deleteData"><i class="fas fa-trash"></i> Hapus
                        Terpilih</button>
                    <div class="card-body mt-5">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-hover">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="select_all"></th>
                                        <th>Nama Pelatihan</th>
                                        <th>Gambar Kegiatan Pelatihan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="add_new">
                                <?php foreach($data as $x): ?>
                                    <tr id="data">
                                        <td><input type="checkbox" class="checkbox_ids" name="ids" value="<?= $x->id?>"></td>
                                        <td><?= $x->nama_pelatihan ?></td>
                                        <td class="text-center"><img src="img/kegiatan_pelatihan/<?= $x->gambar ?>" alt="" width="100"></td>
                                        <td>
                                            <a href="<?= base_url()?>kegiatan_pelatihan_edit/<?=$x->id?>" class="btn text-warning  edit_inline"><i class="fa fa-edit"></i></a>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kegiatan Pelatihan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form  class="row" enctype='multipart/form-data' id="modal_form">
                    <div class="form-group col-sm-12">
                        <label for="kategori">Nama Pelatihan</label>
                        <input type="hidden" name="user_id" value="<?php echo $id_user?>">
                        <select name="kegiatan_pelatihan" id="" class="form-control">
                            <?php foreach($option as $d): ?>
                                <option value="<?= $d['nama_pelatihan']; ?>"><?= $d['pelatihan']; ?></option>
                                <?php endforeach; ?>
                        </select>
                    </div>
                    <div id="option2Content" class="form-group col-sm-12">
                        <label for="">Gambar Kegiatan</label>
                        <br>
                            <input type="file" name="gambar" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"> 
                            <img src="https://www.openaccessgovernment.org/wp-content/uploads/2019/03/dreamstime_s_115214614.jpg"
                            id="blah" width="150" alt=""  class="mb-5">
                            <br>
                            <small style="font-size:12px;">Berikut adalah contoh gambar kegiatan dari blk !</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script>
    var url = '<?php echo base_url(); ?>';

    $("#modal_form").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        var url = '<?php echo base_url(); ?>';

        $.ajax({
            type: 'POST',
            url: url+'kegiatan_pelatihan_store', 
            data: formData,
            processData: false,
            contentType: false, 
            dataType: 'json', 
            success: function (response) {
                if(response.status == 'success') {
                    toastr.success(response.message);
                    setTimeout(function(){
                                location = url +'kegiatan_pelatihan';
                    },1500)
                }else if(response.status == 'error_data'){
                    toastr.error(response.errors);
                }else if(response.status == 'error_length'){
                    toastr.error(response.errors);
                }else{
                    toastr.error(response.errors.gambar);
                }

            },
        });
    });

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
              url: url+"kegiatan_pelatihan_delete",
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
                        location = url+'kegiatan_pelatihan';
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