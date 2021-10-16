<div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-1 pb-2 pt-1 d-flex">
        <div class="image">
          <img src="{{url('dist/img/avatar5.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="/profile" class="d-block">
            {{auth()->user()->name}}
          </a>
        </div>
      </div>
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-1 pb-2 pt-1 d-flex">
        <div class="image ">
          <img src="{{url('dist/img/gembok.png')}}" class="rounded">
        </div>
        <div class="info">
          <div class="d-block text-light">
            <span class="badge badge-info">  
              Login As {{Str::title(auth()->user()->roles()->pluck('name')->implode(', '))}}
            </span>
          </div>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            @sectionMissing('menu_dashboard') <a href="/dashboard" class="nav-link"> @else @yield('menu_dashboard') @endif
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <!-- Sidebar Admin Kabeng dan Toolman -->
          <!-- menu referensi -->
          @hasanyrole('admin|kabeng|toolman')
            @sectionMissing('menu_referensi') 
              <li class="nav-item"> 
            @else 
              @yield('menu_referensi') 
            @endif
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-cogs text-warning"></i>
                  <p>
                    Referensi
                    <i class="right fas fa-angle-left "></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <!-- menu pendanaan -->   
                  <li class="nav-item">
                  @sectionMissing('menu_budgeting') 
                    <a href="/budgeting" class="nav-link"> 
                  @else 
                      @yield('menu_budgeting') 
                  @endif
                      <i class="far fa-circle nav-icon text-warning"></i>
                      <p>Pendanaan</p>
                    </a>
                  </li>
                  <!-- menu tahun anggaran -->
                  <li class="nav-item">
                  @sectionMissing('menu_fiscal') 
                    <a href="/fiscal" class="nav-link"> 
                  @else 
                      @yield('menu_fiscal')
                  @endif
                      <i class="far fa-circle nav-icon text-warning"></i>
                      <p>Tahun Anggaran</p>
                    </a>
                  </li>
                </ul>
              </li>
            <!-- end menu referensi -->
          @endhasanyrole
          <!-- End Sidebar Admin Kabeng dan Toolman -->

          <!-- menu profile -->
          @sectionMissing('menu_profile') 
              <li class="nav-item"> 
            @else 
              @yield('menu_profile') 
            @endif
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-user text-primary"></i>
                  <p>
                    Profil
                    <i class="right fas fa-angle-left "></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">   
                  <li class="nav-item">
                  @sectionMissing('menu_editprofile') 
                    <a href="/profile" class="nav-link"> 
                  @else 
                      @yield('menu_editprofile') 
                  @endif
                      <i class="far fa-circle nav-icon text-primary"></i>
                      <p>Edit Profil</p>
                    </a>
                  </li>
                </ul>
              </li>
            <!-- end menu profile -->

          <!-- Sidebar ADMIN -->
          <!-- menu konfig -->
          @hasanyrole('admin')
          @sectionMissing('menu_konfig') <li class="nav-item"> @else @yield('menu_konfig') @endif
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cogs text-danger"></i>
              <p>
                Konfigurasi
                <i class="right fas fa-angle-left "></i>
              </p>
            </a>
            <ul class="nav nav-treeview">   
              <li class="nav-item">
              @sectionMissing('menu_organisasi') <a href="/organitation" class="nav-link"> @else @yield('menu_organisasi') @endif
                  <i class="far fa-circle nav-icon text-danger"></i>
                  <p>Organisasi</p>
                </a>
              </li>
              <li class="nav-item">
              @sectionMissing('menu_pengguna') <a href="/pengguna" class="nav-link"> @else @yield('menu_pengguna') @endif
                  <i class="far fa-circle nav-icon text-danger"></i>
                  <p>Pengguna</p>
                </a>
              </li>
            </ul>
          </li>
          @endhasanyrole 
          <!-- End Sidebar ADMIN -->
          <li class="nav-header">KETERANGAN</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">Penting</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>Konfig</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Isian</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-success"></i>
              <p>Cetak</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>