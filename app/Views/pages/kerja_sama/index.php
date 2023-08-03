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
                    <h3>Icon</h3>
                    <button class="btn btn-primary btn-sm float-right" data-toggle="modal"
                        data-target="#exampleModal"><i class="fas fa-plus"></i> Tambah Kerjasama</button>
                    <button class="btn btn-danger btn-sm float-right mr-1 deleteData"><i class="fas fa-trash"></i> Hapus Terpilih</button>
                    <div class="card-body mt-5">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-hover">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="select_all"></th>
                                        <th>Nama Mitra</th>
                                        <th>Logo</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="add_new">
                                <?php foreach($data as $val): ?>
                                    <tr id="data">
                                        <td><input type="checkbox" class="checkbox_ids" name="ids" value="<?= $val->id?>"></td>
                                        <td><?= $val->nama_perusahaan?></td>
                                        <td><img src="img/kerjasama/<?= $val->logo_perusahaan?>" width="100"></td>
                                        <td>
                                            <a href="<?= base_url()?>kerja_sama_edit/<?= $val->id?>" class="btn text-warning  edit_inline"><i
                                                    class="fa fa-edit"></i></a>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Visi atau Misi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form  class="row" enctype='multipart/form-data' id="modal_form">
                <div class="form-group col-sm-12">
                    <label for="kategori">Nama Mitra</label>
                    <input type="hidden" name="user_id" value="<?php echo $id_user ?>">
                    <input type="text" class="form-control" name="nama_perusahaan">
                </div>
                <div id="option2Content" class="form-group col-sm-12">
                    <label for="">Logo</label>
                    <br>
                        <input type="file" name="logo_perusahaan" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"> 
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRMewYtckPBPDbPhzUwRMNi_mEqv4A6jEUJbtAqzLtA&s"
                        id="blah" width="100" alt="" >
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script>
    var url = '<?php echo base_url(); ?>';
    $("#modal_form").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: url + 'kerja_sama_store', // URL to the server-side script that handles file upload
            data: formData,
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting the content type
            dataType: 'json', // Specify the expected response type
            success: function (response) {
                if(response.status == 'success') {
                    toastr.success(response.message);
                    setTimeout(function(){
                                location = url +'kerja_sama';
                    },1500)
                }else if(response.status == 'error_length'){
                    toastr.error(response.errors);
                }else if(response.errors.nama_perusahaan){
                    toastr.error(response.errors.nama_perusahaan);
                }else{
                    toastr.error(response.errors.logo_perusahaan);
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
              url: url+"kerja_sama_delete",
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
                        location = url+'kerja_sama';
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