<nav>
    <div class="nav-link">
        <h3>TOKO LKS</h3>
        <?php
            $home = '';
            $products = '';
            $profile = '';
            $transaction = '';
        ?>
        @if(isset(Auth::user()->nama_lengkap))
            <?php
                $home = url('/');
                $products = url('/#products');
                $profile = url('profile');
                $transaction = url('transaction');
            ?>
        @elseif(isset(Auth::user()->nama))
            <?php
                $home = url('admin');
                $products = url('admin/#products');
                $profile = url('admin/profile');
                $transaction = url('admin/transaction');
            ?>
        @endif
        <a href="{{ $home }}" class="@if(request()->is('')) selected @elseif(request()->is('admin')) selected @endif">Home</a>
        <a href="{{ $products }}">Products</a>
        <a href="{{ $transaction }}" class="@if(request()->is('transaction')) selected @elseif(request()->is('admin/transaction')) selected @endif">Transaction</a>
        <form action="{{ $products }}" method="GET">
            <input type="text" placeholder="Search" name="keyword">
            <input type="submit" value="Search" class="search">
        </form>
    </div>
    <div class="nav-right">
        @if(isset(Auth::user()->nama_lengkap))
            <a href="{{ $profile }}">{{ Auth::user()->nama_lengkap }}</a>
        @elseif(isset(Auth::user()->nama))
            <a href="{{ $profile }}">{{ Auth::user()->nama }}</a>
        @endif
    </div>
</nav>
