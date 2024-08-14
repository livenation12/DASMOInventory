<aside class="bg-gradient-to-br from-gray-800 to-gray-900 -translate-x-80 fixed inset-0 z-50 my-3 ml-4 h-[calc(100vh-32px)] w-72 rounded-xl transition-transform duration-300 xl:translate-x-0">
   <div class="relative border-b border-white/20">
      <a class="flex items-center gap-4 py-1 px-4" href="<?= ROOT ?>home">
         <img src="<?= ROOT ?>assets/icon.png" width="80px" alt="DASMO">
         <h6 class="block antialiased tracking-normal font-sans text-base font-semibold leading-relaxed text-white">DASMO Inventory</h6>
      </a>
      <button class="middle none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-8 max-w-[32px] h-8 max-h-[32px] rounded-lg text-xs text-white hover:bg-white/10 active:bg-white/30 absolute right-0 top-0 grid rounded-br-none rounded-tl-none xl:hidden" type="button">
         <span class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" aria-hidden="true" class="h-5 w-5 text-white">
               <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
         </span>
      </button>
   </div>
   <div class="m-4">
      <ul class="mb-4 flex flex-col gap-1">
         <li>
            <a aria-current="page" href="<?= ROOT ?>home">
               <button class="middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg text-white capitalize gap-4 px-4 w-full flex items-center
                                                  <?= getActiveTab() === 'home' ? 'bg-gradient-to-tr from-blue-600 to-blue-400 shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/40 active:opacity-[0.85]' : '' ?>" type="button">
                  <i class="fa-solid fa-gauge"></i>
                  <p class="block antialiased font-sans text-base leading-relaxed text-inherit font-medium capitalize">dashboard</p>
               </button>
            </a>
         </li>
         <li>
            <a class="" href="<?= ROOT ?>inventory">
               <button class="middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg text-white hover:bg-white/10 active:bg-white/30 w-full flex items-center gap-4 px-4 capitalize
                                                     <?= getActiveTab() === 'inventory' ? 'bg-gradient-to-tr from-blue-600 to-blue-400 shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/40 active:opacity-[0.85]' : '' ?>" type="button">
                  <i class="fa-solid fa-warehouse"></i>
                  <p class="block antialiased font-sans text-base leading-relaxed text-inherit font-medium capitalize">inventory</p>
               </button>
            </a>
         </li>
         <li>
            <a class="" href="<?= ROOT ?>transactions">
               <button class="middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg text-white hover:bg-white/10 active:bg-white/30 w-full flex items-center gap-4 px-4 capitalize
                                                     <?= getActiveTab() === 'transactions' ? 'bg-gradient-to-tr from-blue-600 to-blue-400 shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/40 active:opacity-[0.85]' : '' ?>" type="button">
                  <i class="fa-solid fa-arrow-right-arrow-left"></i>
                  <p class="block antialiased font-sans text-base leading-relaxed text-inherit font-medium capitalize">transactions</p>
               </button>
            </a>
         </li>
      </ul>
   </div>
   <div class="absolute bottom-0">
      <p class="p-4 font-sans text-sm font-italic text-white"><i class="fa-solid fa-user-circle mx-2"></i><?= Auth::getFullname() ?></p>
   </div>
</aside>