
<li class="nav-item">
    <a class="nav-link" href="{{route('index')}}" >Главная</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{route('about')}}" >О проекте</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{route('news.index')}}" >Новости</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{route('news.category.index')}}" >Категории новостей</a>
</li>
@if(\Auth::check())
<li class="nav-item">
    <a class="nav-link" href="{{route('home')}}" >Account</a>
</li>
<li class="nav-item @if(!\Auth::user()->isAdmin) visually-hidden @endif">
    <a class="nav-link" href="{{route('admin.index')}}" >Админ панель</a>
</li>
@endif
