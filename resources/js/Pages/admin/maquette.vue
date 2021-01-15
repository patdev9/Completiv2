<template>
<div class="flex h-screen bg-gray-100 font-sans">
 <nav class="bg-black pt-2 md:pt-1 pb-1 px-1 mt-0 h-auto fixed w-full z-20 top-0">

        <div class="flex flex-wrap items-center">
            <div class="flex flex-shrink md:w-1/3 justify-center md:justify-start text-white">
                <a href="#">
                    <img src="../../../../public/img/LOGO-imie.jpg" alt="Logo Imie" class="w-13">
                </a>
            </div>
            <div class="flex flex-1 md:w-1/3 justify-center md:justify-start text-white px-2">
                <span class="relative w-full">
                    <input type="search" placeholder="Rechercher" class="w-full bg-gray-900 text-white transition border border-transparent focus:outline-none focus:border-gray-400 rounded py-3 px-2 pl-10 appearance-none leading-normal">
                    <div class="absolute search-icon" style="top: 1rem; left: .8rem;">
                        <svg class="fill-current pointer-events-none text-white w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path>
                        </svg>
                    </div>
                </span>
            </div>
            <div class="flex w-full pt-2 content-center justify-between md:w-1/3 md:justify-end">
                <div class="flex items-center px-4">
                     <div class="mr-3">
                            <div class="font-medium text-base text-white">{{ $page.user.name }}</div>
                            <div class="font-medium text-sm text-white">{{ $page.user.email }}</div>
                        </div>
                        <div class="flex-shrink-0">
                            <img class="h-10 w-10 rounded-full" :src="$page.user.profile_photo_url" :alt="$page.user.name" />
                        </div>
                    </div>
            </div>
        </div>
    </nav>
  <div id="" class="h-screen w-16 menu blue text-white px-4 flex nunito shadow relative hover-trigger">

        <ul class="list-reset ">
            <li class="  mt-80">
                <a href="#" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-indigo-400">
                    <i class="text-2xl fas fa-home fa-fw"></i>
                </a>
            </li>
            <li class="my-2 md:my-0">
                <a href="#" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-indigo-400">
                    <i class="text-2xl far fa-id-badge pr-1 ml-1"></i>
                </a>
            </li>
            <li class="my-2 md:my-0">
                <a href="#" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-indigo-400">
                    <i class="text-2xl far fa-calendar-alt"></i>
                </a>
            </li>
            <li class="my-2 md:my-0">
                <a href="#" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-indigo-400">
                    <i class="text-2xl fas fa-chart-area fa-fw mr-3"></i>
                </a>
            </li>
            <li class="my-2 md:my-0">
                <a href="#" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-indigo-400">
                    <i class="text-2xl fa fa-wallet fa-fw mr-3"></i>
                </a>
            </li>
        </ul>
         <div  class="fixed h-screen w-40 shadow menu bg-white border flex nunito items-center mt-4 border-grey-100 ml-12 hover-target">
    <ul class="list-reset  ">
            <li class="my-3  mt-80">
                <a href="#" class=" py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
                   <span class="w-full inline-block pb-1 md:pb-0 text-sm">Home</span>
                </a>
            </li>
            <li class="my-2  ">
                <a href="#" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
                    <span class="w-full inline-block pb-1 md:pb-0 text-sm">Tasks</span>
                </a>
            </li>
            <li class="my-2 md:my-0">
                <a href="#" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
                <span class="w-full inline-block pb-1 md:pb-0 text-sm">Messages</span>
                </a>
            </li>
            <li class="my-2 md:my-0">
                <a href="#" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
                   <span class="w-full inline-block pb-1 md:pb-0 text-sm">Analytics</span>
                </a>
            </li>
            <li class="my-2 md:my-0">
                <a href="#" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
                    <span class="w-full inline-block pb-1 md:pb-0 text-sm">Payments</span>
                </a>
            </li>
        </ul>
  </div>
    </div>
   

    </div>
</template>

<script>
export default {

}
</script>

<style>
.blue{
    background-color: #00a1eb;
}
        .nunito {
            font-family: 'nunito', font-sans;
        }
        
        .border-b-1 {
            border-bottom-width: 1px;
        }
        
        .border-l-1 {
            border-left-width: 1px;
        }
        
        hover\:border-none:hover {
            border-style: none;
        }
        
        #sidebar {
            transition: ease-in-out all .3s;
            z-index: 9999;
        }
        
        #sidebar span {
            opacity: 0;
            position: absolute;
            transition: ease-in-out all .1s;
        }
        
        #sidebar:hover {
            width: 200px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            background-color: white;
        }
        
        #sidebar:hover span {
            opacity: 1;
        }
        .hover-trigger .hover-target {
    display: none;
}

.hover-trigger:hover .hover-target {
    display: block;
}
    </style>