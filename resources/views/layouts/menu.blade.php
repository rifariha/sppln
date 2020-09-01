<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{{ route('users.index') }}"><i class="fa fa-edit"></i><span>Users</span></a>
</li>

<li class="{{ Request::is('articleCategories*') ? 'active' : '' }}">
    <a href="{{ route('articleCategories.index') }}"><i class="fa fa-edit"></i><span>Article Categories</span></a>
</li>

<li class="{{ Request::is('articles*') ? 'active' : '' }}">
    <a href="{{ route('articles.index') }}"><i class="fa fa-edit"></i><span>Articles</span></a>
</li>

<li class="treeview {{ Request::is('dppDocuments*') ? 'active menu-open' : '' }}">
    <a href="#">
    <i class="fa fa-newspaper-o"></i><span>Dpp Document</span>
    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
    <ul class="treeview-menu">
        <li class="{{ Request::is('dppDocuments') ? 'active' : '' }}">
            <a href="{{ route('dppDocuments.index') }}"><i class="fa fa-edit"></i><span>SP PLN</span></a>
        </li>
        <li class="{{ Request::is('dppDocuments/document/uiksbu') ? 'active' : '' }}">
            <a href="{{ route('dppDocuments.uiksbu') }}"><i class="fa fa-map-signs"></i><span>SP UIKSBU</span></a>
        </li>
    </ul>
</li>