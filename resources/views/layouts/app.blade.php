<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>PNB Repositories</title>
</head>
<body class="font-nunito bg-[#EEEFF3] text-[#333333]">
    <header class="border-b  border-gray-100  bg-white">
        <div class="flex items-center justify-between w-[95%] mx-auto h-16 max-w-screen-2xl sm:px-6 lg:px-8">
          <div class="flex items-center">
            <button type="button" class="p-2 sm:mr-4 lg:hidden">
              <svg
                class="w-6 h-6"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16"
                />
              </svg>
            </button>
      
            <a href="" class="flex">
              <img class="h-8" src="{{asset('img/icon/icon.svg')}}" alt="">
            </a>
          </div>
      
          <div class="flex items-center justify-end flex-1">
            <nav class="hidden lg:text-gray-500 lg:tracking-wide lg:font-semibold lg:text-base lg:space-x-6 lg:flex">
              <a href="/home" class="block h-16 mx-2 leading-[4rem] border-b-4 border-transparent opacity-50 hover:opacity-100 hover:border-blue-600 duration-300">
                Beranda
              </a>
              <a href="{{ route('repository.index')}}" class="block h-16 mx-2 leading-[4rem] border-b-4 border-transparent opacity-50 hover:opacity-100 hover:border-blue-600 duration-300">
                Repositori
              </a>
              <a href="/Favorite" class="block h-16 mx-2 leading-[4rem] border-b-4 border-transparent opacity-50 hover:opacity-100 hover:border-blue-600 duration-300">
                Favorite
              </a>
              <div class="py-5">
                <button id="dropdownDividerButton" data-dropdown-toggle="dropdownDivider"  class="bg-blue-600 px-3 py-1 font-extrabold text-white rounded-md">Akunku</button>
              </div>
            </nav>
          </div>
        </div>
      </header>

<!-- Dropdown menu -->
<div id="dropdownDivider" class="hidden z-10 w-32 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(289px, 70px);">
    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDividerButton">
      <li>
        <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Profile</a>
      </li>
      <li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
          <button type="submit" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Logout</button>
        </form>
      </li>
    </ul>
</div>


      @yield('contents')
      <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>

</body>
</html>