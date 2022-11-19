<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);
        $adminStock = Role::create(['name' => 'admin-stock']);
        $adminTransport = Role::create(['name' => 'admin-transport']);
        $picker = Role::create(['name' => 'picker']);
        $checker = Role::create(['name' => 'checker']);
        $asp = Role::create(['name' => 'asp']);
        $planner = Role::create(['name' => 'planner']);
        $main = Role::create(['name' => 'main']);
        $project = Role::create(['name' => 'project']);


        $roleManagement = Permission::create(['name' => 'role-management']);
        $userManagement = Permission::create(['name' => 'user-management']);
        $itemManagement = Permission::create(['name' => 'item-management']);
        $warehouseManagement = Permission::create(['name' => 'warehouse-management']);
        $inventoryManagement = Permission::create(['name' => 'inventory-management']);
        $supplierManagement = Permission::create(['name' => 'supplier-management']);
        $transferStockManagement = Permission::create(['name' => 'transfer-stock-management']);
        $logisticManagement = Permission::create(['name' => 'logistic-management']);
        $purchaseOrderManagement = Permission::create(['name' => 'purchase-order-management']);
        $negresManagement = Permission::create(['name' => 'negres-management']);
        $materialRequestManagement = Permission::create(['name' => 'material-request-management']);
        $pickingFormManagement = Permission::create(['name' => 'picking-form-management']);

        // admin
        $admin->givePermissionTo($roleManagement);
        $admin->givePermissionTo($userManagement);
        $admin->givePermissionTo($itemManagement);
        $admin->givePermissionTo($warehouseManagement);
        $admin->givePermissionTo($inventoryManagement);
        $admin->givePermissionTo($supplierManagement);
        $admin->givePermissionTo($transferStockManagement);
        $admin->givePermissionTo($logisticManagement);
        $admin->givePermissionTo($purchaseOrderManagement);
        $admin->givePermissionTo($materialRequestManagement);
        $admin->givePermissionTo($pickingFormManagement);
        $admin->givePermissionTo($negresManagement);

        // user
        $user->givePermissionTo($inventoryManagement);

        // admin stock
        $adminStock->givePermissionTo($inventoryManagement);

        // admin transport
        $adminTransport->givePermissionTo($transferStockManagement);
        $adminTransport->givePermissionTo($pickingFormManagement);

        // picker
        $picker->givePermissionTo($transferStockManagement);
        $picker->givePermissionTo($pickingFormManagement);

        // checker
        $checker->givePermissionTo($transferStockManagement);
        $checker->givePermissionTo($pickingFormManagement);

        // asp
        $asp->givePermissionTo($transferStockManagement);
        $asp->givePermissionTo($pickingFormManagement);

        // planner
        $planner->givePermissionTo($warehouseManagement);
        $planner->givePermissionTo($inventoryManagement);
        $planner->givePermissionTo($transferStockManagement);
        $planner->givePermissionTo($materialRequestManagement);
        $planner->givePermissionTo($pickingFormManagement);

        // main
        $main->givePermissionTo($roleManagement);
        $main->givePermissionTo($userManagement);
        $main->givePermissionTo($itemManagement);
        $main->givePermissionTo($warehouseManagement);
        $main->givePermissionTo($inventoryManagement);
        $main->givePermissionTo($supplierManagement);
        $main->givePermissionTo($transferStockManagement);
        $main->givePermissionTo($logisticManagement);
        $main->givePermissionTo($purchaseOrderManagement);
        $main->givePermissionTo($negresManagement);
        $main->givePermissionTo($materialRequestManagement);

        // project
        $project->givePermissionTo($warehouseManagement);
        $project->givePermissionTo($inventoryManagement);
        $project->givePermissionTo($transferStockManagement);
        $project->givePermissionTo($purchaseOrderManagement);
        $project->givePermissionTo($negresManagement);
        $project->givePermissionTo($materialRequestManagement);
        $project->givePermissionTo($pickingFormManagement);
    }
}