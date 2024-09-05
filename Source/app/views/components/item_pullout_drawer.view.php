<!-- drawer component -->
<div id="pullOutForm" class="fixed top-0 right-0 z-50 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-[500px]" tabindex="-1" aria-labelledby="drawer-right-label">
          <h5 id="drawer-right-label" class="inline-flex items-center mb-4 text-black font-semibold">
                    <i class="fa-solid fa-arrows-turn-right me-2"></i> Pull Out Form
          </h5>
          <button type="button" data-drawer-hide="pullOutForm" aria-controls="pullOutForm" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <i class="fa-solid fa-x"></i>
                    <span class="sr-only">Close menu</span>
          </button>
          <hr>
          <div class="border-b border-gray-200 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="pullout-type-tab" data-tabs-toggle="#pullout-type-tab-content" data-tabs-active-classes="text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500" data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700" role="tablist">
                              <li class="me-2" role="presentation">
                                        <button class="inline-block p-4 border-b-2 rounded-t-lg" id="permanent-tab" data-tabs-target="#permanent-form" type="button" role="tab" aria-controls="permanent" aria-selected="false">Permanent</button>
                              </li>
                              <li class="me-2" role="presentation">
                                        <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="temporary-tab" data-tabs-target="#temporary-form" type="button" role="tab" aria-controls="temporary" aria-selected="false">Temporary</button>
                              </li>
                    </ul>
          </div>
          <div id="pullout-type-tab-content">
                    <div class="hidden p-4 rounded-lg bg-gray-50" id="permanent-form" role="tabpanel" aria-labelledby="temporary-tab">
                              <form enctype="multipart/form-data" id="permanentPullOutForm" method="post" class="flex flex-col gap-4 p-2">
                                        <input type="hidden" name="csrfToken" value="<?= escape($csrfToken); ?>">
                                        <input type="hidden" name="itemId" value="<?= escape($details->itemId); ?>">
                                        <div>
                                                  <label for="type" class="soft-label">Type</label>
                                                  <input readonly type="text" name="pullOutType" id="pullOutType" value="Permanent" class="soft-input" />
                                        </div>
                                        <div>
                                                  <label for="puller" class="soft-label">Name</label>
                                                  <input required type="text" name="puller" id="puller" class="soft-input" />
                                        </div>
                                        <div>
                                                  <label for="fromLocation" class="soft-label">From</label>
                                                  <input readonly value="<?= escape($details->designation); ?>" type="text" name="fromLocation" id="fromLocation" class="soft-input" />
                                        </div>
                                        <div>
                                                  <label for="toLocation" class="soft-label">To</label>
                                                  <input required type="text" name="toLocation" id="toLocation" class="soft-input" />
                                        </div>
                                        <div>
                                                  <label class="soft-label" for="attachment">Upload attachment</label>
                                                  <input name="attachment" class="soft-file rounded-lg" id="attachment" type="file">
                                        </div>

                                        <button type="submit" class="btn-primary bg-blue-500">Pull Out</button>
                              </form>
                    </div>
                    <div class="hidden p-4 rounded-lg bg-gray-50" id="temporary-form" role="tabpanel" aria-labelledby="temporary-tab">
                              <form enctype="multipart/form-data" id="temporaryPullOutForm" method="post" class="flex flex-col gap-4 p-2">
                                        <input type="hidden" name="csrfToken" value="<?= escape($csrfToken); ?>">
                                        <input type="hidden" name="itemId" value="<?= escape($details->itemId); ?>">

                                        <div>
                                                  <label for="pullOutType" class="soft-label">Type</label>
                                                  <input readonly type="text" name="pullOutType" id="pullOutType" value="Temporary" class="soft-input" />
                                        </div>
                                        <div>
                                                  <label for="puller" class="soft-label">Name</label>
                                                  <input required type="text" name="puller" id="puller" class="soft-input" />
                                        </div>
                                        <div>
                                                  <label for="fromLocation" class="soft-label">From</label>
                                                  <input readonly value="<?= escape($details->designation); ?>" type="text" name="fromLocation" id="fromLocation" class="soft-input" />
                                        </div>
                                        <div>
                                                  <label for="toLocation" class="soft-label">To</label>
                                                  <input required type="text" name="toLocation" id="toLocation" class="soft-input" />
                                        </div>
                                        <div>
                                                  <label for="returnDate" class="soft-label">Return Date</label>
                                                  <input required type="datetime-local" name="returnDate" id="returnDate" class="soft-input" />
                                        </div>
                                        <div>
                                                  <label class="soft-label" for="attachment">Upload attachment</label>
                                                  <input name="attachment" class="soft-file rounded-lg" id="attachment" type="file">
                                        </div>
                                        <button type="submit" class="btn-primary bg-blue-500">Pull Out</button>
                              </form>
                    </div>
          </div>

</div>
<script src="<?= JS ?>items/pullout.js"></script>