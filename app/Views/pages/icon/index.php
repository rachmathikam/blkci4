<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<style>
    input[type=number] {
  -moz-appearance: textfield;
}
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

#toast-container > .customer-info {            

  background-color: dodgerblue;
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
                    <h3>Icon</h3>
                    <button class="btn btn-primary btn-sm float-right"  data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i> Tambah Icon</button>
                    <button class="btn btn-danger btn-sm float-right mr-1 deleteData"><i class="fas fa-trash"></i> Delete Terpilih</button>
                    <div class="card-body mt-5">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-hover">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="select_all"></th>
                                        <th>Nama Icon</th>
                                        <th>Icon</th>
                                        <th>Unicode</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="add_new">
                                    <?php foreach ($icon as $value): ?>
                                    <tr id="data<?= $value['id']; ?>">
                                        <td><input type="checkbox"  class="checkbox_ids" name="ids" value="<?= $value['id']; ?>"></td>
                                        <td>
                                            <span class="editSpan icon_name"><?= $value['icon_name']; ?></span>
                                            <input type="text" name="icon_name" class="editInput icon_name" style="display:none;" value="<?= $value['icon_name']; ?>"> 
                                        </td>
                                        <td><i class="<?= $value['icon_name']; ?>"></i></td>
                                        <td>
                                            <span class="editSpan unicode"><?= $value['unicode']; ?></span>
                                            <input type="text" name="unicode" class="editInput unicode" style="display:none;" value="<?= $value['unicode']; ?>"> 
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
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_icon" class="row">
                <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <input type="hidden" class="user_id" name="user_id" value="<?= $id_user ?>" />
                <input type="hidden" name="id"  value="<?php if(!empty($data_kontak['id'])){ echo $data_kontak['id']; }?>" />
                    <div class="form-group col-md-12">
                        <label for="">Nama Icon</label>
                        <input type="text" class="form-control" name="icon_name">
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="">Unicode</label>
                        <input type="text" class="form-control" name="unicode">
                    </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<!-- jQuery Validation plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>    
<script>  
    var url = '<?= base_url(); ?>';
    $(document).ready(function() {
        //form submit icon
        $('#form_icon').validate({
        rules: {
                icon_name: {
                required: true,
                },
                unicode: {
                required: true,
                }
            },
            messages: {
                icon_name: {
                required: "Masukkan Nomer HP anda."
                },
                unicode: {
                required: "Masukkan unicode anda !"
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
                        url: url+'icon_store', 
                        type: 'POST',
                        data: $('#form_icon').serialize(),
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                swal(response.message, {
                                    icon : "success",
                                    buttons:false,
                                    timer: 1500,
                                }); 
                                
                                setTimeout(function(){
                                    location = url +'icon';
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

        $('#unicode').on('click', function() {
            $('#unicode').removeClass('is-valid is-invalid');
        });
        $('#icon_name').on('click', function() {
            $('#icon_name').removeClass('is-valid is-invalid');
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
            url : url+"icon_edit",
            dataType: "json",
            data:'action=edit&id='+ID+'&'+inputData+'&'+'user_id=<?php echo $id_user ?>',
            success:function(response){
            if(response.status == 'success'){
                toastr.success(response.message);
                trObj.find(".editSpan.icon_name").text(response.data.icon_name);
                trObj.find(".editSpan.unicode").text(response.data.unicode);
                

                trObj.find(".editInput.icon_name").val(response.data.icon_name);
                trObj.find(".editInput.unicode").val(response.data.unicode);

                trObj.find(".editInput").hide();
                trObj.find(".editSpan").show();
                trObj.find(".btnSave").hide();
                trObj.find(".editCancel").hide();
                trObj.find(".edit_inline").show();
                setTimeout(function(){
                        location = url+'icon';
                    },1500)
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
              url: url+"icon_delete",
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
                        location = url+'icon';
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
