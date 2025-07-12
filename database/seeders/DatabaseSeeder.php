<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Member;
use App\Models\Tag;
use App\Models\TagDetail;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $admin_name = 'Vo Vi Khang';
        Member::query()->create([
            'name' => $admin_name,
            'phone' => '0799599040',
            'slug' => Str::slug($admin_name),
            'birthday' => '2003-02-04',
            'gender' => '0',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('241200ka', [
                'rounds' => 12,
            ])
        ]);

        Tag::insert([
            [
                'id' => 1,
                'name' => 'core cpu',
                'slug' => Str::slug('core cpu'),
                'created_at' => '2025-07-11 09:07:21',
                'updated_at' => '2025-07-11 09:07:21',
            ],
            [
                'id' => 2,
                'name' => 'Kích thước màn hình',
                'slug' => Str::slug('Kích thước màn hình'),
                'created_at' => '2025-07-11 11:28:21',
                'updated_at' => '2025-07-11 11:28:21',
            ],
            [
                'id' => 3,
                'name' => 'Card đồ hoạ rời',
                'slug' => Str::slug('Card đồ hoạ rời'),
                'created_at' => '2025-07-11 11:28:38',
                'updated_at' => '2025-07-11 11:29:33',
            ],
            [
                'id' => 4,
                'name' => 'Độ phân giải màn hình',
                'slug' => Str::slug('Độ phân giải màn hình'),
                'created_at' => '2025-07-11 11:29:24',
                'updated_at' => '2025-07-11 11:29:24',
            ],
            [
                'id' => 5,
                'name' => 'Nhu cầu',
                'slug' => Str::slug('Nhu cầu'),
                'created_at' => '2025-07-11 15:41:18',
                'updated_at' => '2025-07-11 15:41:18',
            ],
            [
                'id' => 6,
                'name' => 'Dung lượng Ram',
                'slug' => Str::slug('Dung lượng Ram'),
                'created_at' => '2025-07-11 15:41:47',
                'updated_at' => '2025-07-11 15:41:47',
            ],
            [
                'id' => 7,
                'name' => 'Dung lượng SSD',
                'slug' => Str::slug('Dung lượng SSD'),
                'created_at' => '2025-07-11 15:41:56',
                'updated_at' => '2025-07-11 15:41:56',
            ],
        ]);

        TagDetail::insert([
            // tag_id = 1 (Dòng chip)
            ['tag_id' => 1, 'name' => 'Apple M1', 'slug' => 'apple-m1'],
            ['tag_id' => 1, 'name' => 'Apple M2', 'slug' => 'apple-m2'],
            ['tag_id' => 1, 'name' => 'Apple M3', 'slug' => 'apple-m3'],
            ['tag_id' => 1, 'name' => 'Apple M4', 'slug' => 'apple-m4'],
            ['tag_id' => 1, 'name' => 'Intel Core Ultra 5', 'slug' => 'intel-core-ultra-5'],
            ['tag_id' => 1, 'name' => 'Intel Core Ultra 7', 'slug' => 'intel-core-ultra-7'],
            ['tag_id' => 1, 'name' => 'Intel Core Ultra 9', 'slug' => 'intel-core-ultra-9'],
            ['tag_id' => 1, 'name' => 'Intel Core i3', 'slug' => 'intel-core-i3'],
            ['tag_id' => 1, 'name' => 'Intel Core i5', 'slug' => 'intel-core-i5'],
            ['tag_id' => 1, 'name' => 'Intel Core i7', 'slug' => 'intel-core-i7'],
            ['tag_id' => 1, 'name' => 'Intel Core i9', 'slug' => 'intel-core-i9'],
            ['tag_id' => 1, 'name' => 'Qualcomm', 'slug' => 'qualcomm'],
            ['tag_id' => 1, 'name' => 'Snapdragon', 'slug' => 'snapdragon'],
            ['tag_id' => 1, 'name' => 'AMD Ryzen 5', 'slug' => 'amd-ryzen-5'],
            ['tag_id' => 1, 'name' => 'AMD Ryzen 7', 'slug' => 'amd-ryzen-7'],
            ['tag_id' => 1, 'name' => 'AMD Ryzen 9', 'slug' => 'amd-ryzen-9'],

            // tag_id = 2 (Kích thước màn hình)
            ['tag_id' => 2, 'name' => 'Khoảng 13 inch', 'slug' => 'khoang-13-inch'],
            ['tag_id' => 2, 'name' => 'Khoảng 14 inch', 'slug' => 'khoang-14-inch'],
            ['tag_id' => 2, 'name' => 'Trên 15 inch', 'slug' => 'tren-15-inch'],

            // tag_id = 3 (Card đồ hoạ)
            ['tag_id' => 3, 'name' => 'NVIDIA Geforce Series', 'slug' => 'nvdia-geforce-series'],
            ['tag_id' => 3, 'name' => 'Card Onboard', 'slug' => 'card-onboard'],
            ['tag_id' => 3, 'name' => 'AMD Radeon Series', 'slug' => 'amd-radeon-series'],


            // tag_id = 4 (Độ phân giải màn hình)
            ['tag_id' => 4, 'name' => 'HD', 'slug' => 'hd'],
            ['tag_id' => 4, 'name' => 'Full HD', 'slug' => 'full-hd'],
            ['tag_id' => 4, 'name' => '2K', 'slug' => '2k'],
            ['tag_id' => 4, 'name' => '2.8K', 'slug' => '28k'],
            ['tag_id' => 4, 'name' => '3K', 'slug' => '3k'],
            ['tag_id' => 4, 'name' => '3.2K', 'slug' => '32k'],

            // tag_id = 5 (Nhu cầu sử dụng)
            ['tag_id' => 5, 'name' => 'Văn Phòng', 'slug' => 'van-phong'],
            ['tag_id' => 5, 'name' => 'Gamming', 'slug' => 'gamming'],
            ['tag_id' => 5, 'name' => 'Đồ hoạ - Kỹ thuật', 'slug' => 'do-hoa-ky-thuat'],
            ['tag_id' => 5, 'name' => 'Học sinh - Sinh Viên', 'slug' => 'hoc-sinh-sinh-vien'],
            ['tag_id' => 5, 'name' => 'Mỏng nhẹ', 'slug' => 'mong-nhe'],

            // tag_id = 6 (RAM)
            ['tag_id' => 6, 'name' => '8 GB', 'slug' => '8-gb'],
            ['tag_id' => 6, 'name' => '12 GB', 'slug' => '12-gb'],
            ['tag_id' => 6, 'name' => '16 GB', 'slug' => '16-gb'],
            ['tag_id' => 6, 'name' => '24 GB', 'slug' => '24-gb'],
            ['tag_id' => 6, 'name' => '32 GB', 'slug' => '32-gb'],
            ['tag_id' => 6, 'name' => '48 GB', 'slug' => '48-gb'],
            ['tag_id' => 6, 'name' => '64 GB', 'slug' => '64-gb'],
            ['tag_id' => 6, 'name' => '96 GB', 'slug' => '96-gb'],
            ['tag_id' => 6, 'name' => '128 GB', 'slug' => '128-gb'],

            // tag_id = 7 (SSD)
            ['tag_id' => 7, 'name' => '256 GB', 'slug' => '256-gb'],
            ['tag_id' => 7, 'name' => '512 GB', 'slug' => '512-gb'],
            ['tag_id' => 7, 'name' => '1TB', 'slug' => '1tb'],
            ['tag_id' => 7, 'name' => '2TB', 'slug' => '2tb'],
            ['tag_id' => 7, 'name' => '3TB', 'slug' => '3tb'],
            ['tag_id' => 7, 'name' => '4TB', 'slug' => '4tb'],
            ['tag_id' => 7, 'name' => '6TB', 'slug' => '6tb'],
            ['tag_id' => 7, 'name' => '8TB', 'slug' => '8tb'],
        ]);

        Brand::insert([
            [
                'id' => 1,
                'name' => 'Lenovo',
                'slug' => 'lenovo',
                'logo' => 'thumbnail_6871c154d3833.webp',
                'country' => 'ádfasdf',
                'website_link' => 'sadfasdf',
                'status' => 0,
                'created_at' => '2025-07-11 09:09:03',
                'updated_at' => '2025-07-12 08:58:44',
            ],
            [
                'id' => 2,
                'name' => 'MSI',
                'slug' => 'msi',
                'logo' => 'thumbnail_6871c168b2ba1.webp',
                'country' => 'ưeadsf',
                'website_link' => 'ádfasd',
                'status' => 0,
                'created_at' => '2025-07-11 09:09:21',
                'updated_at' => '2025-07-12 08:59:04',
            ],
            [
                'id' => 3,
                'name' => 'Apple',
                'slug' => 'apple',
                'logo' => 'thumbnail_6871c0997f6d2.webp',
                'country' => 'sdafsad',
                'website_link' => 'sadfdsa',
                'status' => 0,
                'created_at' => '2025-07-12 08:54:53',
                'updated_at' => '2025-07-12 08:55:37',
            ],
            [
                'id' => 4,
                'name' => 'Acer',
                'slug' => 'acer',
                'logo' => 'thumbnail_6871c0f694917.webp',
                'country' => 'sasdf',
                'website_link' => 'asdf',
                'status' => 0,
                'created_at' => '2025-07-12 08:57:10',
                'updated_at' => '2025-07-12 08:57:10',
            ],
            [
                'id' => 5,
                'name' => 'HP',
                'slug' => 'hp',
                'logo' => 'thumbnail_6871c149714d8.webp',
                'country' => 'asdf',
                'website_link' => 'asdf',
                'status' => 0,
                'created_at' => '2025-07-12 08:58:33',
                'updated_at' => '2025-07-12 08:58:33',
            ],
            [
                'id' => 6,
                'name' => 'Asus',
                'slug' => 'asus',
                'logo' => 'thumbnail_6871c17e2550e.webp',
                'country' => 'asdf',
                'website_link' => 'asdf',
                'status' => 0,
                'created_at' => '2025-07-12 08:59:26',
                'updated_at' => '2025-07-12 08:59:26',
            ],
            [
                'id' => 7,
                'name' => 'Dell',
                'slug' => 'dell',
                'logo' => 'thumbnail_6871c18ee2c09.webp',
                'country' => 'asdf',
                'website_link' => 'adsf',
                'status' => 0,
                'created_at' => '2025-07-12 08:59:42',
                'updated_at' => '2025-07-12 08:59:42',
            ],
            [
                'id' => 8,
                'name' => 'Gigabyte',
                'slug' => 'gigabyte',
                'logo' => 'thumbnail_6871c1ad69845.webp',
                'country' => 'adsf',
                'website_link' => 'dasf',
                'status' => 0,
                'created_at' => '2025-07-12 09:00:13',
                'updated_at' => '2025-07-12 09:00:13',
            ],
        ]);
    }
}
