<!--sidebar-menu-->
<div id="sidebar">
    <a href="{{ url('/admin/dashboard') }}" class="visible-phone"
        ><i class="icon icon-home"></i> Dashboard</a
    >
    <ul>
        <li class="active">
            <a href="{{ url('/admin/dashboard') }}"
                ><i class="icon icon-home"></i> <span>Dashboard</span></a
            >
        </li>
        <li class="submenu">
            <a href="#">
                <i class="icon icon-th-list"></i>
                <span>Categories</span>
                <span class="label label-important">2</span>
            </a>
            <ul>
                <li>
                    <a href="{{ url('/admin/add-category') }}">Add category</a>
                </li>
                <li>
                    <a href="{{ url('/admin/view-categories') }}">View Categories</a>
                </li>
            </ul>
        </li>
        <li class="submenu">
            <a href="#">
                <i class="icon icon-th-list"></i>
                <span>Products</span>
                <span class="label label-important">2</span>
            </a>
            <ul>
                <li>
                    <a href="{{ url('/admin/add-product') }}">Add products</a>
                </li>
                <li>
                    <a href="{{ url('/admin/view-products') }}">View products</a>
                </li>
            </ul>
        </li>
        <li class="submenu">
            <a href="#">
                <i class="icon icon-th-list"></i>
                <span>Coupons</span>
                <span class="label label-important">2</span>
            </a>
            <ul>
                <li>
                    <a href="{{ url('/admin/add-coupon') }}">Add Coupon</a>
                </li>
                <li>
                    <a href="{{ url('/admin/view-coupons') }}">View Coupons</a>
                </li>
            </ul>
        </li>
    </ul>
</div>
<!--sidebar-menu-->
