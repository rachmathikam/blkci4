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
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <form action="">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Pilih yang akan di setting</label>
                                    <select class="form-control" id="contentToggle">
                                        <option value="hidden">Kontak</option>
                                        <option value="visible">Konten</option>
                                        <option value="other">Sosial Media</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8" id="content1" >
                    <div class="card">
                        <div class="card-body">
                            <form id="registrationForm" method="POST" action="<?= base_url('/hero_store');?>">
                               <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                <h3>Kontak</h3>
                               <input type="hidden" class="user_id" name="user_id" value="<?= $id_user ?>" />
                               <input type="hidden" name="id"  value="<?php if(!empty($data_kontak['id'])){ echo $data_kontak['id']; }?>" />

                               <?php if(!empty($data_kontak)){?>
                                <input type="hidden" id="update" name="update" value="update" />
                                <?php }else{?>
                                    <input type="hidden" id="create" name="create" value="create" />
                                <?php }?>
                             
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Email <i class="fas fa-envelope"></i></label>
                                            <input type="email" class="form-control" id="email" name="email" value="<?php if(!empty($data_kontak['email'])){ echo $data_kontak['email']; }?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">No Telp / WA <i class="fas fa-phone"></i></label>
                                            <input type="number"class="form-control" id="phone_number" name="phone_number" value="<?php if(!empty($data_kontak['phone_number'])){ echo $data_kontak['phone_number']; } ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="">Lokasi <i class="fas fa-map-marker-alt"></i></label>
                                            <textarea name="lokasi" id="lokasi" cols="30" rows="10" class="form-control"><?php if(!empty($data_kontak['lokasi'])){ echo $data_kontak['lokasi']; } ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <?php if(!empty($data_kontak)){?>
                                <button class="btn btn-warning float-right" type="submit">Update</button>
                                <?php }else{?>
                                <button class="btn btn-primary float-right" type="submit">Simpan</button>
                                <?php }?>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 " id="content2"  style="display:none;">
                    <div class="card">
                        <div class="card-body">
                            <form id="form_profile" enctype='multipart/form-data'>
                                <h3>Profile</h3>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Title Pertama</label>
                                            <input type="text"  name="title_pertama" id="title_pertama" class="form-control" value="<?php if(!empty($data_profile['1st_title'])){ echo $data_profile['1st_title']; }?>">
                                             <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                            <input type="hidden" class="user_id" name="user_id" value="<?= $id_user ?>" />
                                            <input type="hidden" name="id"  value="<?php if(!empty($data_profile['id'])){ echo $data_profile['id']; }?>" />
                                           
                                            <?php if(!empty($data_profile)){?>
                                            <input type="hidden" id="update" name="update" value="update" />
                                            <?php }else{?>
                                                <input type="hidden" id="create" name="create" value="create" />
                                            <?php }?>
                                            
                                            <?php if(!empty($data_profile)){?>
                                            <input type="hidden" id="update" name="old_background" value="<?= $data_profile['background']?>" />
                                            <?php }?>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Title kedua</label>
                                            <input type="text"  name="title_kedua" id="title_kedua" class="form-control"  value="<?php if(!empty($data_profile['2nd_title'])){ echo $data_profile['2nd_title']; }?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Title ketiga</label>
                                            <input type="text" name="title_ketiga" id="title_ketiga"  class="form-control" value="<?php if(!empty($data_profile['3rd_title'])){ echo $data_profile['3rd_title']; }?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="">deskripsi</label>
                                            <textarea id="deskripsi" rows="3" name="deskripsi" id="deskripsi" class="form-control"><?php if(!empty($data_profile['deskripsi'])){ echo $data_profile['deskripsi']; }?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <div class="col-md-8">
                                                <label for="Background">Background</label>
                                                <input type="file" name="background" id="background" class="form-control background" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                                <div class="invalid-feedback" style="display:block">
                                                   
                                                </div>
                                             </div>
                                            <div class="col-md-4">
                                            <?php if(!empty($data_profile)){?>
                                                <img src="/img/profile/<?=$data_profile['background'] ?>" id="blah" alt="your image" width="100" />
                                            <?php }else{?>
                                                <img src="https://previews.123rf.com/images/aquir/aquir1411/aquir141100300/33838205-example-blue-square-stamp-isolated-on-white-background.jpg" id="blah" alt="your image" width="100" />
                                            <?php }?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if(!empty($data_profile)){?>
                                <button class="btn btn-warning float-right" type="submit">Update</button>
                                <?php }else{?>
                                <button class="btn btn-primary float-right" type="submit">Simpan</button>
                                <?php }?>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8" id="content3" style="display:none">
                    <div class="card">
                        <div class="card-body">
                            <h3>Social Media</h3>
                            <button class="btn btn-primary btn-sm float-right"  data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i> Tambah Social Media</button>
                            <button class="btn btn-danger btn-sm float-right mr-1"><i class="fas fa-trash"></i> Tambah Social Media</button>
                            <div class="card-body mt-5">
                                <div class="table-responsive">
                                    <table id="basic-datatables" class="display table table-hover">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" id="select_all"></th>
												<th>Nama Social media</th>
												<th>Icon</th>
												<th>link</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="add_new">
                                        <?php foreach($result->getResult() as $value): ?>
                                             <tr id="data<?= $value->id; ?>">
                                                <td><input type="checkbox"  class="checkbox_ids" name="ids" value="<?= $value->id; ?>"></td>
                                                <td><?= $value->social_media_name; ?></td>
                                                <td><i class="<?= $value->icon_name; ?>"></i></td>
                                                <td><?= $value->link; ?></td>
                                                <td>
                                                     <button class="btn text-warning btn-sm edit_inline"><i class="fa fa-edit"></i></button>
													<button class="btn text-primary btn-sm btnSave" style="display:none;"><i class="fa fa-check"></i></button>
													<button class="btn text-danger btn-sm editCancel" style="display:none;"><i class="fa fa-times"></i></button>
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
        <form action="" class="row" method="POST">
            <div class="form-group col-md-6">
                <label for="">Pilih Icon</label>
                <select name="" id="" class="form-control">
                    <option value=""></option>
                    <option value=""></option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="">Nama Social Media</label>
                <input type="text" class="form-control" name="nama_social_media">
            </div>
            <div class="form-group col-sm-12">
                <label for="">Link Social Media</label>
                <input type="text" class="form-control" name="link">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
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
<!-- Bootstrap CSS -->
<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <!-- jQuery Validation plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
        
    <script>  


