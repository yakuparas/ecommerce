<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Admin</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{route('admin.dashboard')}}">YP</a>
        </div>
        <ul class="sidebar-menu">
            <li>
              <a class="nav-link" href="{{route('admin.dashboard')}}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a>            </li>
            </li>

            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fab fa-product-hunt"></i> <span>Katalog</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{route('admin.category.list')}}">Kategoriler</a></li>
                    <li><a class="nav-link" href="{{route('admin.product.list')}}">Ürünler</a></li>
                    <li><a class="nav-link" href="{{route('admin.variants.list')}}">Seçenekler</a></li>
                    <li><a class="nav-link" href="{{route('admin.brands.list')}}">Markalar</a></li>
                </ul>
            </li>

            <li>
              <a class="nav-link" href="{{route('admin.order')}}"><i class="fas fa-truck"></i> <span>Siparişler</span></a>            </li>
            </li>

            <li>
              <a class="nav-link" href="{{route('admin.dashboard')}}"><i class="fas fa-user-tag"></i> <span>Müşteriler</span></a>            </li>
            </li>

            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-cogs"></i> <span>Ayarlar</span></a>
              <ul class="dropdown-menu">
                  <li><a class="nav-link" href="{{route('admin.slider.list')}}">Slider</a></li>
                  <li><a class="nav-link" href="{{route('admin.dashboard')}}">Para Birimleri</a></li>
                  <li><a class="nav-link" href="{{route('admin.settings.list')}}">Mağaza Ayarları</a></li>
                  <li><a class="nav-link" href="{{route('admin.dashboard')}}">E-Posta Ayarları</a></li>
                  <li><a class="nav-link" href="{{route('admin.dashboard')}}">Sanal Pos Ayarları</a></li>
              </ul>
          </li>
        </ul>
    </aside>
</div>
