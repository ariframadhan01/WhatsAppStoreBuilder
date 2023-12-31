<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Store;
use App\Models\Template;
use App\Models\Utility;
use App\Models\UserStore;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrPermissions = [
            [
                "name" => "Manage Dashboard",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ], [
                "name" => "Manage Store Analytics",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Manage User",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Create User",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Edit User",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Delete User",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Manage Role",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Create Role",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Delete Role",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Edit Role",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Manage Orders",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Show Orders",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Delete Orders",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Manage Products",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Create Products",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Delete Products",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Show Products",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Edit Products",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Create Variants",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Edit Variants",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Delete Variants",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Manage Product category",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Create Product category",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Delete Product category",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Edit Product category",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Manage Product Tax",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Create Product Tax",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],

            [
                "name" => "Delete Product Tax",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Edit Product Tax",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],

            [
                "name" => "Manage Product Coupan",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Create Product Coupan",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Show Product Coupan",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Delete Product Coupan",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Edit Product Coupan",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],

            [
                "name" => "Manage Location",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Create Location",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Delete Location",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Edit Location",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Manage Shipping",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Create Shipping",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Delete Shipping",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Edit Shipping",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Manage Customers",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Show Customers",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Manage Settings",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Manage Change Store",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Manage Language",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Create Language",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Delete Language",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Manage Store",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Create Store",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Delete Store",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Edit Store",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Reset Password",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Manage Email Template",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
        ];
        Permission::insert($arrPermissions);
        $ownerRole        = Role::create(
            [
                'name' => 'Owner',
                'created_by' => 0,
                'store_id' => 1,
            ]
        );
        $ownerPermissions = [
            ["name" => "Manage Dashboard"],

            ["name" => "Manage Store Analytics"],

            ["name" => "Manage Role"],
            ["name" => "Create Role"],
            ["name" => "Delete Role"],
            ["name" => "Edit Role"],

            ["name" => "Manage User"],
            ["name" => "Create User"],
            ["name" => "Delete User"],
            ["name" => "Edit User"],

            ["name" => "Reset Password"],
            ["name" => "Manage Orders"],
            ["name" => "Show Orders"],
            ["name" => "Delete Orders"],

            ["name" => "Manage Products"],
            ["name" => "Create Products"],
            ["name" => "Show Products"],
            ["name" => "Delete Products"],
            ["name" => "Edit Products"],

            ["name" => "Manage Product category"],
            ["name" => "Create Product category"],
            ["name" => "Delete Product category"],
            ["name" => "Edit Product category"],

            ["name" => "Create Variants"],
            ["name" => "Edit Variants"],
            ["name" => "Delete Variants"],

            ["name" => "Manage Product Tax"],
            ["name" => "Create Product Tax"],
            ["name" => "Delete Product Tax"],
            ["name" => "Edit Product Tax"],

            ["name" => "Manage Product Coupan"],
            ["name" => "Create Product Coupan"],
            ["name" => "Show Product Coupan"],
            ["name" => "Delete Product Coupan"],
            ["name" => "Edit Product Coupan"],

            ["name" => "Manage Location"],
            ["name" => "Create Location"],
            ["name" => "Delete Location"],
            ["name" => "Edit Location"],

            ["name" => "Manage Shipping"],
            ["name" => "Create Shipping"],
            ["name" => "Delete Shipping"],
            ["name" => "Edit Shipping"],

            ["name" => "Manage Customers"],
            ["name" => "Show Customers"],

            ["name" => "Manage Settings"],

            ["name" => "Create Store"],
            ["name" => "Manage Store"],
            ["name" => "Manage Change Store"],

            ["name" => "Manage Language"],
            ["name" => "Create Language"],
            ["name" => "Delete Language"],

            ["name" => "Manage Email Template"],
        ];
        $ownerRole->givePermissionTo($ownerPermissions);

        $admin = User::create(
            [
                'name' => 'Owner',
                'email' => 'owner@example.com',
                'email_verified_at' => date("Y-m-d H:i:s"),
                'password' => Hash::make('1234'),
                'type' => 'Owner',
                'lang' => 'en',
                'created_by' => 0,
            ]
        );
        $admin->assignRole($ownerRole);
        $objStore             = Store::create(
            [
                'name' => 'My WhatsStore',
                'email' => 'owner@example.com',
                'created_by' => $admin->id,
                'tagline' => 'WhatsStore',
                'enable_storelink' => 'on',
                'content' => 'Hi,
Welcome to {store_name},
Your order is confirmed & your order no. is {order_no}
Your order detail is:
Name : {customer_name}
Address : {billing_address} , {shipping_address}
~~~~~~~~~~~~~~~~
{item_variable}
~~~~~~~~~~~~~~~~
Qty Total : {qty_total}
Sub Total : {sub_total}
Discount Price : {discount_amount}
Shipping Price : {shipping_amount}
Tax : {item_tax}
Total : {item_total}
~~~~~~~~~~~~~~~~~~
To collect the order you need to show the receipt at the counter.
Thanks {store_name}',
                'item_variable' => '{sku} : {quantity} x {product_name} - {variant_name} + {item_tax} = {item_total}',
                'store_theme' => 'theme7-v1',
                'theme_dir' => 'theme7',
                'address' => 'india',
                'whatsapp' => '#',
                'facebook' => '#',
                'instagram' => '#',
                'twitter' => '#',
                'youtube' => '#',
                'footer_note' => '© 2020 WhatsStore. All rights reserved',
                'logo' => 'logo.png',
            ]
        );
        $admin->current_store = $objStore->id;
        $admin->save();

        UserStore::create(
            [
                'user_id' => $admin->id,
                'store_id' => $objStore->id,
                'permission' => 'Owner',
            ]
        );

        Utility::defaultEmail();
        Utility::userDefaultData();

        $data = [
            ['name' => 'local_storage_validation', 'value' => 'jpg,jpeg,png,xlsx,xls,csv,pdf', 'created_by' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'wasabi_storage_validation', 'value' => 'jpg,jpeg,png,xlsx,xls,csv,pdf', 'created_by' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 's3_storage_validation', 'value' => 'jpg,jpeg,png,xlsx,xls,csv,pdf', 'created_by' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'local_storage_max_upload_size', 'value' => 2048000, 'created_by' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'wasabi_max_upload_size', 'value' => 2048000, 'created_by' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 's3_max_upload_size', 'value' => 2048000, 'created_by' => 1, 'created_at' => now(), 'updated_at' => now()]
        ];
        DB::table('settings')->insert($data);

        $template = [
            [
                'template_name' => 'name',
                'prompt' => '"Create creative product names:  ##description## \n\nSeed words: ##keywords## \n\n" in comma seprate and no number',
                'module' => 'products',
                'field_json' => '{"field":[{"label":"Seed words","placeholder":"e.g.  fast, healthy, compact","field_type":"text_box","field_name":"keywords"},{"label":"Product Description","placeholder":"e.g. Provide product details","field_type":"textarea","field_name":"description"}]}',
                'is_tone' => '0',
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                'template_name' => 'description',
                'prompt' => 'Write a long creative product description for: ##title##',
                'module' => 'products',
                'field_json' => '{"field":[{"label":"Product name","placeholder":"e.g. VR, Honda","field_type":"text_box","field_name":"title"},{"label":"Audience","placeholder":"e.g. Women, Aliens","field_type":"text_box","field_name":"audience"},{"label":"Product Description","placeholder":"e.g. VR is an innovative device that can allow you to be part of virtual world","field_type":"textarea","field_name":"description"}]}',
                'is_tone' => '1',
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
            ],
            [
                'template_name' => 'name',
                'prompt' => 'give catchy only name of category  for : ##keywords##  without icon or emojis',
                'module' => 'products_category',
                'field_json' => '{"field":[{"label":"Seed words","placeholder":"e.g.  fast, healthy, compact","field_type":"text_box","field_name":"keywords"}]}',
                'is_tone' => '0',
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
            ],
            [
                'template_name' => 'name',
                'prompt' => 'give 1 catchy only name of Offer or discount Coupon  for : ##keywords## ',
                'module' => 'products_coupon',
                'field_json' => '{"field":[{"label":"Seed words","placeholder":"e.g.  fast, healthy, compact","field_type":"text_box","field_name":"keywords"}]}',
                'is_tone' => '0',
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
            ],
            [
                'template_name' => 'name',
                'prompt' => 'I am starting a #### shipping service and need a unique name that reflects style, efficiency, and reliability. Can you help me come up with some creative options?',
                'module' => 'products_shipping',
                'field_json' => '{"field":[{"label":"What do want to ship? ","placeholder":"e.g.  Cloth, Electronics,","field_type":"text_box","field_name":"keywords"}]}',
                'is_tone' => '0',
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
            ],
            [
                'template_name' => 'name',
                'prompt' => 'please suggest subscription plan  name  for this  :  ##description##  for my business',
                'module' => 'plan',
                'field_json' => '{"field":[{"label":"What is your plan about?","placeholder":"e.g. Describe your plan details ","field_type":"textarea","field_name":"description"}]}',
                'is_tone' => '0',
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
            ],
            [
                'template_name' => 'description',
                'prompt' => 'please suggest subscription plan  description  for this  :  "##title##\n\nTone of generated text must be:\n ##tone_language## \n\n  for my business',
                'module' => 'plan',
                'field_json' => '{"field":[{"label":"What is your plan title?","placeholder":"e.g. Pro Resller,Exclusive Access","field_type":"text_box","field_name":"title"}]}',
                'is_tone' => '1',
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
            ],
            [
                'template_name' => 'cookie_title',
                'prompt' => 'please suggest me cookie title for this ##description## website   which i can use in my website cookie',
                'module' => 'cookie',
                'field_json' => '{"field":[{"label":"Website name or info","placeholder":"e.g. example website ","field_type":"textarea","field_name":"title"}]}',
                'is_tone' => '0',
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
            ],
            [
                'template_name' => 'strictly_cookie_title',
                'prompt' => 'please suggest me only Strictly Cookie Title for this ##description##  website which i can use in my website cookie',
                'module' => 'cookie',
                'field_json' => '{"field":[{"label":"Website name or info","placeholder":"e.g. example website ","field_type":"textarea","field_name":"title"}]}',
                'is_tone' => '0',
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
            ],
            [
                'template_name' => 'cookie_description',
                'prompt' => 'please suggest me  Cookie description for this cookie title "##title##"\n\nTone of generated text must be:\n ##tone_language## \n\n   which i can use in my website cookie',
                'module' => 'cookie',
                'field_json' => '{"field":[{"label":"Cookie Title ","placeholder":"e.g. example website ","field_type":"text_box","field_name":"title"}]}',
                'is_tone' => '1',
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
            ],
            [
                'template_name' => 'strictly_cookie_description',
                'prompt' => 'please suggest me Strictly Cookie description for this Strictly cookie title "##title## "\n\nTone of generated text must be:\n ##tone_language## \n\n   which i can use in my website cookie',
                'module' => 'cookie',
                'field_json' => '{"field":[{"label":"Strictly Cookie Title ","placeholder":"e.g. example website ","field_type":"text_box","field_name":"title"}]}',
                'is_tone' => '1',
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
            ],
            [
                'template_name' => 'more_information_description',
                'prompt' => 'I need assistance in crafting compelling content for my ##web_name##\n\nTone of generated text must be:\n ##tone_language## \n\n website Contact Us page of my website. The page should provide relevant information to users, encourage them to reach out for inquiries, support, and feedback, and reflect the unique value proposition of my business.',
                'module' => 'cookie',
                'field_json' => '{"field":[{"label":"Websit Name","placeholder":"e.g. example website ","field_type":"text_box","field_name":"web_name"}]}',
                'is_tone' => '1',
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
            ],
            [
                'template_name' => 'metadesc',
                'prompt' => '"Write SEO meta description for:\n\n ##description## \n\nWebsite name is:\n ##title## \n\nSeed words:\n ##keywords## \n\nTone of generated text must be:\n ##tone_language## \n\n"',
                'module' => 'seo_setting',
                'field_json' => '{"field":[{"label":"Website Name","placeholder":"e.g. Amazon, Google","field_type":"text_box","field_name":"title"},{"label":"Website Description","placeholder":"e.g. Describe what your website or business do","field_type":"textarea","field_name":"description"},{"label":"Keywords","placeholder":"e.g.  cloud services, databases","field_type":"text_box","field_name":"keywords"}]}',
                'is_tone' => '1',
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
            ],
            [
                'template_name' => 'metakeyword',
                'prompt' => '"Write SEO meta title for:\n\n ##description## \n\nWebsite name is:\n ##title## \n\nSeed words:\n ##keywords## \n\n"',
                'module' => 'seo_setting',
                'field_json' => '{"field":[{"label":"Website Name","placeholder":"e.g. Amazon, Google","field_type":"text_box","field_name":"title"},{"label":"Website Description","placeholder":"e.g. Describe what your website or business do","field_type":"textarea","field_name":"description"},{"label":"Keywords","placeholder":"e.g.  cloud services, databases","field_type":"text_box","field_name":"keywords"}]}',
                'is_tone' => '0',
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
            ],
            [
                'template_name' => 'store_name',
                'prompt' => '"Create creative Store names: ##description## \n\nSeed words: ##keywords## \n\n"',
                'module' => 'store',
                'field_json' => '{"field":[{"label":"Seed words","placeholder":"e.g.  Store","field_type":"text_box","field_name":"keywords"},{"label":"Store Description","placeholder":"e.g. Store product details","field_type":"textarea","field_name":"description"}]}',
                'is_tone' => '0',
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
            ]
        ];
        Template::insert($template);
        Utility::languagecreate();
    }
}
