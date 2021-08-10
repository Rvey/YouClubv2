<template>
    <div class="fixed bottom-0 right-0 left-0  h-20 flex items-center bg-white md:hidden ">
      <div class="flex  w-full justify-center">
        <ul class="w-full flex justify-around items-center text-4xl list-none p-0 ">
          <li class="">
            <router-link to="/" class="active"><i class='bx bx-home shadow-xl' ></i></router-link>
          </li>
          <li>
            <router-link to="/Dashboard">
            <i class='bx bxs-dashboard text-gray-700 '>
              </i></router-link>
          </li>
          <li class="p-4 bg-gray-400 rounded-full">
            <router-link to="/Community">
            <img src="@/assets/logo.svg" class="w-14 h-14  mb-20  " alt="" srcset="" />
            </router-link>
          </li>
          <li>
            <router-link to="/Login"><i class='bx bx-user-circle text-gray-700' ></i></router-link>
          </li>

          <li>
            <i class='bx bx-log-in-circle text-gray-700 ' @click.prevent="logout()"></i>
          </li>
        </ul>
      </div>
    </div>
</template>