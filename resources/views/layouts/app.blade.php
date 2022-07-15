<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>PNB Repositories</title>
</head>
<body class="font-nunito bg-[#EEEFF3]">
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
            <nav class="hidden lg:text-gray-500 lg:tracking-wide lg:font-semibold lg:text-sm lg:space-x-4 lg:flex">
              <a href="/about" class="block h-16 leading-[4rem] border-b-4 border-transparent hover:text-slate-800 hover:border-blue-600">
                Beranda
              </a>
              <a href="/news" class="block h-16 leading-[4rem] border-b-4 border-transparent hover:border-blue-600">
                Repositori
              </a>
              <a href="/products" class="block h-16 leading-[4rem] border-b-4 border-transparent hover:border-blue-600">
                Favorite
              </a>
              <div class="py-5">
                <a href="" class="bg-blue-600 px-3 py-1 font-extrabold text-white rounded-md">Akunku</a>
              </div>
            </nav>
          </div>
        </div>
      </header>

      @yield('contents')
</body>
</html>