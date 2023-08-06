<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<style>
    .editInput {
        display: none;
        height: 35px;
        border-radius: 5px;
        border: 1px;
        background: #c6c2cc;
    }
    .di_terima{
        background-color:#28a745; 
    }
    .pending{
        background-color:#FFC107;
    }
    option{
        background-color:white;
        color:black;
    }
    .status{
        height:35px; 
        border-radius:4px; 
        color:white; 
        width:100px;
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
                    <button class="btn btn-primary btn-sm float-right" data-toggle="modal"
                        data-target="#exampleModal"><i class="fas fa-plus"></i> Tambah Kerjasama Mitra</button>
                    <button class="btn btn-danger btn-sm float-right mr-1 deleteData"><i class="fas fa-trash"></i> Hapus Terpilih</button>
                    <div class="card-body mt-5">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-hover">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="select_all"></th>
                                        <th>Nama Mitra</th>
                                        <th>Bidang Usaha</th>
                                        <th>Email</th>
                                        <th>Alamat</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="add_new">
                                <?php foreach($data as $val): ?>
                                    <tr id="data<?= $val['id']?>">
                                        <td><input type="checkbox" class="checkbox_ids" name="ids" value="<?= $val['id']?>"></td>
                                        <td>
                                          <span class="editSpan nama_mitra"><?= $val['nama_mitra'] ?></span>
                                            <input type="text" class="editInput nama_mitra" name="nama_mitra" value="<?= $val['nama_mitra'] ?>">
                                        </td>
                                        <td>
                                            <span class="editSpan bidang_usaha"><?= $val['bidang_usaha'] ?></span>
                                            <input type="text" class="editInput bidang_usaha" name="bidang_usaha" value="<?= $val['bidang_usaha'] ?>">
                                        </td>
                                        <td>    
                                            <span class="editSpan email"><?= $val['email'] ?></span>
                                            <input type="text" class="editInput email" name="email" value="<?= $val['email'] ?>">
                                        </td>
                                        <td>
                                            <span class="editSpan alamat"><?= $val['alamat'] ?></span>
                                            <input type="text" class="editInput alamat" name="alamat" value="<?= $val['alamat'] ?>">
                                         </td>
                                        <td id="myTd" class="statusCell">
                                            <?php $selected ='';?>
                                            <?php $selected2 ='';?>
                                            <select class="text-center status" id="status<?php echo $val['id']?>" name="status<?php echo $val['id']?>" onchange="cobaSaja('<?php echo $val['id']?>')" style="background-color:<?= $val['color']?>">
                                            <?php if($val['status'] == 'di_terima') {?>
                                                <?php $selected ='selected';?>
                                                <?php  }?>
                                                <?php if($val['status'] == 'pending') {?>
                                                <?php $selected2 ='selected';?>
                                                <?php  }?>
                                                <option <?php echo $selected ?> value="di_terima">Di terima</option>
                                                <option <?php echo $selected2 ?> value="pending">Pending</option>
                                              
                                            </select>
                                        </td>
                                        <td>
                                            <button class="btn text-warning  edit_inline"><i class="fa fa-edit"></i></button>
                                            <button class="btn text-primary  btnSave" style="display:none;"><i class="fa fa-check"></i></button>
                                            <button class="btn text-danger  editCancel" style="display:none;"><i class="fa fa-times"></i></button>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Partner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form  class="row" enctype='multipart/form-data' id="modal_form">
                <div class="form-group col-md-6">
                    <label for="kategori">Nama Mitra</label>
                    <input type="hidden" name="user_id" value="<?php echo $id_user ?>">
                    <input type="text" class="form-control" id="nama_mitra" name="nama_mitra">
                </div>
                <div class="form-group col-md-6">
                    <label for="kategori">Bidang Usaha</label>
                    <input type="text" class="form-control"ïd="bidang_usaha" name="bidang_usaha">
                </div>
                <div class="form-group col-md-6">
                    <label for="kategori">Email</label>
                    <input type="text" class="form-control" id="email" name="email">
                </div>
                <div class="form-group col-md-6">
                    <label for="kategori">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat">
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
    <script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<!-- jQuery Validation plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script>
    var url = '<?php echo base_url(); ?>';

    $(document).ready(function() {
        //form submit icon
        $('#modal_form').validate({
        rules: {
                nama_mitra: {
                required: true,
                },
                bidang_usaha: {
                required: true,
                },
                email: {
                required: true,
                },
                alamat: {
                required: true,
                }
            },
            messages: {
                nama_mitra: {
                required: "Nama Mitra harus di isi !."
                },
                bidang_usaha: {
                required: "Bidang Usaha harus di isi !"
                },
                email: {
                required: "Email harus di isi !"
                },
                alamat: {
                required: "Alamat harus di isi !"
                }
            },
            errorElement: "div",
            errorPlacement: function(error, element) {
                error.addClass("invalid-feedback");
                error.insertAfter(element);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass("is-invalid").addClass("is-valid");
            },
            submitHandler: function(form) {
                var data = $('#create').val();
                if (data != '') {
                    $.ajax({
                        url: url+'kerjasama_store', 
                        type: 'POST',
                        data: $('#modal_form').serialize(),
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                swal(response.message, {
                                    icon : "success",
                                    buttons:false,
                                    timer: 1500,
                                }); 
                                
                                setTimeout(function(){
                                    location = url +'kerjasama';
                                },1500)
                                
                            } else if (response.status === 'error') {
                                toastr.error('Error: ' + response.message);
                            } else if (response.status === 'error') {
                                toastr.error('Validation Error:', response.errors);
                            }
                        },
                        error: function(xhr, status, error) {
                            toastr.error('AJAX request failed: ' + error);
                        
                        }
                    });
                }
            }
        });

        $('#nama_mitra').on('click', function() {
            $('#nama_mitra').removeClass('is-valid is-invalid');
        });
        $('#bidang_usaha').on('click', function() {
            $('#bidang_usaha').removeClass('is-valid is-invalid');
        });

        $('#email').on('click', function() {
            $('#email').removeClass('is-valid is-invalid');
        });

        $('#alamat').on('click', function() {
            $('#alamat').removeClass('is-valid is-invalid');
        });
    });

    $("#add_new").on('click','.edit_inline',function(){
            var  btn = $(this);
        btn.closest("tr").find(".edit_inline").hide();

        $(this).closest("tr").find(".editSpan").hide();
        $(this).closest("tr").find(".editInput").show(250);
        $(this).closest("tr").find(".editCancel").show(250);
        $(this).closest("tr").find(".edit_inline").hide();
        $(this).closest("tr").find(".btnSave").show(250);
    });

    $("#add_new").on('click','.editCancel', function(e){
        e.preventDefault();
        
        $(this).closest("tr").find(".editSpan").show(); 
        $(this).closest("tr").find(".editInput").hide();

        $(this).closest("tr").find(".edit_inline").show(250);
        $(this).closest("tr").find(".editCancel").hide();

        $(this).closest("tr").find(".btnSave").hide();
    });

    $("#add_new").on("click", '.btnSave',function(e) {
        e.preventDefault();
        var trObj = $(this).closest("tr");
        
            var ID = $(this).closest("tr").attr('id');
        
            var inputData = $(this).closest("tr").find(".editInput").serialize();
            

        $.ajax({
            type: "POST",
            url : url+"kerjasama_update",
            dataType: "json",
            data:'action=edit&id='+ID+'&'+inputData+'&'+'user_id=<?php echo $id_user ?>',
            success:function(response){
            if(response.status == 'success'){
                toastr.success(response.message);
                trObj.find(".editSpan.nama_mitra").text(response.data.nama_mitra);
                trObj.find(".editSpan.bidang_usaha").text(response.data.bidang_usaha);
                trObj.find(".editSpan.email").text(response.data.email);
                trObj.find(".editSpan.alamat").text(response.data.alamat);
                

                trObj.find(".editSpan.nama_mitra").val(response.data.nama_mitra);
                trObj.find(".editSpan.bidang_usaha").val(response.data.bidang_usaha);
                trObj.find(".editSpan.email").val(response.data.email);
                trObj.find(".editSpan.alamat").val(response.data.alamat);

                trObj.find(".editInput").hide();
                trObj.find(".editSpan").show();
                trObj.find(".btnSave").hide();
                trObj.find(".editCancel").hide();
                trObj.find(".edit_inline").show();

                }else{
                    console.log(response.errors);
                   if(response.errors.nama_mitra){
                       toastr.error(response.errors.nama_mitra);
                   }else if(response.errors.bidang_usaha){
                    toastr.error(response.errors.bidang_usaha);
                   }else if(response.errors.email){
                    toastr.error(response.errors.email);
                   }else if(response.errors.alamat){
                    toastr.error(response.errors.alamat);
                   }
                 
                }
            }
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
              url: url+"kerjasama_delete",
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

function cobaSaja(isi){
        var inputData = $('#status'+isi).val();
    
        $.ajax({
            type: "POST",
            url : url+"status_edit",
            dataType: "json",
            data:'statusAksi=edit&id='+isi+'&'+'status='+inputData+'&'+'user_id=<?php echo $id_user ?>',
            success:function(response){
            if(response.status == 'success'){
                toastr.success(response.message);
                    $("#status"+isi).css({ 'background-color' : '', 'opacity' : '' });
                    $('#status'+isi).attr('class',"text-center status "+inputData);
                
               }
            }
        });    
    }

</script>
<?= $this->endSection(); ?>