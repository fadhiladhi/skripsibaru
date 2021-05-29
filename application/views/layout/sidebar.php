<!--sidebar start-->
<aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
          <li class="active">
            <a class="" href="index.html">
                          <i class="icon_house_alt"></i>
                          <span>Dashboard</span>
                      </a>
          </li>
          <li class="sub-menu">
            <a href="javascript:;" class="">
                          <i class="icon_document_alt"></i>
                          <span>Master Data</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
              <li><a class="" href="<?=base_url('dashboard/list_barang')?>">Barang</a></li>
              <li><a class="" href="<?=base_url('dashboard/list_user')?>">User</a></li>
            </ul>
          </li>

        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->