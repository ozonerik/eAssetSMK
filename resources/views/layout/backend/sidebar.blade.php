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
                      <p>Sumber Anggaran</p>
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
                  <!-- menu item type-->
                  <li class="nav-item">
                  @sectionMissing('menu_itemtype') 
                    <a href="/itemtype" class="nav-link"> 
                  @else 
                      @yield('menu_itemtype')
                  @endif
                      <i class="far fa-circle nav-icon text-warning"></i>
                      <p>Jenis Barang</p>
                    </a>
                  </li>
                  <!-- menu storage-->
                  <li class="nav-item">
                  @sectionMissing('menu_storeroom') 
                    <a href="/storeroom" class="nav-link"> 
                  @else 
                      @yield('menu_storeroom')
                  @endif
                      <i class="far fa-circle nav-icon text-warning"></i>
                      <p>Penyimpanan</p>
                    </a>
                  </li>
                </ul>
              </li>
            <!-- end menu referensi -->
            <!-- menu asset-->
            @sectionMissing('menu_asset') 
              <li class="nav-item"> 
            @else 
              @yield('menu_asset') 
            @endif
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-cubes text-info"></i>
                  <p>
                    Asset
                    <i class="right fas fa-angle-left "></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <!-- menu inventaris--> 
                  <li class="nav-item">
                  @sectionMissing('menu_inventaris') 
                    <a href="/inventory" class="nav-link"> 
                  @else 
                      @yield('menu_inventaris') 
                  @endif
                      <i class="far fa-circle nav-icon text-info"></i>
                      <p>Inventaris</p>
                    </a>
                  </li>
                  <!-- menu grafik--> 
                  <li class="nav-item">
                  @sectionMissing('menu_graph') 
                    <a href="/inventory/graph" class="nav-link"> 
                  @else 
                      @yield('menu_graph') 
                  @endif
                      <i class="far fa-circle nav-icon text-info"></i>
                      <p>Grafik Inventaris</p>
                    </a>
                  </li>
                </ul>
              </li>
            <!-- end menu asset -->
            <!-- menu print-->
            @sectionMissing('menu_print') 
              <li class="nav-item"> 
            @else 
              @yield('menu_print') 
            @endif
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-print text-success"></i>
                  <p>
                    Print
                    <i class="right fas fa-angle-left "></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <!-- menu printasset--> 
                  <li class="nav-item">
                  @sectionMissing('menu_printasset') 
                    <a href="/prints/assets" class="nav-link"> 
                  @else 
                      @yield('menu_printasset') 
                  @endif
                      <i class="far fa-circle nav-icon text-success"></i>
                      <p>Print Asset</p>
                    </a>
                  </li>
                  <!-- menu printlabel--> 
                  <li class="nav-item">
                  @sectionMissing('menu_printlabel') 
                    <a href="/prints/labels" class="nav-link"> 
                  @else 
                      @yield('menu_printlabel') 
                  @endif
                      <i class="far fa-circle nav-icon text-success"></i>
                      <p>Print Label</p>
                    </a>
                  </li>
                </ul>
              </li>
            <!-- end menu print -->
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