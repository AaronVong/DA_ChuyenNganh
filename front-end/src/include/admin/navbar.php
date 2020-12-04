<nav class="navbar">
    <div class="navbar__right">
        <div class="admin">
            <button type="button" class="links admin__avatar btn">
                <span class="links__text">Quyền Minh</span>
                <i class="fas fa-angle-down"></i>
            </button>
            <ul class="admin__menu">
                <li class="menu__items"><a href="#" class="links" id="admin__info">
                        <i class="fas fa-user-cog"></i>
                        <span class="links__text">Information</span>
                    </a>
                </li>
                <li class="menu__items">
                    <a href="#" class="links" id="admin__logout">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="links__text">LogOut</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <ul class="navbar__nav">
        <li class="nav__items">
            <button href="#" class="links btn--widenav btn" type="button">
                <i class="fas fa-angle-double-right"></i>
                <span class="links__text">TechoNow</span>
            </button>
        </li>
        <li class="nav__items"><a href="admin.php?fnc=qlsp" class="links"><i class="fas fa-dolly-flatbed"></i><span
                    class="links__text">Quản lý Sản
                    Phẩm</span></a>
        </li>
        <!-- <li class="nav__items">
            <a href="admin.php?fnc=qlctsp" class="links">
                <i class="fas fa-carrot"></i>
                <span class="links__text">Quản lý Chi Tiết Sản Phẩm</span>
            </a>
        </li> -->
        <li class="nav__items">
            <a href="admin.php?fnc=qlloaisp" class="links">
                <i class="fas fa-cat"></i>
                <span class="links__text">quản lý loại sản phẩm</span>
            </a>
        </li>
        <li class="nav__items">
            <a href="admin.php?fnc=qldh" class="links">
                <i class="fas fa-box-open"></i><span class="links__text">quản lý đơn hàng</span>
            </a>
        </li>
        <li class="nav__items">
            <a href="admin.php?fnc=qlkh" class="links">
                <i class="fas fa-users"></i>
                <span class="links__text">quản lý khách hàng</span>
            </a>
        </li>
    </ul>
</nav>
