<div class="sidebar sidebar-style-2">			
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="../assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                        <?= $name ?>
                            <span class="user-level">Administrator</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#profile">
                                    <span class="link-collapse">My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#edit">
                                    <span class="link-collapse">Edit Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#settings">
                                    <span class="link-collapse">Settings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-primary">
            <li class="nav-item">
                <a href="<?= base_url('/dashboard')?>">
                    <i class="fas fa-home"></i>
                    <p>Dashboard</p>
                </a>
			</li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>
                <li class="nav-item">
                <a href="<?= base_url('/hero_content')?>">
                    <i class="fas fa-layer-group"></i>
                    <p>Base Setting</p>
                </a>
			</li>
            <li class="nav-item">
                <a href="<?= base_url('/icon')?>">
                    <i class="fas fa-list"></i>
                    <p>Icon</p>
                </a>
			</li>
            <li class="nav-item">
                <a href="<?= base_url('/visi_misi')?>">
                    <i class="fas fa-clipboard-list"></i>
                    <p>Visi Misi</p>
                </a>
			</li>
            <li class="nav-item">
                <a href="<?= base_url('/kerja_sama')?>">
                    <i class="fas fa-handshake"></i>
                    <p>Kerjasama Mitra</p>
                </a>
			</li>
            <li class="nav-item">
                <a href="<?= base_url('/testimonial')?>">
                    <i class="fas fa-quote-left"></i>
                    <p>Testimonial Pendaftar</p>
                </a>
            </li>
            <li class="nav-item">
                    <a href="<?= base_url('/kegiatan_pelatihan')?>">
                        <i class="fas fa-tasks"></i>
                        <p>Kegiatan Pelatihan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('/berita')?>">
                        <i class="fas fa-newspaper"></i>
                        <p>Berita BLK</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>