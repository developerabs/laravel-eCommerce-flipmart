<!-- NAVIGATION -->
<!-- ========================================================= -->
<div id="left-nav" class="nano">
    <div class="nano-content">
        <nav>
            <ul class="nav nav-left-lines" id="main-nav">
                <!--HOME-->
                <li class="active-item"><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i><span>Dashboard</span></a></li>
                <!--FORMS-->
                <li class="has-child-item close-item">
                    <a><i class="fa fa-columns" aria-hidden="true"></i><span>Brand </span></a>
                    <ul class="nav child-nav level-1">
                        <li><a href="{{ url('/addBrand') }}">Add Brand</a></li>
                        <li><a href="{{ url('/allBrand') }}">All Brand</a></li>
                       
                    </ul>
                </li>
                <!--TABLES-->
                <li class="has-child-item close-item">
                    <a><i class="fa fa-table" aria-hidden="true"></i><span>Tables</span></a>
                    <ul class="nav child-nav level-1">
                        <li><a href="tables_basic.html">Basic</a></li>
                        <li><a href="tables_data-tables.html">DataTable</a></li>
                        <li><a href="tables_responsive.html">Responsive</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
