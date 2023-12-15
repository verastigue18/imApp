<div id="sidebar">
    <div class="logo">
        <img class="logo-icon" src="" alt="">
        <h3 class="logo-name" style="color: #F77F00;">imApp</h3>
    </div>

    <ul class="nav-menu">
        <div class="top-menu">
            <a class="link <?= urlIs('/dashboard') ? 'active' : 'deactivate' ?>" href="/dashboard"><li class="nav-item">Dashboard</li></a>
            <a class="link <?= urlIs('/orders') ? 'active' : 'deactivate' ?>" href="/orders"><li class="nav-item">Orders</li></a>
            <a class="link <?= urlIs('/customers') ? 'active' : 'deactivate' ?>" href="/customers"><li class="nav-item">Customers</li></a>
            <a class="link <?= urlIs('/inventory') ? 'active' : 'deactivate' ?>" href="/inventory"><li class="nav-item">Inventory</li></a>
        </div>

        <div class="bottom-menu">
            <a class="link <?= urlIs('/logout') ? 'active' : 'deactivate' ?>" href="/logout"><li class="nav-item">Logout</li></a>
        </div>
    </ul>
</div>

<?php

?>
