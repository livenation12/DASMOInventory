<!-- drawer component -->

<div id="itemUpdate" class="fixed top-0 right-0 z-50 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-[500px] dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-right-label">
          <h5 id="drawer-right-label" class="inline-flex items-center mb-4 text-base font-semibold text-gray-100">
                    <i class="fa-solid fa-arrows-turn-right me-2"></i> Update Form
          </h5>
          <button type="button" data-drawer-hide="itemUpdate" aria-controls="itemUpdate" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <i class="fa-solid fa-x"></i>
                    <span class="sr-only">Close menu</span>
          </button>
          <hr />
          <form id="updateItemForm" method="post" class="flex flex-col gap-4 my-2 p-2">
                    <input type="hidden" name="csrfToken" value="<?= escape($csrfToken); ?>">
                    <input type="hidden" name="itemId" value="<?= escape($details->itemId); ?>">
                    <div>
                              <p class="text-white text-sm my-2">Description</p>
                              <div class="flex gap-x-2">
                                        <input value="<?= $details->assetType ?>" placeholder="Asset type" required type="text" name="assetType" id="assetType" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                        <input value="<?= $details->brand ?>" placeholder="Brand" required type="text" name="brand" id="brand" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                              </div>
                    </div>
                    <div>
                              <label for="propNumber" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Propery number</label>
                              <input value="<?= $details->propNumber ?>" type="text" name="propNumber" id="propNumber" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                    </div>
                    <div>
                              <label for="serialNumber" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Serial Number</label>
                              <input value="<?= $details->serialNumber ?>" type="text" name="serialNumber" id="serialNumber" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                    </div>
                    <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choose quantity:</label>
                    <div class="relative flex items-center max-w-[8rem]">
                              <button type="button" id="decrement-button" data-input-counter-decrement="quantity" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                        <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                        </svg>
                              </button>
                              <input value="<?= $details->quantity ?>" type="text" id="quantity" data-input-counter aria-describedby="helper-text-explanation" class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="999" required />
                              <button type="button" id="increment-button" data-input-counter-increment="quantity" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                        <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                        </svg>
                              </button>
                    </div>
                    <div>
                              <label for="designation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Designation</label>
                              <input value="<?= $details->designation ?>" required type="text" name="designation" id="designation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                    </div>
                    <div>
                              <label for="endUser" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End User</label>
                              <input value="<?= $details->endUser ?>" type="text" name="endUser" id="endUser" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                    </div>
                    <button id="updateSubmitBtn" type="submit" disabled class="disabled:bg-gray-500 bg-blue-500 text-sm rounded-lg py-3 text-white">Update Item</button>
          </form>
</div>


<script src="<?= JS ?>items/update.js"></script>