<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li>
                <a href="{{ route('posts.index') }}"><i class="fa fa-bar-chart-o fa-fw"></i> Posts</a>
                <a href="{{ route('tags.index') }}"><i class="fa fa-bar-chart-o fa-fw"></i> Tags</a>
                <a href="{{ route('categories.index') }}"><i class="fa fa-bar-chart-o fa-fw"></i> Categories</a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>