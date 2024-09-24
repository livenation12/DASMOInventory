<div class="datatable-wrapper w-full">
    <div class="flex justify-end items-center mx-3">
        <div class="space-x-2 italic">
            <span class="text-blue-500"><i class="fa-solid fa-circle-dot animate-pulse me-1"></i>Available</span>
            <span class="text-red-500"><i class="fa-solid fa-circle-dot animate-pulse me-1"></i>Borrowed</span>
        </div>
    </div>
    <table id="inventoryTable" class="datatable">
        <thead>
            <tr>
                <th></th>
                <th>QUANTITY</th>
                <th>DESCRIPTION</th>
                <th>PROPERTY NUMBER</th>
                <th>SERIAL NUMBER</th>
                <th>DESIGNATION</th>
                <th class="hidden">END USER</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <!-- Data will be injected here by DataTable -->
        </tbody>
    </table>
</div>

<?php $this->view("dependencies/datatable") ?>