<div class="my-2">
    <h3 class="text-3xl font-bold">Transactions Masterlist</h3>
    <div class="datatable-wrapper shadow-xl border ">
        <div class="flex justify-end items-center mx-3">
            <div class="space-x-2 italic">
                <span class="text-blue-500"><i class="fa-solid fa-circle-dot animate-pulse me-1"></i>Completed</span>
                <span class="text-yellow-500 "><i class="fa-solid fa-circle-dot animate-pulse me-1"></i>Pending</span>
            </div>
        </div>
        <table id="transactionsTable" class="datatable">
            <thead>
                <tr>
                    <th></th>
                    <th>QUANTITY</th>
                    <th>DESCRIPTION</th>
                    <th>PROPERTY NUMBER</th>
                    <th>SERIAL NUMBER</th>
                    <th>LOCATION FROM</th>
                    <th>LOCATION TO</th>
                    <th>END USER</th>
                    <th>STATUS</th>
                    <th>PULLOUT</th>
                    <th>RETURNED</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>


<?php $this->view("dependencies/datatable") ?>