$(document).ready(function() {
    // $('.container').preloader({
    //     text:'loading',
    //     percent:'100',
    //     duration:'1000',
    //     zIndex:'200',
    //     setRelative:false

    // });
    $.validator.addMethod("phoneID", function(phone_number, element) {
      phone_number = phone_number.replace(/\s+/g, ''); 
      return this.optional(element) || phone_number.match(/^\d{11}$/);
    }, "Please enter a valid 11-digit phone number.");
    
        document.querySelector("#phone_number").addEventListener("keypress", function (evt) {
        if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
        {
            evt.preventDefault();
        }
        });
            $('#num').keydown(function(e) {
        if (e.keyCode === 190 || e.keyCode === 110) {
            e.preventDefault();
        }
        });
    
    //form submit kontak
    $('#registrationForm').validate({
      rules: {
        phone_number: {
          required: true,
          minlength: 11,
          maxlength: 13

        },
        email: {
          required: true,
          email: true
        },
        lokasi: {
          required: true
        }
      },
      messages: {
        phone_number: {
          required: "Masukkan Nomer HP anda.",
          minlength: "minimal 11 nomer untuk menginput nomer hp",
          maxlength: "Maaf nomer hp melampui batas makasimal"

        },
        email: {
          required: "Masukkan email anda !",
          email: "Maaf yang anda masukkan bukan email !"
        },
        lokasi: {
          required: "Silahkan masukkan lokasi yang tepat !"
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
        var url = '<?= base_url(); ?>';
        var data = $('#create').val();
        if (data != '') {
            $.ajax({
                    url: url+'hero_contact/', 
                    method: 'POST',
                    data: $('#registrationForm').serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            swal(response.message, {
                                icon : "success",
                                buttons:false,
                                timer: 1500,
                            }); 
                            
                            setTimeout(function(){
                                location = url +'hero_content';
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
        $('#email').on('click', function() {
            $('#email').removeClass('is-valid is-invalid');
        });
        $('#phone_number').on('click', function() {
            $('#phone_number').removeClass('is-valid is-invalid');
        });
        $('#lokasi').on('click', function() {
            $('#lokasi').removeClass('is-valid is-invalid');
        });

        $('select').on('change', function() {
            $('.is-valid, .is-invalid').removeClass('is-valid is-invalid');
        });
  });

  // form submit profile
  $(document).ready(function() {
  $('#form_profile').validate({
      rules: {
        title_pertama: {
          required: true,
         

        },
        title_kedua: {
          required: true,
         

        },
        title_ketiga: {
          required: true,
        

        },
        deskripsi: {
          required: true,
        
        },
      },
      messages: {
        title_pertama: {
          required: "Masukkan title pertama.",

        },
        title_kedua: {
          required: "Masukkan title kedua !",
        
        },
        title_ketiga: {
          required: "Masukkan title ketiga !"
        },
        deskripsi: {
          required: "Masukkan deskripsi !"
        },
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
        var url = '<?= base_url(); ?>';
        var formData = new FormData(form);
            $.ajax({
                    url:url+'hero_profile/', // Replace with your actual URL
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        
                        if (response.status === 'success') {
                            swal(response.message, {
                                icon : "success",
                                buttons:false,
                                timer: 1500,
                            }); 

                            setTimeout(function(){
                                location = url +'hero_content';
                            },1500)
                            
                        } else if (response.status === 'error') {
                            $.notify({
                                // options
                                icon: 'flaticon-lock-1',
                                title: 'Error',
                                message: response.errors.background,
                                target: '_blank'
                            });
                            $(".background").addClass('is-invalid');
                            var text = document.querySelector(".invalid-feedback");
                            text.textContent  = response.errors.background;
                            console.log(text.textContent);
                        } else if (response.status === 'error') {
                            toastr.error('Validation Error:', response.errors.background);
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error('AJAX request failed: ' + error);
                       
                    }
                });
             }
    });
        $('#title_pertama').on('click', function() {
            $('#title_pertama').removeClass('is-valid is-invalid');
        });
        $('#title_kedua').on('click', function() {
            $('#title_kedua').removeClass('is-valid is-invalid');
        });
        $('#title_ketiga').on('click', function() {
            $('#title_ketiga').removeClass('is-valid is-invalid');
        });
        $('#deskripsi').on('click', function() {
            $('#deskripsi').removeClass('is-valid is-invalid');
        });


        $('select').on('change', function() {
            $('.is-valid, .is-invalid').removeClass('is-valid is-invalid');
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
        url : "http://localhost/blk/setting_profile/fetch.php",
        dataType: "json",
        data:'action=edit&id='+ID+'&'+inputData+'&'+'user_id=<?php echo $id_user ?>',
        success:function(response){
          if(response.status == 200){
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
			setTimeout(function(){
					location = 'http://localhost/blk/setting_profile/setting.php';
				},1500)
          }
        }
    });

});
  
  </script>
<?= $this->endSection(); ?>
