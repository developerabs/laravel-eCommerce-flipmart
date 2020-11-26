<!-- NAVIGATION -->
<!-- ========================================================= -->
<div id="left-nav" class="nano">
    <div class="nano-content">
        <nav>
            <ul class="nav nav-left-lines" id="main-nav">
                <!--HOME-->
                <li class="{{ (request()->is('/')) ? 'active-item':''}}"><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i><span>Dashboard</span></a></li>
                <!--FORMS-->
                <li class="has-child-item close-item {{ (request()->is('brand/*')) ? 'open-item':''}}">
                    <a><i class="fa fa-columns" aria-hidden="true"></i><span>Brand </span></a>
                    <ul class="nav child-nav level-1">
                        <li class="{{ (request()->is('brand/addBrand')) ? 'active-item':''}}"><a href="{{ url('/brand/addBrand') }}">Add Brand</a></li>
                        <li class="{{ (request()->is('brand/allBrand')) ? 'active-item':''}}"><a href="{{ url('/brand/allBrand') }}">All Brand</a></li>
                       
                    </ul>
                </li>
                <!--TABLES-->
                <li class="has-child-item close-item">
                    <a><i class="fa fa-table" aria-hidden="true"></i><span>Category</span></a>
                    <ul class="nav child-nav level-1">
                        <li><a href="{{ url('/categorys') }}">Categorys</a></li>
                        <li><a href="{{ url('/categorys/addSubcategorys') }}">Sub Categorys</a></li>
                        <li><a href="tables_responsive.html">Sub Sub Categorys</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
