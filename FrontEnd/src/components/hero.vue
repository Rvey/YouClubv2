<template>
    <div class="hero">
      <div class="content">
        <div class="textbox space-y-6">
          <h3 class="text-7xl">Meet</h3>
          <h2 > <span>You</span>Club </h2>
          <p class="text-gray-700 text-lg">A platform for sharing content and engage with others</p>
            <div class=" hover:translate-x-5">
            <div class="bg-black"></div>
           <button type="submit" class=" hover:bg-blue-600 hover:text-white transition-all ease-linear  px-6 py-4 bg-white m-7 rounded-lg hover:drop-shadow-xl  font-semibold  leading-tight">Learn More</button>
            </div>
        </div>

    </div>
 
  </div>
    <section class=" text-gray-200 bg-gray-900">
      <div class="max-w-6xl mx-auto px-5 py-24 ">
        <div class="flex flex-wrap w-full mb-20 flex-col items-center text-center">
          <h1 class=" title-font  text-4xl font-extrabold leading-10 tracking-tight text-left sm:text-5xl sm:leading-none md:text-6xl mb-24">Meet YouClub</h1>
          <p class="lg:w-1/2 w-full leading-relaxed text-base">
            YouClub, a solution for exchanging and sharing information between learners with the possibility for everyone to access , ,share , interact with topics and resources easily  

          </p>
        </div>
        <div class="flex flex-wrap -m-4">
          <div class="w-full p-4">
            <div class="border border-gray-300 p-6 rounded-lg">
              <div class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-4">
             <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon" style="width: 2em; height: 2em;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1"><path d="M298.667 213.333v85.334H896v-85.334M298.667 554.667H896v-85.334H298.667m0 341.334H896v-85.334H298.667m-128-14.08c-31.574 0-56.747 25.6-56.747 56.747s25.6 56.747 56.747 56.747c31.146 0 56.746-25.6 56.746-56.747s-25.173-56.747-56.746-56.747m0-519.253c-35.414 0-64 28.587-64 64s28.586 64 64 64c35.413 0 64-28.587 64-64s-28.587-64-64-64m0 256c-35.414 0-64 28.587-64 64s28.586 64 64 64c35.413 0 64-28.587 64-64s-28.587-64-64-64z"/></svg>
              </div>
              <h2 class="text-lg text-gray-100 font-medium title-font mb-2">Rich editor</h2>
              <p class="leading-relaxed text-base">Rich editor enables content contributors easily create and publish HTML anywhere</p>
              
            

            </div>
          </div>

          <div class="w-full p-4">
            <div class="border border-gray-300 p-6 rounded-lg ">
              <div class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-4 italic ">
                <span class="font-bold text-sm ">
                Svg
                </span>
              </div>
              <h2 class="text-lg text-gray-100 font-medium title-font mb-2">all in one place</h2>
              <p class="leading-relaxed text-base w-full">Discover topics and people and interact with them all in one place no more wasted posts and time</p>

          
            </div>
          </div>
          <div class="w-full p-4">
            <div class="border border-gray-300 p-6 rounded-lg">
              <div class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-4">
                 <span class="font-bold text-sm ">
                Svg
                </span>
              </div>
              <h2 class="text-lg text-gray-100 font-medium title-font mb-2">by people like you</h2>                                                
              <p class="leading-relaxed text-base">a variety of articles by YouCoders all in one place </p>
              
              

            </div>
          </div>
        </div>
      </div>
    </section>
<div class="min-w-screen pt-46 bg-gray-800 flex items-center justify-center px-5 py-5">
    <div class="bg-indigo-600 text-white rounded shadow-xl py-5 px-5 w-full lg:w-10/12 xl:w-3/4" x-data="{welcomeMessageShow:true}" x-show="welcomeMessageShow" x-transition:enter="transition-all ease duration-500 transform" x-transition:enter-start="opacity-0 scale-110" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition-all ease duration-500 transform" x-transition:leave-end="opacity-0 scale-90">
        <div class="flex flex-wrap -mx-3 items-center">
            <div class="w-1/4 px-3 text-center hidden md:block ">


                <div class="p-5 xl:px-8 md:py-5">
               
                  <lottie-player src="https://assets7.lottiefiles.com/packages/lf20_bpqri9y8.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop  autoplay></lottie-player>
                </div>


            </div>
            <div class="w-full sm:w-1/2 md:w-2/4 px-3 text-left">
                <div class="p-5 xl:px-8 md:py-5 ml-7">
                    <h3 class="text-2xl">Hi 👋</h3>
                    <h5 class="text-xl mb-3"></h5>
                    <p class="text-md font-medium text-indigo-200 ">Create account or Discover the community it's all yours</p>
                </div>
            </div>
            <div class="w-full sm:w-1/2 md:w-1/4 px-3 text-center">
                <div class="p-5 xl:px-8 md:py-5">
                    <router-link class="block w-full py-3 px-4 rounded text-indigo-600 bg-gray-200 hover:bg-white hover:text-gray-900 focus:outline-none transition duration-150 ease-in-out mb-3" to="/Login" target="_blank">Join Us</router-link>


                    <router-link class=" block w-full py-3 px-4 rounded text-white bg-indigo-900 hover:bg-gray-900 focus:outline-none transition duration-150 ease-in-out" to="/Community" >COMMUNITY</router-link>
                </div>
            </div>
        </div>
    </div>
</div>

<div class=" bg-gray-900 p-4 text-white text-xs w-full text-center">
   Created with a half brain 
</div>
  
</template>
<script>
export default {

  setup() {
    
  },
}
</script>